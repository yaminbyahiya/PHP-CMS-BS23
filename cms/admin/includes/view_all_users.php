<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Username</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Email</th>
            <th>Role</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $query = "SELECT * FROM users";
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
                    echo "<tr>";
                    echo "<td>$user_id</td>";
                    echo "<td>$username</td>";
                    echo "<td>$user_firstname</td>";
                    echo "<td>$user_lastname</td>";
                    echo "<td>$user_email</td>";
                    echo "<td>$user_role</td>";

                    // $query_cat_id="SELECT * FROM category WHERE cat_id=$cat_id";
                    // $result_cat_id=mysqli_query($connection, $query_cat_id);
                    // while($row=mysqli_fetch_assoc($result_cat_id)){
                    //     $cat_id=$row["cat_id"];
                    //     $cat_title=$row["cat_title"];
                    //     echo "<td>$cat_title</td>";
                    // }

                    // echo "<td>$comment_email</td>";
                    // echo "<td>$comment_status</td>";
                    // $query_post="SELECT * FROM posts WHERE id=$comment_post_id";
                    // $query_result_post=mysqli_query($connection, $query_post);
                    // while($row = mysqli_fetch_assoc($query_result_post)){
                    //     $post_id=$row["id"];
                    //     $post_title=$row["post_title"];
                    //     echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
                    // }
                    // echo "<td>$post_image</td>"; 
                    echo "<td><a href='./comments.php?approve=$user_id'>Approve</a></td>";
                    echo "<td><a href='./comments.php?unapprove=$user_id'>Unapprove</a></td>";
                    // echo "<td><a href='./posts.php?source=edit_post&p_id='>Edit</a></td>";
                    echo "<td><a href='./comments.php?delete=$user_id'>Delete</a></td>";
                echo "</tr>";
                }
            }
            
        ?>
        <?php
            if(isset($_GET["delete"])){
                $delete_comment_id=$_GET["delete"];
                $query="DELETE FROM comments WHERE comment_id='$delete_comment_id'";
                $result = mysqli_query($connection, $query);
                header("Location: ./comments.php");
            }
            if(isset($_GET["approve"])){
                $approve_comment_id=$_GET["approve"];
                $query="UPDATE comments SET comment_status='approved' WHERE comment_id='$approve_comment_id'";
                $result = mysqli_query($connection, $query);
                header("Location: ./comments.php");
            }
            if(isset($_GET["unapprove"])){
                $unapprove_comment_id=$_GET["unapprove"];
                $query="UPDATE comments SET comment_status='unapproved' WHERE comment_id='$unapprove_comment_id'";
                $result = mysqli_query($connection, $query);
                header("Location: ./comments.php");
            }
        ?>
    </tbody>
</table>