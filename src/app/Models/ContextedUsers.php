<?php
namespace Models;

use \Utils\Identity;
use \Exceptions\HTTPException;
use \Models\Apikey;

class ContextedUsers extends \Models\User
{

  public static function listAll($offset, $limit, $filters = null, $opts = [])
  {
    $model = new self;
    $identity = $model->app->get('IDENTITY');
    $metadata = $model->app->get('METADATAPROVIDER');

    $context = $opts[0];
    $context_id = $opts[1];

    $query = '';


    $results = [];
    $total = 0;

    $qobj = self::filteredQuery($filters, $query, $bindings);

    $total = $model->count($qobj); //this line does a count of how many rows total
    $results = $model->find($qobj, ['offset' => $offset, 'limit' => $limit, 'order' => 'id ASC']);

    $metadata->setTotal($total); //this line assigns that total to METADATAPROVIDER

          //------------------------------

    return empty($results) ? [] : $results->castAll($model->castDepth);
  }

  public static function getOne($id, $internal = false, $opts = [])
  {
    $model = new self;
    $identity = $model->app->get('IDENTITY');

    $context = $opts[0];
    $context_id = $opts[1];


    if (!$model->dry()) {
      return $internal ? $model : $model->cast(null, $model->castDepth);
    }

    throw new HTTPException('Not Found.', 404);
  }

  public static function put($id, $payload, $opts = [])
  {
    $model = new self;

    $valid = true;


    //this ensures you can edit entities that you have permission to see
    $existing = self::getOne($id, true, $opts);


    $fields = [
      'name',
      'email',
      'username',
      'surname',
      'password',
      'role'
    ];

    if($existing->username != $payload['username']){
      self::checkDuplicateUsername($payload['username']);
    }

      //normal props
    $existing->copyfrom($payload, $fields);

      //normal sanity checks
    $mandatoryFields = ['name', 'username', 'password', 'role'];

    $valid = self::checkMandatoryFields($existing, $mandatoryFields);

    if ($valid) {
      $existing->save();
      return $existing->cast(null, $model->castDepth);
    }

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

  public static function create($payload, $opts = [])
  {

    $model = new self;
    $context = $opts[0];
    $context_id = $opts[1];

    $valid = true;

    $fields = [
      'name',
      'email',
      'username',
      'surname',
      'password',
      'role',
    ];

    //Given username does not exist in db
    self::checkDuplicateUsername($payload['username']);

      //normal props
    $model->copyfrom($payload, $fields);

      //normal sanity checks
    $mandatoryFields = ['name', 'username', 'password', 'role'];

    $valid = self::checkMandatoryFields($model, $mandatoryFields);

    if ($context && $valid) {
      $model->save();
      return $model->cast(null, $model->castDepth);
    }

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

  public static function delete($id, $opts = [])
  {
     //this ensures you can delete entities that you have permission to see
    $existing = self::getOne($id, true, $opts);
    Apikey::deactivateAll($id);
    $casted = $existing->cast(null, 0);
    $existing->erase();
    return $casted;
  }

  public static function uploadAvatar($id, $opts = [])
  {
    $model = new self;
    $identity = $model->app->get('IDENTITY');

    $existing = self::getOne($id, true, $opts);

    $folder = $model->app->get('CONFIG')['FOLDERS']['avatars'];

    $fileModel = \Models\File::createFromUpload($folder, null, function ($filePath) {
      \Utils\ImageResizer::resize($filePath, 128, 128);
    });

    $existing->avatar = $fileModel->id;
    $existing->save();

    return $existing->cast(null, $existing->castDepth);
  }

}