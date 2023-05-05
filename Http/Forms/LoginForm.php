<?php

namespace Http\Forms;

use Core\Validator;
use Core\ValidationException;

class LoginForm {

    protected $errors = [];
    
    public function __construct(public array $attributes) {
        
        if(!Validator::string($attributes['login'], 1, 30)){
            $this->errors['login'] = 'Please provide valid login';
        }
        if(!Validator::string($attributes['password'], 1)){
            $this->errors['password'] = 'Please provide valid password';
        }
        
    }

    public static function validate($attributes) {
        
        $instance = new static($attributes);
        
        return $instance->failed() ? $instance->throw() : $instance;
    }
    
    public function throw() {
        
        ValidationException::throw($this->getErrors(), $this->attributes);  
    }
    
    public function failed() {
        
        return !empty($this->errors);
    }
    
    public function addError($field, $response){
        
        $this->errors[$field] = $response;
        
        return $this;
    }
    
    public function getErrors() {
        
        return $this->errors;
    }

}
