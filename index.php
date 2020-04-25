<?php include "includes/header.php"; ?>

<?php include "includes/nav.php"; ?>

<?php include "includes/db.php"; ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <h1 class="page-header">
                   CMS
                    <small>Blog</small>
                </h1>

                <!-- First Blog Post -->

                    <?php
                    // to limit the number of posts on the page and design a multiple number of same pages but different posts
                        if(isset($_GET['page'])){
                            $page = $_GET['page'];

                        }else{
                            $page = "";
                        }

                        if($page == "" || $page == 1){

                            $page_1 = 0;

                        }else{
                            $page_1 = ($page * 5) - 5;
                        }

                       
                        $count_posts = "SELECT * FROM posts WHERE posts_status = 'published'";
                        $query_count = mysqli_query($connection, $count_posts);
                        $find = mysqli_num_rows($query_count);
                        $find = ceil($find/5);

                        if($find < 1){
                            echo "<div class='alert alert-danger text-center text-capitalize text-danger' role='alert'>No posts available</div>";
                        }else{

                        //end of that (; 
                        $query = "SELECT * FROM posts WHERE posts_status = 'published' LIMIT $page_1,5";

                        $select_data_from_posts = mysqli_query($connection, $query);

                        while($row = mysqli_fetch_assoc( $select_data_from_posts)){

                            $posts_id = $row['posts_id'];
                            $posts_title = $row['posts_title'];
                            $post_user = $row['post_user'];
                            $posts_date = $row['posts_date'];
                            $posts_image = $row['posts_image'];
                            $posts_content = substr($row['posts_content'],0,300);
                            $posts_status = $row['posts_status'];


                                //  echo '<div class="alert alert-danger" role="alert">
                                //  NO post to display here right now!
                                //  </div>';
                                    
                            
                                
                        


                            ?>
                                         
                                <h2>
                                    <a href="post/<?php echo "{$posts_id}"; ?>"><?php echo "{$posts_title}"; ?></a>
                                </h2>
                                <p class="lead">
                                    by <a href="author_posts.php?author=<?php echo "{$post_user}"; ?>&p_id=<?php echo $posts_id; ?>"><?php echo "{$post_user }"; ?></a>
                                </p>
                                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo "{$posts_date}"; ?> at 10:00 PM</p>
                                <hr>
                               <a href="post.php?p_id=<?php echo "{$posts_id}"; ?>">
                                <img class="img-responsive" src="/cms/images/<?php echo "{$posts_image}"; ?>" alt="">
                                </a>
                                <hr>
                                <p><?php echo "{$posts_content}"; ?></p>
                                <br>
                                <a class="btn btn-primary" href="post.php?p_id=<?php echo "{$posts_id}"; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                                <hr>

              


                      <?php  }}?>



                    
                    



            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php"; ?>
        </div>
        <!-- /.row -->

        <hr>
                                <ul class="pager">
                                <?php
                                 for($i = 1; $i <= $find; $i ++){

                                    if($i == $page){

                                        echo "<li ><a class= 'active_link' href = 'index.php?page={$i}'>{$i}</a></li>";
                                    }else{
                                        echo "<li ><a href = 'index.php?page={$i}'>{$i}</a></li>";
                                    }
                                    

                                 }
                                 ?>
                                </ul>
      <?php include "includes/footer.php"; ?>