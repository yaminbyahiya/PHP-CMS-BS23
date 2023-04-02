<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Author</th>
            <th>Title</th>
            <th>Category</th>
            <th>Status</th>
            <th>Image</th>
            <th>Tags</th>
            <th>Comments</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $query = "SELECT * FROM posts";
            $result = mysqli_query($connection, $query);
            if(!$result){
                die("Query Failed". mysqli_error());
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
                    echo "<tr>";
                    echo "<td>$id</td>";
                    echo "<td>$post_author</td>";
                    echo "<td>$post_title</td>";
                    echo "<td>$cat_id</td>";
                    echo "<td>$post_status</td>";
                    echo "<td><img src='../images/$post_image' alt='Post Image'></td>";
                    // echo "<td>$post_image</td>";
                    echo "<td>$post_tags</td>";
                    echo "<td>$post_comment_count</td>";
                    // echo "<td>$post_content</td>";
                    echo "<td>$post_date</td>";
                    echo "<td><a href='./posts.php?delete=$id'>Delete</a></td>";
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
        ?>
    </tbody>
</table>