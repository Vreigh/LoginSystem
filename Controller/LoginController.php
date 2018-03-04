<?php

namespace Controller;

use Model\User;
use Helpers\UriManager;
use Helpers\Helper;
use Helpers\GUMP;

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
            $id != null ? '' : $errors['login_general'] = "Email and Password don't match";
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
        
        $data = array(
            'name' => $_POST['name'],
            'surname' => $_POST['surname'],
            'address' => $_POST['address'],
            'password' => $_POST['password'],
            'password_confirm' => $_POST['password_confirm'],
            'email' => $_POST['email']
        );
        
        $gump = new GUMP();
        $data = $gump->sanitize($data);
        
        $gump->validation_rules(array(
                'name'    => 'required|alpha_dash|max_len,40|min_len,2',
                'surname'    => 'required|alpha_dash|max_len,50|min_len,2',
                'address'       => 'required|max_len,40|min_len,2',
                'password'      => 'required|max_len,50|min_len,6',
                'password_confirm'      => 'required|max_len,50|min_len,6',
                'email' => 'required|valid_email'
        ));

        $validated = $gump->run($data);
        $errors = $gump->get_errors_array();
        
        if($validated['password'] !== $validated['password_confirm']){
            $errors['password_confirm'] = 'Passwords dont match!';
        }
        
        if(empty($errors)){
            $result = \Database\DB::query('SELECT COUNT(*) FROM ' . User::getTableName() . ' WHERE email = :email', array('email' => $validated['email']));
            $result = $result->fetch();
            if((int)$result[0] > 0){
                $errors['email'] = 'This email address is already taken';
            }
        }
        
        if(empty($errors)){
            $validated['password'] = $validated['password']; // tutaj hashowanie
            $user = new User($validated);
            $user->save();
            User::login($validated['email'], $validated['password']);
            UriManager::redirect('users');
        }else{
            $old = $data;
            include('View/welcome.php');
        }
    }
}
