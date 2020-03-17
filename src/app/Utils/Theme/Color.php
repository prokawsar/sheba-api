<?php
namespace Utils\Theme;

use \Exception;

class Color
{
  protected $stringColor;
  protected $rgb = [];

  public function __construct($hexColor)
  {
    $this->validateColor($hexColor);
  }

  public function __toString()
  {
    return $this->stringColor;
  }

  public function getRGB(){
    return $this->rgb;
  }

  protected function validateColor($value)
  {
    if (preg_match('/^(#([0-9a-f]{6})|#([0-9a-f]{3}))$/i', $value, $m)) {
      if (isset($m[3])) {
        $num = hexdec($m[3]);
        foreach ([3, 2, 1] as $i) {
          $t = $num & 0xf;
          $color[$i] = $t << 4 | $t;
          $num >>= 4;
        }
      } else {
        $num = hexdec($m[2]);
        foreach ([3, 2, 1] as $i) {
          $color[$i] = $num & 0xff;
          $num >>= 8;
        }
      }

      $this->stringColor = $value;
      $this->rgb = $color;

      return true;
    }

    if(preg_match('/rgba\s?\(\s?([\d]{1,3})\s?,\s?([\d]{1,3})\s?,\s?([\d]{1,3})\s?,\s?([\d.]+)\s?\)/', $value, $m)){
      $color = [null, $m[1], $m[2], $m[3], $m[4]];
      $this->stringColor = $value;
      $this->rgb = $color;

      return true;
    }

    if($value == 'transparent'){
      $this->stringColor = $value;
      $this->rgb = $value;
      return true;
    }

    throw new Exception('Invalid color: ' . $value);
  }
}