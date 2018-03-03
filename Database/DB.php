<?php

namespace Database;

class DB {
    private static $db;
    
    public static function set($db){
        self::$db = $db;
    }
    
    public static function query($command){
        return self::$db->query($command);
    }  
}
