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
DB::seed();

$root = "/php/LoginSystem/";
UriManager::prepare($root);
$fullUri = UriManager::getrequestUri();
$fullUri = explode("?", $fullUri, 2);
$uri = $fullUri[0];
$method = filter_input(INPUT_SERVER, 'REQUEST_METHOD');

session_start();

if(($uri == '') || ($uri == 'register')){
    $controller = new LoginController();
    
    if(($method == "GET") && ($uri == '')){
        $controller->get();
    }else if(($method == "POST") && ($uri == '')){
        $controller->login();
    }else if(($method == "POST") && ($uri == 'register')){
        $controller->register();
    }else echo "Sorry, bad request!";
}else if(($uri == 'users') || ($uri == 'user') || ($uri == 'user/create') || 
        ($uri == 'users/logout') || ($uri == 'user/delete')){
    $controller = new UserController();

    if(($method == "GET") && ($uri == "users")){
        $controller->index();
    }else if(($method == "GET") && ($uri == "user")){
        $controller->edit();
    }else if(($method == "GET") && ($uri == "user/create")){
        $controller->create();
    }else if(($method == "POST") && ($uri == "user/create")){
        $controller->post();
    }else if(($method == "POST") && ($uri == "user")){
        $controller->update();
    }else if(($method == "GET") && ($uri == "user/delete")){
        $controller->delete();
    }else if(($method == "GET") && ($uri == "users/logout")){
        $controller->logout();
    }else echo "Sorry, bad request!";
}else{
    echo "Sorry, bad request!";
}


