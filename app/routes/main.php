<?php

#Use the router module
use App\Core\Router\Router;

#Create instance of router
$router = new Router();

#Add routes
$router->any('/', 'CubeController.home')->use('auth_check');

$router->group()->use('auth_check')->namespace('Auth')->register(function(Router $router){

    $router->any('/', 'CubeController.home');
    $router->get('/home', '@home');
    $router->get('/about', '@about');
    $router->get('/services', '@services');
    $router->get('/contact', '@contact');
    $router->get('/404', '@404');

    //route for the registration page
    $router->get('/register', '@register');
    $router->post('/register', 'RegisterController.register');

    //route to login
    $router->get('/login', '@login');
    $router->post('/login', 'LoginController.login');
});

//users route
$router->group('/dashboard')->use(['auth', 'user_check'])->namespace('Dashboard')->register(function(Router $router){
    //route to dashboard
    $router->get('/', 'MainController.index');
    $router->get('/logout', 'MainController.logout');
    $router->get('/404', '@404');

    $router->get('/apply', 'ApplyController.apply');
    $router->post('/apply', 'ApplyController.applyAction');
});

//admin route
$router->group('/admin')->use(['auth', 'admin_check'])->namespace('Admin')->register(function(Router $router){
    //route to admin dashboard
    $router->get('/', 'MainController.index');
    $router->get('/members', 'MainController.members');
    $router->get('/manageloan/{id}', 'ManageloanController.displayloan');
    $router->post('/manageloan/{id}', 'ManageloanController.manageloan');  
    $router->get('/404', '@404'); 
});

$router->get('/logout', 'MainController.logout')->namespace('Admin');