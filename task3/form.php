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
    <div class="form-item">
      Имя:<input name="name" />
    <div><br>
    Email:<input name="email" /><br>
    Год:<select name="year">
      <?php 
      for ($i = 1922; $i <= 2022; $i++) {
        printf('<option value="%d">%d год</option>', $i, $i);
      }
      ?>
    </select><br>
    Пол:<input type="radio" name="sex" value="male" checked>
      <label>
        Мужчина
      </label>
    <input type="radio" name="sex" value="female">
      <label>
        Женщина
      </label><br>
    Конечностей:<input type="radio" name="limbs" value="3">
      <label>
        3
      </label>
    <input type="radio" name="limbs" value="4" checked>
      <label>
        4
      </label><br>
    Биография:<textarea name="biography"></textarea><br>
    <input type="submit" value="ok" />
  </form>
</body>
</html>