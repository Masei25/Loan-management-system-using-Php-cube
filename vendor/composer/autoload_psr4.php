<?php

// autoload_psr4.php @generated by Composer

$vendorDir = dirname(dirname(__FILE__));
$baseDir = dirname($vendorDir);

return array(
    'Twig\\' => array($vendorDir . '/twig/twig/src'),
    'Symfony\\Polyfill\\Mbstring\\' => array($vendorDir . '/symfony/polyfill-mbstring'),
    'Symfony\\Polyfill\\Ctype\\' => array($vendorDir . '/symfony/polyfill-ctype'),
    'App\\Providers\\' => array($baseDir . '/app/providers'),
    'App\\Models\\' => array($baseDir . '/app/models'),
    'App\\Middlewares\\' => array($baseDir . '/app/middlewares'),
    'App\\Exceptions\\' => array($baseDir . '/app/exceptions'),
    'App\\Events\\' => array($baseDir . '/app/events'),
    'App\\Core\\' => array($baseDir . '/main/core'),
    'App\\Controllers\\' => array($baseDir . '/app/controllers'),
);
