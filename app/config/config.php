<?php

defined('APP_PATH') || define('APP_PATH', realpath('.'));

return new \Phalcon\Config\Adapter\Ini(
    APP_PATH . '/app/config/config.ini'
);
