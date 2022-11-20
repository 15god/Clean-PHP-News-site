<?php
setcookie('email','$email', time()-1, '/');
setcookie('password','$password', time()-1, '/');
header("Location: /");
 ?>
