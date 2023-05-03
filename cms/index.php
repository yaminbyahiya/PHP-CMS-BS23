<?php 
    include "includes/db.php"; //importing database connection
    include "includes/header.php"; //importing header module
?>
    <!-- Navigation -->
    
    <?php 
        include "./admin/functions.php"; //importing functions
        include "includes/navigation.php"; //importing navbar
        $count_users = users_online(); //displays the number of active users

    ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                <?php
                    if(isset($_GET["page"])){ //GET request for pagination
                        $page = $_GET["page"];
                    }else{
                        $page = "";
                    }
                    if($page==0 || $page==1){
                        $page_1=0;
                    }else{
                        $page_1=($page*5)-5;
                    }
                    if(isset($_SESSION["user_role"]) && $_SESSION["user_role"]=="admin"){ //Restricting draft posts only to admin through session
                        $post_count_query = "SELECT * FROM posts";
                    }else{
                        $post_count_query = "SELECT * FROM posts WHERE post_status='Published'";
                    }
                    $find_count = mysqli_query($connection, $post_count_query); //Query to find number of posts
                    $count = mysqli_num_rows($find_count); //Number of posts
                    if($count < 1){
                        echo "<h1 class='text-center'>No Post Found</h1>";
                    }
                    $count = ceil($count / 5); //Calculating number of pages for the posts
                    if(isset($_SESSION["user_role"]) && $_SESSION["user_role"]=="admin"){
                        $query = "SELECT * FROM posts LIMIT $page_1,5"; //Selecting posts according to page number for admin
                    }else{
                        $query = "SELECT * FROM posts WHERE post_status='Published' LIMIT $page_1,5"; //Selecting posts according to page number for subscriber
                    }
                    // $query = "SELECT * FROM posts WHERE post_status='Published' LIMIT $page_1,5";
                    $result = mysqli_query($connection, $query);
                    while($row = mysqli_fetch_assoc($result)){ //Storing all the retrieved values from DB to variables
                        $post_id=$row["id"];
                        $post_title = $row["post_title"];
                        $post_author = $row["post_author"];
                        $post_date = $row["post_date"];
                        $post_image = $row["post_image"];
                        $post_content = substr($row["post_content"],0,100);

                        ?>
                        <h1 class="page-header">
                            Page Heading
                            <small>Secondary Text</small>
                        </h1>
                        <!-- Displaying active users -->
                        <h1><?php echo $count_users; ?></h1>

                        <!-- Displaying all posts through while loop -->
                        <h2>
                            <a href="post.php?p_id=<?php echo $post_id ?>"><?php echo $post_title ?></a>
                        </h2>
                        <p class="lead">
                        by <a href="author_posts.php?author=<?php echo $post_author ?>&p_id=<?php echo $post_id ?>"><?php echo $post_author ?></a>
                        </p>
                        <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?> </p>
                        <hr>
                        <a href="post.php?p_id=<?php echo $post_id ?>">
                            <img class="img-responsive" src="images/<?php echo $post_image ?>" alt="">
                        </a>
                        <hr>
                        <p><?php echo $post_content ?></p>
                        <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                        <hr>
                    <?php
                    }
                    ?>

                

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php
                include "includes/sidebar.php"; //importing sidebar on homepage
            ?>

        </div>
        <!-- /.row -->

        <hr>
        
        <!-- Footer -->
        <ul class="pager">
            <?php //Pagination
                for($i=1;$i<=$count;$i++){
                    if($i==$page){
                        echo "<li><a class='active_link' href='index.php?page=$i'>$i</a></li>";
                    }else{
                        echo "<li><a href='index.php?page=$i'>$i</a></li>";
                    }
                }
            ?>
        </ul>

<?php 
    include "includes/footer.php"; //importing footer on homepage
?>