<?php

namespace Controller;

use Model\User;

class UserController {
    
    public function __construct($redirect) {
        if(!User::isAuth()){
            header('Location: ' . $redirect);
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
}
