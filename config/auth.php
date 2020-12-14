<?php

use App\Providers\UsersProvider;

return array(

    'schema' => 'users',

    'primary_key' => 'id',

    'hash_method' => 'password_verify',

    'instance' => UsersProvider::class,
    
    'combination' => array(
        array(
            'secret_key' => 'password',
            'fields' => 'email'
        )
    )
);