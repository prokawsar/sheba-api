<?php

$folders = [
  'avatars' => 'avatars_dev',
  'documents' => 'documents_dev',
];

if (K_ENV == K_ENV_PRODUCTION) {
  $folders = [
    'avatars' => 'avatars',
    'documents' => 'documents',
  ];
}


return $folders;