<?php

namespace Helpers;

class UriManager {
    private static $root = '';
    
    public static function prepare($root){
        self::$root = $root;
    }
    
    public static function getRequestUri(){
        return str_replace(self::$root, '', filter_input(INPUT_SERVER, 'REQUEST_URI', FILTER_SANITIZE_STRING));
    }
    
    public static function getUrl($target){
        return self::$root . $target;
    }
    
    private static function getHeader($target){
        return 'Location: ' . self::getUrl($target);
    }
    
    public static function redirect($target){
        header(self::getHeader($target));
        die();
    }
}
