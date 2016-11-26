<?php

defined('APP_PATH') || define('APP_PATH', realpath('.'));

/**
 * Ini配置.
 */
$Ini = new \Phalcon\Config\Adapter\Ini(
    APP_PATH . '/app/config/config.ini'
);

/**
 * 迅搜配置.
 */
$xsconfig = scandir( $Ini->application->xsconfigDir );
foreach ($xsconfig as $v) {
    if ( substr($v, 0, 1) !== '.' ) { 
        $Ini->xs[] = rtrim($v, '.ini'); 
    }
}
unset($xsconfig);

return $Ini;
