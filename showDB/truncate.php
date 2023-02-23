<?php 
    if (isset($_POST['myActionName'])) {
        $host = "localhost";
        $user = "u52855";
        $pass = "5599036";
        $name = "u52855";
        $connection = mysqli_connect($host, $user, $pass, $name);
        $query1 = "TRUNCATE TABLE application";
        $query2 = "TRUNCATE TABLE abilities";
        if ($connection == false) {
            print "Ошибка подключения";
        }
        if (mysqli_multi_query($connection, $query1) && mysqli_multi_query($connection, $query2)) {
            print "record deleted Successfully";
        } else {
            print "Error:" . mysqli_error($connection);
        }
    }
?>
