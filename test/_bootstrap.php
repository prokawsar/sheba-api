<?php
define('AUTOMATED_TESTING', true);

require_once(__DIR__ . '/../src/vendor/autoload.php');
spl_autoload_register(function ($class) {
    $file = preg_replace('#\\\#','/', $class) . '.php';
    if (stream_resolve_include_path($file))
        require $file;
});
$app = require_once(__DIR__ . '/../src/app/config/bootstrap.php');