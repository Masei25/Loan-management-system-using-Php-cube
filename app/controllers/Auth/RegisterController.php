<?php

namespace App\Controllers\Auth;

use App\Core\Http\Request;
use App\Models\UsersModel;
use App\Core\Http\Response;
use App\Core\Http\Controller;
use App\Core\Misc\InputValidator;

class RegisterController extends Controller
{
    public function register(Request $request, Response $response)
    {   
        $firstname = $request->input('firstname');
        $lastname = $request->input('lastname');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $transpin = $request->input('transpin');
        $transpin2 = $request->input('transpin2');
        $password = $request->input('password');
        $password2 = $request->input('password2');

        //validate input class
        InputValidator::init([
            'emailField' => function(InputValidator $validator, string $message){
                if($validator->getValue() == ''){
                    return null;
                }

                if(UsersModel::findBy('email', $validator->getValue())){
                    $validator->attachError($message);
                }
            }
        ]);

        $firstname->validate('required');
        $lastname->validate('required');
        $email->validate('required')->emailField('Email already exist');
        $phone->validate('required');
        $transpin->validate('required')->equals($transpin2, 'Transaction pin mismatch');
        $password->validate('required')->equals($password2, 'Password mismatch');

        if(!InputValidator::isValid()){
            $error = InputValidator::getErrors();
            return $response->withSession('msg', $error)->redirect('/register');
        }

        UsersModel::createEntry([
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'phone' => $phone,
            'transpin' => password_hash($transpin, PASSWORD_BCRYPT),
            'password' => password_hash($password, PASSWORD_BCRYPT)
        ]);

        $msg = 'Account successfully created. Please login to your account';
        return $response->withSession('msg', $msg)->redirect('/login');
    }
}