<?php

header('Content-Type: text/html; charset=UTF-8');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  $messages = array();
  if (!empty($_COOKIE['save'])) {
      setcookie('save', '', 100000);
      $messages['gucci'] = '<div class="good">Спасибо, результаты сохранены</div>';
  }
  $errors = array();
  $errors['name'] = !empty($_COOKIE['name_error']);
  $errors['email1'] = !empty($_COOKIE['email_error1']);
  $errors['email2'] = !empty($_COOKIE['email_error2']);
  $errors['year1'] = !empty($_COOKIE['year_error1']);
  $errors['year2'] = !empty($_COOKIE['year_error2']);
  $errors['sex1'] = !empty($_COOKIE['sex_error1']);
  $errors['sex2'] = !empty($_COOKIE['sex_error2']);
  $errors['hand1'] = !empty($_COOKIE['hand_error1']);
  $errors['hand2'] = !empty($_COOKIE['hand_error2']);
  $errors['abilities1'] = !empty($_COOKIE['abilities_error1']);
  $errors['abilities2'] = !empty($_COOKIE['abilities_error2']);
  $errors['biography1'] = !empty($_COOKIE['biography_error1']);
  $errors['biography2'] = !empty($_COOKIE['biography_error2']);
  $errors['checkboxContract'] = !empty($_COOKIE['checkboxContract_error']);

  if ($errors['name']) {
    setcookie('name_error', '', 100000);
    $messages['name'] = '<p class="msg">Заполните имя</p>';
  }
  if ($errors['email1']) {
    setcookie('email_error1', '', 100000);
    $messages['email1'] = '<p class="msg">Заполните email</p>';
  } else if ($errors['email2']) {
    setcookie('email_error2', '', 100000);
    $messages['email2'] = '<p class="msg">Корректно* заполните email</p>';
  }
  if ($errors['year1']) {
    setcookie('year_error1', '', 100000);
    $messages['year1'] = '<p class="msg">Неправильный формат ввода года</p>';
  } else if ($errors['year2']) {
    setcookie('year_error2', '', 100000);
    $messages['year2'] = '<p class="msg">Вам должно быть 14 лет</p>';
  }
  if ($errors['sex1']) {
    setcookie('sex_error1', '', 100000);
    $messages['sex1'] = '<p class="msg">Выберите пол</p>';
  }
  if ($errors['sex2']) {
    setcookie('sex_error2', '', 100000);
    $messages['sex2'] = '<p class="msg">Выбран неизвестный пол</p>';
  }
  if ($errors['hand1']) {
    setcookie('hand_error1', '', 100000);
    $messages['hand1'] = '<p class="msg">Выберите руку</p>';
  }
  if ($errors['hand2']) {
    setcookie('hand_error2', '', 100000);
    $messages['hand2'] = '<p class="msg">Выбрана неизвестная рука</p>';
  }
  if ($errors['abilities1']) {
    setcookie('abilities_error1', '', 100000);
    $messages['abilities1'] = '<p class="msg">Выберите хотя бы одну <br> сверхспособность</p>';
  } else if ($errors['abilities2']) {
    setcookie('abilities_error2', '', 100000);
    $messages['abilities2'] = '<p class="msg">Выбрана неизвестная <br> сверхспособность</p>';
  }
  if ($errors['biography1']) {
    setcookie('biography_error1', '', 100000);
    $messages['biography1'] = '<p class="msg">Расскажи о себе что-нибудь</p>';
  } else if ($errors['biography2']) {
    setcookie('biography_error2', '', 100000);
    $messages['biography2'] = '<p class="msg">Недопустимый формат ввода <br> биографии</p>';
  }
  if ($errors['checkboxContract']) {
    setcookie('checkboxContract_error', '', 100000);
    $messages['checkboxContract'] = '<p class="msg">Ознакомьтесь с контрактом</p>';
  }
  $values = array();
  $values['name'] = empty($_COOKIE['name_value']) ? '' : $_COOKIE['name_value'];
  $values['email'] = empty($_COOKIE['email_value']) ? '' : $_COOKIE['email_value'];
  $values['year'] = empty($_COOKIE['year_value']) ? '' : $_COOKIE['year_value'];
  $values['sex'] = empty($_COOKIE['sex_value']) ? '' : $_COOKIE['sex_value'];
  $values['hand'] = empty($_COOKIE['hand_value']) ? '' : $_COOKIE['hand_value'];
  $values['abilities'] = empty($_COOKIE['abilities_value']) ? '' : $_COOKIE['abilities_value'];
  $values['biography'] = empty($_COOKIE['biography_value']) ? '' : $_COOKIE['biography_value'];
  $values['checkboxContract'] = empty($_COOKIE['checkboxContract_value']) ? '' : $_COOKIE['checkboxContract_value'];
  include('form.php');
} else {
  $errors = FALSE;

  $name = $_POST['name'];
  $email = $_POST['email'];
  $year = $_POST['year'];
  $sex = $_POST['sex'];
  $hand = $_POST['hand'];
  if(isset($_POST["abilities"])) {
    $abilities = $_POST["abilities"];
    $filtred_abilities = array_filter($abilities, 
    function($value) {
      return($value == 1 || $value == 2 || $value == 3);
    }
    );
  }
  $biography = $_POST['biography'];
  $checkboxContract = isset($_POST['checkboxContract']);

  if (empty($name)) {
    setcookie('name_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  } else {
    setcookie('name_value', $name, time() + 30 * 24 * 60 * 60);
  }

  if (empty($email)) {
    setcookie('email_error1', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    setcookie('email_error2', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  } else {
    setcookie('email_value', $email, time() + 30 * 24 * 60 * 60);
  }

  if (!is_numeric($year)) {
    setcookie('year_error1', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  } else if ((2023 - $year) < 14) {
    setcookie('year_error2', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  } else {
    setcookie('year_value', $year, time() + 30 * 24 * 60 * 60);
  }

  if (empty($sex)) {
    setcookie('sex_error1', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  } else if ($sex != 'male' && $sex != 'female') {
    setcookie('sex_error2', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  } else {
    setcookie('sex_value', $sex, time() + 30 * 24 * 60 * 60);
  }

  if (empty($hand)) {
    setcookie('hand_error1', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  } else if ($hand != 'right' && $hand != 'left') {
    setcookie('hand_error2', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  } else {
    setcookie('hand_value', $hand, time() + 30 * 24 * 60 * 60);
  }

  if (empty($abilities)) {
    setcookie('abilities_error1', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  } else if (count($filtred_abilities) != count($abilities)) {
    setcookie('abilities_error2', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  } else {
    setcookie('abilities_value', serialize($abilities), time() + 30 * 24 * 60 * 60);
  }

  if (empty($biography)) {
    setcookie('biography_error1', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  } else if (!preg_match('/^[\p{Cyrillic}\d\s,.!?-]+$/u', $biography)) {
    setcookie('biography_error2', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  } else {
    setcookie('biography_value', $biography, time() + 30 * 24 * 60 * 60);
  }

  if ($checkboxContract == '') {
    setcookie('checkboxContract_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  } else {
    setcookie('checkboxContract_value', $checkboxContract, time() + 30 * 24 * 60 * 60);
  }

  if ($errors) {
    header('Location: index.php');
    exit();
  }
  else {
    setcookie('name_error', '', 100000);
    setcookie('email_error1', '', 100000);
    setcookie('email_error2', '', 100000);
    setcookie('year_error1', '', 100000);
    setcookie('year_error2', '', 100000);
    setcookie('sex_error1', '', 100000);
    setcookie('sex_error2', '', 100000);
    setcookie('hand_error1', '', 100000);
    setcookie('hand_error2', '', 100000);
    setcookie('abilities_error1', '', 100000);
    setcookie('abilities_error2', '', 100000);
    setcookie('biography_error1', '', 100000);
    setcookie('biography_error2', '', 100000);
    setcookie('checkboxContract_error', '', 100000);
  }

  $user = 'u52855';
  $pass = '5599036';
  $db = new PDO('mysql:host=localhost;dbname=u52855', $user, $pass, array(PDO::ATTR_PERSISTENT => true));

  try {
    $stmt = $db->prepare("INSERT INTO application (name, email, year, sex, hand, biography) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$name, $email, $year, $sex, $hand, $biography]);
    $application_id = $db->lastInsertId();
    $stmt = $db->prepare("INSERT INTO abilities (application_id, superpower_id) VALUES (?, ?)");
    foreach ($abilities as $superpower_id) {
      $stmt->execute([$application_id, $superpower_id]);
    }
  } catch (PDOException $e) {
    print('Error : ' . $e->getMessage());
    exit();
  }
  setcookie('save', '1');
  header('Location: ?save=1');
}
