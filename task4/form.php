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
  <?php
    if (!empty($messages)) {
        print('<div id="messages">');
        foreach ($messages as $message) {
            print($message);
        }
        print('</div>');
    }
  ?>
  <form action="" method="POST">
    <div class="form-head">
        <h1>Форма</h1>
    </div>
    <div class="form-content">
      <div class="form-item">
        <div class="group1 <?php if ($errors['name']) {print 'error';} ?>">
          <input class="line" name="name" value="<?php print $values['name']; ?>" />
          <label class="labelText " for="name">Имя</label>
        </div>
        <div class="group2 <?php if ($errors['email1'] || $errors['email2']) {print 'error';} ?>">
          <input class="line" name="email" value="<?php print $values['email']; ?>" />
          <label class="labelText" for="name">Email</label>
        </div>
      </div>
      <div class="form-item">
        <div class="date">
          <span <?php if ($errors['year1'] || $errors['year2']) {print 'class="error"';} ?>>Год рождения:</span>
          <select name="year">
            <?php 
              for ($i = 2023; $i >= 1922; $i--) {
                if ($i == $values['year']) {
                  printf('<option selected value="%d">%d год</option>', $i, $i);
                } else {
                printf('<option value="%d">%d год</option>', $i, $i);
                }
              }
            ?>
          </select>
        </div>
      </div>
      <div class="form-item">
        <p <?php if ($errors['sex']) {print 'class="error"';} ?>>Пол:</p>
        <ul>
          <li>
            <input type="radio" id="radioMale" name="sex" value="male" <?php if ($values['sex'] == 'male' || empty($values['sex'])) {print 'checked';} ?>>
            <label for="radioMale">Мужчина</label>
          </li>
          <li>
            <input type="radio" id="radioFemale" name="sex" value="female" <?php if ($values['sex'] == 'female') {print 'checked';} ?>>
            <label for="radioFemale">Женщина</label>
          </li>
        </ul>
      </div>
      <div class="form-item">
        <p <?php if ($errors['hand']) {print 'class="error"';} ?>>Правша или левша:</p>
        <ul>
          <li>
            <input type="radio" id="radioRight" name="hand" value="right" <?php if ($values['hand'] == 'right' || empty($values['hand'])) {print 'checked';} ?>>
            <label for="radioRight">Правша</label>
          </li>
          <li>
            <input type="radio" id="radioLeft" name="hand" value="left" <?php if ($values['hand'] == 'left') {print 'checked';} ?>>
            <label for="radioLeft">Левша</label>
          </li>
        </ul>
      </div>
      <div class="form-item">
        <p <?php if ($errors['abilities1'] || $errors['abilities2']) {print 'class="error"';} ?>>Выбери сверхспособности:</p>
        <ul>
          <li>
            <input type="checkbox" id="god" name="abilities[]" value=1>
            <label for="god">бессмертие</label>
          </li>
          <li>
            <input type="checkbox" id="noclip" name="abilities[]" value=2>
            <label for="noclip">прохождение сквозь стены</label>
          </li>
          <li>
            <input type="checkbox" id="levitation" name="abilities[]" value=3>
            <label for="levitation">левитация</label>
          </li>
        </ul> 
      </div>
      <div class="form-item">
        <p class="big-text <?php if ($errors['biography1'] || $errors['biography2']) {print 'error';} ?>">Расскажи о себе:</p>
        <p class="small-text">(макс. 128 символов, кириллица)</p>
        <textarea name="biography" cols=24 rows=4 maxlength=128 spellcheck="false"><?php if (!empty($values['biography'])) {print $values['biography'];} ?></textarea>
      </div>
    </div>  
    <div class="send">
      <div class="contract">
        <input type="checkbox" id="checkboxContract" name="checkboxContract" <?php if ($values['checkboxContract'] == '1') {print 'checked';} ?>>
        <label for="checkboxContract" <?php if ($errors['checkboxContract']) {print 'class="error"';} ?>>С контрактом ознакомлен</label>
      </div>
      <input class="btn" type="submit" name="submit" value="Отправить" />
    </div>
  </form>
  <div class="href">
    <a href="../task3/showDB/"><img src="https://cdn-icons-png.flaticon.com/512/1602/1602309.png" alt="db" width="20px" height="20px"></a>
  </div>
</body> 
</html>