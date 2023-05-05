<?php

namespace Core;

use Core\App;
use Core\Database;
use Core\Session;

class Authenticator {

    public function attempt($login, $password) {

        $db = App::resolve(Database::class);
        $user = $db->query("SELECT id, login, role_id FROM users WHERE login = :login AND password = :password", [
                    ":login" => $login,
                    ":password" => md5($password . SALT)
                ])->fetch();
        if ($user) {
            $this->login($user);
            return true;
        }
        return false;
    }

    public function login($user) {

        $_SESSION["login"] = $user["login"];
        $_SESSION["user_id"] = $user['id'];
        $_SESSION["role_id"] = $user['role_id'];

        session_regenerate_id(true);

        $db = App::resolve(Database::class);
        $db->query("UPDATE users SET last_auth_date = :date WHERE login = :login", [
            ":date" => date('Y-m-d H:i:s'),
            ":login" => $user['login']
        ]);
        if (isset($_POST['cookieCheckBox'])) {
            $this->setCOOKIE($user);
        }
    }

    public function setCOOKIE($user) {
        setcookie('userKey', $user['id'] . '_' . md5($user['login'] . SALT), time() + 3600, '/');
    }

    public function logout() {

        Session::destroy();
    }

    public static function autoLogin() {
        if (isset($_COOKIE['userKey']) && empty($_SESSION['login'])) {
            $id = explode("_", $_COOKIE['userKey']);
            $db = App::resolve(Database::class);
            $user = $db->query("SELECT id, login, role_id FROM users WHERE id = :id", [
                        ":id" => $id[0]
                    ])->fetch();
            if ($_COOKIE['userKey'] === $user['id'] . '_' . md5($user['login'] . SALT)) {
                (new Authenticator)->login($user);
            }
        }
    }

}
