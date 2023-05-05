<?php

use Core\Authenticator;
use Http\Forms\LoginForm;
use Core\Session;

class LoginController {

    public function create() {

        view("login.view.php", [
            "siteTitle" => "Вход",
            "errors" => Session::get('errors')
        ]);
    }

    public function store() {

        $form = LoginForm::validate($attributes = [
                    'login' => $_POST['login'],
                    'password' => $_POST['password']
        ]);
        
        $signedIn = (new Authenticator)->attempt($attributes['login'], $attributes['password']);
        
        if (!$signedIn) {
            $form->addError('login', 'No matching data')->throw();
        }
        redirect("/");
    }

    public function destroy() {

        (new Authenticator)->logout();
        redirect($_SERVER['HTTP_REFERER']);
    }

}
