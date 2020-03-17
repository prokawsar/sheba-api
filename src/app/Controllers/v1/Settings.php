<?php
namespace Controllers\v1;

use \Utils\Identity;

class Settings extends \Controllers\Base
{
  protected $accessList = [
    'get' => [
      Identity::CONTEXT_SUPER_ADMIN ,
      Identity::CONTEXT_SUPER_USER,
    ],
    'post' => [],
    'put' => [
      Identity::CONTEXT_SUPER_ADMIN ,
      Identity::CONTEXT_SUPER_USER
    ],
    'delete' => []
  ];

  protected $modelsMap = [
    'default' => '\Models\Settings'
  ];

  public function get()
  {
    $model = $this->getModel();
    $this->respond($model::listAll($this->offset, $this->limit, $this->filters));
  }


  public function put()
  {
    $model = $this->getModel();
    $this->respond($model::put($this->requestBody));
  }


}
