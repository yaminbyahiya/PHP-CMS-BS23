<?php
include "db.php";
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
function showAllData(){
    global $connection;
    $query = "SELECT * FROM users";
    $result = mysqli_query($connection, $query);
    if(!$result){
        die("Query Read Failed! ".mysqli_error());
    }
    while($row=mysqli_fetch_assoc($result)){
        $id=$row['id'];
        echo "<option value='$id'>$id</option>";
    }
}
function updateData(){
    global $connection;
    $username=$_POST['username'];
    $password=$_POST['password'];
    $id=$_POST['id'];
    $query="UPDATE users SET user='$username', pass='$password' WHERE id=$id";
    $result=mysqli_query($connection, $query);
    if(!$result){
        die("Update Failed! ".mysqli_error());
    }
}
function deleteData(){
    global $connection;
    $username=$_POST['username'];
    $password=$_POST['password'];
    $id=$_POST['id'];
    $query="DELETE FROM users WHERE id=$id";
    $result=mysqli_query($connection, $query);
    if(!$result){
        die("Update Failed! ".mysqli_error());
    }
}
function createUser(){
    global $connection;
    if(isset($_POST["submit"])){
        $username = $_POST["username"];
        $password = $_POST["password"];
        $username = mysqli_real_escape_string($connection, $username);
        $password = mysqli_real_escape_string($connection, $password);
        $hashFormat = "$2y$10$";
        $salt = "iusesomecrazystrings22";
        $hash_salt = $hashFormat.$salt;
        $password = crypt($password, $hash_salt);
        if($username && $password){
            echo "Login Successful!";
        }else{
            echo "All Fields Must be Filled!";
        }
        $query = "INSERT INTO users(user, pass) VALUES ('$username', '$password')";
        $result = mysqli_query($connection, $query);
        if(!$query){
            die("Query Insertion Failed! ".mysqli_error());
        }
    }
}
function readData(){
    global $connection;
    $query = "SELECT * FROM users";
    $result = mysqli_query($connection, $query);
    if(!$result){
        die("Query Read Failed! ".mysqli_error());
    }
    while($row = mysqli_fetch_assoc($result)){
        echo "<pre>";
        print_r($row);
        echo "</pre>";
    }
}
?>