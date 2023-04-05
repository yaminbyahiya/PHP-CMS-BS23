<?php include "includes/header.php";
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
                            Welcome to Admin
                            <small><?php echo $_SESSION["username"]; ?></small>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-file-text fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                <?php 
                                    $query = "SELECT * FROM posts";
                                    $post_query_result = mysqli_query($connection, $query);
                                    $post_counts = mysqli_num_rows($post_query_result);
                                ?>
                                <div class='huge'><?php echo $post_counts ?></div>
                                        <div>Posts</div>
                                    </div>
                                </div>
                            </div>
                            <a href="./posts.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <?php 
                                            $query = "SELECT * FROM comments";
                                            $comment_query_result = mysqli_query($connection, $query);
                                            $comment_count = mysqli_num_rows($comment_query_result);
                                        ?>
                                    <div class='huge'><?php echo "$comment_count" ?></div>
                                    <div>Comments</div>
                                    </div>
                                </div>
                            </div>
                            <a href="./comments.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-user fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <?php 
                                            $query = "SELECT * FROM users";
                                            $users_query_result = mysqli_query($connection, $query);
                                            $users_count = mysqli_num_rows($users_query_result);
                                        ?>
                                    <div class='huge'><?php echo $users_count ?></div>
                                        <div> Users</div>
                                    </div>
                                </div>
                            </div>
                            <a href="./users.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-list fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <?php 
                                            $query = "SELECT * FROM category";
                                            $category_query_result = mysqli_query($connection, $query);
                                            $category_count = mysqli_num_rows($category_query_result);
                                        ?>
                                        <div class='huge'><?php echo $category_count ?></div>
                                        <div>Categories</div>
                                    </div>
                                </div>
                            </div>
                            <a href="./categories.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <?php
                    $query_published_post = "SELECT * FROM posts WHERE post_status = 'Published'";
                    $select_published_post = mysqli_query($connection, $query_published_post);
                    $select_published_post_count = mysqli_num_rows($select_published_post);
                    $query_post = "SELECT * FROM posts WHERE post_status = 'Draft'";
                    $select_draft_post = mysqli_query($connection, $query_post);
                    $select_draft_post_count = mysqli_num_rows($select_draft_post);
                    $query_comment = "SELECT * FROM comments WHERE comment_status = 'unapproved'";
                    $select_unapproved_comment = mysqli_query($connection, $query_comment);
                    $select_unapproved_comment_count = mysqli_num_rows($select_unapproved_comment);
                    $query_sub = "SELECT * FROM users WHERE user_role = 'subscriber'";
                    $select_sub_users = mysqli_query($connection, $query_sub);
                    $select_unapproved_sub_count = mysqli_num_rows($select_sub_users);
                ?>
                <div class="row">
                <script type="text/javascript">
                    google.charts.load('current', {'packages':['bar']});
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                        ['Data', 'Count'],
                        <?php
                            $element_text=['All Posts', 'Active Posts', 'Draft Posts', 'Categories', 'Users', 'Subscribers', 'Comments', 'Pending Comments'];
                            $element_count=[$post_counts, $select_published_post_count,  $select_draft_post_count, $category_count, $users_count, $select_unapproved_sub_count, $comment_count, $select_unapproved_comment_count];
                            for($i=0; $i<7; $i++){
                                echo "['$element_text[$i]'" . ",". "$element_count[$i]],";
                            }
                        ?>
                        // ['Posts', 1000],
                        ]);

                        var options = {
                        chart: {
                            title: '',
                            subtitle: '',
                        }
                        };

                        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                        chart.draw(data, google.charts.Bar.convertOptions(options));
                    }
                    </script>
                    <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>
                </div>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php 
    include "includes/footer.php";
?>
