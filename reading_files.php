<?php
    $file = "example.txt";
    if($handle = fopen($file, "r")){
        $result = fread($handle, filesize($file));
        echo $result;
        fclose($handle);
    } else{
        echo "File could not be found.";
    }
?>