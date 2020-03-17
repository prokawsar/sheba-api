<?php
namespace Utils;

use \Exceptions\HTTPException;

class Identity extends \Prefab
{
  const CONTEXT_SUPER_ADMIN         = 'SA';
  const CONTEXT_SUPER_USER          = 'SU';

  public static $identityDescriptions = [
    self::CONTEXT_SUPER_ADMIN         => 'Super Admin',
    self::CONTEXT_SUPER_USER          => 'Super User',
  ];

  protected $app;

  public $user = null;
  public $context = null;
  public $inactiveKey = false;

  public function __construct()
  {
    $this->app = \Base::instance();
    $this->identify();
  }

  public function forget()
  {
    $this->user = null;
    $this->context = null;
  }

  public function reIdentify()
  {
    $this->identify();
  }

  private function identify()
  {
    $api_key = $this->app->get('HEADERS.Api-Key');

    $key = new \Models\Apikey;
    $key->load(['`key` = ?', $api_key]);
    if ($key->dry()) {
      return;
    }

    if ($key->active != 1) {
      $this->inactiveKey = true;
      return;
    }

    if (!empty($key->user)) {
      $this->user = $key->user;
      $this->context = $key->user->role;
    }
  }
}
