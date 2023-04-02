<?php
    function confirmQuery($result){
        global $connection;
        if(!$result){
            die("Query Failed ". mysqli_error($connection));
        }
    }
    function insert_category(){
        global $connection;
        if(isset($_POST["submit"])){
            $cat_title=$_POST["cat_title"];
            if(empty($cat_title)){
                echo "All Fields Must be Filled!";
            }else{
                $query = "INSERT INTO category(cat_title) VALUE('$cat_title')";
                $cat_add_result = mysqli_query($connection, $query);

                if(!$cat_add_result){
                    die("Query Failed ". mysqli_error());
                }
            }
        }
    }
    function findAllCategories(){
        global $connection;
        $query = "SELECT * FROM category";
        $result = mysqli_query($connection, $query);
        if(!$result){
            die("Query Failed! ". mysqli_error());
        }else{
            while($row = mysqli_fetch_assoc($result)){
                $cat_id = $row["cat_id"];
                $cat_title = $row["cat_title"];
                echo "<tr>";
                echo "<th>$cat_id</th>";
                echo "<th>$cat_title</th>";
                echo "<th><a href='categories.php?delete=$cat_id'>Delete</a></th>";
                echo "<th><a href='categories.php?update=$cat_id'>Update</a></th>";
                echo "</tr>";
            }
        }
    }
    function deleteCategory(){
        global $connection;
        if(isset($_GET["delete"])){
            $id = $_GET["delete"];
            $query = "DELETE FROM category WHERE cat_id=$id";
            $delete_result = mysqli_query($connection, $query);
            header("Location: categories.php");
            if(!$delete_result){
                die("Deletion Failed ". mysqli_error());
            }else{
                echo "Deletion Successful";
            }
        }
    }
?>