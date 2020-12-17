<?php

namespace App\Middlewares;

use App\Core\Tools\Auth;
use App\Core\Http\Request;
use App\Providers\UsersProvider;
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

        $access_type = array(
            'admin' => UsersProvider::ACCESS_TYPE_ADMIN,
            'user' => UsersProvider::ACCESS_TYPE_USER
        );

        if($user){
            if($user->access_type() == $access_type['admin']){
                return redirect('/admin');
            }
        }
        
        if($user){
            if($user->access_type() == $access_type['user']){
                return redirect('/dashboard');
            }
        }

        return $request;
    }
}