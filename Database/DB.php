<?php

namespace Database;

class DB {
    private static $db;
    
    public static function set($db){
        self::$db = $db;
    }
    
    public static function query($command, $params){
        return self::$db->query($command, $params);
    }
    
    public static function seed(){
        return self::$db->seed();
    }
}
