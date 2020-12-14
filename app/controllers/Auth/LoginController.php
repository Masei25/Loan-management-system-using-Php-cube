<?php

namespace App\Controllers\Auth;

use App\Core\Tools\Auth;
use App\Core\Http\Request;
use App\Core\Http\Response;
use App\Core\Http\Controller;
use App\Core\Exceptions\AuthException;

class LoginController extends Controller
{
    public function login(Request $request, Response $response)
    {   
        $email = $request->input('email');
        $password = $request->input('password');

        $field_name = $email->isEmail() ? 'email' : '';

        try {
            Auth::attempt([
                $field_name => $email,
                'secret_key' => $password
            ]);
        } catch (AuthException $e) {
            return $response->withSession('msg', $e->getMessage())->redirect($request->url()->getPath());
        }

        return $response->redirect('/dashboard');
    }
}