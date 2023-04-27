<?php

namespace Core;

class Validator {
    
    public static $errors = [];
    
    private static function error($result, $response) {
        
        if (!$result){
            self::$errors[] = $response;
        }
    }
    
    public static function string($value, $response, $min = 1, $max = INF){
        
        $value = trim($value);
        $result = strlen($value) >= $min && strlen($value) <= $max;
        self::error($result, $response);
        return $result;
        
    }
    
    public static function email($value, $response) {
        
        $result = filter_var($value, FILTER_VALIDATE_EMAIL);
        self::error($result, $response);
        return $result;
    }
    
}
