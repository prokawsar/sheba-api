<?php
namespace Models;

use \Utils\Identity;
use \Exceptions\HTTPException;

class File extends \Models\Base\File
{

  public function cast($obj = NULL, $rel_depths = 1)
  {
    $dt = parent::cast($obj, $rel_depths);

    $dt['date'] = date('d/m/Y H:i', strtotime($dt['created']));
    $dt['url'] = $this->getUrl();

    return $dt;
  }

  public function getUrl()
  {
    $driver = $this->driver;
    $fqcn = "\\Utils\\FS\\" . $driver;
    $instance = $fqcn::instance();
    return $instance->getUrl($this);
  }

  public function get_url()
  {
    return $this->getUrl();
  }

  public static function create($filePath, $folder = '/', $_driver = null, $cb = null)
  {
    $model = new self;
    $cn = "\\Utils\\FS\\";
    $driver = $model->app->get('FILESYSTEM');

    if ($_driver) {
      $fqcn = $cn . $_driver;
      if (class_exists($fqcn)) {
        $driver = $fqcn::getInstance();
      }
    }

    if ($cb) {
      $cb($filePath);
    }

    $uploaded = $driver->create($filePath, $folder);
    if ($uploaded !== false) {
      $model->copyfrom($uploaded, ['folder', 'name', 'original_name', 'driver']);
      $model->save();
      return $model;
    } else {
      throw new HTTPException('Failed to place file', 500);
    }

  }

  public static function createFromUpload($folder = '/', $_driver = null, $cb = null)
  {
    $web = \Web::instance();
    $files = $web->receive(null, true);
    $file = null;
    foreach ($files as $k => $v) {
      if ($v == 1) {
        $file = $k;
        break;
      }
    }
    if ($file) {
      return self::create($file, $folder, $_driver, $cb);
    }
    throw new HTTPException('Failed to locate uploaded file', 500);
  }

}