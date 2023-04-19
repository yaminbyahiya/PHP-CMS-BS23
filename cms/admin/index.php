<?php include "includes/header.php"; //importing header on admin page
?>
    <div id="wrapper">

        <!-- Navigation -->
        <?php 
            include "includes/navigation.php"; //importing navbar on admin page
        ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Admin
                            <small><?php echo $_SESSION["username"]; //Displaying name of the logged in user ?></small> 
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
                                    $post_counts = recordCount("posts") //Retrieving number of posts
                                ?>
                                <!-- Displaying number of posts -->
                                <div class='huge'><?php echo $post_counts ?></div>
                                        <div>Posts</div>
                                    </div>
                                </div>
                            </div>
                            <!-- Link to View All Post Page -->
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
                                            $comment_count = recordCount("comments") //Retrieving number of comments
                                        ?>
                                    <!-- Displaying number of comments -->
                                    <div class='huge'><?php echo "$comment_count" ?></div>
                                    <div>Comments</div>
                                    </div>
                                </div>
                            </div>
                            <!-- Link to Comments Page -->
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
                                            $users_count = recordCount("users"); //Retrieving number of users
                                        ?>
                                    <!-- Displaying number of users -->
                                    <div class='huge'><?php echo $users_count ?></div>
                                        <div> Users</div>
                                    </div>
                                </div>
                            </div>
                            <!-- Link to Users Page -->
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
                                            $category_count = recordCount("category"); //Retrieving numer of categories
                                        ?>
                                        <!-- Displaying number of categories -->
                                        <div class='huge'><?php echo $category_count ?></div>
                                        <div>Categories</div>
                                    </div>
                                </div>
                            </div>
                            <!-- Link to Categories Page -->
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
                    // $query_published_post = "SELECT * FROM posts WHERE post_status = 'Published'";
                    // $select_published_post = mysqli_query($connection, $query_published_post);
                    $select_published_post_count = checkStatus("posts","post_status","Published"); //Retrieving published post count from DB
                    // $query_post = "SELECT * FROM posts WHERE post_status = 'Draft'";
                    // $select_draft_post = mysqli_query($connection, $query_post);
                    $select_draft_post_count = checkStatus("posts","post_status","Draft"); //Retrieving draft post count from DB
                    // $query_comment = "SELECT * FROM comments WHERE comment_status = 'unapproved'";
                    // $select_unapproved_comment = mysqli_query($connection, $query_comment);
                    $select_unapproved_comment_count = checkStatus("comments","comment_status","unapproved");// Retrieving comments from DB
                    // $query_sub = "SELECT * FROM users WHERE user_role = 'subscriber'";
                    // $select_sub_users = mysqli_query($connection, $query_sub);
                    $select_unapproved_sub_count = checkStatus("users","user_role","subscriber");//Retrieving subscribers count from DB
                ?>
                <!-- Displaying visual graphical information -->
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
                            for($i=0; $i<sizeof($element_text); $i++){
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
    include "includes/footer.php"; //importing footer for admin homepage
?>
