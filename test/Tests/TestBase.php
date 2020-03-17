<?php
namespace Tests;

class TestBase{

    protected $app;
    protected $test;

    public $passed = 0;
    public $failed = 0;
    public $exceptions = 0;

    function __construct(){
        $this->app = \Base::instance();

        //less verbose errors in console
        $this->app->set('DEBUG', 0);
        $this->app->set('HIGHLIGHT', false);
    }

    function before(){

    }

    function after(){

    }

    function beforeEach(){

    }

    function afterEach(){

    }

    function run(){
        $class = get_class($this);
        $methods = get_class_methods($class);

        $toRun = [];
        foreach($methods as $meth){
            if(stripos($meth, 'test') === 0){
                $toRun[] = $meth;
            }
        }

        if(count($toRun) > 0){
            $this->before();
            foreach($toRun as $m){
                $this->test = new \Test;
                echo "- ".$m. "\n";
                try{
                  $this->beforeEach();
                  $this->{$m}();
                  $this->afterEach();
                  $this->log();
                  echo "\n";
                }catch(\Exception $ex){
                  $this->op($ex->getMessage(), 'Uncaught Exception', true);
                  $this->exceptions++;
                  echo "\n";
                }
            }
            $this->after();
        }
    }

    function reIdentify($key){
        $this->app->set('HEADERS.Api-Key', $key);
        $this->app->get('IDENTITY')->reIdentify();
    }

    function forgetIdentity(){
        $this->app->get('IDENTITY')->forget();
    }

    function resetDatabase(){

        //need to do this in the right order

        //1. remove views
        foreach ($this->app->get('VIEWS_LIST') as $view) {
            $mdl = "\\DBViews\\" . $view;
            $mdl::setdown();
        }

        //2. remove tables
        foreach ($this->app->get('MODELS_LIST') as $model) {
            $mdl = "\\Models\\Base\\". $model;
            $mdl::setdown();
        }

        //3. recreate tables
        foreach ($this->app->get('MODELS_LIST') as $model) {
            $mdl = "\\Models\\Base\\" . $model;
            $mdl::setup();
        }

        //4. recreate views
        foreach ($this->app->get('VIEWS_LIST') as $view) {
            $mdl = "\\DBViews\\" . $view;
            $mdl::setup();
        }
    }

    function fillData($data,$namespace = "\\Models\\"){
      if(is_array($data)){

        $tally = [];

        foreach($data as $table => $rows){
          $mdl = $namespace.$table;
          foreach($rows as $row){
            $model = new $mdl;
            foreach($row as $field => $value){
              //handle @ pointers
              if($this->startsWith($value, '@')){
                preg_match("/@([^\[]*)\[(\d+)\]/", $value, $matches);
                if(isset($matches[1]) && isset($tally[$matches[1]])){
                  if(isset($matches[2]) && isset($tally[$matches[1]][$matches[2]])){
                    $value = $tally[$matches[1]][$matches[2]];
                  }
                }
              }
              //set field values
              $model->{$field} = $value;
            }
            $model->save();

            //store ids for @ pointers
            $tally[$table][] = $model->id;
          }
        }
      }
    }

    /**
     * setColumnDefaultValue
     *
     * @param
     * expected params:
     * $table_name: required (string or array)
     * $column_name: required (string)
     * $default_value: optional (string or integer) (defaults to 0)
     * $data_type: optional (string) (has default value)
     **/

