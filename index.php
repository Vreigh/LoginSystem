<?php
include('load.php');

use Database\DB;
use Database\DBMySQL;
use Model\User;
use Controller\LoginController;
use Controller\UserController;


$dbMySQL = new DBMySQL(include("config.php"), true);
DB::set($dbMySQL);

$root = "/php/LoginSystem/";
$uri = str_replace($root, '', filter_input(INPUT_SERVER, 'REQUEST_URI', FILTER_SANITIZE_STRING));
$method = filter_input(INPUT_SERVER, 'REQUEST_METHOD');



/*$array = ['name' => "Adam", "surname" => "Jabik", "address" => "exampleAddress", "email" => "ExampleEmail", "password" => "password", 'is_admin' => true];
$user = new User($array);
$user->save();*/


session_start();

if($uri == ''){
    $controller = new LoginController($root . 'users');
    
    if($method == "GET"){
        $controller->get();
    }else if($method == "POST"){
        $controller->post();
    }
}else if($uri == 'users'){
    $controller = new UserController($root);

    if($method == "GET"){
        $controller->get();
    }else if($method == "POST"){
        $controller->post();
    }else if($method == "PUT"){
        $controller->put();
    }else if($method == "DELETE"){
        $controller->delete();
    }
}else{
    echo "Sorry, bad request!";
}


