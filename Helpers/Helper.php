<?php

namespace Helpers;


class Helper {
    public static function displayErrors($array){
        foreach($array as $row){
            echo "<div class=\"alert alert-danger\"> $row </div>";
        }
    }
}
