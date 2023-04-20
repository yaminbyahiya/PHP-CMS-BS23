<?php 
    include "includes/header.php"; //importing header section for Categories page
    // include "functions.php";
?>
    <div id="wrapper">

        <!-- Navigation -->
        <?php 
            include "includes/navigation.php"; //importing navbar for Categories page
        ?>

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
                            insert_category(); //Catches POST request of SQL query for storing new category on DB
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

                            <?php
                                if(isset($_GET["update"])){
                                    include "includes/update_category.php"; //imports category update module if a GET request is received
                                }
                            ?>
                            
                        </div>
                        <!-- Category list table -->
                        <div class="col-xs-6">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Category</th>
                                        <th>Delete</th>
                                        <th>Update</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        findAllCategories(); //SQL query retrieves all category details from DB and displays as table data
                                    ?>
                                    <?php
                                        deleteCategory(); //Catches GET request of SQL query for deleting a specific category using category id
                                    ?>
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
    include "includes/footer.php" //imports footer section for the categories page
?>
