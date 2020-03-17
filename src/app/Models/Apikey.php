<?php
namespace Models;

class Apikey extends \Models\Base\Apikey
{
  public static function deactivateAll($user_id)
  {
    \Base::instance()->get('DB')->exec(
      'UPDATE `apikey` SET `active` = 0 WHERE user = ' . $user_id .
        ' AND `active` = 1'
    );
  }

  //Random pronounceable ref key
  public static function randomPronounceableRefKey($syllables = 3, $strong = false)
  {
    $pw = '';
    $c = 'bcdfghjklmnprstvwz'; // consonants except hard to speak ones
    $v = 'aeiou';              // vowels
    $a = $c . $v;              // all

    //Append Caps & Special Chars
		if($strong){
			$caps = 'AEIOQUXY';
			$special = '@#!$&()/^';
			$cpsRandom = $caps[rand(0, strlen($caps) - 1)];
			$splRandom = $special[rand(0, strlen($special) - 1)];
			$pw .= $cpsRandom;
			$pw .= $splRandom;
    }

    //iterate till number of syllables reached
    for ($i = 0; $i < $syllables; $i++) {
      $pw .= $c[rand(0, strlen($c) - 1)];
      $pw .= $v[rand(0, strlen($v) - 1)];
      $pw .= $a[rand(0, strlen($a) - 1)];
    }

    //... and add a nice number
    $pw .= rand(10, 99);

    return $pw;
  }

  public static function deleteAllInactiveKey()
  {
    \Base::instance()->get('DB')->exec(
      'DELETE FROM `apikey` WHERE `active` = 0'
    );
  }

}

