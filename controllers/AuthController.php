<?php

use Models\Auth;

class AuthController {

    public function create() {

        view("auth.view.php", [
            "siteTitle" => "Вход",
        ]);
    }

    public function store() {

        Auth::authUser(); //extract redirect
    }

    public function destroy(){
        
        Auth::logoutUser();
    }
}
