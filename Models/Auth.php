<?php

namespace Models;

use Core\Validator;
use Core\App;
use Core\Database;

//разделить логику входа

class Auth {

    public static function authUser() {

        $login = $_POST['login'];
        $password = $_POST['password'];

        $errors = [];

        Validator::string($login, "Login must be between 6 and 30 characters", 1, 30); //Поменять потом
        Validator::string($password, "Password must be at least 8 characters", 1);

        if (!empty(Validator::$errors)) {
            return view("auth.view.php", [
                "siteTitle" => "Вход",
                "errors" => Validator::$errors
            ]);
        }

        $db = App::resolve(Database::class);
        $user = $db->query("SELECT id, login, role_id FROM users WHERE login = :login AND password = :password", [
                    ":login" => $login,
                    ":password" => md5($password . SALT)
                ])->fetch();

        if (!$user) {
            $_SESSION['message'] = "Wrong login or password";
            header("Location: /auth");
            exit();
        } else {
            $_SESSION["login"] = $user["login"];
            $_SESSION["user_id"] = $user['id'];
            $_SESSION["role_id"] = $user['role_id'];

            session_regenerate_id(true);

            $db->query("UPDATE users SET last_auth_date = :date WHERE login = :login", [
                ":date" => date('Y-m-d H:i:s'),
                ":login" => $login
            ]);
            if (isset($_POST['cookieCheckBox'])) {
                setcookie('userKey', $user['id'] . '_' . md5($user['login'] . SALT), time() + 3600, '/');
            }
            header("Location: /");
            exit;
        }
    }

    public static function logoutUser() {

        session_destroy();
        $_SESSION = [];
        setcookie('userKey', '', time() - 3600, '/');
        setcookie('PHPSESSID', '', time() - 3600, '/');
        header('Location:' . $_SERVER['HTTP_REFERER']);
        exit();
    }

}
