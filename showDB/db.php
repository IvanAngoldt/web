<?php 

$host = "localhost";
$user = "u52855";
$pass = "5599036";
$name = "u52855";

$induction = mysqli_connect($host, $user, $pass, $name);

if ($induction == false) {
    echo "Ошибка подключения";
}

?>