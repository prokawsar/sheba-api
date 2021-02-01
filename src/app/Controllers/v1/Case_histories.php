<?php
namespace Controllers\v1;

use Utils\Identity;

class Case_histories extends \Controllers\Base
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
      ],
      'get_with_treatments' => [
        Identity::CONTEXT_SUPER_ADMIN,
        Identity::CONTEXT_SUPER_USER
      ],
      'delete' => [
        Identity::CONTEXT_SUPER_ADMIN,
      ],
    ];

    protected $allowedSearchFields = ['name', 'deleted'];

    protected $modelsMap = [
      'default' => 'Models\Case_histories',
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
    
    public function get_with_treatments()
    {
      $model = $this->getModel();
      $this->respond($model::listWithTreatment());
    }
    
    public function delete()
    {
      $model = $this->getModel();
      $this->respond($model::delete($this->params['id']));
    }

}
