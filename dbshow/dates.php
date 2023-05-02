<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
  <link rel="stylesheet" href="style.css">
  <title>Database u52855</title>
</head>
<body>
<form action="" method="POST" >
  <?php
    if (!empty($_COOKIE['delete_abilitie_error'])) {
      echo "<div class='message'>Вы не можете удалить последнюю способность у пользователя id=" . $_COOKIE['delete_abilitie_error'] . "</div>";
      setcookie('delete_abilitie_error', '', time() + 24 * 60 * 60);
    }
  ?>
  <table>
    <caption>Данные из таблицы application</caption>
    <tr> 
      <th>id</th>
      <th>Имя</th>
      <th>email</th>
      <th>Год</th>
      <th>Пол</th>
      <th>Преобладающая рука</th>
      <th>Биография</th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
    </tr>
    <?php
    $stmt = $db->prepare("SELECT * FROM application");
    $stmt->execute();
    $all_dates = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($all_dates as $form) {
    echo 
    "<tr>
        <td>"; echo $form['application_id']; echo "</td>
        <td>"; echo $form['name']; echo "</td>
        <td>"; echo $form['email']; echo "</td>
        <td>"; echo $form['year']; echo "</td>
        <td>"; echo $form['sex']; echo "</td>
        <td>"; echo $form['hand']; echo "</td>
        <td>"; echo $form['biography']; echo "</td>
        <td> <input name='edit.1."; echo $form['application_id']; echo "' type='image' src='https://cdn3.iconfinder.com/data/icons/social-productivity-line-art-5/128/history-edit-512.png' width='25' height='25' alt='submit'/></td>
        <td> <input name='clear.1."; echo $form['application_id']; echo "' type='image' src='https://cdn-icons-png.flaticon.com/512/860/860829.png' width='25' height='25' alt='submit'/></td>
        </tr>";
    }
    ?>
  </table>
  <div class="abilities">
    <table class="abilities1">
      <caption>Данные из таблицы abilities</caption>
      <tr> 
        <th>id отправителя</th>
        <th>суперсила</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
      </tr>
      <?php
      $stmt = $db->prepare("SELECT * FROM abilities");
      $stmt->execute();
      $all_dates = $stmt->fetchAll(PDO::FETCH_ASSOC);
      foreach ($all_dates as $form) {
        echo "
          <tr>
            <td>"; echo $form['application_id']; echo "</td>
            <td>"; $form['superpower_id'] == 1 ? print "бессмертие" : ($form['superpower_id'] == 2 ? print "прохождение сквозь стены" : print "левитация"); echo "</td>
            <td> <input name='edit.2."; echo $form['application_id']; echo "' type='image' src='https://cdn3.iconfinder.com/data/icons/social-productivity-line-art-5/128/history-edit-512.png' width='25' height='25' alt='submit'/></td>
            <td> <input name='clear.2."; echo $form['abilities_id']; echo "' type='image' src='https://cdn-icons-png.flaticon.com/512/860/860829.png' width='25' height='25' alt='submit'/></td>
            </tr>
        ";
      }
      ?>
    </table>
    <table class="abilities2">
      <caption>Статистика abilities</caption>
      <tr> 
        <th>суперсила</th>
        <th>кол-во</th>
      </tr>
      <?php
      $stmt = $db->prepare("SELECT count(application_id) from abilities where superpower_id = 1;");
      $stmt->execute();
      $first = $stmt->fetchColumn();
      $stmt = $db->prepare("SELECT count(application_id) from abilities where superpower_id = 2;");
      $stmt->execute();
      $second = $stmt->fetchColumn();
      $stmt = $db->prepare("SELECT count(application_id) from abilities where superpower_id = 3;");
      $stmt->execute();
      $third = $stmt->fetchColumn();
      echo "
      <tr>
        <td>бессмертие</td>
        <td>"; echo (empty($first) ? '0' : $first); echo "</td>
      </tr>
      <tr>
        <td>прохождение сквозь стены</td>
        <td>"; echo (empty($second) ? '0' : $second); echo "</td>
      </tr>
      <tr>
        <td>левитация</td>
        <td>"; echo (empty($third) ? '0' : $third); echo "</td>
      </tr>
    ";
      ?>
    </table>
  </div>
  <table>
    <caption>Данные из таблицы users</caption>
    <tr> 
      <th>id отправителя</th>
      <th>Логин</th>
      <th>Пароль</th>
      <th>&nbsp;</th>
    </tr>
    <?php
    $stmt = $db->prepare("SELECT * FROM users");
    $stmt->execute();
    $all_dates = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($all_dates as $form) {
      echo "
        <tr>
          <td>"; echo $form['application_id']; echo "</td>
          <td>"; echo $form['login']; echo "</td>
          <td>"; echo $form['password']; echo "</td>
          <td> <input name='clear.3."; echo $form['user_id']; echo "' type='image' src='https://cdn-icons-png.flaticon.com/512/860/860829.png' width='25' height='25' alt='submit'/></td>
          </tr>
      ";
    }
    ?>
  </table>
  <input name='truncate' type="submit" value="truncate all"/>
</form>
</body>
</html>