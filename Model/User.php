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
    
    public function getTableName(){
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
    
    protected function getInsertSql(){
        $sql = "INSERT INTO " . self::getTableName();
        $sql .= " (name, surname, address, password, email, is_admin) ";
        $sql .= "VALUES ( \"$this->name\", \"$this->surname\", \"$this->address\", \"$this->password\", \"$this->email\", \"$this->is_admin\")";
        return $sql;
    }
    
    protected function getUpdateSql(){
        $sql = "UPDATE " . self::getTableName() .  " SET ";
        $sql .= " name = \"$this->name\"";
        $sql .= ", surname = \"$this->surname\"";
        $sql .= ", address = \"$this->address\"";
        $sql .= ", password = \"$this->password\"";
        $sql .= ", email = \"$this->email\"";
        $sql .= ", is_admin = \"$this->is_admin\"";
        $sql .= " WHERE id = \"$this->id\"";
        return $sql;
    }
    
    public static function getTableCreateString(){
        $sql = "CREATE TABLE IF NOT EXISTS " . self::getTableName() . " (";
        $sql .= " id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,";
        $sql .= " name VARCHAR(50) NOT NULL,";
        $sql .= " surname VARCHAR(50) NOT NULL,";
        $sql .= " address VARCHAR(50) NOT NULL,";
        $sql .= " password VARCHAR(100) NOT NULL,";
        $sql .= " email VARCHAR(60) NOT NULL,";
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
    
    public static function getByID($id){
        $result = DB::query("SELECT * FROM " . self::getTableName() . " WHERE id = $id");
        $result = $result->fetch();
        if($result == null) return null;
        return new self($result, (int)$result['id']);
    }
    
    
}