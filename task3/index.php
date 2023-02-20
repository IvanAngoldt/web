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

if (empty($_POST['year']) || !is_numeric($_POST['year']) || !preg_match('/^\d+$/', $_POST['year'])) {
  print('Заполните год.<br/>');
  $errors = TRUE;
}

if ($errors) {
  print('Попробуйте ещё раз.');
  exit();
}

$user = 'u52855';
$pass = '5599036';

try {
  $db = new mysqli("localhost", "u52855", "5599036", "u52855");
} catch (PDOException $e) {
die($e->getMessage());
}

$fio = $_POST['fio'];

$db->query("SET NAMES 'utf8'");
$db->query("INSERT INTO form (fio) VALUES ('$fio')");
$db->close();
if ($db->connect_error){
    echo "Error Number: ".$db->connect_errno."<br>";
    echo "Error: ".$db->connect_error;
}

header('Location: ?save=1');
?>