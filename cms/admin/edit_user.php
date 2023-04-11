<?php
    if(isset($_GET["edit_user"])){
        $user_id=$_GET["edit_user"];
        $query = "SELECT * FROM users WHERE user_id=$user_id";
        $result_users = mysqli_query($connection, $query);
        if(!$result_users){
            die("Query Failed". mysqli_error());
        }else{
            while($row = mysqli_fetch_assoc($result_users)){
                $user_id=$row["user_id"];
                $username=$row["user_name"];
                $user_password=$row["user_password"];
                $user_firstname=$row["user_firstname"];
                $user_lastname=$row["user_lastname"];
                $user_email=$row["user_email"];
                $user_image=$row["user_image"];
                $user_role=$row["user_role"];
            }
        }
        if(isset($_POST["edit_user"])){
            $user_name=$_POST["user_name"];
            $user_firstname=$_POST["user_firstname"];
            $user_lastname=$_POST["user_lastname"];
            $user_role=$_POST["user_role"];
            $user_email=$_POST["user_email"];
            $user_password=$_POST["user_password"];
            $post_date = date('d-m-y');
            if(!empty($user_password)){
                $query_password = "SELECT user_password FROM users WHERE user_id=$user_id";
                $get_user_query = mysqli_query($connection, $query_password);
                if(!$get_user_query){
                    die("Query Failed". mysqli_fetch_assoc($connection));
                }else{
                    $row = mysqli_fetch_array($get_user_query);
                    $db_user_password = $row["user_password"];
                }
                if($db_user_password != $user_password){
                    $hashed_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 12));
                }
            }
            $edit_user_query = "UPDATE users SET user_name='$user_name', user_firstname='$user_firstname', user_lastname='$user_lastname', user_role='$user_role', user_email='$user_email', user_password='$hashed_password' WHERE user_id=$user_id";
            $edit_update_result = mysqli_query($connection, $edit_user_query);
            confirmQuery($edit_update_result);
        }
    }else{
        header("Location: index.php");
    }
    // if(isset($_POST["edit_user"])){
    //     // $user_id=$_POST["user_id"];
    //     $user_firstname=$_POST["user_firstname"];
    //     $user_lastname=$_POST["user_lastname"];
    //     $user_role=$_POST["user_role"];
    //     // $post_image=$_FILES["image"]["name"];
    //     // $post_image_temp=$_FILES["image"]["tmp_name"];
    //     $user_name=$_POST["user_name"];
    //     $user_email=$_POST["user_email"];
    //     $user_password=$_POST["user_password"];
    //     // $post_date=date("d-m-y");
    //     // $post_comment_count=4;
    //     // move_uploaded_file($post_image_temp, "../images/$post_image");
    //     $query = "INSERT INTO users(user_firstname, user_lastname, user_role, user_name, user_email, user_password) VALUES ('$user_firstname', '$user_lastname', '$user_role', '$user_name', '$user_email', '$user_password')";
    //     $user_add_result = mysqli_query($connection, $query);
    //     confirmQuery($user_add_result);
    // }
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="post_author">Username</label>
        <?php echo $user_id; ?>
        <input type="text" value="<?php echo $username; ?>" class="form-control" name="user_name">
    </div>
    <div class="form-group">
        <label for="post_status">First Name</label>
        <input type="text" value="<?php echo $user_firstname; ?>" class="form-control" name="user_firstname">
    </div>
    <div class="form-group">
        <label for="title">Last Name</label>
        <input type="text" value="<?php echo $user_lastname; ?>" class="form-control" name="user_lastname">
    </div>
    <div class="form-group">
        <select name="user_role" id="">
            <option value="<?php echo $user_role; ?>"><?php echo $user_role; ?></option>
            <?php 
                if($user_role == 'admin'){
                    echo "<option value='subsciber'>Subscriber</option>";
                }else{
                    echo "<option value='admin'>Admin</option>";
                }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="post_tags">Email</label>
        <input type="email" value="<?php echo $user_email; ?>" class="form-control" name="user_email">
    </div>
    <div class="form-group">
        <label for="post_tags">Password</label>
        <input autocomplete="off" type="password" value="<?php //echo $user_password; ?>" class="form-control" name="user_password">
    </div>
    <!-- <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="image"> 
    </div> -->

    <!-- <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form_control" name="post_content" id="" cols="30" rows="10"></textarea>
    </div> -->
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="edit_user" value="Edit">
    </div>
</form>