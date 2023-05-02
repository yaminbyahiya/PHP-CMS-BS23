<?php

    function escape($string){
        global $connection;
        return mysqli_real_escape_string($connection, trim($string));
    }

    function users_online(){
        if(isset($_GET["onlineusers"])){
            global $connection;
            if(!$connection){
                session_start();
                include("../includes/db.php");
                $session = session_id();
                $time = time();
                $time_out_in_seconds = 30;
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
                echo $count_users;
            }
        }
    }
    users_online();
    function confirmQuery($result){
        global $connection;
        if(!$result){
            die("Query Failed ". mysqli_error($connection));
        }
    }
    // function insert_category(){
    //     global $connection;
    //     if(isset($_POST["submit"])){
    //         $cat_title=$_POST["cat_title"];
    //         if(empty($cat_title)){
    //             echo "All Fields Must be Filled!";
    //         }else{
    //             $query = "INSERT INTO category(cat_title) VALUE('$cat_title')";
    //             $cat_add_result = mysqli_query($connection, $query);

    //             if(!$cat_add_result){
    //                 die("Query Failed ". mysqli_error());
    //             }
    //         }
    //     }
    // }
    function insert_category(){
        global $connection;
        if(isset($_POST["submit"])){
            $cat_title=$_POST["cat_title"];
            if(empty($cat_title)){
                echo "All Fields Must be Filled!";
            }else{
                $stmt = mysqli_prepare($connection, "INSERT INTO category(cat_title) VALUE(?)");
                mysqli_stmt_bind_param($stmt, 's', $cat_title);
                mysqli_stmt_execute($stmt);

                if(!$stmt){
                    die("Query Failed ". mysqli_error($connection));
                }
                mysqli_stmt_close($stmt);
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
                echo "<th><a class='btn btn-danger' href='categories.php?delete=$cat_id'>Delete</a></th>";
                echo "<th><a class='btn btn-info' href='categories.php?update=$cat_id'>Update</a></th>";
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
    function recordCount($table){
        global $connection;
        $query = "SELECT * FROM ". $table;
        $select_all_post = mysqli_query($connection, $query);
        $result = mysqli_num_rows($select_all_post);
        confirmQuery($result);
        return $result;
    }
    function checkStatus($table,$column,$status){
        global $connection;
        $query = "SELECT * FROM $table WHERE $column = '$status'";
        $result = mysqli_query($connection, $query);
        return mysqli_num_rows($result);
    }
    function is_admin($username){
        global $connection;
        $query = "SELECT user_role FROM users WHERE user_name='$username'";
        $result = mysqli_query($connection, $query);
        confirmQuery($result);
        $row = mysqli_fetch_array($result);
        if($row["user_role"]=="admin"){
            return true;
        }else{
            return false;
        }
    }
    function username_exists($username){
        global $connection;
        $query = "SELECT user_name FROM users WHERE user_name='$username'";
        $result = mysqli_query($connection, $query);
        $number_of_users = mysqli_num_rows($result);
        if($number_of_users > 0){
            return true;
        }else{
            return false;
        }
    }
    function email_exists($email){
        global $connection;
        $query = "SELECT user_email FROM users WHERE user_email='$email'";
        $result = mysqli_query($connection, $query);
        $number_of_email = mysqli_num_rows($result);
        if($number_of_email > 0){
            return true;
        }else{
            return false;
        }
    }
    function register_user($username, $email, $password){
        global $connection;

        if(!empty($username) && !empty($email) && !empty($password)){
            $username=mysqli_real_escape_string($connection, $username);
            $email=mysqli_real_escape_string($connection, $email);
            $password=mysqli_real_escape_string($connection, $password);
            $password = password_hash($password, PASSWORD_BCRYPT, array('cost'=>12));
            $query = "SELECT randSalt FROM users";
            $select_randsalt_query = mysqli_query($connection, $query);
            // if(!$select_randsalt_query){
            //     die("Query Failed". mysqli_error($connection));
            // }
            // $row=mysqli_fetch_assoc($select_randsalt_query);
            // $salt=$row["randSalt"];
            // $password = crypt($password, $salt);
            $query = "INSERT INTO users (user_name, user_email, user_password, user_role) VALUES ('$username', '$email', '$password', 'subscriber')";
            $register_user_query=mysqli_query($connection, $query);
            if(!$register_user_query){
                die("Query Failed". mysqli_error($connection));
            }
            $message = "Registration Successful";
        }else{
            // echo "<script>alert('Fields cannot be empty!')</script>";
            $message= "Fields cannot be empty!";
        }
    }
    function login_user($username, $password){
        global $connection;
        $username = trim($username);
        $password = trim($password);
        $username=mysqli_real_escape_string($connection, $username);
        $password=mysqli_real_escape_string($connection, $password);
        $query="SELECT * FROM users WHERE user_name='$username'";
        $select_user_query_result=mysqli_query($connection, $query);
        if(!$select_user_query_result){
            die("Query Failed". mysqli_error($connection));
        }
        while($row=mysqli_fetch_assoc($select_user_query_result)){
            $db_user_id=$row["user_id"];
            $db_username=$row["user_name"];
            $db_password=$row["user_password"];
            $db_user_firstname=$row["user_firstname"];
            $db_user_lastname=$row["user_lastname"];
            $db_user_role=$row["user_role"];
        }
        // $password = crypt($password, $db_password);
        if(password_verify($password, $db_password)){
            $_SESSION["username"]=$db_username;
            $_SESSION["firstname"]=$db_user_firstname;
            $_SESSION["lastname"]=$db_user_lastname;
            $_SESSION["user_role"]=$db_user_role;
            header("Location: ../admin/");
            // redirect("/cms/admin");
        }else{
            header("Location: ../index.php");
            // redirect("/cms/index.php");
        }
    }
    function redirect($location){
        return header("Location:".$location);
    }
?>