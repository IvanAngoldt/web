<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
  <link rel="stylesheet" href="login.css">
  <title>Login</title>
</head>
<body>
<div class="login">
    <?php 
      if (!empty($messages)) {
        foreach ($messages as $message) {
          print($message);
        }
      }
    ?>
    <form action="" method="post">
      <p>Вход</p>
      <input name="login" class="form-content">
      <input name="password" type="password" class="form-content">
      <input type="submit" value="Войти" class="form-content"/>
    </form>
</div>
</body>