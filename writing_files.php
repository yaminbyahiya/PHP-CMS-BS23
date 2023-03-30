<?php
    $file = "example.txt";
    if($handle = fopen($file, "w")){
        fwrite($handle, "Software Engineer Trainee at Brain Station 23");
        fclose($handle);
    } else{
        echo "File could not be found.";
    }
?>