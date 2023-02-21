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
      <p>
        Имя
      </p>
      <input name="name" />
    </div>
    <div class="form-item">
      <p>
        Email:
      </p>
      <input name="email" />
    </div>
    <div class="form-item">
      <p>
        Год:
        <select name="year">
          <?php 
          for ($i = 2000; $i <= 2023; $i++) {
            printf('<option value="%d">%d год</option>', $i, $i);
          }
          ?>
        </select>
      </p>
    </div>
    <div class="form-item">
      <ul>
        <p>
          Пол:
        </p>
        <li>
          <input type="radio" name="sex" value="male" checked>
          <label>
            Мужчина
          </label>
        </li>
        <li>
          <input type="radio" name="sex" value="female">
          <label>
            Женщина
          </label>
        </li>
      </ul>
    </div><br>
    <div class="form-item">
      <ul>
        Конечностей:
        <li>
          <input type="radio" name="limbs" value="3">
            <label>
              3
            </label>
        </li>
          <li>
          <input type="radio" name="limbs" value="4" checked>
            <label>
              4
            </label>
          </li>
      </ul>
    </div><br>
    <div class="form-item">
      Биография:<textarea name="biography"></textarea>
    </div><br>
    <input type="submit" value="ok" />
  </form>
</body>
</html>