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
  if (!empty($messages['gucci'])) {
    print($messages['gucci']);
  }
  ?>
  <form action="" method="POST">
    <div class="form-head">
        <h1>Форма</h1>
    </div>
    <div class="form-content">
      <div class="form-item">
        <p <?php if ($errors['name']) {print 'class="error"';} ?>>Имя</p>
        <input class="line" name="name" value="<?php echo $values['name']; ?>" />
        <?php if ($errors['name']) {print $messages['name'];} ?>
      </div>
      <div class="form-item">
        <p <?php if ($errors['email1'] || $errors['email2']) {print 'class="error"';} ?>>Email</p>
        <input class="line" name="email" value="<?php print $values['email']; ?>" />
        <?php if ($errors['email1']) {print $messages['email1'];} else if ($errors['email2']) {print $messages['email2'];}?>
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
        <?php if ($errors['year1']) {print $messages['year1'];} else if ($errors['year2']) {print $messages['year2'];}?>  
      </div>
      <div class="form-item">
        <p <?php if ($errors['sex1'] || $errors['sex2']) {print 'class="error"';} ?>>Пол:</p>
        <?php if ($errors['sex1']) {print $messages['sex1'];} else if ($errors['sex2']) {print $messages['sex2'];}?>  
        <ul>
          <li>
            <input type="radio" id="radioMale" name="sex" value="male" <?php if ($values['sex'] == 'male') {print 'checked';} ?>>
            <label for="radioMale">Мужчина</label>
          </li>
          <li>
            <input type="radio" id="radioFemale" name="sex" value="female" <?php if ($values['sex'] == 'female') {print 'checked';} ?>>
            <label for="radioFemale">Женщина</label>
          </li>
        </ul>
      </div>
      <div class="form-item">
        <p <?php if ($errors['hand1'] || $errors['hand2']) {print 'class="error"';} ?>>Правша или левша:</p>
        <?php if ($errors['hand1']) {print $messages['hand1'];} else if ($errors['hand2']) {print $messages['hand2'];}?>
        <ul>
          <li>
            <input type="radio" id="radioRight" name="hand" value="right" <?php if ($values['hand'] == 'right') {print 'checked';} ?>>
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
        <?php if ($errors['abilities1']) {print $messages['abilities1'];} else if ($errors['abilities2']) {print $messages['abilities2'];}?>
        <ul>
          <li>
            <input type="checkbox" id="god" name="abilities[]" value=1 <?php if (isset($values['abilities']) && !empty($values['abilities']) && in_array(1, unserialize($values['abilities']))) {print 'checked';}?>>
            <label for="god">бессмертие</label>
          </li>
          <li>
            <input type="checkbox" id="noclip" name="abilities[]" value=2 <?php if (isset($values['abilities']) && !empty($values['abilities']) && in_array(2, unserialize($values['abilities']))) {print 'checked';}?>>
            <label for="noclip">прохождение сквозь стены</label>
          </li>
          <li>
            <input type="checkbox" id="levitation" name="abilities[]" value=3 <?php if (isset($values['abilities']) && !empty($values['abilities']) && in_array(3, unserialize($values['abilities']))) {print 'checked';}?>>
            <label for="levitation">левитация</label>
          </li>
        </ul> 
      </div>
      <div class="form-item">
        <p class="big-text <?php if ($errors['biography1'] || $errors['biography2']) {print 'error';} ?>">Расскажи о себе:</p>
        <p class="small-text">(макс. 128 символов, кириллица)</p>
        <?php if ($errors['biography1']) {print $messages['biography1'];} else if ($errors['biography2']) {print $messages['biography2'];}?>
        <textarea name="biography" cols=24 rows=4 maxlength=128 spellcheck="false"><?php if (!empty($values['biography'])) {print $values['biography'];} ?></textarea>
      </div>
    </div>  
    <div class="send">
      <div class="contract">
        <input type="checkbox" id="checkboxContract" name="checkboxContract" <?php if ($values['checkboxContract'] == '1') {print 'checked';} ?>>
        <label for="checkboxContract" <?php if ($errors['checkboxContract']) {print 'class="error"';} ?>>С контрактом ознакомлен</label>
        <?php if ($errors['checkboxContract']) {print $messages['checkboxContract'];} ?>
      </div>
      <input class="btn" type="submit" name="submit" value="Отправить" />
    </div>
  </form>
  <div class="href">
    <a href="../task3/showDB/"><img src="https://cdn-icons-png.flaticon.com/512/1602/1602309.png" alt="db" width="20px" height="20px"></a>
  </div>
</body> 
</html>
