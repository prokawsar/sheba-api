<?php
namespace DBViews;

class DBBaseView{

  protected $app,
    $viewName = '',
    $viewSource = '';

  public function __construct()
  {
    $this->app = \Base::instance();
  }

  public static function setdown()
  {
    $model = new static;
    $model->app->get('DB')->query('DROP VIEW IF EXISTS `'.$model->viewName.'`');
  }

  public static function setup()
  {
    $model = new static;
    $model->app->get('DB')->query($model->viewSource);
  }
}