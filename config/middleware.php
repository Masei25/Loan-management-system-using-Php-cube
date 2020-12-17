<?php

use App\Middlewares\AuthMiddleware;
use App\Middlewares\UserMiddleware;
use App\Middlewares\AdminMiddleware;
use App\Middlewares\CheckAuthMiddleware;

return array(
    'auth' => AuthMiddleware::class,
    'auth_check' => CheckAuthMiddleware::class,
    'admin_check' => AdminMiddleware::class,
    'user_check' => UserMiddleware::class
);