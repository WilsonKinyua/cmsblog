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

                        if(isset($_GET['p_id'])){
                    
                           $the_post_id = $_GET['p_id'];
                           $the_post_author = $_GET['author'];
                        }

                        $query = "SELECT * FROM posts WHERE post_user = '{$the_post_author}' ";

                        $select_data_from_posts = mysqli_query($connection, $query);

                        while($row = mysqli_fetch_assoc($select_data_from_posts)){
                            $posts_title = $row['posts_title'];
                            $post_user = $row['post_user'];
                            $posts_date = $row['posts_date'];
                            $posts_image = $row['posts_image'];
                            $posts_content = $row['posts_content'];


                            ?>
                                            
                                <h2>
                                    <a href="#"><?php echo "{$posts_title}"; ?></a>
                                </h2>
                                <p class="lead">
                                 All Posts by <?php echo "{$post_user}"; ?>
                                </p>
                                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo "{$posts_date}"; ?> at 10:00 PM</p>
                                <hr>
                                <img class="img-responsive" src="images/<?php echo "{$posts_image}"; ?>" alt="">
                                <hr>
                                <p><?php echo "{$posts_content}"; ?></p>
                             

                                <hr>

              


                      <?php  }?>


                                <!-- Blog Comments -->
                            <?php

                            if(isset($_POST['create_comment'])){
                                    $the_post_id = $_GET['p_id'];
                                    $comment_author = $_POST['comment_author'];
                                    $comment_email = $_POST['comment_email'];
                                    $comment_content = $_POST['comment_content'];

                                if(!empty($comment_author) && !empty($comment_email) && !empty($comment_content) ){

                                    $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date)";
                                    $query .= "VALUES ($the_post_id, '{$comment_author}', '{$comment_email}', '{$comment_content}', 'unapproved', now())";


                                    $create_comment_query = mysqli_query($connection,$query);
                                    if(!$create_comment_query){
                                        die('query error'.mysqli_error($connection));
                                    }

                                   $query = "UPDATE posts SET posts_comment_count = posts_comment_count + 1 ";
                                   $query .= "WHERE posts_id = $the_post_id ";
                                   $update_comment_count = mysqli_query($connection,$query);

                                }else{
                                   echo "<script> alert('Fields cannot be empty.');</script>";
                                }

                            }




                            ?>



            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php"; ?>
        </div>
        <!-- /.row -->

        <hr>

      <?php include "includes/footer.php"; ?>