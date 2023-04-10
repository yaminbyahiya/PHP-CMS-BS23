<?php
    function users_online(){
        global $connection;
        $session = session_id();
        $time = time();
        $time_out_in_seconds = 60;
        $time_out = $time - $time_out_in_seconds;
        $query = "SELECT * FROM users_online WHERE session='$session'";
        $send_query = mysqli_query($connection, $query);
        $count = mysqli_num_rows($send_query);
        if($count==NULL){
            $new_session_query="INSERT INTO users_online(session, time) VALUES ('$session', '$time')";
            $new_session_query_result = mysqli_query($connection, $new_session_query);
        }else{
            $new_session_query="UPDATE users_online SET time='$time' WHERE session='$session'";
            $new_session_query_result = mysqli_query($connection, $new_session_query);
        }
        $users_online_query = "SELECT * FROM users_online WHERE time > '$time_out'";
        $users_online_query_result = mysqli_query($connection, $users_online_query);
        $count_users = mysqli_num_rows($users_online_query_result);
        return $count_users;
    }
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