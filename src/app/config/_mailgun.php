<?php

$mailConfig = array(
  'server' => 'debugmail.io',
  'port' => 25,
  'username' => '',
  'password' => '',
  'sender' => ''
);

if (K_ENV == K_ENV_PRODUCTION || K_ENV == K_ENV_TESTING) {

}

return $mailConfig;
