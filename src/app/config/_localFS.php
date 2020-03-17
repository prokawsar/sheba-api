<?php

$localFS = array(
    'folder'        => __DIR__ . '/../../public/files/',
    'url'           => '/files/',
    'domain_url'    => null
);


if (K_ENV == K_ENV_PRODUCTION) {

}

return $localFS;