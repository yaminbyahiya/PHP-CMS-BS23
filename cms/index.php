<?php 
    include "includes/db.php";
    include "includes/header.php";
?>
    <!-- Navigation -->
    
    <?php 
        include "includes/navigation.php";
        $session = session_id();
        $time = time();
        $time_out_in_seconds = 60;
        $time_out = $time - $time_out_in_seconds;
        $query = "SELECT * FROM users_online WHERE session='$session'";
        $send_query = mysqli_query($connection, $query);
        $count = mysqli_num_rows($send_query);
        if($count==NULL){
            $new_session_query="INSERT INTO users_online(session, time) VALUES ('$session', '$time')";
            $new_session_query_result = mysqli_query($connection, $new_session_query);
        }else{
            $new_session_query="UPDATE users_online SET time='$time' WHERE session='$session'";
            $new_session_query_result = mysqli_query($connection, $new_session_query);
        }
        $users_online_query = "SELECT * FROM users_online WHERE time > '$time_out'";
        $users_online_query_result = mysqli_query($connection, $users_online_query);
        $count_users = mysqli_num_rows($users_online_query_result);

    ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                <?php
                    if(isset($_GET["page"])){
                        $page = $_GET["page"];
                    }else{
                        $page = "";
                    }
                    if($page==0 || $page==1){
                        $page_1=0;
                    }else{
                        $page_1=($page*5)-5;
                    }
                    $post_count_query = "SELECT * FROM posts";
                    $find_count = mysqli_query($connection, $post_count_query);
                    $count = mysqli_num_rows($find_count);
                    $count = ceil($count / 5);
                    $query = "SELECT * FROM posts WHERE post_status='Published' LIMIT $page_1,5";
                    $result = mysqli_query($connection, $query);
                    while($row = mysqli_fetch_assoc($result)){
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
                        <h1><?php echo $count_users; ?></h1>

                        <!-- First Blog Post -->
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
                include "includes/sidebar.php";
            ?>

        </div>
        <!-- /.row -->

        <hr>
        
        <!-- Footer -->
        <ul class="pager">
            <?php 
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
    include "includes/footer.php";
?>