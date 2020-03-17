<?php
$DS = DIRECTORY_SEPARATOR;
$files_search = str_replace('/', $DS, __DIR__ . '/../src/app/Models/Base/*.php');

$files = glob($files_search);

$MODELS_LIST = [];

foreach ($files as $file) {
    $fnm = basename($file);
    if(substr($fnm, 0, 2) != 'V_'){
        $MODELS_LIST[] = str_replace('.php', '', $fnm);
    }
}

$app->set('MODELS_LIST', $MODELS_LIST);
?>