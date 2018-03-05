<?php

namespace Controller;

use Model\User;
use Helpers\UriManager;
use Helpers\Helper;
use Helpers\GUMP;
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
       $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
       if(!$id){
           UriManager::redirect('users');
       }
       $user = User::getByID($id);
       if(!$user){
           UriManager::redirect('users');
       }
       
       $userFormAction = UriManager::getUrl('user?id=' . $id);
       $old = $user->asArray();
       include("View/admin/edit.php");
    }
    
    public function update(){
       $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
       if(!$id){
           UriManager::redirect('users');
       }
       $user = User::getByID($id);
       if(!$user){
           UriManager::redirect('users');
       }
       
       echo "TO DO"; // walidacja update (recznie)
    }
    
    public function create(){
        echo "create";
    }
    
    public function post(){
        // TO DO
    }
    
    public function delete(){
       $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
       if(!$id || ($id == $_SESSION['id'])){
           UriManager::redirect('users');
       }
       $user = User::getByID($id);
       if(!$user){
           UriManager::redirect('users');
       }
       
       //$user->delete();
    }
    
    public function logout(){
        unset($_SESSION['id']);
        UriManager::redirect('');
    }
    
    public static function tryCreate(){
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
                'name'    => 'required|max_len,40|min_len,2',
                'surname'    => 'required|max_len,50|min_len,2',
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
        
        return array(
            'data' => $data,
            'validated' => $validated,
            'errors' => $errors
        );
    }
}
