<?php

namespace Core\Middleware;

class Auth{
    
    public function handle() {

        if (!$_SESSION["user_id"] ?? false) {
            header("Location: /");
            exit();
        }
    }
}
