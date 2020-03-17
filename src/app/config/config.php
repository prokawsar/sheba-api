<?php

//load sub-configurations
require __DIR__ . "/_env.php";

$config = [
    'DB'            => require __DIR__ . "/_db.php",
    'LOG'           => require __DIR__ . "/_log.php",
    'MAILGUN'       => require __DIR__ . "/_mailgun.php",
    'S3FS'          => require __DIR__ . "/_s3FS.php",
    'PDF'           => require __DIR__ . "/_pdf.php",
    'LOCALFS'       => require __DIR__ . "/_localFS.php",
    'FOLDERS'       => require __DIR__ . "/_folders.php",
    'TWILIO'        => require __DIR__ . "/_twilio.php",
];

return $config;
