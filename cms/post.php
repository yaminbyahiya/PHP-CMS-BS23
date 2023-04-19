<?php 
    include "includes/db.php";
    include "includes/header.php";
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
                    if(isset($_GET["p_id"])){
                        $post_id=$_GET["p_id"];
                    }
                    $query = "SELECT * FROM posts WHERE id=$post_id";
                    $view_query = "UPDATE posts SET post_views_count = post_views_count + 1 WHERE id=$post_id";
                    $view_query_result=mysqli_query($connection, $view_query);
                    if(!$view_query_result){
                        die("Query Failed". mysqli_error($connection));
                    }
                    if(isset($_SESSION["user_role"]) && $_SESSION["user_role"]=="admin"){
                        $query="SELECT * FROM posts WHERE id='$post_id'";
                    }else{
                        $query="SELECT * FROM posts WHERE id='$post_id' AND post_status='Published'";
                    }
                    $result = mysqli_query($connection, $query);
                    while($row = mysqli_fetch_assoc($result)){
                        $post_title = $row["post_title"];
                        $post_author = $row["post_author"];
                        $post_date = $row["post_date"];
                        $post_image = $row["post_image"];
                        $post_content = $row["post_content"];
                ?>
                        
                        <h1 class="page-header">
                            Page Heading
                            <small>Secondary Text</small>
                        </h1>

                        <!-- First Blog Post -->
                        <h2>
                            <a href="#"><?php echo $post_title ?></a>
                        </h2>
                        <p class="lead">
                            by <a href="index.php"><?php echo $post_author ?></a>
                        </p>
                        <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?> </p>
                        <hr>
                        <img class="img-responsive" src="images/<?php echo $post_image ?>" alt="">
                        <hr>
                        <p><?php echo $post_content ?></p>
                        <!-- <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a> -->

                        <hr>
                    <?php
                    }
                    ?>

                <!-- Blog Comments -->

                <!-- Comments Form -->
                <?php 
                    if(isset($_POST["create_comment"])){
                        $comment_author=$_POST["comment_author"];
                        $comment_email=$_POST["comment_email"];
                        $comment_content=$_POST["comment_content"];
                        if(!empty($comment_author) && !empty($comment_email) && !empty($comment_content)){
                            $query="INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) VALUES ($post_id, '$comment_author', '$comment_email', '$comment_content', 'unapproved', now())";
                            $create_comment=mysqli_query($connection, $query);
                            if(!$create_comment){
                                die("Query Failed". mysqli_error($connection));
                            }
                            // $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 WHERE id=$post_id";
                            // $count_query_result=mysqli_query($connection, $query);
                            // if(!$count_query_result){
                            //     die("Query Failed". mysqli_error($connection));
                            // }
                        }else{
                            echo "<script>alert('Fields cannot be empty!')</script>";
                        }
                    }
                ?>
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form" action="" method="post">
                        <div class="form-group">
                            <label for="Author">Author</label>
                            <input type="text" class="form-control" name="comment_author">
                        </div>
                        <div class="form-group">
                            <label for="Email">Email</label>
                            <input type="email" class="form-control" name="comment_email">
                        </div>
                        <div class="form-group">
                            <label for="Comment">Your Comment</label>
                            <textarea name="comment_content" class="form-control" rows="3"></textarea>
                        </div>
                        <button type="submit" name="create_comment" class="btn btn-primary">Submit Comment</button>
                    </form>
                </div>

                <hr>
                <div class="btn btn-light" type="button" data-href="http://127.0.0.1/PHP-CMS-BS23/cms/post.php?p_id=1#" data-layout="" data-size="">
                    <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2F127.0.0.1%2FPHP-CMS-BS23%2Fcms%2Fpost.php%3Fp_id%3D1%23&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Share on Facebook </a>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16"><path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/></svg>
                </div>
                <div class="btn btn-light">
                    <a href="https://twitter.com/share?ref_src=twsrc%5Etfw" class="twitter-share-button" data-show-count="false">Share on Twitter </a>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-twitter" viewBox="0 0 16 16">
                        <path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z"/>
                    </svg>
                    <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                </div>
                <div class="btn btn-light">
                    <a href="https://wa.me/?text=http://127.0.0.1/PHP-CMS-BS23/cms/post.php?p_id=24" data-action="share/whatsapp/share">Share on WhatsApp </a>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
                        <path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"/>
                    </svg>
                </div>

                <!-- Posted Comments -->
                <br>
                <?php
                    $query = "SELECT * FROM comments WHERE comment_post_id=$post_id AND comment_status='approved' ORDER BY comment_id DESC";
                    $select_comment_query = mysqli_query($connection, $query);
                    if(!$select_comment_query){
                        die("Query Failed". mysqli_error($connection));
                    }
                    while($row=mysqli_fetch_assoc($select_comment_query)){
                        $comment_author=$row["comment_author"];
                        $comment_content=$row["comment_content"];
                        $comment_date=$row["comment_date"];
                    }
                ?>
                <!-- Comment -->
                <?php 
                    if(!$comment_author && !$comment_content && !$comment_date){
                        // echo "No comments found!";
                    }else{
                ?>
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment_author; ?>
                            <small><?php echo $comment_date; ?></small>
                        </h4>
                        <?php echo $comment_content; ?>
                    </div>
                </div>

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