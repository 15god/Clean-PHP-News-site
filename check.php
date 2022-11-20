<?php
  if (!empty($_POST) ) {
    $email = $_POST["email"] ?? '';
    $password = $_POST["password"] ?? '';
    function checkAuth(string $email, string $password): bool {
      $file = "usersDB.txt";
      $file = fopen('usersDB.txt', 'r');
      while(!feof($file)){
          $line = fgets($file);
          $array = explode(";",$line);
          if(trim($array[0]) == $_POST["email"] && trim($array[1])==$_POST["password"]){
              return true;
              break;
              }
            }
      return false;
    }
    if (checkAuth($email, $password)) {
          setcookie('email','$email', 0, '/');
          setcookie('password','$password', 0, '/');
          header("Location: /");
          exit;
    }
    else {
      $error = "Ошибка";
      header("Location: auth.php");
      exit;
    }
  }
  elseif (!empty($_GET)) {
    file_put_contents("usersDB.txt", $_GET["email"] . ";" . $_GET["password"] . "\n", FILE_APPEND);
    header("Location: /auth.php");
    exit;
  }
  else{
    echo "failed";
  }
?>
