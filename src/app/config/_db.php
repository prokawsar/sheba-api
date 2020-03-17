<?php

$dbconfig = array(
    'adapter'   => 'mysql',
    'host'      => 'localhost',
    'username'  => 'root',
    'password'  => '',
    'dbname'    => 'sheba_homoeo',
);

if (K_ENV == K_ENV_PRODUCTION) {
    $dbconfig['dbname'] = 'live_database';
}

return $dbconfig;