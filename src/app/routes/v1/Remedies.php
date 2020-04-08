<?php
 return [
  'routes' => [
    'post' => [
      '/' => 'post',
      '/search' => 'search',
      '/field' => 'createField',
    ],
    'put' => [
      '/@id' => 'put',
      '/field/@id' => 'updateField',
    ],
  ]
];