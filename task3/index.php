<?php

header('Content-Type: text/html; charset=UTF-8');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  if (!empty($_GET['save'])) {
    print('
      <p>
        Спасибо, результаты сохранены.
      </p>
      ');
  }
  include('form.php');
  exit();
}

$name = $_POST['name'];
$email = $_POST['email'];
$year = $_POST['year'];
$sex = $_POST['sex'];
$hand = $_POST['hand'];
$biography = $_POST['biography'];
$checkboxContract = isset($_POST['checkboxContract']);

if (isset($_POST['god'])) { 
  $god = 1; 
} else {
$god = 0;
}
if (isset($_POST['noclip'])) { 
  $noclip = 1; 
} else {
$noclip = 0;
}
if (isset($_POST['levitation'])) { 
  $levitation = 1; 
} else {
$levitation = 0;
}

$errors = FALSE;

if (empty($name)) {
  print('
    <h1>
      Заполните имя.
    </h1>
  <br/>');
  $errors = TRUE;
} else if (empty($email)) {
  print('
    <h1>
      Заполните email.
    </h1>
  <br/>');
  $errors = TRUE;
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  print('
    <h1>
      Корректно* заполните email.
    </h1>
  <br/>');
  $errors = TRUE;
} else if ($god == 0 && $noclip == 0 && $levitation == 0) {
  print('
    <h1>
      Выберите хотя бы одну способность.
    </h1>
  <br/>');
  $errors = TRUE;
} else if (empty($biography)) {
  print('
    <h1>
      Расскажи о себе что-нибудь.
    </h1>
  <br/>');
  $errors = TRUE;
} else if ($checkboxContract == '') {
  print('
    <h1>
      Ознакомьтесь с контрактом.
    </h1>
  <br/>');
  $errors = TRUE;
}

if ($errors) {
  exit();
}

$user = 'u52855';
$pass = '5599036';
$db = new PDO('mysql:host=localhost;dbname=u52855', $user, $pass, array(PDO::ATTR_PERSISTENT => true));

try {
  $stmt = $db->prepare("INSERT INTO application (name, email, year, sex, hand, biography) VALUES ('$name', '$email', '$year', '$sex', '$hand', '$biography')");
  $stmt -> execute(['name', 'email', 'year', 'sex', 'hand', 'biography']);
  $stmt = $db->prepare("INSERT INTO abilities (god, noclip, levitation) VALUES ('$god', '$noclip', '$levitation')");
  $stmt -> execute(['god', 'noclip', 'levitation']);
}
catch(PDOException $e){
  print('Error : ' . $e->getMessage());
  exit();
}

header('Location: ?save=1');
?>