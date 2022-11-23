<?php

function checkAuth(array $userInfo): bool {
    $infoJSON = json_decode(file_get_contents("usersDB.json"), true);
    foreach ($infoJSON as $user) {
        if (md5($user['login']) === md5($userInfo["login"])) {
            if (md5($user['password']) === md5($userInfo["password"])) {
                return true;
            }
            return false;
        }
    }
    return false;
}

function userReg(array $newUserInfo): bool {
    $infoJSON = json_decode(file_get_contents("usersDB.json"), true);
    foreach ($infoJSON as $user) {
        if ($user["email"] == $newUserInfo["email"] || $user["login"] == $newUserInfo["login"]) {
            return false;
        }
    }
    $infoJSON[] = $newUserInfo;
    file_put_contents("usersDB.json", json_encode($infoJSON, JSON_PRETTY_PRINT));
    return true;
}

function inputDataFormat() {
    $userInfo = [
        "login" => trim(htmlspecialchars($_POST["login"])),
        "password" => trim(htmlspecialchars($_POST["password"]))
    ];
    if (!empty($_POST['email'])) {
        $userInfo["email"] = filter_var(htmlspecialchars($_POST["email"]), FILTER_SANITIZE_EMAIL);
    }
    return $userInfo;
}

function autoLogin() {
    $infoJSON = json_decode(file_get_contents("usersDB.json"), true);
    foreach ($infoJSON as $user) {
        if ($_COOKIE['userKey'] === md5($user['login'])) {
            return true;
        }
    }
    return false;
}
