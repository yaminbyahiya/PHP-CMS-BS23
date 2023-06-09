<?php 
    include "includes/header.php";
    if(isset($_SESSION["username"])){
        if(!is_admin($_SESSION["username"])){
            header("Location: ../index.php");
        }
    }
    // include "functions.php";
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
                            if(isset($_GET["source"])){
                                $source=$_GET["source"];
                            }else{
                                $source=" ";
                            }
                            switch($source){
                                case "add_user";
                                    include "add_user.php";
                                    break;
                                case "edit_user";
                                    include "edit_user.php";
                                    break;
                                default:
                                    include "includes/view_all_users.php";
                                    break;
                            }
                        ?>
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
