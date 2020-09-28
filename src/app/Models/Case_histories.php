<?php
namespace Models;

use \Utils\Identity;
use \Exceptions\HTTPException;

class Case_histories extends \Models\Base\Case_histories
{

  public $castDepth = [
    'patient' => [
      '*' => 0
    ],
    'treatments' => 0
  ];


  public static function listAll($offset, $limit, $filters = null, $opts = [])
  {
    $model = new self;
    $metadata = $model->app->get('METADATAPROVIDER');

    $query = '`' . $model->table . '`.`deleted` <> 1 AND `patient` IS NOT null';
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

    $fields = self::field();

    //normal props
    $model->copyfrom($payload, $fields);

    if($payload['patient'] && !empty($payload['patient']['id'])){
      $model->patient = $payload['patient']['id'];
    }else{
      $patient = Patients::create($payload['patient']);
      $model->patient = $patient['id'];      
    }
    //normal sanity checks
    $mandatoryFields = ['patient'];

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

    $fields = self::field();
    
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

  public static function listWithTreatment($filters = null)
  {
    $model = new self;
    $metadata = $model->app->get('METADATAPROVIDER');

    $query = '`' . $model->table . '`.`deleted` <> 1 AND `patient` IS NOT null';
    $bindings = [];
    $results = [];
    $qobj = self::filteredQuery($filters, $query, $bindings, $model->table);

    $results = $model->find($qobj, ['offset' => 0, 'limit' => 100, 'order' => '`' . $model->table . '`.`modified` DESC']);
    $results = empty($results) ? [] : $results->castAll($model->castDepth);

    $newr = array_filter($results, function ($item){
      return !is_null($item['treatments']);
    });
    
    $result = [];
    foreach($newr as $item){
      array_push($result, $item);
    }
    $metadata->setTotal(count($result));
    return $result;
  }
  
  public static function field()
  {
    return [
      'patient',
      'built', 'constitution', 'diathesis', 'miasm', 'temperament',
      'temperature_and_weather', 'thermal_sensitivity', 'sensation',
      'tendency_take_cold', 'desires', 'aversions', 'birth_history_milestones',
      'tissues', 'stages_and_states', 'attacks_and_side', 'ailments_from',
      'affections', 'clinical', 'modalities', 'mental_state_and_disorders',
      'appearance_and_behavior', 'attention_and_concentration', 'expression',
      'consciousness', 'mood_and_affect', 'memory', 'speech',
      'thoughts_and_ideas', 'perception', 'intelligence', 'judgment',
      'fear_and_live_alone', 'boring', 'peaceful', 'anger', 'hobby',
      'habit', 'addiction', 'nutrition', 'anaemia', 'cyanosis',
      'dehydration', 'jaundice', 'pulse', 'breathing', 'peculiar_rare_symptoms',
      'head', 'skull_cranium', 'brain_and_nerves', 'vertigo', 'headache',
      'hair', 'face_and_jaws', 'eyes', 'organs', 'sight', 'ears', 'hearing',
      'nose', 'smell', 'septum', 'mouth', 'tongue', 'taste', 'teeth', 'gums',
      'm_m', 'lips', 'saliva', 'throat', 'tonsills', 'uvula', 'external',
      'internal', 'thirst', 'hunger', 'appetite', 'oesophagus', 'stomach',
      'abdomen', 'epigastrium', 'hpyochondrium', 'umbilical_region',
      'lumbar_region', 'liver', 'gallbladder', 'pancreas', 'spleen',
      'hypogastrium', 'iliac_region', 'inguinal_region', 'intestine',
      'anus_and_rectum', 'stools', 'urinary_system', 'quantity', 'color',
      'sediment', 'befor', 'during', 'after', 'kidneys', 'ureters',
      'bladder', 'urethra', 'male_genital', 'mgo_desires', 'powers',
      'emission', 'female_genital', 'fgo_organs', 'mensruation',
      'leucorrhoea', 'pregnancy', 'respiratory_system', 'respi_organs',
      'respi_breathing', 'lymphatic_system', 'endocrine_disorders',
      'hormones', 'chest', 'sternum', 'ribs', 'circulatory_system',
      'hearts_movements', 'sacrum_back_spine', 'vertibra', 'nape',
      'scapula', 'shoulders', 'axilla', 'extrimities', 'hips', 'pelvis',
      'buttocks', 'all_over_the_body', 'bones', 'joints', 'muscles', 'skin',
      'sleep', 'dreams', 'fever_chill_heat_sweat', 'intolerable', 'ameliarable',
      'vission', 'smelling', 'neck_and_back', 'digestion', 'heart', 'lungs',
      'relationship',
    ];
  }

}
