<?php
return [
  'routes' => [
    'head' => [
      '/' => null,
      '/@id' => null,
      '/@context' => 'get',
      '/@context/@context_id' => 'get',
      '/@context/@context_id/@id' => 'getOne'
    ],

    'get' => [
      '/' => null,
      '/@id' => null,
      '/@context/@context_id' => 'get',
      '/@context/@context_id/@id' => 'getOne'
    ],

    'post' => [
      '/' => null,
      '/@context/@context_id' => 'post',
      '/@context/@context_id/avatar/@id' => 'uploadAvatar'
    ],

    'put' => [
      '/@id' => null,
      '/@context/@context_id/@id' => 'put'
    ],

    'delete' => [
      '/@id' => null,
      '/@context/@context_id/@id' => 'delete'
    ]
  ]
];
 