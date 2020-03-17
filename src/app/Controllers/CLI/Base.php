<?php

namespace Controllers\CLI;

class Base
{
    protected $app;

    //Route params
    protected $params = [];

    public function __construct(\Base $app)
    {
        if (php_sapi_name() !== 'cli'){
            echo 'Na\'ah no go here!!!';
            exit;
        }

        $this->app = \Base::instance();

        $this->params = $_SERVER['argv'];
        array_shift($this->params);
        array_shift($this->params);
    }
}