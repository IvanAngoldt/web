<?php

include('basic_auth.php');
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  if (!empty($_COOKIE['editor'])) {
    header('Location: editor.php');
  }
  include('dates.php');
  exit();
} else {

  $message = array_key_first($_POST);
  $pieces = explode("_", $message);

  if ($pieces[0] == 'clear') {
    switch ($pieces[1]) {
      case 1:
        $stmt = $db->prepare("DELETE FROM application WHERE application_id = ?");
        $stmt->execute([$pieces[2]]);
        $stmt = $db->prepare("DELETE FROM abilities WHERE application_id = ?");
        $stmt->execute([$pieces[2]]);
        $stmt = $db->prepare("DELETE FROM users WHERE application_id = ?");
        $stmt->execute([$pieces[2]]);
        break;
      case 2:
        $stmt = $db->prepare("SELECT * FROM abilities WHERE abilities_id = ?");
        $stmt->execute([$pieces[2]]);
        $abil = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $app_id = $abil[0]['application_id'];
        $stmt = $db->prepare("SELECT * FROM abilities WHERE application_id = ?");
        $stmt->execute([$app_id]);
        $abilities = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (count($abilities) > 1) {
          $stmt = $db->prepare("DELETE FROM abilities WHERE abilities_id = ?");
          $stmt->execute([$pieces[2]]);
        } else {
          setcookie('delete_abilitie_error', $app_id, time() + 24 * 60 * 60);
        }
        break;
      case 3:
        $stmt = $db->prepare("DELETE FROM users WHERE user_id = ?");
        $stmt->execute([$pieces[2]]);
        break;
    }
  }
  if ($pieces[0] == 'edit') {
    setcookie('editor', '1', time() + 24 * 60 * 60);
    setcookie('app_id', $pieces[2], time() + 24 * 60 * 60);
  }


  if(isset($_POST['truncate'])) {
    $stmt = $db->prepare("TRUNCATE application; TRUNCATE abilities; TRUNCATE users");
    $stmt->execute();
  }

  header('Location: index.php');
}