<?php 
include "db.php";
include "functions.php";
if(isset($_POST['submit'])){
    updateData();
}
?>
<?php include "includes/header.php"; ?>
    <div class="container">
        <div class="col-m-6">
            <h1 class="text-center">Update User</h1>
            <form action="login_update.php" method="post">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" name="username">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password">
                </div>
                <div class="form-group">
                    <select name="id" id="">
                        <?php
                            showAllData();
                        ?>
                    </select>
                </div>
                <input type="submit" class="btn btn-primary" name="submit" value="Update">
            </form>
        </div>
    </div>
<?php include "includes/footer.php" ?>