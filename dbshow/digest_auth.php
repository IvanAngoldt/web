<?php

$realm = 'task 6';
$nonce = uniqid();
$digest = getDigest();

if (is_null($digest)) {
    requireLogin($realm,$nonce);
}

$digestParts = digestParse($digest);

include('dbconnect.php');
$stmt = $db->prepare("SELECT login, password FROM admins WHERE login = ?");
$stmt->execute([$digestParts['username']]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($row) {
    $validUser = $row['login'];
    $validPassHash = $row['password'];
}
    
$A1 = md5("{$validUser}:{$realm}:{$validPassHash}");
$A2 = md5("{$_SERVER['REQUEST_METHOD']}:{$digestParts['uri']}");

// $userPass = isset($_POST['password']) ? $_POST['password'] : '';
// $userPassHash = md5($userPass);
// d41d8cd98f00b204e9800998ecf8427e

$validResponse = md5("{$A1}:{$digestParts['nonce']}:{$digestParts['nc']}:{$digestParts['cnonce']}:{$digestParts['qop']}:{$A2}");

if ($digestParts['response'] !== $validResponse /* || $validPassHash !== $userPassHash */) {
    requireLogin($realm,$nonce);
}

echo 'Вы вошли как администратор с логином: ' . $validUser;

function getDigest() {
    if (isset($_SERVER['PHP_AUTH_DIGEST'])) {
        $digest = $_SERVER['PHP_AUTH_DIGEST'];
    } elseif (isset($_SERVER['HTTP_AUTHORIZATION'])) {
        if (strpos(strtolower($_SERVER['HTTP_AUTHORIZATION']),'digest')===0)
            $digest = substr($_SERVER['HTTP_AUTHORIZATION'], 7);
    }
    return $digest;
}

function requireLogin($realm,$nonce) {
    header('WWW-Authenticate: Digest realm="' . $realm . '",qop="auth",nonce="' . $nonce . '",opaque="' . md5($realm) . '"');
    header('HTTP/1.0 401 Unauthorized');
    echo 'Text to send if user hits Cancel button';
    die();
}

function digestParse($digest) {
    $needed_parts = array('nonce'=>1, 'nc'=>1, 'cnonce'=>1, 'qop'=>1, 'username'=>1, 'uri'=>1, 'response'=>1);
    $data = array();
    preg_match_all('@(\w+)=(?:(?:")([^"]+)"|([^\s,$]+))@', $digest, $matches, PREG_SET_ORDER);
    foreach ($matches as $m) {
        $data[$m[1]] = $m[2] ? $m[2] : $m[3];
        unset($needed_parts[$m[1]]);
    }
    return $needed_parts ? false : $data;
}