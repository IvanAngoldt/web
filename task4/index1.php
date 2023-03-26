<?php
header('Content-Type: text/html; charset=UTF-8');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $messages = array();
    if (!empty($_COOKIE['save'])) {
        setcookie('save', '', 100000);
        $messages[] = 'Спасибо, результаты сохранены.';
    }
    $errors = array();
    $errors['name'] = !empty($_COOKIE['name_error']);
    $errors['email'] = !empty($_COOKIE['email_error']);
    if ($errors['name']) {
        setcookie('name_error', '', 100000);
        $messages[] = '<div class="error">Заполните имя.</div>';
    }
    if ($errors['email']) {
        setcookie('email_error', '', 100000);
        $messages[] = '<div class="error">Заполните email.</div>';
    }
    $values = array();
    $values['name'] = empty($_COOKIE['name_value']) ? '' : $_COOKIE['name_value'];
    $values['email'] = empty($_COOKIE['email_value']) ? '' : $_COOKIE['email_value'];
    include('form.php');
} else {
    $errors = FALSE;
    if (empty($_POST['name'])) {
        setcookie('name_error', '1', time() + 24 * 60 * 60);
        $errors = TRUE;
    } else {
        setcookie('name_value', $_POST['name'], time() + 30 * 24 * 60 * 60);
    }
    if (empty($_POST['email'])) {
        setcookie('email_error', '1', time() + 24 * 60 * 60);
        $errors = TRUE;
    } else {
        setcookie('email_value', $_POST['email'], time() + 30 * 24 * 60 * 60);
    }
    if ($errors) {
        header('Location: index.php');
        exit();
    } else {
        setcookie('name_error', '', 100000);
    }
    $user = 'u52855';
    $pass = '5599036';
    $db = new PDO('mysql:host=localhost;dbname=u52855', $user, $pass, array(PDO::ATTR_PERSISTENT => true));
    $name = $_POST['name'];
    $email = $_POST['email'];
    try {
        $stmt = $db->prepare("INSERT INTO test (name, email) VALUES ('$name', '$email')");
        $stmt->execute(['name', 'email']);
    } catch (PDOException $e) {
        print('Error : ' . $e->getMessage());
        exit();
    }
    setcookie('save', '1');
    header('Location: index.php');
}