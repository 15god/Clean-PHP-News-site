<?php

use Models\Registration;

class RegistrationController{
    
    public function create() {

        view("reg.view.php", [
            "siteTitle" => "Регистрация",
        ]);
    }
    
    public function store() {

        Registration::storeUser;
    }
}