<?php
    include ("./includes/delete_modal.php"); //importing delete modal for popup delete promt
    if(isset($_POST["checkBoxArray"])){ //POST catch for multi checkbox action
        foreach($_POST["checkBoxArray"] as $checkBoxValue){
            $bulk_options=$_POST["bulk_options"];
            switch($bulk_options){
                case "Published":
                    $query = "UPDATE posts SET post_status = '$bulk_options' WHERE id=$checkBoxValue";
                    $status_update_result = mysqli_query($connection, $query);
                    if(!$status_update_result){
                        die("Query Failed". mysqli_error($connection));
                    }
                    break;
                case "Draft":
                    $query = "UPDATE posts SET post_status = '$bulk_options' WHERE id=$checkBoxValue";
                    $status_update_result = mysqli_query($connection, $query);
                    if(!$status_update_result){
                        die("Query Failed". mysqli_error($connection));
                    }
                    break;
                case "Delete":
                    $query = "DELETE FROM posts WHERE id=$checkBoxValue";
                    $status_update_result = mysqli_query($connection, $query);
                    if(!$status_update_result){
                        die("Query Failed". mysqli_error($connection));
                    }
                    break;
                case "Clone":
                    $query = "SELECT * FROM posts WHERE id=$checkBoxValue";
                    $select_post_query = mysqli_query($connection, $query);
                    while($row = mysqli_fetch_assoc($select_post_query)){
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
                    $query = "INSERT INTO posts(category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status) VALUES ($cat_id, '$post_title', '$post_author', '$post_date', '$post_image', '$post_content', '$post_tags', '$post_status')";
                    $clone_result = mysqli_query($connection, $query);
                    if(!$clone_result){
                        die("Query Failed". mysqli_error($connection));
                    }
                    break;
            }
        }
    }
?>
<!-- Selector for multi checkbox action -->
<form action="" method="post">
    <table class="table table-bordered table-hover">
        <div id="bulkOptionsContainer" class="col-xs-4">
            <select class="form-control" name="bulk_options" id="">
                <option value="">Select Options</option>
                <option value="Published">Publish</option>
                <option value="Draft">Draft</option>
                <option value="Delete">Delete</option>
                <option value="Clone">Clone</option>
            </select>
        </div>
        <div class="col-xs-4">
            <input type="submit" name="submit" class="btn btn-success" value="Apply">
            <a class="btn btn-primary" href="posts.php?source=add_post">Add New</a>
        </div>
        <!-- Table of all posts -->
        <thead>
            <tr>
                <th><input id="selectAllBoxes" type="checkbox"></th>
                <th>Id</th>
                <th>Author</th>
                <th>Title</th>
                <th>Category</th>
                <th>Status</th>
                <th>Image</th>
                <th>Tags</th>
                <th>Comments</th>
                <th>Date</th>
                <th>View Post</th>
                <th>Edit</th>
                <th>Delete</th>
                <th>Views Count</th>
            </tr>
        </thead>
        <tbody>
            <?php
                // $query = "SELECT * FROM posts ORDER BY id DESC";
                $query = "SELECT posts.id, posts.post_content, posts.post_author, posts.post_user, posts.post_title, posts.category_id, posts.post_status, posts.post_image, posts.post_tags, posts.post_comment_count, posts.post_date, posts.post_views_count, category.cat_id, category.cat_title FROM posts LEFT JOIN category ON posts.category_id = category.cat_id ORDER BY posts.id DESC";
                $result = mysqli_query($connection, $query);
                if(!$result){
                    die("Query Failed". mysqli_error($connection));
                }else{
                    while($row = mysqli_fetch_assoc($result)){ //Retrieving all post data from DB and storing in variables
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
                        $post_views_count=$row["post_views_count"];
                        $category_title = $row["cat_title"];
                        $category_id=$row["cat_id"];
                        echo "<tr>";
                        echo "<td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='$id'></td>";
                        echo "<td>$id</td>";
                        echo "<td>$post_author</td>";
                        echo "<td>$post_title</td>";

                        // $query_cat_id="SELECT * FROM category WHERE cat_id=$cat_id";
                        // $result_cat_id=mysqli_query($connection, $query_cat_id);
                        // while($row=mysqli_fetch_assoc($result_cat_id)){
                        //     $cat_id=$row["cat_id"];
                        //     $cat_title=$row["cat_title"];
                            echo "<td>$category_title</td>";
                        //}

                        echo "<td>$post_status</td>";
                        echo "<td><img src='../images/$post_image' width='100px' alt='Post Image'></td>";
                        // echo "<td>$post_image</td>";
                        echo "<td>$post_tags</td>";
                        $query = "SELECT * FROM comments WHERE comment_post_id=$id";
                        $send_comment_query = mysqli_query($connection, $query);
                        if(!$send_comment_query){
                            die("Query Failed". mysqli_error($connection));
                        }
                        $row = mysqli_fetch_array($send_comment_query);
                        $comment_id = $row["comment_id"];
                        $count_comments = mysqli_num_rows($send_comment_query);
                        echo "<td><a href='post_comments.php?id=$id'>$count_comments</a></td>";
                        // echo "<td>$post_content</td>";
                        echo "<td>$post_date</td>";
                        echo "<td><a class='btn btn-success' href='../post.php?p_id=$id'>View Post</a></td>";
                        echo "<td><a class='btn btn-info' href='./posts.php?source=edit_post&p_id=$id'>Edit</a></td>";
            ?>
            <!-- Delete button for posts -->
            <form action="" method="post">
                <input type="hidden" name="post_id" value="<?php echo $id ?>">
                <td>
                    <input type="submit" class="btn btn-danger" name="delete" value="Delete">
                </td>
            </form>
            <?php
                        // echo "<td><a rel='$id' href='javascript:void(0)' class='delete_link'>Delete</a></td>";
                        // echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete?'); \" href='posts.php?delete=$id'>Delete</a></td>";
                        echo "<td><a class='btn btn-warning' href='posts.php?reset=$id'>$post_views_count</a></td>";
                    echo "</tr>";
                    }
                }

            ?>
            <?php
                if(isset($_POST["delete"])){ //POST catch for post delete button
                    $delete_post_id=$_POST["post_id"];
                    $query="DELETE FROM posts WHERE id='$delete_post_id'";
                    $result = mysqli_query($connection, $query);
                    header("Location: ./posts.php");
                }
                if(isset($_GET["reset"])){
                    $query = "UPDATE posts SET post_views_count = 0 WHERE id=$id";
                    $reset_result = mysqli_query($connection, $query);
                    if(!$reset_result){
                        die("Query Failed". mysqli_error($connection));
                    }
                }
            ?>
        </tbody>
    </table>
</form>
<!-- Popup for post delete prompt -->
<script>
    $(document).ready(function(){
        $(".delete_link").on('click',function(){
            var id = $(this).attr("rel");
            var delete_url = "posts.php?delete=" + id + " ";
            alert(delete_url);
            $(".modal_delete_link").attr("href", delete_url);
            $("#exampleModal").modal('show');
        })
    });
</script>