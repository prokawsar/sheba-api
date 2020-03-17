<?php
namespace Utils;

use \Exception;
use \Utils\Theme\Generator;

class OrgTheme
{

  protected $app;
  protected $templatePath = 'theme/theme.php';
  public $primary;
  public $info;
  public $gradientStart = '#fff';
  public $gradientEnd = '#fff';
  public $logoBackground = 'transparent';

  function __construct($opts = [])
  {
    $this->app = \Base::instance();

    if (isset($opts['templatePath'])) {
      $this->templatePath = $opts['templatePath'];
    }
    if (isset($opts['primary'])) {
      $this->primary = $opts['primary'];
    }
    if (isset($opts['info'])) {
      $this->info = $opts['info'];
    }
    if (isset($opts['gradientStart'])) {
      $this->gradientStart = $opts['gradientStart'];
    }
    if (isset($opts['gradientEnd'])) {
      $this->gradientEnd = $opts['gradientEnd'];
    }
    if (isset($opts['logoBackground'])) {
      $this->logoBackground = $opts['logoBackground'] != false ? '#fff' : 'transparent';
    }
  }

  public function generate()
  {
    if($this->validateProps()){
      $generator = new Generator([
        'templatePath' => $this->templatePath,
        'primary' => $this->primary,
        'info' => $this->info,
        'gradientStart' => $this->gradientStart,
        'gradientEnd' => $this->gradientEnd,
        'logoBackground' => $this->logoBackground,
      ]);

      return $generator->generate();
    }

    return false;
  }

  protected function validateProps()
  {
    if (empty($this->templatePath)) {
      throw new Exception('Invalid template path');
      return false;
    }
    if (empty($this->primary)) {
      throw new Exception('Invalid primary color');
      return false;
    }
    if (empty($this->info)) {
      throw new Exception('Invalid info color');
      return false;
    }
    if (empty($this->gradientStart)) {
      throw new Exception('Invalid gradientStart color');
      return false;
    }
    if (empty($this->gradientEnd)) {
      throw new Exception('Invalid gradientEnd color');
      return false;
    }

    return true;
  }
}