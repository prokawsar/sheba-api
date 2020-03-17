<?php

namespace Controllers\CLI;

use \Models\Apikey;

class Purge extends Base
{

    public function __construct($app)
    {
        parent::__construct($app);

    }

    /*
    * this will delete only files containing in the /runtime/cache folder
    * which will not delete the subfolders
    */
    public function clearCache()
    {
        $folder = $this->app->get('TEMP');
        $folder .= '/cache/*.*';
        array_map('unlink', array_filter((array) glob($folder)));
    }

    /*
    * this will Permanently delete all apikey those has 'active' is 0
    *
    */
    public function clearAPIKey()
    {
        Apikey::deleteAllInactiveKey();
    }

}