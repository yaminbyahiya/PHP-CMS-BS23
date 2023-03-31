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
                            <small>Author</small>
                        </h1>
                        <?php
                            if(isset($_POST["submit"])){
                                $cat_title=$_POST["cat_title"];
                                if(empty($cat_title)){
                                    echo "All Fields Must be Filled!";
                                }else{
                                    $query = "INSERT INTO category(cat_title) VALUE('$cat_title')";
                                    $cat_add_result = mysqli_query($connection, $query);
        
                                    if(!$cat_add_result){
                                        die("Query Failed ". mysqli_error());
                                    }
                                }
                            }
                        ?>
                        <div class="col-xs-6">
                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="cat_title">Add Category!</label>
                                    <input type="text" class="form-control" name="cat_title">
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name="submit" value="Add Category!">
                                </div>
                            </form>
                        </div>
                        <div class="col-xs-6">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Category</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $query = "SELECT * FROM category";
                                        $result = mysqli_query($connection, $query);
                                        if(!$result){
                                            die("Query Failed! ". mysqli_error());
                                        }else{
                                            while($row = mysqli_fetch_assoc($result)){
                                                $cat_id = $row["cat_id"];
                                                $cat_title = $row["cat_title"];
                                                echo "<tr>";
                                                echo "<th>$cat_id</th>";
                                                echo "<th>$cat_title</th>";
                                                echo "</tr>";
                                            }
                                        }
                                    ?>
                                    <!-- <th>Baseball Category</th>
                                    <th>Basketball Category</th> -->
                                </tbody>
                            </table>
                        </div>
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
