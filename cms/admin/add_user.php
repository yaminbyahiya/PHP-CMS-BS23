<?php
    if(isset($_POST["create_user"])){
        // $user_id=$_POST["user_id"];
        $user_firstname=$_POST["user_firstname"];
        $user_lastname=$_POST["user_lastname"];
        $user_role=$_POST["user_role"];
        // $post_image=$_FILES["image"]["name"];
        // $post_image_temp=$_FILES["image"]["tmp_name"];
        $user_name=$_POST["user_name"];
        $user_email=$_POST["user_email"];
        $user_password=$_POST["user_password"];
        $user_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 10));
        // $post_date=date("d-m-y");
        // $post_comment_count=4;
        // move_uploaded_file($post_image_temp, "../images/$post_image");
        $query = "INSERT INTO users(user_firstname, user_lastname, user_role, user_name, user_email, user_password) VALUES ('$user_firstname', '$user_lastname', '$user_role', '$user_name', '$user_email', '$user_password')";
        $user_add_result = mysqli_query($connection, $query);
        confirmQuery($user_add_result);
        echo "User Created: "."<a href='users.php'>View Users</a>";
    }
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="post_author">Username</label>
        <input type="text" class="form-control" name="user_name">
    </div>
    <div class="form-group">
        <label for="post_status">First Name</label>
        <input type="text" class="form-control" name="user_firstname">
    </div>
    <div class="form-group">
        <label for="title">Last Name</label>
        <input type="text" class="form-control" name="user_lastname">
    </div>
    <div class="form-group">
        <select name="user_role" id="">
            <option value="subscriber">Select Options</option>
            <option value="admin">Admin</option>
            <option value="subsciber">Subscriber</option>
        </select>
    </div>
    <div class="form-group">
        <label for="post_tags">Email</label>
        <input type="email" class="form-control" name="user_email">
    </div>
    <div class="form-group">
        <label for="post_tags">Password</label>
        <input type="password" class="form-control" name="user_password">
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
        <input class="btn btn-primary" type="submit" name="create_user" value="Publish">
    </div>
</form>