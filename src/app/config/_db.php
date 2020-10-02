<?php

$dbconfig = array(
    'adapter'   => 'mysql',
    'host'      => getenv('DATABASE_URL'),
    'username'  => getenv('DB_USERNAME'),
    'password'  => getenv('DB_PASSWORD'),
    'dbname'    => getenv('DB_NAME'),
);

if (K_ENV == K_ENV_PRODUCTION) {
    $dbconfig['dbname'] = 'live_database';
}

return $dbconfig;