<?php
namespace Models;

use \Utils\Identity;
use \Exceptions\HTTPException;

class Remedies extends \Models\Base\Remedies
{

  public $castDepth = null;


  public static function listAll($offset, $limit, $filters = null, $opts = [])
  {
    $model = new self;
    $metadata = $model->app->get('METADATAPROVIDER');

    $query = '`' . $model->table . '`.`deleted` <> 1';
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


  public static function put($payload)
  {

    //

    return self::listAll(0, 1000, null, []);
  }

  public static function getOne($id, $internal = false)
  {
      $model = new self;
      $identity = $model->app->get('IDENTITY');

      $model->load([$model->primary . ' = ? AND `deleted` <> 1', $id]);


      if(!$model->dry()){
        return $internal ? $model : $model->cast(null, $model->castDepth);
      }

      throw new HTTPException('Not Found.', 404);
    }


}
