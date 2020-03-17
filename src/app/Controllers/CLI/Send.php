<?php

namespace Controllers\CLI;


class Send extends Base
{


  public function __construct($app)
  {
    parent::__construct($app);
    $this->logger = $this->app->get('LOGGER');

  }
}
