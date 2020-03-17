<?php

$app->set('CONFIG', $config);

//Database service
$app->set('DB', call_user_func(function ($app) {
    $config = $app->get('CONFIG')['DB'];
    $dsn = $config['adapter']. ':host=' . $config['host'] . ';dbname=' . $config['dbname'];

    return new DB\SQL(
        $dsn,
        $config['username'],
        $config['password']
    );

}, $app));

//responder service
$app->set('RESPONDER', call_user_func(function ($app) {
    return \Responses\JSONResponse::instance();
}, $app));

//metadata provider service
$app->set('METADATAPROVIDER', call_user_func(function ($app) {
    return \Utils\MetadataProvider::instance();
}, $app));

//requestbody service
$app->set('REQUESTBODY', call_user_func(function ($app) {
    return \Utils\RequestBody::instance();
}, $app));

//cache service
$app->set('CACHE','folder='.__DIR__.'/../../runtime/cache/');

//Logger service
$app->set('LOGS', $app->get('CONFIG')['LOG']['folder']);
$app->set('LOGGER', call_user_func(function ($app) {
    return new \Utils\Log($app->get('CONFIG')['LOG']);
}, $app));

//Identity service
$app->set('IDENTITY', call_user_func(function () {
    return new \Utils\Identity();
}));

//file system service
$app->set('FILESYSTEM', call_user_func(function () {
    return \Utils\FS\LocalDriver::instance();
}));

//Mailgun Service
$app->set('MAILGUN', call_user_func(function ($app) {
    return new \Utils\Mailgun($app->get('CONFIG')['MAILGUN']);
}, $app));


//SMS Service
$app->set('SMS', call_user_func(function ($app) {
    return new \Utils\SMS($app->get('CONFIG')['TWILIO']);
}, $app));

//PDF renderer service
$app->set('PDFRenderer', call_user_func(function ($app) {
    return new \Utils\PDFRenderer($app->get('CONFIG')['PDF']);
}, $app));

