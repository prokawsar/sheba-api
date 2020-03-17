<?php
namespace Models;

use \Utils\Identity;
use \Exceptions\HTTPException;

class Settings extends \Models\Base\Settings
{

  public $castDepth = null;

  private static $cache = [];

  public static function listAll($offset, $limit, $filters = null, $opts = [])
  {
    $model = new self;
    $metadata = $model->app->get('METADATAPROVIDER');

    $query = '`' . $model->table . '`.`name` IS NOT null';
    $bindings = [];
    $results = [];
    $total = 0;

    $qobj = self::filteredQuery($filters, $query, $bindings, $model->table);

    //count how many rows total
    $total = $model->count($qobj);
    $results = $model->find($qobj, ['offset' => $offset, 'limit' => $limit, 'order' => '`' . $model->table . '`.`id` ASC']);

       //assign that total to METADATAPROVIDER
    $metadata->setTotal($total);




    return empty($results) ? [] : $results->castAll($model->castDepth);
  }


  public static function put($data)
  {

    foreach ($data as $payload) {
      $model = new self;
      $model->load(['id = ?', $payload['id']]);

      if ($model->dry()) {
        throw new HTTPException(
          'Bad Request.',
          400,
          array(
            'dev' => 'All required fields may not have been filled in',
            'internalCode' => '',
            'more' => '',
          )
        );
      }

      if(isset($payload['value'])) {
        $model->value = $payload['value'];
      }

      $model->save();
    }

    return self::listAll(0, 1000, null, []);
  }

  public static function getOne($name)
  {
    $model = new self;
    $setting = $model->load(['name = ?', $name]);

    if(!$model->dry()) {
      return $model->cast(null, 0);
    }

    throw new HTTPException(
      'Bad Request.',
      400,
      array(
        'dev' => 'Setting does not exist'
      )
    );
  }

  public static function getSetting($name)
  {

    if (!isset(self::$cache[$name])) {
      $value = null;
      $model = new self;
      $model->load(['name = ?', $name]);
      if (!$model->dry()) {
        $value = $model->value;
      }

      self::$cache[$name] = $value;

    }

    return self::$cache[$name];
  }

}
