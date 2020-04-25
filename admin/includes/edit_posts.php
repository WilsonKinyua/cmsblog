                        <?php 
                  
                        if(isset($_GET['p_id'])){

                        $the_post_id = $_GET['p_id'];

                        }

                        
                        $query = "SELECT * FROM posts WHERE posts_id = {$the_post_id} ";

                        $select_posts_by_id = mysqli_query($connection, $query);

                        while($row = mysqli_fetch_assoc($select_posts_by_id)){
                            $posts_id            = $row['posts_id'];
                            $posts_author        = $row['posts_author'];
                            $posts_title         = $row['posts_title'];
                            $posts_category_id   = $row['post_category_id'];
                            $posts_status          = $row['posts_status'];
                            $posts_image         = $row['posts_image'];
                            $posts_content       = $row['posts_content'];
                            $posts_tags         = $row['posts_tag'];
                            $posts_comments      = $row['posts_comment_count'];
                            $posts_date         = $row['posts_date'];
                        
                        
                        }
                    

                        if(isset($_POST['update_post'])){

                          $post_user =  $_POST['post_user'];
                          $post_title = $_POST['post_title'];
                          $post_category_id = $_POST['post_category'];
                          $post_status = $_POST['posts_status']; 
                          $post_image = $_FILES['image']['name'];
                          $post_image_temp = $_FILES['image']['tmp_name'];
                          $post_content = $_POST['post_content'];
                          $post_tags = $_POST['post_tags'];


                          move_uploaded_file( $post_image_temp , "../images/$post_image");

                          
                         if(empty($post_image)){
                            $query = "SELECT * FROM posts";
                            $select_image = mysqli_query($connection,$query);

                            while($row = mysqli_fetch_array($select_image)){
                                $post_image = $row['post_image'];

                            }
                        }


                          $query     = "UPDATE posts SET ";
                          $query    .= "posts_author = '{$post_user}', ";
                          $query    .= "posts_title = '{$post_title}', ";
                          $query    .= "post_category_id = '{$post_category_id}', ";
                          $query    .= "posts_status = '{$post_status}', ";
                          $query    .= "posts_date = now(), ";
                          $query    .= "posts_tag = '{$post_tags}', ";
                          $query    .= "posts_content = '{$post_content}', ";
                          $query    .= "posts_image = '{$post_image}' ";
                          $query    .= "WHERE posts_id = {$posts_id} ";

                          $update_post = mysqli_query($connection,$query);
                          confirmQuery($update_post);
                          echo '<div class="alert alert-success" role="alert"> Post has been updated!</div>' . " " . ""; 

        
                            
                            }    
                    
                         
                        ?>
                                 
           
           
           
          
           
           <form action="" method="post" enctype="multipart/form-data">    
                    
                    
                    <div class="form-group">
                        <label for="title">Post Title</label>
                        <input value="<?php echo $posts_title; ?>" type="text" class="form-control" name="post_title">
                    </div>

                        <div class="form-group">
                        <label for="category">Category</label>
                            <br>
                            <select name="post_category" id="post_category">
                                        <?php
                                        
                                        
                                            $query = "SELECT * FROM categories";
                                            $select_categories = mysqli_query($connection,$query);

                                            confirmQuery($select_categories); 

                                            while($row = mysqli_fetch_assoc($select_categories)){

                                            $cat_id = $row['cat_id'];
                                            $cat_title = $row['cat_title'];

                                                echo "<option value='{$cat_id}'>{$cat_title}</option>";

                                            
                                        
                                        }
                                        
                                        ?>





                            </select>
                    </div>



                    <div class="form-group">
                    <label for="author">User</label>
                    <br>
                            <select name="post_user" id="post_user">
                                        <?php
                                        
                                        
                                            $user_query = "SELECT * FROM users";
                                            $select_user = mysqli_query($connection,$user_query);

                                            confirmQuery($select_user); 

                                            while($row = mysqli_fetch_assoc($select_user)){

                                            $user_id = $row['user_id'];
                                            $username = $row['username'];
                                            
                                            echo "<option value='{$username}'>{$username}</option>";
                                        
                                        }
                                        
                                        ?>

                            </select>
                    </div>



                    <!-- <div class="form-group">
                    <label for="text">Posts Author</label>
                    <input value="<?php //echo $posts_author; ?>" type="text" class="form-control" name="post_user">
                    </div> -->

                    <div class="form-group">
                    <label for="status">Post Status</label>
                        <br>
                    <select name="posts_status" id="">

                        <option value="<?php echo $posts_status; ?>"><?php echo $posts_status; ?></option>
                                <?php 
                                if($posts_status == 'published') {
          
                                    echo "<option value='draft'>Draft</option>";
                                 
                                 } else {
                                 
                                   echo "<option value='published'>Published</option>";
                                 
                                 }
                                
                                ?>
                                    


                    </select>
                    </div>
                <div class="form-group">
                <label for="image">Post Image</label>
                                 <br>
                        <img width="100" src="../images/<?php echo $posts_image; ?>" alt="">
                        <br>
                        <input type="file"  name="image">
                    </div>

                    <div class="form-group">
                        <label for="post_tags">Post Tags</label>
                        <input value="<?php echo $posts_tags; ?>" type="text" class="form-control" name="post_tags">
                    </div>
                    
                    <div class="form-group">
                        <label for="post_content">Post Content</label>
                        <textarea class="form-control "name="post_content" id="body" cols="30" rows="10">

                        <?php echo str_replace('\r\n','<br>',$posts_content); ?>
                        
                        </textarea>
                    </div>
                    
                    

                    <div class="form-group">
                        <input class="btn btn-success" type="submit" name="update_post" value="Update Post">
                    </div>


                </form>

           