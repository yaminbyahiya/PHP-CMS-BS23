<?php
    include "db.php";
    include "functions.php";
    createUser();
    include "includes/header.php";
?>
    <!-- <div class="container">
        <div class="col-m-6">
            <h1 class="text-center">Create User!</h1>
            <form action="login.php" method="post">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-group" name="username">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-group" name="password">
                </div>
                <input type="submit" class="btn btn-primary" name="submit" value="Submit">
            </form>
        </div>
    </div>
    <form> -->
    <div class="container">
        <div class="col-m-6">
            <h1 class="text-center">Create User</h1>
            <form action="login.php" method="post">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" name="username" placeholder="Enter username">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Enter Password">
                </div>
                <input type="submit" class="btn btn-primary" name="submit" value="Submit">
            </form>
        </div>
    </div>
<?php
    include "includes/footer.php";
?>