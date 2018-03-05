<?php

namespace Controller;

use Model\User;
use Helpers\UriManager;
use Helpers\Helper;
use Database\DB;

class UserController {
    
    public function __construct() {
        if(!User::isAuth()){
            UriManager::redirect('');
        }
    }
    
    public function index(){
        if(!User::isAdmin()){
            include("View/index.php");
        }else{
            $users = DB::query("SELECT * FROM " . User::getTableName());
            $users = $users->fetchAll();
            include("View/admin/index.php");
        }
    }
    
    public function edit(){
       echo "edit " . $_GET['id'];
    }
    
    public function update(){
       // walidacja. Wszystko ok - update.
    }
    
    public function create(){
        echo "create";
    }
    
    public function post(){
        // TO DO
    }
    
    public function delete(){
       echo "delete " . $_GET['id'];
    }
    
    public function logout(){
        unset($_SESSION['id']);
        UriManager::redirect('');
    }
}
