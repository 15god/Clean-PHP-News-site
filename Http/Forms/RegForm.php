<?php

namespace Http\Forms;

use Core\Validator;

class RegForm {
    
    protected $errors = [];
    
    public function validate($email, $login, $password){
        
        if(!Validator::string($login, 6, 30)){
            $this->errors['login'] = "Login must be between 6 and 30 characters";
        }
        if(!Validator::string($password, 8)){
            $this->errors['password'] = "Password must be at least 8 characters";
        }
        if(!Validator::email($email)){
            $this->errors['email'] = "Email is non-valid";
        }
        
        return empty($this->errors);
    }
    
    public function addError($field, $response){
        
        $this->errors[$field] = $response;
    }
    
    public function getErrors() {
        
        return $this->errors;
    }
}
