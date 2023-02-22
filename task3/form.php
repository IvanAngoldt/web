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
  <form action="" method="POST">
    <div class="form-content">
      <div class="form-item">
        <h1 class="chzh">Форма</h1>
      </div>
      <div class="form-item">
        <p>Имя</p>
        <input class="line" name="name" />
      </div>
      <div class="form-item">
        <p>Email:</p>
        <input class="line" name="email" />
      </div>
      <div class="form-item">
        Год рождения:
        <select name="year">
          <?php 
            for ($i = 2022; $i >= 1922; $i--) {
              printf('<option value="%d">%d год</option>', $i, $i);
            }
          ?>
          </select>
      </div>
      <div class="form-item">
        <ul>
          <p>Пол:</p>
          <li>
            <input type="radio" id="radioMale" name="sex" value="male" checked>
            <label for="radioMale">Мужчина</label>
          </li>
          <li>
            <input type="radio" id="radioFemale" name="sex" value="female">
            <label for="radioFemale">Женщина</label>
          </li>
        </ul>
      </div>
      <div class="form-item">
        <ul>
          <p>Правша или левша:</p>
          <li>
            <input type="radio" id="radioRight" name="hand" value="right" checked>
            <label for="radioRight">Правша</label>
          </li>
          <li>
            <input type="radio" id="radioLeft" name="hand" value="left">
            <label for="radioLeft">Левша</label>
          </li>
        </ul>
      </div>
      <div class="form-item">
        <p>Выбери сверхспособности:</p>
        <ul>
          <li>
            <input type="checkbox" id="god" name="god">
            <label for="god">бессмертие</label>
          </li>
          <li>
            <input type="checkbox" id="noclip" name="noclip">
            <label for="noclip">прохождение сквозь стены</label>
          </li>
          <li>
            <input type="checkbox" id="levitation" name="levitation">
            <label for="levitation">левитация</label>
          </li>
        </ul> 
      </div>
      <div class="form-item">
        <p class="big-text">Расскажи о себе:</p>
        <p class="small-text">(макс. 128 символов)</p>
        <textarea name="biography" cols=24 rows=4 maxlength=128></textarea>
      </div>
    </div>  
    <div class="send">
      <div class="contract">
        <input type="checkbox" id="checkboxContract" name="checkboxContract">
        <label for="checkboxContract">С контрактом ознакомлен</label>
      </div>
      <input class="btn" type="submit" name="submit" value="Отправить" />
    </div>
  </form>
</body>
</html>