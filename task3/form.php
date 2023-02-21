<?php 
  if (empty($name)) {
    $errors = "Пустое имя!";
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
  <link rel="stylesheet" href="style.css">
  <title>Form</title>
</head>
<body>
  <span> <?php echo $errors ?></span>
  <form action="" method="POST">
    <div class="form-content">
      <div class="form-item">
        <h1>
          Форма
        </h1>
      </div>
      <div class="form-item">
        <p>
          Имя
        </p>
        <input class="line" name="name" />
      </div>
      <div class="form-item">
        <p>
          Email:
        </p>
        <input class="line" name="email" />
      </div>
      <div class="form-item">
        <p>
          Год рождения:
          <select name="year">
            <?php 
            for ($i = 2022; $i >= 1922; $i--) {
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
            <input type="radio" id="radioMale" name="sex" value="male" checked>
            <label for="radioMale">
              Мужчина
            </label>
          </li>
          <li>
            <input type="radio" id="radioFemale" name="sex" value="female">
            <label for="radioFemale">
              Женщина
            </label>
          </li>
        </ul>
      </div>
      <div class="form-item">
        <ul>
          <p>
            Конечностей:
          </p>
          <li>
            <input type="radio" id="radioThree" name="limbs" value="3">
              <label for="radioThree">
                3
              </label>
          </li>
            <li>
            <input type="radio" id="radioFour" name="limbs" value="4" checked>
              <label for="radioFour">
                4
              </label>
            </li>
        </ul>
      </div>
      <div class="form-item">
        <p class="big-text">
          Биография:
        </p>
        <p class="small-text">
          (макс. 128 символов)
        </p>
        <textarea name="biography" cols=24 rows=4 maxlength=128></textarea>
      </div>
    </div>  
    <input class="btn" type="submit" value="Отправить" />
  </form>
</body>
</html>