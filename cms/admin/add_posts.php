<?php
    if(isset($_POST["create_post"])){
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
    }
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="title">
    </div>
    <div class="form-group">
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
    <div class="form-group">
        <label for="post_author">Post Author</label>
        <input type="text" class="form-control" name="author">
    </div>
    <div class="form-group">
        <select name="post_status" id="">
            <option value="Draft">Post Status</option>
            <option value="Published">Publish</option>
            <option value="Draft">Draft</option>
        </select>
    </div>
    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="image"> 
    </div>
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags">
    </div>
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form_control" name="post_content" id="body" cols="30" rows="10"></textarea>
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_post" value="Publish">
    </div>
</form>