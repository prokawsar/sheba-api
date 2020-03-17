<?php

  return [
    'routes' => [
      'post' => array(
        '/' => 'notFound',
        '/avatar' => 'uploadAvatar',
        '/acceptPushToken' => 'acceptPushToken'
      ),
      'get' => array(
        '/' => 'getOne',
        '/@id' => 'notFound',
        '/dealer' => 'getDealerInfo'
      ),
      'put' => array(
        '/@id' =>  'notFound',
        '/' => 'put',
        '/switch' => 'switchToDualFuel',
        '/trackLink' => 'trackLink'
      ),
      'delete' => array(
        '/@id' =>  'notFound',
        '/' =>  'notFound'
      )
    ]
  ];