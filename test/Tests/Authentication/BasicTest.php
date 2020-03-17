<?php
namespace Tests\Authentication;

class BasicTest extends \Tests\TestBase{

    /**
     * List of tests
     * ================
     * [x] Invalid auth request should contain Invalid username error
     * [x] Valid auth request should not contain Invalid username error
     * [x] Valid auth request returns right user
     * [x] trying to login with wrong login type should fail
     * [x] passwords are not returned with user data
     * [x] An ApiKey is generated for successful logins
     *
     */

    function before(){

      //clear the DB
      $this->resetDatabase();


      $data = [
        'User' => [
          [
            'name' => 'testAdmin',
            'username' => 'testAdmin',
            'password' => 'password1',
            'role' => \Utils\Identity::CONTEXT_SUPER_ADMIN ,
            'deleted' => 0,
          ]
        ]
      ];

      $this->fillData($data);

      $this->app->set('DEBUG', 0);
      $this->app->set('HIGHLIGHT', false);
    }

    function after(){

    }

    function testInvalidLogin(){
      $response = $this->mockException([
        'url'        => 'POST /v1/auth',
        'data' => [
          'username' => 'xxx',
          'password' => 'xxx'
         ]
      ]);

      $this->test->expect(
        $this->contains($response, 'Invalid username'),
        "Invalid auth request should contain Invalid username error"
      );

    }

    function testValidLogin(){
      $response = $this->mockRequest([
        'url'        => 'POST /v1/auth',
        'data' => [
          'username' => 'testAdmin',
          'password' => 'password1',
          'login_type' => \Utils\Identity::CONTEXT_SUPER_ADMIN
         ]
      ]);

      $this->test->expect(
        $response['records']['id'] == '1',
        "Valid auth request returns right user"
      );

      $this->test->expect(
        empty($response['records']['password']),
        "Passwords are not returned with user data"
      );

      $apiKey = new \Models\Apikey;
      $apiKey->load(['`key` = ?', $response['records']['key']]);
      if(!$apiKey->dry()){
        $this->test->expect(
          ($apiKey->user->id == $response['records']['id']),
          "An ApiKey is generated for successful logins"
        );
      }else{
        $this->test->expect(
          (0 == 1), //fail this on purpose
          "An ApiKey is generated for successful logins, model is dry()"
        );
      }
    }

}