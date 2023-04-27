<?php

namespace Core\Middleware;

class Admin{

    public function handle() {

        if ($_SESSION['role_id'] == 1 || !$_SESSION['user_id']) {
            header("Location: /");
            exit();
        }
    }
}
