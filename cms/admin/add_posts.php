<?php
    if(isset($_POST["create_post"])){ //POST catch for new post form
        $post_title=$_POST["title"];
        $post_cat_id=$_POST["post_category"];
        $post_author=$_POST["author"];
        $post_status=$_POST["post_status"];
        $post_image=$_FILES["image"]["name"];
        $post_image_temp=$_FILES["image"]["tmp_name"];
        $post_tags=$_POST["post_tags"];
        $post_content=$_POST["post_content"];
        $post_date=date("d-m-y");
        // $post_comment_count=4;
        move_uploaded_file($post_image_temp, "../images/$post_image");
        $query = "INSERT INTO posts(category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status) VALUES ($post_cat_id, '$post_title', '$post_author', now(), '$post_image', '$post_content', '$post_tags', '$post_status')";
        $post_add_result = mysqli_query($connection, $query);
        confirmQuery($post_add_result);
        $add_post_id=mysqli_insert_id($connection);
        echo "<p class='bg-success'>Post Updated. <a href='../post.php?p_id=$add_post_id'>View Post</a> or <a href='posts.php?source=add_post'>Add More Posts</a></p>";
    }
?>
<!-- Form for creating new post -->
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="title">
    </div>
    <!-- Dropdown for category selection -->
    <div class="form-group">
        <label for="category">Category</label>
        <select name="post_category" id="">
            <?php
                $query="SELECT * FROM category";
                $result=mysqli_query($connection, $query);
                while($row=mysqli_fetch_assoc($result)){
                    $cat_id=$row["cat_id"];
                    $cat_title=$row["cat_title"];
                    echo "<option value='$cat_id'>$cat_title</option>";
                }
            ?>
        </select>
    </div>
    <!-- <div class="form-group">
        <label for="users">Users</label>
        <select name="post_users" id="">
            <?php 
                $query="SELECT * FROM users";
                $result=mysqli_query($connection, $query);
                while($row=mysqli_fetch_assoc($result)){
                    $user_id=$row["user_id"];
                    $user_name=$row["user_name"];
                    echo "<option value='$user_name'>$user_name</option>";
                }
            ?>
        </select>
    </div> -->
    <!-- Author Name Input -->
    <div class="form-group">
        <label for="post_author">Post Author</label>
        <input type="text" class="form-control" name="author">
    </div>
    <!-- Dropdown for post status -->
    <div class="form-group">
        <select name="post_status" id="">
            <option value="Draft">Post Status</option>
            <option value="Published">Publish</option>
            <option value="Draft">Draft</option>
        </select>
    </div>
    <!-- Image Input -->
    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="image"> 
    </div>
    <!-- Post Tags Input -->
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags">
    </div>
    <!-- Post Content Input -->
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form_control" name="post_content" id="body" cols="30" rows="10"></textarea>
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_post" value="Publish">
    </div>
</form>