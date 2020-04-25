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
                    
                        $query = "SELECT * FROM posts WHERE posts_status = 'published'";

                        $select_data_from_posts = mysqli_query($connection, $query);

                        while($row = mysqli_fetch_assoc( $select_data_from_posts)){

                            $posts_id = $row['posts_id'];
                            $posts_title = $row['posts_title'];
                            $posts_author = $row['posts_author'];
                            $posts_date = $row['posts_date'];
                            $posts_image = $row['posts_image'];
                            $posts_content = substr($row['posts_content'],0,300);
                            $posts_status = $row['posts_status'];

                            if($posts_status == 'published'){

                                //  echo '<div class="alert alert-danger" role="alert">
                                //  NO post to display here right now!
                                //  </div>';
                                    
                            
                                
                        


                            ?>
                                            
                                <h2>
                                    <a href="post.php?p_id=<?php echo "{$posts_id}"; ?>"><?php echo "{$posts_title}"; ?></a>
                                </h2>
                                <p class="lead">
                                    by <a href="author_posts.php?author=<?php echo "{$posts_author}"; ?>&p_id=<?php echo $posts_id; ?>"><?php echo "{$posts_author}"; ?></a>
                                </p>
                                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo "{$posts_date}"; ?> at 10:00 PM</p>
                                <hr>
                               <a href="post.php?p_id=<?php echo "{$posts_id}"; ?>">
                                <img class="img-responsive" src="images/<?php echo "{$posts_image}"; ?>" alt="">
                                </a>
                                <hr>
                                <p><?php echo "{$posts_content}"; ?></p>
                                <br>
                                <a class="btn btn-primary" href="post.php?p_id=<?php echo "{$posts_id}"; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                                <hr>

              


                      <?php  } }?>



                    
                    



            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php"; ?>
        </div>
        <!-- /.row -->

        <hr>

      <?php include "includes/footer.php"; ?>