<?php

namespace Model;

use Database\DB;

class User extends Model
{
    private $name;
    private $surname;
    private $address;
    private $password;
    private $email;
    private $is_admin;
    
    public static function getTableName(){
        return "users";
    }

    protected function fill($array){
        $this->name = $array['name'];
        $this->surname = $array['surname'];
        $this->address = $array['address'];
        $this->password = $array['password'];
        $this->email = $array['email'];
        $this->is_admin = (int)$array['is_admin'];
    }
    
    public function asArray(){
        return array(
            'id' => $this->id,
            'name' => $this->name,
            'surname' => $this->surname,
            'address' => $this->address,
            'password' => $this->password,
            'email' => $this->email,
            'is_admin' => $this->is_admin
        );
    }
    
    protected function getInsertSql(){
        $sql = "INSERT INTO " . self::getTableName();
        $sql .= " (name, surname, address, password, email, is_admin) ";
        $sql .= "VALUES ( :name, :surname, :address, :password, :email, :is_admin)";
        return $sql;
    }
    
    protected function getUpdateSql(){
        $sql = "UPDATE " . self::getTableName() .  " SET ";
        $sql .= " name = :name";
        $sql .= ", surname = :surname";
        $sql .= ", address = :address";
        $sql .= ", password = :password";
        $sql .= ", email = :email";
        $sql .= ", is_admin = :is_admin";
        $sql .= " WHERE id = :id";
        return $sql;
    }
    
    public static function getTableCreateString(){
        $sql = "CREATE TABLE IF NOT EXISTS " . self::getTableName() . " (";
        $sql .= " id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,";
        $sql .= " name VARCHAR(50) NOT NULL,";
        $sql .= " surname VARCHAR(50) NOT NULL,";
        $sql .= " address VARCHAR(50) NOT NULL,";
        $sql .= " password VARCHAR(100) NOT NULL,";
        $sql .= " email VARCHAR(60) NOT NULL UNIQUE,";
        $sql .= " is_admin TINYINT(1) NOT NULL";
        $sql .= ")";
        return $sql;
    }
    
    public static function isAuth(){
        if(!isset($_SESSION['id'])){
            return false;
        }
        $id = $_SESSION['id'];
        if(self::getByID($id) == null){
            return false;
        }
        return true;
    }
    
    public static function isAdmin(){
        if(!isset($_SESSION['id'])){
            return false;
        }
        $id = $_SESSION['id'];
        $user = self::getByID($id);
        if($user == null) return false;
        if($user->is_admin == 1) return true;
        
    }
    
    public function login($email, $password){
        $id = null;
        
        $result = DB::query("SELECT id, password FROM " . self::getTableName() . " WHERE email = :email", array('email' => $email));
        $result = $result->fetch();
        
        if($result != null){
            if(password_verify($password, $result['password'])){
                $id = (int)$result['id'];
                $_SESSION['id'] = $id;
            }
        }
        
        return $id;
    }
    
    public static function hash($password){
        return password_hash($password, PASSWORD_DEFAULT);
    }
    
    public static function getByID($id){
        $result = DB::query("SELECT * FROM " . self::getTableName() . " WHERE id = :id", array('id' => $id));
        $result = $result->fetch();
        if($result == null) return null;
        return new self($result, (int)$result['id']);
    }
}