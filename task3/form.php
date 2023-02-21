<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>Form</title>
</head>
<body>
<form class="form" action="" method="POST">
  Имя: <input name="name" />
  e-mail: <input name="email" />
  ><label><input type="radio" checked="checked" name="sex" value="male"/>
    Мужчина
  </label>
  <label><input type="radio" name="sex" value="female" />
    Женщина
  </label>
  Год: <select name="year"> <?php 
    for ($i = 1922; $i <= 2022; $i++) {
      printf('<option value="%d">%d год</option>', $i, $i);
    }
   ?>
  </select>
  <input class="input" type="submit" value="ok" />
</form>
</body>
</html>