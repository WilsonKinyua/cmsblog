<?php include "../cms/functions.php"; ?>
<?php
              

            if(IsItMethod('post')){
                if(isset($_POST['login'])){
                    
                    if(isset($_POST['username']) && isset($_POST['password'])){
            
                        login_user($_POST['username'],$_POST['password']);
                    
                        }else{
                        redirect("index");  
                        }

                }
             
            
            }

?>


<div class="col-md-4">
                    <!-- Blog Search Well -->
                            <div class="well">
                        <h4>Blog Search</h4>
                        <form class="form_control" action="search.php" method="post">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search">
                            <span class="input-group-btn">
                                <button class="btn btn-primary" type="submit" name="submit">
                                    <span class="glyphicon glyphicon-search"></span>
                            </button>
                            </span>
                        </div>
                        
                        </form>
                        <!-- /.input-group -->
                    </div>


                    <!-- Login in form -->
                    <div class="well">

                    <?php if(isset($_SESSION['user_role'])): ?>

                            <h4>Logged In as <?php echo $_SESSION["username"]; ?></h4>
                            <a href="/cms/includes/logout.php" class="btn btn-primary">Log Out</a>

                    <?php else: ?>

                        <h4>Login Form</h4>
                        <form class="form_control"  method="post">
                        <div class="form_group">
                                    <label for="username">Username</label>
                                    
                                    <input type="text" class="form-control" name="username" placeholder="Enter Your username">
                        
                        </div>
                        <br>
                        <div class="form_group">
                                    <!-- <label for="username">Password</label> -->
                                    <input type="password" class="form-control" name="password" placeholder="Enter Your password">
                    
                        </div>
                        <br>
                        <div class="form-group">
                            <input class="btn btn-primary" type="submit" name="login" value="Login in">
                        </div>
                        <div class="form-group">
                            <span>
                                <a href="forgot_password.php?forgot=<?php echo uniqid(true); ?>">Forgot Password</a>
                            </span>
                        </div> 
                                
                        </form>

                    <?php endif; ?>


                        <!-- /.input-group -->
                    </div>

<!-- Blog Categories Well -->
<div class="well">
<h4>Blog Categories</h4>
<div class="row">
<div class="col-lg-6">
    <ul class="list-unstyled">



    <?php 
            

            $query = " SELECT * FROM categories LIMIT 10";
            $select_display_categories = mysqli_query($connection,$query);


            while($row = mysqli_fetch_assoc($select_display_categories)){
            $cat_title = $row['cat_title'];
            $cat_id = $row['cat_id'];
            
                echo "<li><a href='category.php?category=$cat_id' >{$cat_title}</a></li>";


            };
            ?>
    




    </ul>
</div>
<!-- /.col-lg-6 -->
<!-- <div class="col-lg-6">
    <ul class="list-unstyled">
        <li><a href="#">Category Name</a>
        </li>
        <li><a href="#">Category Name</a>
        </li>
        <li><a href="#">Category Name</a>
        </li>
        <li><a href="#">Category Name</a>
        </li>
    </ul>
</div> -->
<!-- /.col-lg-6 -->
</div>
<!-- /.row -->
</div>

<!-- Side Widget Well -->
<?php include "includes/widget.php"; ?>

</div>
