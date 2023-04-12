<?php
    if(isset($_POST["checkBoxArray"])){
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
                $query = "SELECT * FROM posts ORDER BY id DESC";
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
                        $post_views_count=$row["post_views_count"];
                        echo "<tr>";
                        echo "<td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='$id'></td>";
                        echo "<td>$id</td>";
                        echo "<td>$post_author</td>";
                        echo "<td>$post_title</td>";

                        $query_cat_id="SELECT * FROM category WHERE cat_id=$cat_id";
                        $result_cat_id=mysqli_query($connection, $query_cat_id);
                        while($row=mysqli_fetch_assoc($result_cat_id)){
                            $cat_id=$row["cat_id"];
                            $cat_title=$row["cat_title"];
                            echo "<td>$cat_title</td>";
                        }

                        echo "<td>$post_status</td>";
                        echo "<td><img src='../images/$post_image' alt='Post Image'></td>";
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
                        echo "<td><a href='../post.php?p_id=$id'>View Post</a></td>";
                        echo "<td><a href='./posts.php?source=edit_post&p_id=$id'>Edit</a></td>";
                        // echo "<td><a href='./posts.php?delete=$id'>Delete</a></td>";
                        echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete?'); \" href='posts.php?delete=$id'>Delete</a></td>";
                        echo "<td><a href='posts.php?reset=$id'>$post_views_count</a></td>";
                    echo "</tr>";
                    }
                }

            ?>
            <?php
                if(isset($_GET["delete"])){
                    $delete_post_id=$_GET["delete"];
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