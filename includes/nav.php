<?php include "includes/db.php"; ?>

    <!-- Navigation -->
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
                <a class="navbar-brand" href="/cms">CMS Front</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">

               
                 <!-- This query actually pulls data from the table named as categories and pull the cat_tile -->
                 
                    <?php 

                    $query = " SELECT * FROM categories";
                    $select_all_categories = mysqli_query($connection,$query);


                    while($row = mysqli_fetch_assoc($select_all_categories)){
                        $cat_title = $row['cat_title'];
                        $cat_id = $row['cat_id'];

                        echo "<li><a  href='/cms/category/{$cat_id}' >{$cat_title}</a></li>";
                                             // php code to put a nav active incase of click

                    // $category_class = "";

                    // $registration_class = "";
                    
                    // $page_name = basename($_SERVER['PHP_SELF']);
                    // $registration = "registration.php";
                    // if(isset($_GET['category']) && $_GET['category'] == $cat_id) {

                    //     $category_class = "active";


                    // }else if ($page_name == $registration){

                    //     $registration_class = "active";

                    // }
                    // end of php code to put a nav active incase of click
                      


                    };
                    ?>

          
                    <li><a class="<?php //echo $registration_class; ?>" href="/cms/registration">Registration</a></li>

                    <?php if(isLoggedIn()): ?>

                        <li><a href="/cms/admin">Admin</a></li>
                        <li><a href="/cms/includes/logout.php">Log out</a></li>

                    <?php else: ?>

                        <li><a href="login.php">Login</a></li>

                    <?php endif; ?>


                    <li><a href="/cms/contact">Contact Me</a></li>
                            <!-- End of the query -->
                            
                        </ul>
                    </div>
                    <!-- /.navbar-collapse -->
                    </div>
                    <!-- /.container -->
                    </nav>