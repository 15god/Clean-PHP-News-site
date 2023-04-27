<?php

namespace Models;

use Core\Validator;
use Core\App;
use Core\Database;

class Registration {

    public static function storeUser() {

        $email = $_POST['email'];
        $login = $_POST['login'];
        $password = $_POST['password'];

        Validator::string($login, "Login must be between 6 and 30 characters", 6, 30);
        Validator::string($password, "Password must be at least 8 characters", 8,);
        Validator::email($email, "Email is non-valid");

        if (!empty(Validator::$errors)) {
            return view("reg.view.php", [
                "siteTitle" => "Регистрация",
                "errors" => Validator::$errors
            ]);
        }

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
            header("Location: /auth");
            exit();
        } else {
            $_SESSION['message'] = "Username or email is already in use";
            header("Location: /reg");
            exit();
        }
    }

}
