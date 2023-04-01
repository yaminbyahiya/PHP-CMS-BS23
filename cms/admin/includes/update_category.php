<form action="" method="post">
                                <div class="form-group">
                                    <label for="cat_title">Update Category!</label>
                                    <?php 
                                        if(isset($_GET["update"])){
                                            $cat_id=$_GET["update"];
                                            $query = "SELECT * FROM category WHERE cat_id=$cat_id";
                                            $result_cat = mysqli_query($connection, $query);
                                            if(!$result_cat){
                                                die("Query Failed". mysqli_error());
                                            }else{
                                                while($row = mysqli_fetch_assoc($result_cat)){
                                                    $cat_title=$row["cat_title"];
                                                    $cat_id=$row["cat_id"];
                                                }
                                            }
                                        }
                                    ?>
                                    <input value="<?php if(isset($cat_title)) echo "$cat_title"; ?>" type="text" class="form-control" name="cat_title">
                                    <?php
                                        if(isset($_POST["update_query"])){
                                            $cat_title = $_POST["cat_title"];
                                            $query = "UPDATE category SET cat_title='$cat_title' WHERE cat_id='$cat_id'";
                                            $update_query = mysqli_query($connection, $query);
                                            if(!$update_query){
                                                die("Query Failed ". mysqli_error());
                                            }
                                        }
                                    ?>
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name="update_query" value="Update Category!">
                                </div>
                            </form>