    function setColumnDefaultValue($table_name, $column_name, $default_value = 0, $data_type = 'TINYINT(1)') {
        foreach ((array) $table_name as $table) {
          $this->app->get('DB')->exec('
              ALTER TABLE `'.$table.'`
              CHANGE COLUMN `'.$column_name.'` `'.$column_name.'` '. $data_type.' NULL DEFAULT "'. $default_value.'" ;
          ');
        }
    }

    function startsWith($haystack, $needle){
        $length = strlen($needle);
        return (substr($haystack, 0, $length) === $needle);
    }

    function endsWith($haystack, $needle){
        $length = strlen($needle);
        if ($length == 0) {
            return true;
        }

        return (substr($haystack, -$length) === $needle);
    }

    function contains($haystack, $needle){
        return strpos($haystack, $needle) !== false;
    }

    function notContains($haystack, $needle){
        return strpos($haystack, $needle) === false;
    }

    function arrayContains($expected, $actual) {
        $return = array();

        foreach ($expected as $key => $val) {
            if (array_key_exists($key, $actual)) {
                if (is_array($val)) {
                    $diff = $this->arrayContains($val, $actual[$key]);
                    if (count($diff)) { $return[$key] = $diff; }
                } else {
                    if ($val != $actual[$key]) {
                        $return[$key] = $val;
                    }
                }
            } else {
                $return[$key] = $val;
            }
        }
        return $return;
    }

    // assertion methods
    function assertEquals($expected, $actual, $message = null){
        $pass = $expected == $actual;
        $message = $pass ? $message : $message . " - expected {$expected}, got {$actual}";

        return $this->test->expect(
            $pass,
            $message
        );
    }

    function assertArrayContains($expected, $actual, $message = null){
        if(!is_array($expected) || !is_array($actual)) {
            throw new \Exception('assertArrayContains expects arrays');
        }

        $diff = $this->arrayContains($expected, $actual);
        $pass = empty($diff);

        $message = $pass
            ? $message
            : $message . sprintf(". Arrays do not match. \nExpected %s\nActual %s", print_r($diff, true), print_r($actual, true));

        return $this->test->expect(
            $pass,
            $message
        );
    }

    function assertArrayNotContains($expected, $actual, $message = null){
        return $this->test->expect(
            array_intersect($expected, $actual) !== $expected,
            $message
        );
    }

    function assertContains($haystack, $needle, $message){
        return $this->test->expect(
            $this->contains($haystack, $needle),
            $message
        );
    }

    function assertNotContains($haystack, $needle, $message){
        return $this->test->expect(
            $this->notContains($haystack, $needle),
            $message
        );
    }

    /**
     * mockException
     *
     * @param array
     * expected array keys:
     * url: required
     * data: optional
     * headers: array of headers (optional)
     * identity: optional
     **/

    function mockException($data = [])
    {

        $ex_message = "";
        try{

          $this->mockRequest($data);

        }catch(\exceptions\HTTPException $ex){
          $ex_message = $ex->getMessage();
        }
        $this->test->expect(
          ($ex_message != '' ),
          "Expected Exception has thrown in this test."
        );

        return $ex_message;
    }

    /**
     * mockRequest
     *
     * @param array
     * expected array keys:
     * url: required
     * data: optional
     * headers: array of headers (optional)
     * identity: optional,
     **/

    function mockRequest($data = [])
    {
      if(!isset($data['url']) || empty($data['url'])){
        throw new \Exception('All required parameters not sent for test');
      }
      if(isset($data['identity'])){
        $this->reIdentify($data['identity']);
      }
      if(isset($data['headers'])) {
        if (is_array($data['headers'])) {
          foreach ($data['headers'] as $key => $value) {
            $this->app->set('HEADERS.'.$key, $value);
          }
        }
      }
      $mockData = [];
      if(isset($data['data'])){
        $mockData = $data['data'];
      }
      $this->app->mock($data['url'], $mockData);
      $response = $this->app->get('APP_RESPONSE');
      return json_decode($response, true);
    }

    function log(){
        foreach ($this->test->results() as $result) {
            $msg = $result['text'];
            if ($result['status']){
                $this->op($msg, 'Pass');
                $this->passed++;
            }else{
                $this->op($msg, 'Fail', true);
                $this->failed++;
            }
            usleep(50000);
        }
    }





    function op($txt, $msg, $err = false){
        if($err){
            echo "  -> \033[1;97;41m " .$msg." \e[0m" . " - $txt\n";
        }else{
            echo "  -> \033[1;97;42m " .$msg." \e[0m" . " - $txt\n";
        }
        ob_flush();
        ob_end_flush();
    }

}