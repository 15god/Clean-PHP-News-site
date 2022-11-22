<?php

function checkAuth(array $userInfo): bool {
    $infoJSON = json_decode(file_get_contents("usersDB.json"), true);
    for ($i = 0; $i < count($infoJSON); $i++) {
        if ((md5($infoJSON[$i]["login"]) === md5($userInfo["login"])) &&
                (md5($infoJSON[$i]["password"]) === md5($userInfo["password"]))) {
            return true;
        }
    }
    return false;
}

function userReg(array $newUserInfo) {
    $infoJSON = json_decode(file_get_contents("usersDB.json"), true);
    $infoJSON[] = $newUserInfo;
    file_put_contents("usersDB.json", json_encode($infoJSON));
}

function inputDataFormat() {
    if (!empty($_POST['email'])) {
        $userInfo = [
            "login" => trim(htmlspecialchars($_POST["login"])),
            "password" => trim(htmlspecialchars($_POST["password"])),
            "email" => filter_var(htmlspecialchars($_POST["email"]), FILTER_SANITIZE_EMAIL)
        ];
    } else {
        $userInfo = [
            "login" => trim(htmlspecialchars($_POST["login"])),
            "password" => trim(htmlspecialchars($_POST["password"]))
        ];
    }
    return $userInfo;
}
