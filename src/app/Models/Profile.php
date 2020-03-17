<?php
  namespace Models;

  use \Utils\Identity;
  use \Exceptions\HTTPException;
  use \Models\User;

  class Profile extends \Models\Base\User
  {
    public static function getOne($internal = false)
    {
      $model = new \Models\User;
      $identity = $model->app->get('IDENTITY');

      $model->load([$model->primary . ' = ? AND `deleted` <> 1', $identity->user->id]);

      $castDepth = $model->castDepth;

      if(!$model->dry()){
        return $internal ? $model : $model->cast(null, $castDepth);
      }

      throw new HTTPException('Not Found.', 404);
    }

    public static function put($payload)
    {
      $model = new \Models\User; //base model for user
      $identity = $model->app->get('IDENTITY');
      $model->load([$model->primary . ' = ?', $identity->user->id]);

      $valid = true;

      $fields = [
        'name',
        'surname',
        'username',
        'email',
        'password'
      ];

      if ($model->username != $payload['username']) {
        User::checkDuplicateUsername($payload['username']);
      }

      if($model->password  != md5($model->app->get('SALT') . $payload['password'])){
        $model->should_change_password = 0;
      }

      $model->copyfrom($payload, $fields);

      $mandatoryFields = ['name', 'username'];

      $valid = self::checkMandatoryFields($model, $mandatoryFields);

      $castDepth = $model->castDepth;

      if ($valid) {
        $model->save();
        return $model->cast(null, $castDepth);
      }

      throw new HTTPException(
          'Bad Request.',
          400,
          array(
              'dev'          => 'All required fields may not have been filled in',
              'internalCode' => '',
              'more'         => '',
          )
      );
    }

    public static function uploadAvatar()
    {
        $model = new \Models\User;
        $identity = $model->app->get('IDENTITY');

        $existing = static::getOne($identity->user->id);

        $folder = $model->app->get('CONFIG')['FOLDERS']['avatars'];

        $fileModel = \Models\File::createFromUpload($folder, null, function($filePath){
            \Utils\ImageResizer::resize($filePath, 128, 128);
        });

        $existing->avatar = $fileModel->id;
        $existing->save();

        return $existing->cast(null, $existing->castDepth);
    }

    public static function notFound()
    {
      throw new HTTPException('Not Found.', 404);
    }

  }