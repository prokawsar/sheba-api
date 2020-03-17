<?php

$pdfconfig = array(
    'binPath' => '',
    'outputPath' => __DIR__ . '/../../runtime/pdfcache',
    'defaultOptions' => [
        'print-media-type' => true,
        'disable-smart-shrinking' => true,
        'no-outline' => true,
        'page-size' => 'A4',
        'margin-top' => '0',
        'margin-right' => '0',
        'margin-bottom' => '0',
        'margin-left' => '0',
        'dpi' => '150',
        'zoom' => '0.609',
        'load-error-handling' => 'ignore',
        'load-media-error-handling' => 'ignore'
    ]
);

if (K_ENV == K_ENV_LOCAL) {
    $pdfconfig['binPath'] = '"C:\Program Files\wkhtmltopdf\bin\wkhtmltopdf"';
} elseif (K_ENV == K_ENV_TESTING) {
    $pdfconfig['binPath'] = '/var/www/html/api/_bin/wkhtmltopdf';
} elseif (K_ENV == K_ENV_PRODUCTION) {
    $pdfconfig['binPath'] = '/var/www/html/api/_bin/wkhtmltopdf';
}

return $pdfconfig;
