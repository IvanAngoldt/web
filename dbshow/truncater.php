<?php

$stmt = $db->prepare("SELECT * FROM application");
$stmt->execute();
if (empty($stmt->fetchAll(PDO::FETCH_ASSOC)) || isset($_POST['clear_1_0'])) {
  $stmt = $db->prepare("TRUNCATE application");
  $stmt->execute();
}

$stmt = $db->prepare("SELECT * FROM abilities");
$stmt->execute();
if (empty($stmt->fetchAll(PDO::FETCH_ASSOC)) || isset($_POST['clear_2_0'])) {
  $stmt = $db->prepare("TRUNCATE abilities");
  $stmt->execute();
}

$stmt = $db->prepare("SELECT * FROM users");
$stmt->execute();
if (empty($stmt->fetchAll(PDO::FETCH_ASSOC)) || isset($_POST['clear_3_0'])) {
  $stmt = $db->prepare("TRUNCATE users");
  $stmt->execute();
}