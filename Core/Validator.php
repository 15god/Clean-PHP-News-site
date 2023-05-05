<?php

namespace Core;

class Validator {
    
    public static function string($value, $min = 1, $max = INF){
        
        $value = trim($value);
        $result = strlen($value) >= $min && strlen($value) <= $max;
        return $result;
        
    }
    
    public static function email($value) {
        
        $result = filter_var($value, FILTER_VALIDATE_EMAIL);
        return $result;
    }
    
}
