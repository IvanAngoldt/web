<?php

header('Content-Type: text/html; charset=UTF-8');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  if (!empty($_GET['save'])) {
    print('
      <h1>
        Спасибо, результаты сохранены.
      </h1>'
    );
  }
  include('form.php');
  exit();
}

$name = $_POST['name'];
$email = $_POST['email'];
$year = $_POST['year'];
$sex = $_POST['sex'];
$limbs = $_POST['limbs'];
$biography = $_POST['biography'];

$errors = FALSE;

if (empty($name)) {
  print('Заполните имя.<br/>');
  $errors = TRUE;
} else if (empty($email)) {
  print('Заполните email.<br/>');
  $errors = TRUE;
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  print('email заполнен неверно.<br/>');
  $errors = TRUE;
} else if (empty($biography)) {
  print('Заполните биографию.<br/>');
  $errors = TRUE;
}

if ($errors) {
  exit();
}

$user = 'u52855';
$pass = '5599036';
$db = new PDO('mysql:host=localhost;dbname=u52855', $user, $pass, array(PDO::ATTR_PERSISTENT => true));



try {
  $stmt = $db->prepare("INSERT INTO application (name, email, year, sex, limbs, biography) VALUES ('$name', '$email', '$year', '$sex', '$limbs', '$biography')");
  $stmt -> execute(['name', 'email', 'year', 'sex', 'limbs', 'biography']);
}
catch(PDOException $e){
  print('Error : ' . $e->getMessage());
  exit();
}

header('Location: ?save=1');
?>