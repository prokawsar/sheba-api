<?php
$DS = DIRECTORY_SEPARATOR;
$files_search = str_replace('/', $DS, __DIR__ . '/../test/DBViews/V_*.php');

$files = glob($files_search);

$VIEWS_LIST = [];

foreach ($files as $file) {
    $fnm = basename($file);
    $VIEWS_LIST[] = str_replace('.php', '', $fnm);
}

$app->set('VIEWS_LIST', $VIEWS_LIST);
?>