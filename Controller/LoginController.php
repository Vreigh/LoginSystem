<?php

namespace Controller;

use Model\User;
use Helpers\UriManager;
use Helpers\Helper;

class LoginController {
    
    public function __construct() {
        if(User::isAuth()){
            header(UriManager::getHeader('users'));
            die();
        }
    }
    
    public function get(){
        $userFormAction = UriManager::getUrl('register');
        include("View/welcome.php");
    }
    
    public function login(){
        $userFormAction = UriManager::getUrl('register');
        $errors = [];
        if(empty($_POST['l_email'])){
            $errors['l_email'] = [];
            array_push($errors['l_email'], 'To pole jest wymagane!');
        }
        if(empty($_POST['l_password'])){
            $errors['l_password'] = [];
            array_push($errors['l_password'], 'To pole jest wymagane!');
        }   
        if(empty($errors)){
            $id = User::login($_POST['l_email'], $_POST['l_password']);
            if($id != null){
                $_SESSION['id'] = $id;
            }else{
                $errors['l_general'] = [];
                array_push($errors['l_general'], 'Niepoprawne dane logowania');
            }
        }
        if(empty($errors)){
            header(UriManager::getHeader('users'));
            die();
        }else{
            $old['l_email'] = $_POST['l_email'];
            include("View/welcome.php"); 
        }
    }
    
    public function register(){
        var_dump($_POST);
    }
}
