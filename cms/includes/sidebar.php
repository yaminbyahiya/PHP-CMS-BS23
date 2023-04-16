<?php
    include "db.php";
?>
<div class="col-md-4">

                <!-- Blog Search Well -->
                <?php
                if(isset($_POST["submit"])){
                    $search = $_POST["search"];
                    $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%'";
                    $result = mysqli_query($connection, $query);
                    if(!$result){
                        die("Query Failed".mysqli_error());
                    }
                    $count = mysqli_num_rows($result);
                    if($count==0){
                        echo "<h1>No result found!</h1>";
                    }else{
                        echo "<h1>Some result found!</h1>";
                    }
                }
                ?>
                <div class="well">
                    <h4>Blog Search</h4>
                    <form action="search.php" method="post">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control">
                            <span class="input-group-btn">
                                <button name="submit" class="btn btn-default" type="submit">
                                    <span class="glyphicon glyphicon-search"></span>
                            </button>
                            </span>
                        </div>
                    </form>
                        <!-- /.input-group -->
                </div>

                <div class="well">
                    <?php 
                        if(isset($_SESSION["user_role"])){
                            $username = $_SESSION['username'];
                            echo "<h4>Logged in as $username</h4>";
                            echo "<a href='includes/logout.php' class='btn btn-primary'>Logout</a>";
                        }else{ ?>
                            <h4>Login</h4>
                            <form action="includes/login.php" method="post">
                                <div class="form-group">
                                    <input type="text" name="username" class="form-control" placeholder="Enter username">
                                </div>
                                <div class="input-group">
                                    <input type="password" name="password" class="form-control" placeholder="Enter password">
                                    <span class="input-group-btn">
                                        <button name="login" class="btn btn-primary" type="submit">
                                            Submit
                                        </button>
                                    </span>
                                </div>
                            </form>
                    <?php
                        }
                    ?>
                        <!-- /.input-group -->
                </div>


                <!-- Blog Categories Well -->
                <?php
                        $query = "SELECT * FROM category";
                        $result_category = mysqli_query($connection, $query);
                    ?>
                <div class="well">
                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="list-unstyled">
                                <?php
                                    while($row = mysqli_fetch_assoc($result_category)){
                                        $category_title = $row["cat_title"];
                                        $category_id = $row["cat_id"];
                                        echo "<li> <a href='category.php?category=$category_id'> {$category_title} </a> </li>";
                                    }
                                ?>
                            </ul>
                        </div>
                        <!-- /.col-lg-6 -->
                        <!-- /.col-lg-6 -->
                    </div>
                    <!-- /.row -->
                </div>

                <!-- Side Widget Well -->
                <?php include "widget.php"; ?>

            </div>