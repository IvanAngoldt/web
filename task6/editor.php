<?php

header('Content-Type: text/html; charset=UTF-8');
setcookie('editor', '', time() + 24 * 60 * 60);
include('dbconnect.php');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  $messages = array();

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

  if (!empty($errors['name'])) {
      setcookie('name_error', '', 100000);
      $messages['name'] = '<p class="msg">Заполните имя</p>';
  }
  if (!empty($errors['email1'])) {
      setcookie('email_error1', '', 100000);
      $messages['email1'] = '<p class="msg">Заполните email</p>';
  } else if (!empty($errors['email2'])) {
      setcookie('email_error2', '', 100000);
      $messages['email2'] = '<p class="msg">Корректно* заполните email</p>';
  }
  if (!empty($errors['year1'])) {
      setcookie('year_error1', '', 100000);
      $messages['year1'] = '<p class="msg">Неправильный формат ввода года</p>';
  } else if (!empty($errors['year2'])) {
      setcookie('year_error2', '', 100000);
      $messages['year2'] = '<p class="msg">Вам должно быть 14 лет</p>';
  }
  if (!empty($errors['sex1'])) {
      setcookie('sex_error1', '', 100000);
      $messages['sex1'] = '<p class="msg">Выберите пол</p>';
  }
  if (!empty($errors['sex2'])) {
      setcookie('sex_error2', '', 100000);
      $messages['sex2'] = '<p class="msg">Выбран неизвестный пол</p>';
  }
  if (!empty($errors['hand1'])) {
      setcookie('hand_error1', '', 100000);
      $messages['hand1'] = '<p class="msg">Выберите руку</p>';
  }
  if (!empty($errors['hand2'])) {
      setcookie('hand_error2', '', 100000);
      $messages['hand2'] = '<p class="msg">Выбрана неизвестная рука</p>';
  }
  if (!empty($errors['abilities1'])) {
      setcookie('abilities_error1', '', 100000);
      $messages['abilities1'] = '<p class="msg">Выберите хотя бы одну <br> сверхспособность</p>';
  } else if (!empty($errors['abilities2'])) {
      setcookie('abilities_error2', '', 100000);
      $messages['abilities2'] = '<p class="msg">Выбрана неизвестная <br> сверхспособность</p>';
  }
  if (!empty($errors['biography1'])) {
      setcookie('biography_error1', '', 100000);
      $messages['biography1'] = '<p class="msg">Расскажи о себе что-нибудь</p>';
  } else if (!empty($errors['biography2'])) {
      setcookie('biography_error2', '', 100000);
      $messages['biography2'] = '<p class="msg">Недопустимый формат ввода <br> биографии</p>';
  }

  $values = array();
  try {
    $app_id = $_COOKIE['app_id'];
    $stmt = $db->prepare("SELECT name, email, year, sex, hand, biography FROM application WHERE application_id = ?");
    $stmt->execute([$app_id]);
    $dates = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $stmt = $db->prepare("SELECT superpower_id FROM abilities WHERE application_id = ?");
    $stmt->execute([$app_id]);
    $abilities = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
    if (!empty($dates[0]['name'])) {
    $values['name'] = $dates[0]['name'];
    }
    if (!empty($dates[0]['email'])) {
    $values['email'] = $dates[0]['email'];
    }
    if (!empty($dates[0]['year'])) {
    $values['year'] = $dates[0]['year'];
    }
    if (!empty($dates[0]['sex'])) {
    $values['sex'] = $dates[0]['sex'];
    }
    if (!empty($dates[0]['hand'])) {
    $values['hand'] = $dates[0]['hand'];
    }
    if (!empty($abilities)) {
    $values['abilities'] =  serialize($abilities);
    }
    if (!empty($dates[0]['biography'])) {
    $values['biography'] = $dates[0]['biography'];
    }
  } catch (PDOException $e) {
      print('Error : ' . $e->getMessage());
      exit();
  }
  printf('<div id="header">uid: %s</div>', $_COOKIE['app_id']);
  include('formeditor.php');
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

  if (empty($name)) {
    setcookie('name_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  }
  if (empty($email)) {
    setcookie('email_error1', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    setcookie('email_error2', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  } 
  if (!is_numeric($year)) {
    setcookie('year_error1', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  } else if ((2023 - $year) < 14) {
    setcookie('year_error2', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  }
  if (empty($sex)) {
    setcookie('sex_error1', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  } else if ($sex != 'male' && $sex != 'female') {
    setcookie('sex_error2', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  } 
  if (empty($hand)) {
    setcookie('hand_error1', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  } else if ($hand != 'right' && $hand != 'left') {
    setcookie('hand_error2', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  } 
  if (empty($abilities)) {
    setcookie('abilities_error1', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  } else if (count($filtred_abilities) != count($abilities)) {
    setcookie('abilities_error2', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  }
  if (empty($biography)) {
    setcookie('biography_error1', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  } else if (!preg_match('/^[\p{Cyrillic}\d\s,.!?-]+$/u', $biography)) {
    setcookie('biography_error2', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  } 

  if ($errors) {
    header('Location: editor.php');
    exit();
  } else {
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
  }

  try {
    $app_id = $_COOKIE['app_id'];
    
    $stmt = $db->prepare("UPDATE application SET name = ?, email = ?, year = ?, sex = ?, hand = ?, biography = ?
    WHERE application_id = ?");
    $stmt->execute([$name, $email, $year, $sex, $hand, $biography, $app_id]);

    $stmt = $db->prepare("SELECT superpower_id FROM abilities WHERE application_id = ?");
    $stmt->execute([$app_id]);
    $abil = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);

    if (!empty($abil)) {
      if (array_diff($abil, $abilities) || count($abil) != count($abilities)) {
        $stmt = $db->prepare("DELETE FROM abilities WHERE application_id = ?");
        $stmt->execute([$app_id]);
        $stmt = $db->prepare("INSERT INTO abilities (application_id, superpower_id) VALUES (?, ?)");
        foreach ($abilities as $superpower_id) {
            $stmt->execute([$app_id, $superpower_id]);
        }
      }
      } else {
        $stmt = $db->prepare("INSERT INTO abilities (application_id, superpower_id) VALUES (?, ?)");
        foreach ($abilities as $superpower_id) {
            $stmt->execute([$app_id, $superpower_id]);
        }
      }
  } catch (PDOException $e) {
      print('Error : ' . $e->getMessage());
      exit();
  }
  setcookie('app_id', '', time() + 24 * 60 * 60);
  header('Location: ./');
}