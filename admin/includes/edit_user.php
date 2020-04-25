<?php

    if(isset($_GET['edit_user'])){


        $the_user_id = $_GET['edit_user'];
        $query = "SELECT * FROM users WHERE user_id = $the_user_id ";

        $select_users_query = mysqli_query($connection, $query);

        while($row = mysqli_fetch_assoc($select_users_query)){

            $user_id = $row['user_id'];
            $username = $row['username'];
            $user_password = $row['user_password'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_email = $row['user_email'];
            $user_image = $row['user_image'];
            $user_role = $row['user_role'];
        }

        
    
             if(isset($_POST['edit_user'])) { 


            $user_firstname        = $_POST['user_firstname'];
            $user_lastname         = $_POST['user_lastname'];
            $user_role             = $_POST['user_role'];
            $username              = $_POST['username'];
            $user_email            = $_POST['user_email'];
            $user_password         = $_POST['user_password'];


         

            // $query = "SELECT randSalt FROM users";
            // $select_rand_query = mysqli_query($connection,$query);

            // if(!$select_rand_query){
            //     die("Query failed". mysqli_error($connection));
            // }

            // $row = mysqli_fetch_array($select_rand_query);
            // $rand = $row['randSalt'];
            // $hashed_password = crypt($user_password,$rand);


            if(!empty($user_password)){

                $password_query = "SELECT user_password FROM users WHERE user_id = $the_user_id ";
                $get_user = mysqli_query($connection,$password_query);
                confirmQuery($get_user);
                $row = mysqli_fetch_array($get_user);
                $db_user_password = $row['user_password'];

                if($db_user_password != $user_password){
                    $hashed_password = password_hash($user_password,PASSWORD_BCRYPT,array("cost" => 9));
    
                }
                
          

            $query     = "UPDATE users SET ";
            $query    .= "username = '{$username}', ";
            $query    .= "user_password  = '{$hashed_password}', ";
            $query    .= "user_firstname  = '{$user_firstname }', ";
            $query    .= "user_lastname = '{$user_lastname}', ";
            $query    .= "user_email  = '{$user_email }', ";
            $query    .= "user_role = '{$user_role}' ";
            $query    .= "WHERE user_id = {$the_user_id} ";
    
            $update_user = mysqli_query($connection,$query);
            confirmQuery($update_user);

            }else{
                echo '<div class="alert alert-danger" role="alert"> Fill in the empty parts!</div>'; 

            }

            
    }
}else{
    header("Location: index.php");
}
            ?>
 
               <form action="" method="POST">    
                    
                    
                    <div class="form-group">
                        <label for="title">First Name</label>
                        <input type="text" value="<?php echo $user_firstname; ?>" class="form-control" name="user_firstname">
                    </div>

                    <div class="form-group">
                        <label for="title">Last Name</label>
                        <input type="text" value="<?php echo $user_lastname; ?>" class="form-control" name="user_lastname">
                    </div>

                      
                    <div class="form-group">
                            <select name="user_role" id="">
                            <option><?php echo $user_role; ?></option>
                                <?php 
                                if($user_role == 'admin') {
          
                                    echo "<option value='subscriber'>Subscriber</option>";
                                 
                                 } else {
                                 
                                   echo "<option value='admin'>Admin</option>";
                                 
                                 }
                                
                                ?>
                                        
                                        
                                        
                            </select>
                    </div>
                    

                    <div class="form-group">
                        <label for="post_tags">Username</label>
                        <input type="text" value="<?php echo $username; ?>" class="form-control" name="username">
                    </div>

                    <div class="form-group">
                        <label for="post_tags">Email</label>
                        <input type="email" value="<?php echo $user_email; ?>" class="form-control" name="user_email">
                    </div>

                    <div class="form-group">
                        <label for="post_tags">Password</label>
                        <input type="password" autocomplete="off" class="form-control" name="user_password">
                    </div>

                    <div class="form-group">
                        <input class="btn btn-primary" type="submit" name="edit_user" value="Update User">
                    </div>


                </form>
                

             