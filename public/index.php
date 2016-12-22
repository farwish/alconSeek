<?php

error_reporting(E_ALL);

define('APP_PATH', realpath('..'));

try {

    include APP_PATH . "/vendor/autoload.php";

    /**
     * Read the configuration
     */
    $config = include APP_PATH . "/app/config/config.php";

    /**
     * Read auto-loader
     */
    include APP_PATH . "/app/config/loader.php";

    /**
     * Read services
     */
    include APP_PATH . "/app/config/services.php";

    /**
     * Custom Routes.
     */
    include APP_PATH . "/app/config/routes.php";

    /**
     * Handle the request
     */
    $application = new \Phalcon\Mvc\Application($di);

    echo $application->handle()->getContent();

} catch (\Exception $e) {
    echo $e->getMessage() . '<br>';
    //echo '<pre>' . $e->getTraceAsString() . '</pre>';
}
