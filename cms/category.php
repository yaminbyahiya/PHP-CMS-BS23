<?php 
    include "includes/db.php";
    include "includes/header.php";
    include "admin/functions.php";
?>
    <!-- Navigation -->
    
    <?php 
        include "includes/navigation.php";
    ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                
                <?php
                    if(isset($_GET["category"])){
                        $category_id=$_GET["category"];
                    }
                    // if(is_admin($_SESSION["username"])){
                    //     $query = "SELECT * FROM posts WHERE category_id=$category_id";
                    // }else{
                    //     $query = "SELECT * FROM posts WHERE category_id=$category_id AND post_status='Published'";
                    // }
                    if(is_admin($_SESSION["username"])){ //Alternative approach using PREPARE statements
                        $stm1 = mysqli_prepare($connection, "SELECT id, post_title, post_author, post_date, post_image, post_content FROM posts WHERE category_id=?");
                    }else{
                        $stmt2 = mysqli_prepare($connection, "SELECT id, post_title, post_author, post_date, post_image, post_content FROM posts WHERE category_id=? AND post_status=?");
                        $published = "published";
                    }
                    if(isset($stm1)){
                        mysqli_stmt_bind_param($stm1, "i", $category_id);
                        mysqli_stmt_execute($stm1);
                        mysqli_stmt_bind_result($stm1, $id, $post_title, $post_author, $post_date, $post_image, $post_content);
                        $stmt = $stm1;
                    }else{
                        mysqli_stmt_bind_param($stmt2, "is", $category_id, $published);
                        mysqli_stmt_execute($stmt2);
                        mysqli_stmt_bind_result($stmt2, $id, $post_title, $post_author, $post_date, $post_image, $post_content);
                        $stmt = $stmt2;
                    }
                    // $result = mysqli_query($connection, $query);

                    // if(mysqli_num_rows($result) < 1){
                    //     echo "<h1 class='text-center'>No Post Found</h1>";
                    // }
                    if(mysqli_stmt_num_rows($stmt) === 0){
                        echo "<h1 class='text-center'>No Post Found</h1>";
                    }
                    // while($row = mysqli_fetch_assoc($result)){
                    //     $post_id=$row["id"];
                    //     $post_title = $row["post_title"];
                    //     $post_author = $row["post_author"];
                    //     $post_date = $row["post_date"];
                    //     $post_image = $row["post_image"];
                    //     $post_content = substr($row["post_content"],0,100);
                    while(mysqli_stmt_fetch($stmt)){

                        ?>
                        
                        <h1 class="page-header">
                            Page Heading
                            <small>Secondary Text</small>
                        </h1>

                        <!-- First Blog Post -->
                        <h2>
                            <a href="post.php?p_id=<?php echo $post_id ?>"><?php echo $post_title ?></a>
                        </h2>
                        <p class="lead">
                            by <a href="index.php"><?php echo $post_author ?></a>
                        </p>
                        <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?> </p>
                        <hr>
                        <img class="img-responsive" src="images/<?php echo $post_image ?>" alt="">
                        <hr>
                        <p><?php echo $post_content ?></p>
                        <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                        <hr>
                    <?php
                    }
                    ?>

                

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php
                include "includes/sidebar.php";
            ?>

        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->

<?php 
    include "includes/footer.php";
?>