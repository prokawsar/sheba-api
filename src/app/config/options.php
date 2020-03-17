<?php

//package name
$app->set('PACKAGE', 'KWS3.media');

//patch request headers
call_user_func(function ($app) {
    $headers = $app->get('HEADERS');
    if (!isset($headers['Content-Type'])) {
        if (isset($_SERVER['CONTENT_TYPE'])) {
            $app->set('HEADERS.Content-Type', $_SERVER['CONTENT_TYPE']);
        }
    }
    if (!isset($headers['Content-Length'])) {
        if (isset($_SERVER['CONTENT_LENGTH'])) {
            $app->set('HEADERS.Content-Length', $_SERVER['CONTENT_LENGTH']);
        }
    }
}, $app);

//debug mode
$app->set('DEBUG', (K_ENV == K_ENV_PRODUCTION ? 2 : 3));
$app->set('HIGHLIGHT', (K_ENV == K_ENV_PRODUCTION ? false : true));

//default temporary folder
$app->set('TEMP', __DIR__.'/../../runtime/');

//default uploads folder
$app->set('UPLOADS', __DIR__.'/../../runtime/uploads/');

//X-frame
$app->set('XFRAME', 'ALLOWALL');

//set CORS options
$app->set('CORS',[
    'origin'        => '*',
    'credentials'   => true,
    'headers'       => ['api-key', 'origin', 'x-requested-with', 'content-type', 'content-length'],
    'ttl'           => 86400
]);
// All OPTIONS requests get a 200, then die
if ($app->get('VERB') == 'OPTIONS') {
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Headers: ' . $app->get("HEADERS.Access-Control-Request-Headers"));
    header('Access-Control-Allow-Methods: ' . $app->get("HEADERS.Access-Control-Request-Method"));
    header("HTTP/1.0 200 Ok");
    exit;
}

$app->set('UI', __DIR__.'/../views/');



//set Cortex (Model Layer) options
$app->set('CORTEX.standardiseID', false);

//apikey hashing salt
$app->set('SALT', '88A9C8C017A9D1C34A0B06C849EECF2D');
