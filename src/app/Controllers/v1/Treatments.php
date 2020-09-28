<?php
namespace Controllers\v1;

use Utils\Identity;

class Treatments extends \Controllers\Base
{
    protected $accessList = [
      'get' => [
        Identity::CONTEXT_SUPER_ADMIN ,
        Identity::CONTEXT_SUPER_USER
      ],
      'getOne' => [
        Identity::CONTEXT_SUPER_ADMIN ,
        Identity::CONTEXT_SUPER_USER
      ],
      'post' => [
        Identity::CONTEXT_SUPER_ADMIN ,
        Identity::CONTEXT_SUPER_USER
      ],
      'put' => [
        Identity::CONTEXT_SUPER_ADMIN ,
        Identity::CONTEXT_SUPER_USER
      ],
      'create_with_case' => [
        Identity::CONTEXT_SUPER_ADMIN ,
        Identity::CONTEXT_SUPER_USER  
      ],
      'delete' => [],
    ];

    protected $allowedSearchFields = ['patient'];

    protected $modelsMap = [
      'default' => 'Models\Treatments',
    ];

    public function get()
    {
      $model = $this->getModel();
      $this->respond($model::listAll($this->offset, $this->limit, $this->filters));

    }

    public function getOne(){
      $model = $this->getModel();
      $this->respond($model::getOne($this->params['id']));
    }

    public function put(){
      $model = $this->getModel();
      $this->respond($model::put($this->params['id'], $this->requestBody));
    }

    public function post()
    {
      $model = $this->getModel();
      $this->respond($model::create($this->requestBody));
    }

    public function delete()
    {
      $model = $this->getModel();
      $this->respond($model::delete($this->params['id']));
    }
    
    public function create_with_case()
    {
      $model = $this->getModel();
      $this->respond($model::create_with_case($this->requestBody));
    }

}
