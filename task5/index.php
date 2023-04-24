<?php

header('Content-Type: text/html; charset=UTF-8');

$user = 'u52855';
$pass = '5599036';
$db = new PDO('mysql:host=localhost;dbname=u52855', $user, $pass, array(PDO::ATTR_PERSISTENT => true));

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  $messages = array();
  if (!empty($_COOKIE['save'])) {
    setcookie('save', '', 100000);
    $messages['gucci'] = '<div class="good">Спасибо, результаты сохранены</div>';
    if (!empty($_COOKIE['password'])) {
      $messages['login'] = sprintf('<div class="login">Логин: <strong>%s</strong><br>
        Пароль: <strong>%s</strong><br>Войдите в аккаунт с этими данными,<br>чтобы изменить введёные значения формы</div>',
        strip_tags($_COOKIE['login']),
        strip_tags($_COOKIE['password']));
    }
    setcookie('login', '', 100000);
    setcookie('password', '', 100000);
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
  if (!empty($errors['checkboxContract'])) {
    setcookie('checkboxContract_error', '', 100000);
    $messages['checkboxContract'] = '<p class="msg">Ознакомьтесь с контрактом</p>';
  }

  $values = array();
  $values['name'] = empty($_COOKIE['name_value']) ? '' : strip_tags($_COOKIE['name_value']);
  $values['email'] = empty($_COOKIE['email_value']) ? '' : strip_tags($_COOKIE['email_value']);
  $values['year'] = empty($_COOKIE['year_value']) ? '' : strip_tags($_COOKIE['year_value']);
  $values['sex'] = empty($_COOKIE['sex_value']) ? '' : strip_tags($_COOKIE['sex_value']);
  $values['hand'] = empty($_COOKIE['hand_value']) ? '' : strip_tags($_COOKIE['hand_value']);
  $values['abilities'] = empty($_COOKIE['abilities_value']) ? '' : strip_tags($_COOKIE['abilities_value']);
  $values['biography'] = empty($_COOKIE['biography_value']) ? '' : strip_tags($_COOKIE['biography_value']);
  $values['checkboxContract'] = empty($_COOKIE['checkboxContract_value']) ? '' : strip_tags($_COOKIE['checkboxContract_value']);

  if (count(array_filter($errors)) === 0 && !empty($_COOKIE[session_name()]) && session_start() && !empty($_SESSION['login'])) {
    $login = $_SESSION['login'];
    try {
      $stmt = $db->prepare("SELECT application_id FROM users WHERE login = ?");
      $stmt->execute([$login]);
      $app_id = $stmt->fetchColumn();

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

    printf('<div id="header">Вход с логином %s, uid %d<br><a href=logout.php>Выйти</a></div>', $_SESSION['login'], $_SESSION['uid']);
  }
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
    setcookie('email_value', $email, time() + 30 * 24 * 60 * 60);
    $errors = TRUE;
  } else {
    setcookie('email_value', $email, time() + 30 * 24 * 60 * 60);
  }

  if (!is_numeric($year)) {
    setcookie('year_error1', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  } else if ((2023 - $year) < 14) {
    setcookie('year_error2', '1', time() + 24 * 60 * 60);
    setcookie('year_value', $year, time() + 30 * 24 * 60 * 60);
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
    setcookie('biography_value', $biography, time() + 30 * 24 * 60 * 60);
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
    setcookie('checkboxContract_error', '', 100000);
  }

  if (!empty($_COOKIE[session_name()]) && session_start() && !empty($_SESSION['login'])) {
    $login = $_SESSION['login'];
    try {
      $stmt = $db->prepare("SELECT application_id FROM users WHERE login = ?");
      $stmt->execute([$login]);
      $app_id = $stmt->fetchColumn();

      $stmt = $db->prepare("UPDATE application SET name = ?, email = ?, year = ?, sex = ?, hand = ?, biography = ?
        WHERE application_id = ?");
      $stmt->execute([$name, $email, $year, $sex, $hand, $biography, $app_id]);

      $stmt = $db->prepare("SELECT superpower_id FROM abilities WHERE application_id = ?");
      $stmt->execute([$app_id]);
      $abil = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);

      if (array_diff($abil, $abilities)) {
        $stmt = $db->prepare("DELETE FROM abilities WHERE application_id = ?");
        $stmt->execute([$app_id]);

        $stmt = $db->prepare("INSERT INTO abilities (application_id, superpower_id) VALUES (?, ?)");
        foreach ($abilities as $superpower_id) {
          $stmt->execute([$app_id, $superpower_id]);
        }
      }

    } catch (PDOException $e) {
        print('Error : ' . $e->getMessage());
        exit();
    }

  }
  else {
    // TODO: сделать механизм генерации, например функциями rand(), uniquid(), md5(), substr().
    $login = 'user' . rand(1, 100);
    $password = rand(1, 100);
    setcookie('login', $login);
    setcookie('password', $password);
    try {
      $stmt = $db->prepare("INSERT INTO application (name, email, year, sex, hand, biography) VALUES (?, ?, ?, ?, ?, ?)");
      $stmt->execute([$name, $email, $year, $sex, $hand, $biography]);
      $application_id = $db->lastInsertId();
      $stmt = $db->prepare("INSERT INTO abilities (application_id, superpower_id) VALUES (?, ?)");
      foreach ($abilities as $superpower_id) {
        $stmt->execute([$application_id, $superpower_id]);
      }
      $stmt = $db->prepare("INSERT INTO users (application_id, login, password) VALUES (?, ?, ?)");
      $stmt->execute([$application_id, $login, $password]);
    } catch (PDOException $e) {
      print('Error : ' . $e->getMessage());
      exit();
    }
  }

  setcookie('save', '1');
  header('Location: ./');
}
