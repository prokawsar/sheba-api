<?php
$config = [
    'db' => [
        'adapter'   => 'mysql',
        'host'      => 'localhost',
        'username'  => 'root',
        'password'  => '',
        'dbname'    => 'social_energy_test',
    ]
];


$app->set('DB', call_user_func(function ($app, $config) {
    $dsn = $config['adapter']. ':host=' . $config['host'] . ';dbname=' . $config['dbname'];

    return new DB\SQL(
        $dsn,
        $config['username'],
        $config['password']
    );

}, $app, $config['db']));
?>