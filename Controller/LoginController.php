<?php

namespace Controller;

use Model\User;
use Helpers\UriManager;
use Helpers\Helper;
use Helpers\GUMP;
use Controller\UserController;

class LoginController {
    
    public function __construct() {
        if(User::isAuth()){
            UriManager::redirect('users');
        }
    }
    
    public function get(){
        $userFormAction = UriManager::getUrl('register');
        $hideRegister = true;
        include("View/welcome.php");
    }
    
    public function login(){
        $userFormAction = UriManager::getUrl('register');
        $hideRegister = true;
        
        $data = array(
            'login_email' => $_POST['login_email'],
            'login_password' => $_POST['login_password']
        );
        
        $gump = new GUMP();
        $data = $gump->sanitize($data);
        
        $gump->validation_rules(array(
                'login_email'    => 'required|valid_email',
                'login_password'    => 'required',
        ));
        
        $validated = $gump->run($data);
        $errors = $gump->get_errors_array();
        
        if(empty($errors)){
            $id = User::login($validated['login_email'], $validated['login_password']);
            $id != null ? '' : $errors['login_general'] = "Wrong email or password";
        }
        
        if(empty($errors)){
            UriManager::redirect('users');
        }else{
            $old = $data;
            include("View/welcome.php"); 
        }
    }
    
    public function register(){
        $userFormAction = UriManager::getUrl('register');
        $hideLogin = true;
        
        $result = UserController::tryCreate();
        $errors = $result['errors'];
        $validated = $result['validated'];
        $data = $result['data'];
        
        if(empty($errors)){
            $origPass = $validated['password'];
            $validated['password'] = User::hash($validated['password']);
            $user = new User($validated);
            $user->save();
            User::login($validated['email'], $origPass);
            UriManager::redirect('users');
        }else{
            $old = $data;
            include('View/welcome.php');
        }
    }
}
