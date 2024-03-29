<?php
namespace Models;

use \Utils\Identity;
use \Exceptions\HTTPException;

class Remedies extends \Models\Base\Remedies
{

  public $castDepth = null;
  public static $ignoreCheckForDuplicate = ['id', 'name', 'created', 'modified', 'book_references'];

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
    $results = $model->find($qobj, ['offset' => $offset, 'limit' => $limit, 'order' => '`' . $model->table . '`.`name` ASC']);

    //assign that total to METADATAPROVIDER
    $metadata->setTotal($total);

    return self::returnWithPercentage($model, $results);
    // return empty($results) ? [] : $results->castAll($model->castDepth);
  }

  public static function create($payload)
  {
    $model = new self;
    $identity = $model->app->get('IDENTITY');

    $fields = ['name'];

    //normal props
    $model->copyfrom($payload, $fields);

    //normal sanity checks
    $mandatoryFields = ['name'];

    $valid = self::checkMandatoryFields($model, $mandatoryFields) && self::checkDuplicateName($payload['name']);

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

    self::removeDuplicateValues($payload, $existing);

    $fields = [
      'name', 'built', 'constitution', 'diathesis', 'miasm', 'temperament',
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
      'relationship', 'book_references'
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
      $model->load([$model->primary . ' = ? AND `deleted` <> 1', $id]);

      if(!$model->dry()){
        return $internal ? $model : $model->cast(null, $model->castDepth);
      }

      throw new HTTPException('Not Found.', 404);
  }

  public static function returnWithPercentage($model, $results)
  {
    if(!empty($results)){
      $remedies = $results->castAll($model->castDepth);
      $index = 0;
      foreach($remedies as $remedy){
        $mark = 0;
        foreach ($remedy as $key => $value) {
          if($value){
            $mark++;
          }
        }

        $percentage = ($mark / count($remedy)) * 100;
        $remedies[$index]['total_data_size'] = $percentage;
        $index++;
      }
      return $remedies;
    }else{
      return [];
    }
  }

  public static function checkDuplicateName($name)
  {
      $model = new self;
      $model->load(['name = ? AND deleted <> ?', $name, 1]);

      if (!$model->dry()) {
        throw new HTTPException($name . ' is already in use.', 406);
      } else {
        return true;
      }

  }

  public static function removeDuplicateValues(&$payload, $existing)
  {
    foreach($payload as $key => $value){
      if($value && !in_array($key, self::$ignoreCheckForDuplicate)){
        $value = str_replace(',', ', ', $value );
        $merged_array = array_unique( array_map('trim', explode(', ', $value))  + explode(', ', $existing[$key]) ) ;
        $payload[$key] = implode(', ', $merged_array);
      }
    }

  }
}
