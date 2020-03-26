<?php
namespace Controllers\v1;

use Utils\Identity;

class Remedies extends \Controllers\Base
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
      'delete' => [],
    ];

    protected $allowedSearchFields = ['name', 'constitution', 'diathesis', 'miasm', 'temperament',
      'thermals', 'attacks_and_time', 'side', 'temperature_and_weather',
      'ailments_from', 'mind', 'face', 'hair', 'skin', 'built',
      'appetite', 'hunger', 'desires', 'aversions', 'intolerable',
      'hearing', 'smelling', 'taste', 'tongue', 'thirst', 'sleep',
      'dreams', 'stools', 'urine', 'perspiration', 'nutrition', 'anaemia',
      'cyanosis', 'dehydration', 'jaundice', 'breathing', 'pulse', 'sensation',

      'head', 'eyes', 'nose', 'ears', 'teeth', 'gums', 'throat',
      'tonsills', 'neck_and_back', 'extrimities', 'bones', 'oesophagus', 'stomach',
      'abdomen', 'liver', 'gallbladder', 'pancreas', 'spleen', 'intestine', 'duodenum',
      'digestion', 'chest', 'heart', 'lungs', 'mso_mgo', 'fso_mgo', 'anus_and_rectum',
      'notes', 'modalities', 'clinical'
    ];

    protected $modelsMap = [
      'default' => 'Models\Remedies',
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

    public function search()
    {
      $model = $this->getModel();
      $this->respond($model::search($this->requestBody));
    }

}
