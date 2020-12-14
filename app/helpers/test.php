<?php

use App\Core\Tools\Auth;
use App\Core\Http\Session;

function notification(){
    $data = Session::getAndRemove('msg');
    return $data ? : '';
}

function get_notification($val){
    $data = Session::get('msg')[$val][0]?? "";
    return $data;  
}

function remove_notification(){
    $data = Session::remove('msg');
    return $data ? : '';
}

function is_authenticated(): bool{
    return !!Auth::user();
}
