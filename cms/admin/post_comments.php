<?php 
    include "includes/header.php";
    // include "functions.php";
?>
    <div id="wrapper">

        <!-- Navigation -->
        <?php include "includes/navigation.php"; ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Comments
                            <small>Author</small>
                        </h1>
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
            if(isset($_GET["id"])){
                $post_id = $_GET["id"];
            }
            $query = "SELECT * FROM comments WHERE comment_post_id = $post_id";
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
                    echo "<td><a href='./comments.php?approve=$comment_id'>Approve</a></td>";
                    echo "<td><a href='./comments.php?unapprove=$comment_id'>Unapprove</a></td>";
                    // echo "<td><a href='./posts.php?source=edit_post&p_id='>Edit</a></td>";
                    echo "<td><a href='./post_comments.php?delete=$comment_id&id=$post_id'>Delete</a></td>";
                echo "</tr>";
                }
            }
            
        ?>
        <?php
            if(isset($_GET["delete"])){
                $delete_comment_id=$_GET["delete"];
                $query="DELETE FROM comments WHERE comment_id='$delete_comment_id'";
                $result = mysqli_query($connection, $query);
                header("Location: ./post_comments.php?id=$post_id");
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
</div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php 
    include "includes/footer.php"
?>