<?php

namespace App\Middlewares;

use App\Core\Tools\Auth;
use App\Core\Http\Request;
use App\Providers\UsersProvider;
use App\Core\Interfaces\MiddlewareInterface;

class UserMiddleware implements MiddlewareInterface
{
    /**
    * Trigger middleware event
    *
    * @param Request $request
    * @param array|null $args
    * @return mixed
    */
    public function trigger(Request $request, ?array $args = null)
    {   
        $user = Auth::user()->access_type();

        if(!$user == UsersProvider::ACCESS_TYPE_USER){
            return redirect($request->url()->getPath());
        }

        return $request;
    }
}