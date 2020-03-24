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

  public static function create($payload)
  {
    $model = new self;
    $identity = $model->app->get('IDENTITY');

    $fields = [
      'name',
      'constitution', 'diathesis', 'miasm', 'temperament',
      'thermals', 'attacks_and_time', 'side', 'temperature_and_weather',
      'ailments_from', 'sensations', 'mind', 'face', 'hair', 'skin', 'built',
      'appetite', 'hunger', 'desires', 'aversions', 'intolerable', 'ameliarable',
      'vission', 'hearing', 'smelling', 'taste', 'tongue', 'thirst', 'sleep',
      'dreams', 'stools', 'urine', 'perspiration', 'nutrition', 'anaemia',
      'cyanosis', 'dehydration', 'jaundice', 'breathing', 'pulse',

      'head', 'eyes', 'nose', 'ears', 'mouth', 'teeth', 'gums', 'throat',
      'tonsills', 'neck_and_back', 'extrimities', 'bones', 'oesophagus', 'stomach',
      'abdomen', 'liver', 'gallbladder', 'pancreas', 'spleen', 'intestine', 'duodenum',
      'digestion', 'chest', 'heart', 'lungs', 'mso_mgo', 'fso_mgo', 'anus_and_rectum',
      'notes', 'modalities', 'clinical'
    ];

    //normal props
    $model->copyfrom($payload, $fields);

    //normal sanity checks
    $mandatoryFields = ['name'];

    $valid = self::checkMandatoryFields($model, $mandatoryFields);

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

    $fields = [
      'name',
      'constitution', 'diathesis', 'miasm', 'temperament',
      'thermals', 'attacks_and_time', 'side', 'temperature_and_weather',
      'ailments_from', 'sensations', 'mind', 'face', 'hair', 'skin', 'built',
      'appetite', 'hunger', 'desires', 'aversions', 'intolerable', 'ameliarable',
      'vission', 'hearing', 'smelling', 'taste', 'tongue', 'thirst', 'sleep',
      'dreams', 'stools', 'urine', 'perspiration', 'nutrition', 'anaemia',
      'cyanosis', 'dehydration', 'jaundice', 'breathing', 'pulse',

      'head', 'eyes', 'nose', 'ears', 'mouth', 'teeth', 'gums', 'throat',
      'tonsills', 'neck_and_back', 'extrimities', 'bones', 'oesophagus', 'stomach',
      'abdomen', 'liver', 'gallbladder', 'pancreas', 'spleen', 'intestine', 'duodenum',
      'digestion', 'chest', 'heart', 'lungs', 'mso_mgo', 'fso_mgo', 'anus_and_rectum',
      'notes', 'modalities', 'clinical'
    ];
    //normal props
    $existing->copyfrom($payload, $fields);

    //normal sanity checks
    $mandatoryFields = ['name'];

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
      $identity = $model->app->get('IDENTITY');

      $model->load([$model->primary . ' = ? AND `deleted` <> 1', $id]);


      if(!$model->dry()){
        return $internal ? $model : $model->cast(null, $model->castDepth);
      }

      throw new HTTPException('Not Found.', 404);
    }


}
