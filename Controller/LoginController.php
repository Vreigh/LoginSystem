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
        include("View/welcome.php");
    }
    
    public function login(){
        $userFormAction = UriManager::getUrl('register');
        
        $gump = new GUMP();
        $_POST = $gump->sanitize($_POST);
        
        $gump->validation_rules(array(
                'login_email'    => 'required|valid_email',
                'login_password'    => 'required',
        ));
        
        $validated = $gump->run($_POST);
        $errors = $gump->get_errors_array();
        
        if(empty($errors)){
            $id = User::login($validated['login_email'], $validated['login_password']);
            $id != null ? $_SESSION['id'] = $id : $errors['login_general'] = "Email and Password don't match";
        }
        
        if(empty($errors)){
            UriManager::redirect('users');
        }else{
            $old['login_email'] = $_POST['login_email'];
            include("View/welcome.php"); 
        }
    }
    
    public function register(){
        $gump = new GUMP();
        $_POST = $gump->sanitize($_POST);
        
        $gump->validation_rules(array(
                'name'    => 'required|alpha_numeric|max_len,40|min_len,2',
                'surname'    => 'required|max_len,50|min_len,2',
                'address'       => 'required|max_len,40|min_len,2',
                'password'      => 'required|max_len,50|min_len,6',
                'email' => 'required|valid_email'
        ));

        $validated_data = $gump->run($_POST);
        
        var_dump($gump->get_errors_array()); 
        // sprawdz, czy istnieje juz uzytkownik o podanym mailu - jesli tak, dodaj do errorow
        // sprawdz, czy zostalo cos wpisane przy tajnym hasle
        // dane poprawne - utworz usera i zapisz
    }
}
