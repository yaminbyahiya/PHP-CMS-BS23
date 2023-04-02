<?php
    if(isset($_GET["p_id"])){
        $edit_post_id=$_GET["p_id"];
    }
    $query = "SELECT * FROM posts WHERE id=$edit_post_id";
    $result = mysqli_query($connection, $query);
    if(!$result){
        die("Query Failed". mysqli_error($connection));
    }else{
        while($row = mysqli_fetch_assoc($result)){
            $id=$row["id"];
            $cat_id=$row["category_id"];
            $post_author=$row["post_author"];
            $post_title=$row["post_title"];
            $post_date=$row["post_date"];
            $post_image=$row["post_image"];
            $post_content=$row["post_content"];
            $post_tags=$row["post_tags"];
            $post_comment_count=$row["post_comment_count"];
            $post_status=$row["post_status"];
        }
    }
    
    if(isset($_POST["update_post"])){
        $post_title=$_POST["title"];
        $post_cat_id=$_POST["post_category"];
        $post_author=$_POST["author"];
        $post_status=$_POST["post_status"];
        $post_image=$_FILES["image"]["name"];
        $post_image_temp=$_FILES["image"]["tmp_name"];
        $post_tags=$_POST["post_tags"];
        $post_content=$_POST["post_content"];
        // $post_date=date("d-m-y");
        // $post_comment_count=4;
        move_uploaded_file($post_image_temp, "../images/$post_image");
        if(empty($post_image)){
            $query = "SELECT * FROM posts WHERE id=$edit_post_id";
            $result = mysqli_query($connection, $query);
            while($row=mysqli_fetch_assoc($result)){
                $post_image=$row["post_image"];
            }
        }
        $query = "UPDATE posts SET category_id=$post_cat_id, post_title='$post_title', post_author='$post_author', post_date=now(), post_image='$post_image', post_content='$post_content', post_tags='$post_tags', post_comment_count=$post_comment_count, post_status='$post_status' WHERE id=$edit_post_id";
        $post_update_result = mysqli_query($connection, $query);
        confirmQuery($post_update_result);
    }

?>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post Title</label>
        <input value="<?php echo $post_title ?>" type="text" class="form-control" name="title">
    </div>
    <div class="form-group">
        <!-- <label for="post_category">Post Category Id</label>
        <input value="<?php echo $cat_id ?>" type="text" class="form-control" name="post_category_id"> -->
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
        <input value="<?php echo $post_author ?>" type="text" class="form-control" name="author">
    </div>
    <div class="form-group">
        <label for="post_status">Post Status</label>
        <input value="<?php echo $post_status ?>" type="text" class="form-control" name="post_status">
    </div>
    <div class="form-group">
        <label for="post_image">Post Image</label>
        <img src=<?php echo "../images/$post_image" ?> alt="Image">
        <input type="file" name="image"> 
    </div>
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input value="<?php echo $post_tags ?>" type="text" class="form-control" name="post_tags">
    </div>
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form_control" name="post_content" id="" cols="30" rows="10"> <?php echo $post_content ?> </textarea>
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_post" value="Update">
    </div>
</form>