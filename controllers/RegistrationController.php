<?php

use Http\Forms\RegForm;
use Core\App;
use Core\Database;

class RegistrationController {

    public function create() {

        view("reg.view.php", [
            "siteTitle" => "Регистрация",
        ]);
    }

    public function store() {

        $email = $_POST['email'];
        $login = $_POST['login'];
        $password = $_POST['password'];

        $form = new RegForm;

        if ($form->validate($email, $login, $password)) {

            $db = App::resolve(Database::class);
            $userCount = $db->query("SELECT COUNT(*) FROM users WHERE login = :login OR email = :email", [
                        ":login" => $login,
                        ":email" => $email
                    ])->fetchColumn();

            if ($userCount == 0) {
                $db->query("INSERT INTO users (login, email, password)
                VALUES(:login, :email, :password)", [
                    ":login" => $login,
                    ":email" => $email,
                    ":password" => md5($password . SALT)
                ]);
                $_SESSION['message'] = "User registered";
                redirect('/login');
            }
            else {
                $form->addError("email", "Username or email is already in use");
            }
            //$_SESSION['message'] = "Username or email is already in use";
        }
        return view("reg.view.php", [
            "siteTitle" => "Регистрация",
            "errors" => $form->getErrors()
        ]);
    }

}
