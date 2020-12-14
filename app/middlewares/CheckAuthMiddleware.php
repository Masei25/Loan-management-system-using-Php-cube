<?php

namespace App\Middlewares;

use App\Core\Tools\Auth;
use App\Core\Http\Request;
use App\Core\Interfaces\MiddlewareInterface;

class CheckAuthMiddleware implements MiddlewareInterface
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
        $user = Auth::user();

        if($user){
            return redirect('/dashboard');
        }

        return $request;
    }
}