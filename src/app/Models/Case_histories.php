<?php
namespace Models;

use \Utils\Identity;
use \Exceptions\HTTPException;

class Case_histories extends \Models\Base\Case_histories
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
      'patient', 'face', 'mind', 'built', 'hair', 'tongue', 'pulse', 'breathing',

      'anaemia', 'cyanosis', 'dehydration', 'jaundice', 'skin',
      'sensation', 'temperature_and_weather', 'thermals', 'susceptibility',
      'bathing', 'vision', 'hearing', 'smelling', 'taste', 'thirst', 'appetite', 'hunger',
      'desires', 'aversions', 'intolerable', 'ameliorable', 'indigestion', 'eructation',
      'nausia', 'vomiting', 'sweating_perspiration', 'sleep', 'dreams', 'discharges', 'stools',
      'urine', 'menstruation', 'leucorrhoea', 'habit', 'hobby', 'addicted', 'birth_history',
      'milestones', 'mood_and_affect', 'speech', 'thought', 'attention_and_concentration',
      'consciousness', 'appearance_and_behavior', 'memory', 'intelligency', 'judgement',
      'insight', 'temperament', 'alone_and_darkness', 'frightness', 'constitution',
      'diathesis', 'miasm', 'ailments_from', 'attacks_and_time', 'side', 'past_medical_history',
      'family_medical_history', 'rare_peculiar_symptoms'

    ];

    //normal props
    $model->copyfrom($payload, $fields);

    //normal sanity checks
    $mandatoryFields = ['mind'];

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

    $fields = [
      'patient', 'face', 'mind', 'built', 'hair', 'tongue', 'pulse', 'breathing',

      'anaemia', 'cyanosis', 'dehydration', 'jaundice', 'skin',
      'sensation', 'temperature_and_weather', 'thermals', 'susceptibility',
      'bathing', 'vision', 'hearing', 'smelling', 'taste', 'thirst', 'appetite', 'hunger',
      'desires', 'aversions', 'intolerable', 'ameliorable', 'indigestion', 'eructation',
      'nausia', 'vomiting', 'sweating_perspiration', 'sleep', 'dreams', 'discharges', 'stools',
      'urine', 'menstruation', 'leucorrhoea', 'habit', 'hobby', 'addicted', 'birth_history',
      'milestones', 'mood_and_affect', 'speech', 'thought', 'attention_and_concentration',
      'consciousness', 'appearance_and_behavior', 'memory', 'intelligency', 'judgement',
      'insight', 'temperament', 'alone_and_darkness', 'frightness', 'constitution',
      'diathesis', 'miasm', 'ailments_from', 'attacks_and_time', 'side', 'past_medical_history',
      'family_medical_history', 'rare_peculiar_symptoms'
    ];
    //normal props
    $existing->copyfrom($payload, $fields);

    //normal sanity checks
    $mandatoryFields = ['mind'];

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
