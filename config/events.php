<?php
use App\Core\App;
use App\Events\AppCrashEvent;
use App\Events\RouteNotFoundEvent;

return array(
    App::EVENT_ROUTE_NO_MATCH_FOUND => [
        RouteNotFoundEvent::class
    ],

    App::EVENT_APP_ON_CRASH => [
        AppCrashEvent::class
    ]
);