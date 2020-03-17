<?php
return [
  'routes' => [
    'post' => [
      '/' => 'post',
      '/@id/avatar' => 'uploadAvatar'
    ],
    'get' => [
      '/' => 'get',
      '/@id' => 'getOne',
      '/@id/premises' => 'getPremises'
    ]
  ]
];