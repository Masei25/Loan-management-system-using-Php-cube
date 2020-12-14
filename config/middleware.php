<?php

use App\Middlewares\AuthMiddleware;
use App\Middlewares\CheckAuthMiddleware;

return array(
    'auth' => AuthMiddleware::class,
    'auth_check' => CheckAuthMiddleware::class
);