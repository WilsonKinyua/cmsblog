    <?php include "includes/db.php"; ?>
    <?php include "includes/header.php"; ?>



    <?php include "includes/nav.php"; ?>

                    <?php


                    if(isset($_POST['submit'])){

                            $username =  $_POST['username'];
                            $email = $_POST['email'];
                            $password = $_POST['password'];

                            $query = "SELECT username FROM users WHERE username = '$username' ";

                           if( $result = mysqli_query($connection, $query)){

                            if(mysqli_num_rows($result) > 0){

                                 $message = "<div class='alert alert-danger' role='alert'>Username exist.</div>";

                                header("Location: index.php");
                            } else {

                            // cleaning the data before going to the database
                            if(!empty($username) && !empty($email) && !empty($password) ){


                                $username =  mysqli_real_escape_string($connection,$username);
                                $email =  mysqli_real_escape_string($connection,$email);
                                $password =  mysqli_real_escape_string($connection,$password);
    
                                //getting the rand salt encr_p key from the database 
    
                                $password = password_hash($password,PASSWORD_BCRYPT,array("cost" => 9));
    
                                // $query = "SELECT randSalt FROM users";
                                // $select_rand_query = mysqli_query($connection,$query);
    
                                // if(!$select_rand_query){
                                //     die("Query failed". mysqli_error($connection));
                                // }
    
                                // $row = mysqli_fetch_array($select_rand_query);
    
                                //     $rand = $row['randSalt'];
                                //     $password = crypt($password,$rand);
    
    
                                $query = "INSERT INTO users (username,user_email,user_password,user_role)";
                                $query .= "VALUES('{$username}','{$email}','{$password}','Subscriber' )";
                                $register_users_query = mysqli_query($connection,$query);
    
                                if(!$register_users_query){
                                    die('Query failed' . mysqli_error($connection). ' '. mysqli_errno($connection));
                                }
    
                                $message = "<div class='alert alert-success' role='alert'>Your registration has been submitted.</div>";
    
    
    
                            }else{
                                     $message = "<div class='alert alert-danger' role='alert'>Fields Cannot be empty.</div>";
    
                                }

                            }
                        }
                         

                            
                          
                            // if(mysqli_num_rows($result) >= 1 ) {
                          
                            //     return true;
                          
                            // } else {
                          
                            //     return false;
                          
                            // }



                        }else{

                            $message = "";

                        }



                    ?>

        <!-- Page Content -->
        <div class="container">

        <section id="login">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">

                    <div class="form-wrap">
                    <h1>Register</h1>
                        <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                            <h5 class="text_center"><?php echo $message; ?></h5>

                            <div class="form-group">
                                <label for="username" class="">username</label>
                                <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
                            </div>
                            <div class="form-group">
                                <label for="email" class="sr-only">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                            </div>
                            <div class="form-group">
                                <label for="password" class="sr-only">Password</label>
                                <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                            </div>
                    
                            <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                        </form>
                    
                    </div>
                </div> <!-- /.col-xs-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </section>
<br>
<br>
<br>
<br><br><br><br>
<br>
<br>
<br><br><br>
            <hr>

        <?php include "includes/footer.php"; ?>