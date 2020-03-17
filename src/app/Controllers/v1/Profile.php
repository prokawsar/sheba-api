<?php
namespace Controllers\v1;

use Utils\Identity;

class Profile extends \Controllers\Base
{
    protected $accessList = [
      'get' => [],
      'getOne' => [
        Identity::CONTEXT_SUPER_ADMIN ,
        Identity::CONTEXT_SUPER_USER
      ],
      'post' => [],
      'put' => [
        Identity::CONTEXT_SUPER_ADMIN ,
        Identity::CONTEXT_SUPER_USER
      ],
      'delete' => [],
      'uploadAvatar' => [
        Identity::CONTEXT_SUPER_ADMIN ,
        Identity::CONTEXT_SUPER_USER
      ],
      'notFound' => true,
    ];

    protected $allowedSearchFields = [];

    protected $modelsMap = [
      'default' => 'Models\Profile',
    ];

    public function getOne(){
      $model = $this->getModel();
      $this->respond($model::getOne());
    }

    public function put(){
      $model = $this->getModel();
      $this->respond($model::put($this->requestBody));
    }

    public function uploadAvatar(){
      $model = $this->getModel();
      $this->respond($model::uploadAvatar());
    }

    public function notFound(){
      $model = $this->getModel();
      $this->respond($model::notFound());
    }
}
