<?php 

include('db.php');

$result1 = mysqli_query($induction, "SELECT * FROM `application`");
$result2 = mysqli_query($induction, "SELECT * FROM `abilities`");

?>

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
  <table>
    <caption>Данные из таблицы application</caption>
    <tr> 
      <th>&nbsp;</th>
      <th>Имя</th>
      <th>email</th>
      <th>Год</th>
      <th>Пол</th>
      <th>Преобладающая рука</th>
      <th>Биография</th>
    </tr>
    <?php
    while ($form = mysqli_fetch_assoc($result1)) {
      echo "
        <tr>

          <td>"; echo $form['id']; echo "</td>
          <td>"; echo $form['name']; echo "</td>
          <td>"; echo $form['email']; echo "</td>
          <td>"; echo $form['year']; echo "</td>
          <td>"; echo $form['sex']; echo "</td>
          <td>"; echo $form['hand']; echo "</td>
          <td>"; echo $form['biography']; echo "</td>
        </tr>
      ";
    }
    ?>
  </table>

  <table>
    <caption>Данные из таблицы abilities</caption>
    <tr> 
      <th>&nbsp;</th>
      <th>Бессмертие</th>
      <th>Прохождение сквозь стены</th>
      <th>Левитация</th>
    </tr>
    <?php
    while ($form = mysqli_fetch_assoc($result2)) {
      echo "
        <tr>
          <td>"; echo $form['id']; echo "</td>
          <td>"; echo $form['god']; echo "</td>
          <td>"; echo $form['noclip']; echo "</td>
          <td>"; echo $form['levitation']; echo "</td>
        </tr>
      ";
    }
    ?>
  </table>
</body>
</html>