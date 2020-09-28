<?php
return [
  'routes' => [
    'get' => [
      '/' => 'get',
      '/@id' => 'getOne',
      '/with_treatments' => 'get_with_treatments'
    ]
  ]
];