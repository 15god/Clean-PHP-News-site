<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" lang="ru">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA=Compatible" content="ie=edge">
		<title>1st PHP Site</title>
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="https://getbootstrap.com/docs/4.0/dist/css/bootstrap.min.css">
	</head>
	<body>
    <?php
    if (isset($error)):
    ?>
    <span style="color:red; font-size:30px">
      <?php echo $error; ?>
    </span>
    <?php endif; ?>
    <form action="check.php" method="post">
      <input type="email" name="email" id="email" placeholder="Введите email" class="form-control">
      <input type="password" name="password" id="password" placeholder="Введите пароль" class="form-control">
      <input type="submit" name="continue" placeholder="Продолжить" class ="btn btn-succes">
    </form>
    <a class="btn btn-outline-primary" href="registr.php">У меня нет аккаунта</a>
  </body>
</html>
