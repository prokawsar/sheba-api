<?php

/**
 * This loads route definitions from the app/routes/CLI directory and
 * converts them into F3 routes
 */
$DS = DIRECTORY_SEPARATOR;
$CLIRoutes = glob(__DIR__ . $DS . '..' . $DS . 'routes'. $DS .'CLI');
foreach ($CLIRoutes as $CLIR) {
    $definitionFiles = scandir($CLIR);
    foreach ($definitionFiles as $definitionFile) {
        $pathinfo = pathinfo($definitionFile);
        //Only include php files that don't start with a .
        if ($pathinfo['extension'] === 'php' && substr($definitionFile, 0, 1)!==".") {
            $definition = include($CLIR . $DS . $definitionFile);
            $_d = explode(".", $definitionFile);
            $className  = reset($_d);

            //set the routes based on definition
            $routesArray = $definition["routes"];
            if (isset($routesArray) && count($routesArray) > 0) {
                $cli_namespace = 'Controllers\\CLI\\';
                foreach ($routesArray as $endpoint => $resolution) {
                    if(is_numeric($endpoint)){
                        $endpoint = $resolution;
                    }
                    $_handler = $cli_namespace . $className .'->'. $resolution;
                    $app->route('GET /cli/' . $endpoint, $_handler);
                }
            }

        }
    }
}

