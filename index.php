<?php
include('load.php');

use Database\DB;
use Database\DBMySQL;
use Model\User;
use Controller\LoginController;
use Controller\UserController;
use Helpers\UriManager;


$dbMySQL = new DBMySQL(include("config.php"), true);
DB::set($dbMySQL);

$root = "/php/LoginSystem/";
UriManager::prepare($root);
$uri = UriManager::getrequestUri();
$method = filter_input(INPUT_SERVER, 'REQUEST_METHOD');


/*$array = ['name' => "Jerzy", "surname" => "Jabik", "address" => "exampleAddress", "email" => "ExampleEmail", "password" => "password", 'is_admin' => true];
$user = new User($array);
$user->save();

$user = User::getByID(5);
var_dump($user);
*/
session_start();

if(($uri == '') || ($uri == 'register')){
    $controller = new LoginController();
    
    if(($method == "GET") && ($uri == '')){
        $controller->get();
    }else if(($method == "POST") && ($uri == '')){
        $controller->login();
    }else if(($method == "POST") && ($uri == 'register')){
        $controller->register();
    }
}else if(($uri == 'users') || ($uri == 'users/logout')){
    $controller = new UserController();

    if(($method == "GET") && ($uri == "users")){
        $controller->index();
    }else if(($method == "POST") && ($uri == "users")){
        $controller->post();
    }else if(($method == "PUT") && ($uri == "users")){
        $controller->put();
    }else if(($method == "DELETE") && ($uri == "users")){
        $controller->delete();
    }else if(($method == "GET") && ($uri == "users/logout")){
        $controller->logout();
    }
}else{
    echo "Sorry, bad request!";
}


