<?php
    include "db.php";
?>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- <a class="navbar-brand" href="./index.php">CMS Front</a> -->
                <a class="navbar-brand" href="./index">CMS Front</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <?php
                        $query = "SELECT * FROM category";
                        $result = mysqli_query($connection, $query);
                        while($row = mysqli_fetch_assoc($result)){
                            $category_class = "";
                            $registration_class = "";
                            $PageName = basename($_SERVER["PHP_SELF"]);
                            $registration_page = "registration.php";
                            $cat_id = $row["cat_id"];
                            $category_title = $row["cat_title"];
                            if(isset($_GET["category"]) && $_GET["category"]=="$cat_id"){
                                $category_class="active";
                            }else if($PageName == $registration_page){
                                $registration_class = "active";
                            }
                            echo "<li class='$category_class'> <a href='category.php?category=$cat_id'> {$category_title} </a> </li>";
                        }
                    ?>
                    <li>
                        <a href="admin/">Admin Panel</a>
                    </li>
                    <li>
                        <a href="contact.php">Contact</a>
                    </li>
                    <li class='<?php echo $registration_class; ?>'>
                        <a href="registration.php">Registration</a>
                    </li>
                    <?php 
                        if(isset($_SESSION["user_role"])){
                            if(isset($_GET["p_id"])){
                                $p_id = $_GET['p_id'];
                                echo "<li><a href='admin/posts.php?source=edit_post&p_id=$p_id'>Edit Post</a></li>";
                            }
                        }
                    ?>
                    <!-- <li>
                        <a href="#">Contact</a>
                    </li> -->
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>