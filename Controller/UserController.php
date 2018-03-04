<?php

namespace Controller;

use Model\User;
use Helpers\UriManager;
use Helpers\Helper;

class UserController {
    
    public function __construct() {
        if(!User::isAuth()){
            header(UriManager::getHeader(''));
            die();
        }
    }
    
    public function get(){
        echo "get";
    }
    
    public function post(){
       echo "post"; 
    }
    
    public function put(){
        echo "put";
    }
    
    public function delete(){
        echo "delete";
    }
    
    public function logout(){
        unset($_SESSION['id']);
        header(UriManager::getHeader(''));
        die();
    }
}
