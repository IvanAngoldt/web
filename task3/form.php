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
  <input class="input" type="submit" value="ok" />
</form>
</body>
</html>