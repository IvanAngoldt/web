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
  <div class="form_item">
    Имя: <input name="name" />
  </div>
  <div class="form_item">
    e-mail: <input name="email" />
  </div>
  <div class="form_item">
    Год: <select name="year">
      <?php 
      for ($i = 1922; $i <= 2022; $i++) {
        printf('<option value="%d">%d год</option>', $i, $i);
      }
      ?>
    </select>
  </div>
  <div class="radio-class1">
    <span>Укажи пол</span><br>
    <label><input type="radio" checked="checked" name="sex" value="male"/>
      Мужчина
    </label>
    <label><input type="radio" name="sex" value="female" />
      Женщина
    </label>
  </div>
  <div class="radio-class2">
    <span>Сколько у вас конечностей</span><br>
    <label><input type="radio" checked="checked" name="limb" value="3"/>
      Три
    </label>
    <label><input type="radio" name="limb" value="4" />
      Четыре
    </label>
  </div>
  <input class="input" type="submit" value="ok" />
</form>
</body>
</html>