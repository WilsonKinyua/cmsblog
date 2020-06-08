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

                     if(isset($_GET['category'])){

                     $post_category_id = $_GET['category'];

                     if(is_admin($_SESSION['username'])){


                     $stm1 = mysqli_prepare($connection,"SELECT posts_id, posts_title,posts_author, posts_date, posts_image, posts_content FROM posts WHERE post_category_id = ?");

                     }
                     $stm2 = mysqli_prepare($connection,"SELECT posts_id, posts_title,posts_author, posts_date, posts_image, posts_content FROM posts WHERE post_category_id = ? AND posts_status = ?" );
                        $published = 'published';
                       if(isset($stm1)){
                           mysqli_stmt_bind_param($stm1,'i',$post_category_id);
                           mysqli_stmt_execute($stm1);
                           mysqli_stmt_bind_result($stm1,$posts_id, $posts_title,$posts_author, $posts_date, $posts_image, $posts_content);
                           $stm = $stm1;

                       }else{

                        mysqli_stmt_bind_param($stm2,'is',$post_category_id,$published);
                        mysqli_stmt_execute($stm2);
                        mysqli_stmt_bind_result($stm2,$posts_id, $posts_title,$posts_author, $posts_date, $posts_image, $posts_content);
                        $stm = $stm2;

                       }

                      
                    //    if(mysqli_stmt_num_rows($stm) == 0){

                    //     echo '<div class="alert alert-danger" role="alert">
                    //     No posts categories available!!!!
                    //   </div>';
                    //    }else{
                       
                    //    }

                       

                        while($row = mysqli_stmt_fetch($stm)):

                            // $posts_id = $row['posts_id'];
                            // $posts_title = $row['posts_title'];
                            // $posts_author = $row['posts_author'];
                            // $posts_date = $row['posts_date'];
                            // $posts_image = $row['posts_image'];
                            // $posts_content = substr($row['posts_content'],0,300);


                            ?>
                                            
                                <h2>
                                    <a href="/cms/post.php?p_id=<?php echo "{$posts_id}"; ?>"><?php echo "{$posts_title}"; ?></a>
                                </h2>
                                <p class="lead">
                                    by <a href="/cms/"><?php echo "{$posts_author}"; ?></a>
                                </p>
                                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo "{$posts_date}"; ?> at 10:00 PM</p>
                                <hr>
                               
                                <img class="img-responsive" src="/cms/images/<?php echo "{$posts_image}"; ?>" alt="">
                                <hr>
                                <p><?php echo "{$posts_content}"; ?></p>
                                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                                <hr>

              


                        <?php endwhile; mysqli_stmt_close($stm); }else{

                          header("Location: index.php");
                          
                      } ?>



                    
                    



            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php"; ?>
        </div>
        <!-- /.row -->

        <hr>

      <?php include "includes/footer.php"; ?>