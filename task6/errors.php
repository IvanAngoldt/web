<?php


if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $messages = array();

    $errors = array();
    $errors['error_id'] = empty($_COOKIE['error_id']) ? '' : $_COOKIE['error_id'];
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
  
    if (!empty($errors['name'])) {
        setcookie('name_error', '', 100000);
        $messages['name'] = '<p class="msg">Не заполнено поле имени</p>';
    }
    if (!empty($errors['email1'])) {
        setcookie('email_error1', '', 100000);
        $messages['email1'] = '<p class="msg">Не заполнено поле email</p>';
    } else if (!empty($errors['email2'])) {
        setcookie('email_error2', '', 100000);
        $messages['email2'] = '<p class="msg">Некорректно заполнено поле email</p>';
    }
    if (!empty($errors['year1'])) {
        setcookie('year_error1', '', 100000);
        $messages['year1'] = '<p class="msg">Неправильный формат ввода года</p>';
    } else if (!empty($errors['year2'])) {
        setcookie('year_error2', '', 100000);
        $messages['year2'] = '<p class="msg">Выбран возраст менее 14 лет</p>';
    }
    if (!empty($errors['sex1'])) {
        setcookie('sex_error1', '', 100000);
        $messages['sex1'] = '<p class="msg">Не выбран пол</p>';
    }
    if (!empty($errors['sex2'])) {
        setcookie('sex_error2', '', 100000);
        $messages['sex2'] = '<p class="msg">Выбран неизвестный пол</p>';
    }
    if (!empty($errors['hand1'])) {
        setcookie('hand_error1', '', 100000);
        $messages['hand1'] = '<p class="msg">Не выбрана рука</p>';
    }
    if (!empty($errors['hand2'])) {
        setcookie('hand_error2', '', 100000);
        $messages['hand2'] = '<p class="msg">Выбрана неизвестная рука</p>';
    }
    if (!empty($errors['abilities1'])) {
        setcookie('abilities_error1', '', 100000);
        $messages['abilities1'] = '<p class="msg">Не выбрана ни одна сверхспособность</p>';
    } else if (!empty($errors['abilities2'])) {
        setcookie('abilities_error2', '', 100000);
        $messages['abilities2'] = '<p class="msg">Выбрана неизвестная сверхспособность</p>';
    }
    if (!empty($errors['biography1'])) {
        setcookie('biography_error1', '', 100000);
        $messages['biography1'] = '<p class="msg">Не заполнено поле биографии</p>';
    } else if (!empty($errors['biography2'])) {
        setcookie('biography_error2', '', 100000);
        $messages['biography2'] = '<p class="msg">Недопустимый формат ввода биографии</p>';
    }
} else {
    $dates = array();
    $dates['name'] = $_POST['name' . $app_id];
    $dates['email'] = $_POST['email' . $app_id];
    $dates['year'] = $_POST['year' . $app_id];
    $dates['sex'] = $_POST['sex' . $app_id];
    $dates['hand'] = $_POST['hand' . $app_id];
    $abilities = $_POST['abilities' . $app_id];
    $filtred_abilities = array_filter($abilities, function($value) {return($value == 1 || $value == 2 || $value == 3);});
    $dates['biography'] = $_POST['biography' . $app_id];

    $name = $dates['name'];
    $email = $dates['email'];
    $year = $dates['year'];
    $sex = $dates['sex'];
    $hand = $dates['hand'];
    $biography = $dates['biography'];

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
        setcookie('error_id', $app_id, time() + 24 * 60 * 60);
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
        setcookie('error_id', '', 100000);
    }
}