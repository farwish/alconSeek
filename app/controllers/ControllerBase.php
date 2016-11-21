<?php

use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{
    use Alcon\Traits\ControllerTrait;
    
    public function initialize()
    {
        self::init();
    }
}
