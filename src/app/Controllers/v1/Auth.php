<?php
namespace Controllers\v1;

use \Exceptions\HTTPException;
use \Models\User;
use \Models\Apikey;
use \Utils\Tools;
use \Utils\Identity;



class Auth extends \Controllers\Base
{
  protected $accessList = [
    'get' => [Identity::CONTEXT_SUPER_ADMIN],
    'post' => true,
    'resetPassword' => true,
  ];


  public function get()
  {
    $identity = $this->app->get('IDENTITY');
    $_context = $this->params['context'];
    $ret = [];
    $admin = [
      Identity::CONTEXT_SUPER_ADMIN => 'Administrator',
      Identity::CONTEXT_SUPER_USER => 'User',
    ];


    if ($identity->context == Identity::CONTEXT_SUPER_ADMIN) {
      $ret = $admin;
    }

    $this->respond($ret);
  }

  public function post()
  {
    $data = $this->requestBody;

    if (isset($data['username']) &&
      !empty($data['username']) &&
      isset($data['password']) &&
      !empty($data['password']) &&
      isset($data['login_type']) &&
      !empty($data['login_type'])) {

      switch ($data['login_type']) {
        case Identity::CONTEXT_SUPER_ADMIN:
          $this->login();
          return;
          break;
        default:
          throw new HTTPException(
            'Invalid username / password combination',
            403
          );
          break;
      }
    }

    throw new HTTPException(
      'Invalid username / password combination',
      403
    );
  }



  private function login()
  {
    $data = $this->requestBody;

    $username = $data['username'];

    $model = new User;
    $model->load(['username = ? AND deleted <> ?', $username, 1]);

    $verified = !$model->dry() ? password_verify($data['password'], $model->password) : false;


    if (!$model->dry() && $verified) {

      Apikey::deactivateAll($model->id);

      $apikey = new Apikey();
      $apikey->key = Tools::generateAPIKey();
      $apikey->active = 1;
      $apikey->user = $model->id;
      $apikey->user_agent = $this->app->get('AGENT');

      if ($apikey->save()) {

        $dealerCast = 0;
        $user = $model->cast(null, [
          'dealer' => $dealerCast,
          'avatar' => 0
        ]);

        $ret = [
          'id' => $user['id'],
          'name' => $user['name'],
          'surname' => $user['surname'],
          'username' => $user['username'],
          'email' => $user['email'],
          'role' => $user['role'],
          'key' => $apikey['key'],
          'avatar' => $user['avatarurl'],
        ];


        $this->respond($ret);

        return;

      } else {
        throw new HTTPException('Error in saving data', 500);
      }
    }

    throw new HTTPException(
      'Invalid username / password combination',
      403
    );
  }
}