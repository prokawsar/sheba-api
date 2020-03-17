<?php
namespace Utils\Theme;

use \Utils\Theme\Color;
use \View;
use \Exception;

class Generator
{

  protected $app;
  protected $templatePath = '';
  protected $colors = [];

  function __construct($opts = [])
  {
    $this->app = \Base::instance();

    if (isset($opts['templatePath'])) {
      $this->templatePath = $opts['templatePath'];
    }
    foreach($opts as $k => $v){
      if($k != 'templatePath'){
        $this->colors[$k] = new Color($v);
      }
    }

    if(empty($this->templatePath)){
      throw new Exception('Invalid template path');
    }
  }

  public function __get($name){
    if(isset($this->colors[$name])){
      return $this->colors[$name];
    }
    return false;
  }

  public function generate()
  {
    $this->app->set('themer', $this);
    return View::instance()->render($this->templatePath);
  }

  public function darken($color, $amount)
  {
    $color = $this->getValidColor($color);

    return $this->toHexString(
      $this->adjustHsl($color, 3, -$amount)
    );
  }

  public function lighten($color, $amount)
  {
    $color = $this->getValidColor($color);

    return $this->toHexString(
      $this->adjustHsl($color, 3, $amount)
    );
  }

  public function saturate($color, $amount)
  {
    $color = $this->getValidColor($color);

    return $this->toHexString(
      $this->adjustHsl($color, 2, $amount)
    );
  }

  public function desaturate($color, $amount)
  {
    $color = $this->getValidColor($color);

    return $this->toHexString(
      $this->adjustHsl($color, 2, -$amount)
    );
  }

  public function rgba($color, $amount)
  {
    $color = $this->getValidColor($color);

    $rgb = $color->getRGB();
    return sprintf('rgba(%u, %u, %u, %s)', $rgb[1], $rgb[2], $rgb[3], $amount);
  }

  public function adjustHue($color, $amount)
  {
    $color = $this->getValidColor($color);

    return $this->toHexString(
      $this->adjustHsl($color, 1, $amount)
    );
  }

  public function lightness($color)
  {
    $color = $this->getValidColor($color);

    $hsl = $this->toHSL($color);
    return round($hsl[3], 5);
  }

  public function findColorInvert($color)
  {
    /**
     * This is not a sass function
     * It is adapted from a custom function in Bulma
     */

    if($this->colorLuminance($color) > 0.55){
      return $this->rgba(new Color('#000'), 0.7);
    }else{
      return new Color('#fff');
    }
  }

  public function colorLuminance($color)
  {
    /**
     * This is not a sass function
     * It is adapted from a custom function in Bulma
     */
    $color = $this->getValidColor($color);

    $rgb = $color->getRGB();
    $adjusted = [];
    foreach($rgb as $k => $value){
      if($k > 0){
        $v = $value / 255;
        if($v < 0.03928){
          $v = $v / 12.92;
        }else{
          $v = ($v + .055) / 1.055;
          $v = pow($v, 2);
        }
        $adjusted[$k] = $v;
      }
    }

    return round(
      ($adjusted[1] * .2126) +
      ($adjusted[2] * .7152) +
      ($adjusted[3] * .0722),
      5
    );

  }

  public function adjustHSL($color, $idx, $amount)
  {
    $hsl = $this->toHSL($color);
    $hsl[$idx] += $amount;

    if(!isset($hsl[4])){
      $hsl[4] = null;
    }

    return $this->toRGB($hsl[1], $hsl[2], $hsl[3], $hsl[4]);
  }

  public function toHSL($color)
  {
    list(, $red, $green, $blue, $opacity) = $color->getRGB();
    $min = min($red, $green, $blue);
    $max = max($red, $green, $blue);
    $l = $min + $max;
    $d = $max - $min;
    if ((int)$d === 0) {
      $h = $s = 0;
    } else {
      if ($l < 255) {
        $s = $d / $l;
      } else {
        $s = $d / (510 - $l);
      }
      if ($red == $max) {
        $h = 60 * ($green - $blue) / $d;
      } elseif ($green == $max) {
        $h = 60 * ($blue - $red) / $d + 120;
      } elseif ($blue == $max) {
        $h = 60 * ($red - $green) / $d + 240;
      }
    }

    $out = [null, fmod($h, 360), $s * 100, $l / 5.1];

    if(!is_null($opacity)){
      $out[4] = $opacity;
    }

    return $out;

  }

  public function toRGB($hue, $saturation, $lightness, $opacity)
  {
    if ($hue < 0) {
      $hue += 360;
    }
    $h = $hue / 360;
    $s = min(100, max(0, $saturation)) / 100;
    $l = min(100, max(0, $lightness)) / 100;
    $m2 = $l <= 0.5 ? $l * ($s + 1) : $l + $s - $l * $s;
    $m1 = $l * 2 - $m2;
    $r = $this->hueToRGB($m1, $m2, $h + 1 / 3) * 255;
    $g = $this->hueToRGB($m1, $m2, $h) * 255;
    $b = $this->hueToRGB($m1, $m2, $h - 1 / 3) * 255;
    $out = [null, round($r), round($g), round($b)];

    if(!is_null($opacity)){
      $out[4] = $opacity;
    }

    return $out;
  }

  protected function toHexString($colorArray)
  {
    if(isset($colorArray[4])){
      return sprintf('rgba(%u, %u, %u, %s)', $colorArray[1], $colorArray[2], $colorArray[3], $colorArray[4]);
    }
    return sprintf('#%02x%02x%02x', $colorArray[1], $colorArray[2], $colorArray[3]);
  }

  private function hueToRGB($m1, $m2, $h)
  {
    if ($h < 0) {
      $h += 1;
    } elseif ($h > 1) {
      $h -= 1;
    }
    if ($h * 6 < 1) {
      return $m1 + ($m2 - $m1) * $h * 6;
    }
    if ($h * 2 < 1) {
      return $m2;
    }
    if ($h * 3 < 2) {
      return $m1 + ($m2 - $m1) * (2 / 3 - $h) * 6;
    }
    return $m1;
  }

  protected function getValidColor($color){
    if(is_a($color, 'Color')){
      return $color;
    }
    return new Color($color);
  }
}