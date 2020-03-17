<?php
namespace Models;

use \Utils\Identity;
use \Utils\Tools;
use \Models\Apikey;
use \Exceptions\HTTPException;

class User extends \Models\Base\User
{
  public $castDepth = [
    '*' => 0,
    'avatar' => 0
  ];

  public function set_password($val)
  {
    // $validPassword = Tools::validate_password($val);
    // if(!$validPassword){
    //   throw new HTTPException(
    //     'Should be at least 8 characters in length and include at least one lower-case letter, one upper-case letter, one number, and one special character.',
    //     406,
    //     array(
    //       'dev' => 'Password should be a strong one',
    //       'internalCode' => '',
    //       'more' => '',
    //     )
    //   );
    // }

    if(isset($val) && !empty($val)){
      return password_hash($val, PASSWORD_DEFAULT, ['cost' => 12]);
    }

    throw new HTTPException(
      'Please enter a password.',
      406,
      array(
        'dev' => 'Password field should\'nt be empty',
        'internalCode' => '',
        'more' => '',
      )
    );
  }

  public function cast($obj = NULL, $rel_depths = 1)
  {
    $dt = parent::cast($obj, $rel_depths);

    //remove password from being casted
    unset($dt['password']);

    //add avatar image
    $dt['avatarurl'] = $dt['avatar'] ? $dt['avatar']['url'] : 'https://www.gravatar.com/avatar/' . md5($dt['email']) . '?d=identicon&s=128';

    return $dt;
  }

  public function get_avatarurl()
  {
    return $this->avatar ? $this->avatar->getUrl() : 'https://www.gravatar.com/avatar/' . md5($this->email) . '?d=identicon&s=128';
  }

  public static function checkDuplicateUsername($username)
  {
    $model = new self;
    $model->load(['username = ? AND deleted <> ?', $username, 1]);
    if (!$model->dry()) {
      throw new HTTPException(
        'Username already exists',
        406,
        array(
          'dev' => 'The Username you entered is already in use.',
          'internalCode' => '',
          'more' => '',
        )
      );
    }
  }

  public static function createApiKey($role, $description = '')
  {
    $model = new self;
    $db = $model->app->get('DB');
    $db->begin(); //start a database transaction

    $apikey = new Apikey();
    $apikey->key = Tools::generateAPIKey();
    $apikey->active = 1;
    $apikey->user_agent = $model->app->get('AGENT');

    $model->name = $description;
    $model->username = $apikey->key;
    $model->role = $role;
    $model->save();

    $apikey->user = $model->id;
    $apikey->save();

    $db->commit(); //commit the transaction

    return $model->cast(null, $model->castDepth);
  }


  public function hasRole($role)
  {
    $existing = explode('|', $this->role);

    if(!in_array($role, array_keys(Identity::$identityDescriptions))){
      throw new HTTPException('Invalid role given', 500);
    }

    return in_array($role, $existing) ? true : false;
  }

  public function buildUserRole($_role, $opt = true){

    $existing = explode('|', $this->role);
    if($opt){
        $roles = array_filter((array) $_role);
        if(!empty($roles)){
            $existing = array_merge($existing, $roles);

        }
    }else{
        $existing = array_diff($existing, (array) $_role);
    }

    return trim(implode('|', $existing), '|');
  }
}