<?php

namespace Helpers;


class Helper {
    public static function displayErrors($err){
        if(is_array($err)){
            foreach($err as $row){
                echo "<div class=\"alert alert-danger\"> $row </div>";
            }
        }else{
            echo "<div class=\"alert alert-danger\"> $err </div>";
        }
    }
}
