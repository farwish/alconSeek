<?php
/**
 * 路由注册.
 *
 * @farwish
 */
$routes = include(APP_PATH . "/app/config/route_conf.php");

$router = $di->getShared('router');

foreach ($routes as $val) {
    $router->add($val[0], $val[1])->via($val[2]);
}

$router->handle();
