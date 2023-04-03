<?php
    // $db["host"] = "localhost";
    // $db["user"] = "root";
    // $db["pass"] = "";
    // $db["name"] = "cms";
    // foreach($db as $key => $value){
    //     define(strtoupper($key), $value);
    // }
    $connection = mysqli_connect("localhost", "root", "", "cms");
    if(!$connection){
        echo "Connection failed!";
    }
?>
