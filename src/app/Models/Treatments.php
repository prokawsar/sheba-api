<?php
namespace Models;

use \Utils\Identity;
use \Exceptions\HTTPException;

class Treatments extends \Models\Base\Treatments
{

  public $castDepth = [
    'patient' => [
      '*' => 0
    ],
  ];


  public static function listAll($offset, $limit, $filters = null, $opts = [])
  {
    $model = new self;
    $metadata = $model->app->get('METADATAPROVIDER');

    $query = '`' . $model->table . '`.`deleted` <> 1 AND `case_history` IS NOT null';
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

  public static function create($payload)
  {
    $model = new self;
    $identity = $model->app->get('IDENTITY');

    $fields = ['case_history', 'patient', 'remedy', 'notes',
      'taking_rule', 'power'
    ];

    //normal props
    $model->copyfrom($payload, $fields);

    //normal sanity checks
    $mandatoryFields = [];

    $valid = self::checkMandatoryFields($model, $mandatoryFields);
    $valid = true;

    if ($valid) {
      $model->save();
      return $model->cast(null, $model->castDepth);
    }

    throw new HTTPException('Bad Request.', 400, [
      'dev' => 'All required fields may not have been filled in',
      'internalCode' => '',
      'more' => '',
    ]);
  }


  public static function put($id, $payload)
  {
    $model = new self;
    $valid = true;

    $existing = self::getOne($id, true);

    $fields = [ 'remedy', 'notes', 'taking_rule', 'power' ];
    //normal props
    $existing->copyfrom($payload, $fields);

    //normal sanity checks
    $mandatoryFields = [];

    $valid = self::checkMandatoryFields($existing, $mandatoryFields);

    if ($valid) {
      $existing->save();
      return $existing->cast(null, $model->castDepth);
    }

    throw new HTTPException('Bad Request.', 400, array(
        'dev' => 'All required fields may not have been filled in',
        'internalCode' => '',
        'more' => '',
      )
    );
  }

  public static function getOne($id, $internal = false)
  {
      $model = new self;
      $model->load([$model->primary . ' = ? AND `deleted` <> 1', $id]);

      if(!$model->dry()){
        return $internal ? $model : $model->cast(null, $model->castDepth);
      }
      throw new HTTPException('Not Found.', 404);
  }

  public static function create_with_case($payload)
  {

    if($payload['case']){
      $case_history = Case_histories::create($payload['case']);
    }else if($payload['prescribe']){
      $case_history['id'] = $payload['prescribe']['id'];
      $case_history['patient']['id'] = $payload['prescribe']['patient'];

    }

    if($payload['data'] && is_array($payload['data'])){

      self::deleteAllTodaysRecord($case_history['id']);

      foreach($payload['data'] as $treatment){
        $treatment["case_history"] = $case_history['id'];
        $treatment["patient"] = $case_history['patient']['id'];
        self::create($treatment);
      }
    }

    return ['message' => 'Created Successfully'];

  }

  public static function deleteAllTodaysRecord($case_id)
  {
    \Base::instance()->get('DB')->exec(
      'DELETE FROM `treatments` WHERE `case_history` = ' . $case_id . ' AND DATE(`created`) = CURDATE()'
    );

  }

}
