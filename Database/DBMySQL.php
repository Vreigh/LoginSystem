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
        
        if($build) $this->pdo->query("CREATE DATABASE IF NOT EXISTS $config[name]");
        $this->pdo->query("use $config[name]");
        
        if($build) $this->buildTables();
    }
    
    private function buildTables(){
        $this->query(User::getTableCreateString());
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
}