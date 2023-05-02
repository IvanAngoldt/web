<?php
include('dbconnect.php');
$stmt = $db->prepare("TRUNCATE application; TRUNCATE abilities; TRUNCATE users");
$stmt->execute();
header('Location: index.php');