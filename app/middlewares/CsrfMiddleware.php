<?php

namespace App\Middlewares;

use App\Core\Tools\Csrf;
use App\Core\Http\Request;
use App\Core\Interfaces\MiddlewareInterface;

class CsrfMiddleware implements MiddlewareInterface
{
    /**
    * Trigger middleware event
    *
    * @param Request $request
    * @return mixed
    */
    public function trigger(Request $request)
    {   
        $token = $request->input('csrf_token');

        if(!Csrf::isValid($token)) {
            response()
                ->withSession('msg', 'Invalid request')
                ->redirect($request->url()->getPath());
        }

        return $request;
    }
}