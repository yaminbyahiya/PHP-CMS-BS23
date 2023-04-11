<?php 
    include "includes/header.php";
    // include "functions.php";
    if(isset($_SESSION["username"])){
        $username=$_SESSION["username"];
        $query="SELECT * FROM users WHERE user_name='$username'";
        $username_query_result=mysqli_query($connection, $query);
        if(!$username_query_result){
            die("Query Failed". mysqli_error($connection));
        }
        while($row=mysqli_fetch_assoc($username_query_result)){
            $user_id=$row["user_id"];
            $username=$row["user_name"];
            $user_password=$row["user_password"];
            $user_firstname=$row["user_firstname"];
            $user_lastname=$row["user_lastname"];
            $user_email=$row["user_email"];
            $user_image=$row["user_image"];
            $user_role=$row["user_role"];
        }
    }
    if(isset($_POST["edit_user"])){
        $user_name=$_POST["user_name"];
        $user_firstname=$_POST["user_firstname"];
        $user_lastname=$_POST["user_lastname"];
        $user_role=$_POST["user_role"];
        $user_email=$_POST["user_email"];
        $user_password=$_POST["user_password"];
        $edit_user_query = "UPDATE users SET user_name='$user_name', user_firstname='$user_firstname', user_lastname='$user_lastname', user_role='$user_role', user_email='$user_email', user_password='$user_password' WHERE user_name='$user_name'";
        $edit_update_result = mysqli_query($connection, $edit_user_query);
        confirmQuery($edit_update_result);
    }
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
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="post_author">Username</label>
                                <input type="text" value="<?php echo $username; ?>" class="form-control" name="user_name">
                            </div>
                            <div class="form-group">
                                <label for="post_status">First Name</label>
                                <input type="text" value="<?php echo $user_firstname; ?>" class="form-control" name="user_firstname">
                            </div>
                            <div class="form-group">
                                <label for="title">Last Name</label>
                                <input type="text" value="<?php echo $user_lastname; ?>" class="form-control" name="user_lastname">
                            </div>
                            <div class="form-group">
                                <select name="user_role" id="">
                                    <option value="subscriber"><?php echo $user_role; ?></option>
                                    <?php 
                                        if($user_role == 'admin'){
                                            echo "<option value='subsciber'>Subscriber</option>";
                                        }else{
                                            echo "<option value='admin'>Admin</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="post_tags">Email</label>
                                <input type="email" value="<?php echo $user_email; ?>" class="form-control" name="user_email">
                            </div>
                            <div class="form-group">
                                <label for="post_tags">Password</label>
                                <input autocomplete="off" type="password" value="<?php //echo $user_password; ?>" class="form-control" name="user_password">
                            </div>
                            <!-- <div class="form-group">
                                <label for="post_image">Post Image</label>
                                <input type="file" name="image"> 
                            </div> -->

                            <!-- <div class="form-group">
                                <label for="post_content">Post Content</label>
                                <textarea class="form_control" name="post_content" id="" cols="30" rows="10"></textarea>
                            </div> -->
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="edit_user" value="Update">
                            </div>
                        </form>
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
