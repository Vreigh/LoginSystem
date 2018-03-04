<?php

namespace Controller;

use Model\User;
use Helpers\UriManager;
use Helpers\Helper;

class UserController {
    
    public function __construct() {
        if(!User::isAuth()){
            UriManager::redirect('');
        }
    }
    
    public function index(){
        if(!User::isAdmin()){
            include("View/nonadmin.php");
        }else{
            include("View/admin.php");
        }
    }
    
    public function edit(){
        // wyswietl formularz uzytkownika
    }
    
    public function update(){
       echo "post";
       // walidacja. Wszystko ok - update.
    }
    
    public function create(){
        // niemal identycznie jak przy rejestracji
    }
    
    public function delete(){
       // sprawdz, czy nie usuwam sam siebie
    }
    
    public function logout(){
        unset($_SESSION['id']);
        UriManager::redirect('');
    }
}
