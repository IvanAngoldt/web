<?php

header('Content-Type: text/html; charset=UTF-8');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  if (!empty($_GET['save'])) {
    print('Спасибо, результаты сохранены.');
  }
  include('form.php');
  exit();
}

$errors = FALSE;
if (empty($_POST['fio'])) {
  print('Заполните имя.<br/>');
  $errors = TRUE;
}

if ($errors) {
  exit();
}

$user = 'u52855';
$pass = '5599036';
$db = new PDO('mysql:host=localhost;dbname=u52855', $user, $pass, array(PDO::ATTR_PERSISTENT => true));

$fio = $_POST['fio'];
$year = $_POST['year'];

try {
  $stmt = $db->prepare("INSERT INTO application (fio) VALUES ($fio)");
  $stmt -> execute(['fio']);
  $stmt = $db->prepare("INSERT INTO application (year) VALUES ($year)");
  $stmt -> execute(['year']);
}
catch(PDOException $e){
  print('Error : ' . $e->getMessage());
  exit();
}

header('Location: ?save=1');
?>
