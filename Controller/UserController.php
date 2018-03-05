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
       $id = (int)filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
       if(!$id){
           UriManager::redirect('users');
       }
       $user = User::getByID($id);
       if(!$user){
           UriManager::redirect('users');
       }
       
       $old = $user->asArray();
       include("View/admin/edit.php");
    }
    
    public function update(){
       $id = (int)filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
       if(!$id){
           UriManager::redirect('users');
       }
       $user = User::getByID($id);
       if(!$user){
           UriManager::redirect('users');
       }
       
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
                'password'      => 'max_len,50|min_len,6',
                'password_confirm'      => 'max_len,50|min_len,6',
                'email' => 'required|valid_email'
        ));

        $validated = $gump->run($data);
        $errors = $gump->get_errors_array();
        
        if($validated['password'] !== $validated['password_confirm']){
            $errors['password_confirm'] = 'Passwords dont match!';
        }
        
        $userData = $user->asArray();
        
        if(empty($errors)){
            if($validated['email'] != $userData['email']){
                $result = \Database\DB::query('SELECT COUNT(*) FROM ' . User::getTableName() . ' WHERE email = :email', array('email' => $validated['email']));
                $result = $result->fetch();
                if((int)$result[0] > 0){
                    $errors['email'] = 'This new email address is already taken';
                }
            }
        }
        
        if(empty($errors)){
            if(!empty($validated['password'])){
               $origPass = $validated['password'];
               $validated['password'] = User::hash($validated['password']); 
            }else $validated['password'] = $userData['password'];
            
            if($id != $_SESSION['id']){
                empty($_POST['is_admin']) ? $validated['is_admin'] = 0 : $validated['is_admin'] = 1;
            }else $validated['is_admin'] = $userData['is_admin'];
            
            $user->update($validated);
            $user->save();
            UriManager::redirect('users');
        }else{
            $old = $data;
            include("View/admin/edit.php");
        }
    }
    
    public function create(){
        include("View/admin/create.php");  // czemu tu widok sie sypie?
    }
    
    public function post(){
        $result = self::tryCreate();
        $errors = $result['errors'];
        $validated = $result['validated'];
        $data = $result['data'];
        
        if(empty($errors)){
            $origPass = $validated['password'];
            $validated['password'] = User::hash($validated['password']);
            empty($_POST['is_admin']) ? $validated['is_admin'] = 0 : $validated['is_admin'] = 1;
            $user = new User($validated);
            $user->save();
            UriManager::redirect('users');
        }else{
            $old = $data;
            include("View/admin/create.php");
        }
    }
    
    public function delete(){
       (int)$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
       if(!$id || ($id == $_SESSION['id'])){
           UriManager::redirect('users');
       }
       $user = User::getByID($id);
       if(!$user){
           UriManager::redirect('users');
       }
       
       $user->delete();
       UriManager::redirect('users');
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
