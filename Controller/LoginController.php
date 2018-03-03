<?php

namespace Controller;

use Model\User;

class LoginController {
    
    public function __construct($redirect) {
        if(User::isAuth()){
            header('Location: ' . $redirect);
            die();
        }
    }
    
    public function get(){
        include("View/login.php");
    }
    
    public function post(){
       return "POST REQUEST!"; 
    }
}
