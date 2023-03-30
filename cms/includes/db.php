<?php
    $db["host"] = "localhost";
    $db["user"] = "root";
    $db["pass"] = "";
    $db["name"] = "cms";
    foreach($db as $key => $value){
        define(strtoupper($key), $value);
    }
    $connection = mysqli_connect(HOST, USER, PASS, NAME);
    if($connection){
        echo "We are connected!";
    }else{
        echo "Connection failed!";
    }
?>
