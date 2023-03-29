<?php 
include "db.php";
include "functions.php";
if(isset($_POST['submit'])){
    $del=deleteData();
}
?>
<?php include "includes/header.php"; ?>
    <div class="container">
        <div class="col-m-6">
            <h1 class="text-center">Delete User</h1>
            <form action="login_delete.php" method="post">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" name="username">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password">
                </div>
                <div class="form-group">
                    <select name="id" id="" class="form-select">
                        <?php
                            showAllData();
                        ?>
                    </select>
                </div>
                <input type="submit" class="btn btn-primary" name="submit" value="Delete">
            </form>
        </div>
    </div>
<?php include "includes/footer.php" ?>