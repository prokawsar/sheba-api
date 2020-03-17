<?php
namespace Controllers\v1;

use \Utils\Identity;

class ContextedUsers extends \Controllers\Base
{
  protected $accessList = [
    'get' => [
      Identity::CONTEXT_SUPER_ADMIN,
      Identity::CONTEXT_SUPER_USER
    ],
    'getOne' => [
      Identity::CONTEXT_SUPER_ADMIN,
      Identity::CONTEXT_SUPER_USER
    ],
    'post' => [
      Identity::CONTEXT_SUPER_ADMIN,
      Identity::CONTEXT_SUPER_USER
    ],
    'put' => [
      Identity::CONTEXT_SUPER_ADMIN,
      Identity::CONTEXT_SUPER_USER
    ],
    'delete' => [
      Identity::CONTEXT_SUPER_ADMIN,
      Identity::CONTEXT_SUPER_USER
    ]
  ];

  protected $allowedSearchFields = ['name', 'surname', 'username', 'email', 'role'];

  protected $modelsMap = [
    'default' => 'Models\ContextedUsers'
  ];

  public function get()
  {

    $model = $this->getModel();
    $this->respond($model::listAll(
      $this->offset,
      $this->limit,
      $this->filters,
      [
        $this->params['context'],
        $this->params['context_id']
      ]
    ));
  }

  public function getOne()
  {


    $model = $this->getModel();
    $this->respond($model::getOne(
      $this->params['id'],
      false,
      [
        $this->params['context'],
        $this->params['context_id']
      ]
    ));
  }

  public function put()
  {
    $model = $this->getModel();
    $this->respond($model::put(
      $this->params['id'],
      $this->requestBody,
      [
        $this->params['context'],
        $this->params['context_id']
      ]
    ));
  }

  public function post()
  {
    $model = $this->getModel();
    $this->respond($model::create(
      $this->requestBody,
      [
        $this->params['context'],
        $this->params['context_id']
      ]
    ));
  }

  public function delete()
  {
    $model = $this->getModel();
    $this->respond($model::delete(
      $this->params['id'],
      [
        $this->params['context'],
        $this->params['context_id']
      ]
    ));
  }

  public function uploadAvatar()
  {
    $model = $this->getModel();
    $this->respond($model::uploadAvatar(
      $this->params['id'],
      [
        $this->params['context'],
        $this->params['context_id']
      ]
    ));
  }

}
