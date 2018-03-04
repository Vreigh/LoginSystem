<?php

namespace Database;

use Model\User;

class DBMySQL implements IDatabase
{
    private $config;
    private $pdo;
    
    public function __construct($config, $build = false){
        $this->config = $config;
            
        $this->pdo = new \PDO("mysql:host=$config[server]", $config['username'], $config['password']);
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        
        if($build) $this->pdo->query("CREATE DATABASE IF NOT EXISTS $config[name] DEFAULT CHARACTER SET utf8 COLLATE utf8_polish_ci");
        $this->pdo->query("use $config[name]");
        if($build) $this->buildTables();
    }
    
    public function query($sql, $params = null){
        if($params == null){
            return $this->pdo->query($sql);
        }else{
            $result = $this->pdo->prepare($sql);
            $result->execute($params);
            return $result;
        }
    }
    
    private function buildTables(){
        $this->query(User::getTableCreateString());
    }
    
    public function seed(){
        $result = $this->query('SELECT COUNT(*) FROM ' . User::getTableName());
        $result = $result->fetch();
        if((int)$result[0] == 0){
            $array = ['name' => "admin", "surname" => "admin", "address" => "admin", "email" => "admin@e.pl",
                "password" => User::hash("admin1"), 'is_admin' => true];
            $user = new User($array);
            $user->save();
        }
    }
}