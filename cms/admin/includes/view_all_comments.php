<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Author</th>
            <th>Comment</th>
            <th>Email</th>
            <th>Status</th>
            <th>In Response to</th>
            <th>Date</th>
            <th>Approve</th>
            <th>Unapprove</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $query = "SELECT * FROM comments";
            $result_comment = mysqli_query($connection, $query);
            if(!$result_comment){
                die("Query Failed". mysqli_error());
            }else{
                while($row = mysqli_fetch_assoc($result_comment)){
                    $comment_id=$row["comment_id"];
                    $comment_post_id=$row["comment_post_id"];
                    $comment_author=$row["comment_author"];
                    $comment_email=$row["comment_email"];
                    $comment_content=$row["comment_content"];
                    $comment_status=$row["comment_status"];
                    $comment_date=$row["comment_date"];
                    echo "<tr>";
                    echo "<td>$comment_id</td>";
                    echo "<td>$comment_author</td>";
                    echo "<td>$comment_content</td>";

                    // $query_cat_id="SELECT * FROM category WHERE cat_id=$cat_id";
                    // $result_cat_id=mysqli_query($connection, $query_cat_id);
                    // while($row=mysqli_fetch_assoc($result_cat_id)){
                    //     $cat_id=$row["cat_id"];
                    //     $cat_title=$row["cat_title"];
                    //     echo "<td>$cat_title</td>";
                    // }

                    echo "<td>$comment_email</td>";
                    echo "<td>$comment_status</td>";
                    $query_post="SELECT * FROM posts WHERE id=$comment_post_id";
                    $query_result_post=mysqli_query($connection, $query_post);
                    while($row = mysqli_fetch_assoc($query_result_post)){
                        $post_id=$row["id"];
                        $post_title=$row["post_title"];
                        echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
                    }
                    // echo "<td>$post_image</td>";
                    echo "<td>$comment_date</td>";
                    echo "<td><a href='./posts.php?source=edit_post&p_id='>Approve</a></td>";
                    echo "<td><a href='./posts.php?delete='>Unapprove</a></td>";
                    // echo "<td><a href='./posts.php?source=edit_post&p_id='>Edit</a></td>";
                    echo "<td><a href='./posts.php?delete='>Delete</a></td>";
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