   <!-- code to add a post in the admin area -->
    <?php
    
    if(isset($_POST['create_post'])){
        $post_title        = $_POST['title'];
        $post_user       = $_POST['post_user'];
        $post_category_id  = $_POST['post_category'];
        $post_status       = $_POST['posts_status'];

        $post_image        = $_FILES['image']['name'];
        $post_image_temp   = $_FILES['image']['tmp_name'];


        $post_tags         = $_POST['post_tags'];
        $post_content      = $_POST['post_content'];
        $post_date         = date('d-m-y');
        $post_comment_count = 4;
        move_uploaded_file($post_image_temp ,"../images/$post_image");

        // if(!empty($post_title) && !empty($post_author) && !empty($comment_content) ){

     $query = "INSERT INTO posts (post_category_id, posts_title, post_user, posts_date, posts_image, posts_content, posts_tag, posts_comment_count, posts_status) ";
     $query .= "VALUES({$post_category_id}, '{$post_title}', '{$post_user}', now(), '{$post_image}', '{$post_content}','{$post_tags}','{$post_comment_count}', '{$post_status}') ";
     $create_post_query = mysqli_query($connection,$query);
     $the_post_id =  mysqli_insert_id($connection);
     confirmQuery($create_post_query);
    //  echo '<div class="alert alert-success" role="alert">New post has been created</div>' . " <a class = 'btn btn-primary' href='posts.php'>Edit More Posts</a>" ;
     echo "<div class='alert alert-success' role='alert'>New post has been created. <a href='../post.php?p_id={$the_post_id}'>View Post </a> or <a href='posts.php'>Edit More Posts</a></div>";
        // }else{
        //     echo "<script> alert('Fields cannot be empty.');</script>";
        //  }


    }
    
    
    ?>
    
    
    <form action="" method="post" enctype="multipart/form-data">    
                    
                    
                    <div class="form-group">
                        <label for="title">Post Title</label>
                        <input type="text" class="form-control" name="title">
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
                                        
                                        
                                            $user_query = "SELECT * FROM users WHERE username = '$_SESSION[username]' ";
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
                    <input type="text" class="form-control" name="post_author">
                    </div> -->

                    <div class="form-group">
                        <label for="post_tags">Post Status</label>
                        <br>
                    <select name="posts_status" id="">
                        <option value="draft">Select An Option</option>
                        <option value="published">Publish</option>
                        <option value="draft">Draft</option>
                    </select>
                        <!-- <input type="text" class="form-control" name="posts_status"> -->
                    </div>
                    
                <div class="form-group">
                        <label for="post_image">Post Image</label>
                        <input type="file"  name="image">
                    </div>

                    <div class="form-group">
                        <label for="post_tags">Post Tags</label>
                        <input type="text" class="form-control" name="post_tags">
                    </div>
                    
                    <div class="form-group">
                        <label for="post_content">Post Content</label>
                        <textarea class="form-control "name="post_content" id="body" cols="30" rows="10">
                        </textarea>
                    </div>
                    
                    

                    <div class="form-group">
                        <input class="btn btn-primary" type="submit" name="create_post" value="Publish Post">
                    </div>


                </form>
                