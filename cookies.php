<?php
    $name="somename";
    $value=100;
    $expiration=time()+(60*60*24*7);
    setcookie($name,$value,$expiration);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cookies</title>
</head>
<body>
    <?php
        if(isset($_COOKIE["$name"])){
            $someOne = $_COOKIE["$name"];
            echo $someOne;
        }else{
            $someOne = " ";
        }
    ?>
</body>
</html>