<?php include "includes/header.php"; ?>

<?php include "includes/nav.php"; ?>

<?php include "includes/db.php"; ?>

<?php

// if(isset($_POST['liked'])){

//     $id_post = $_POST['posts_id'];
//     $user_id = $_POST['user_id'];
//     // fetching POST likes
//     $query= "SELECT * FROM posts WHERE posts_id = $id_post ";
//     $searchPostQuery = mysqli_query($connection,$query);
//     $post_likes= mysqli_fetch_array($searchPostQuery);
//     $likes = $post_likes['likes'];
//     // if(mysqli_num_rows($searchPostQuery) >= 1){
//     //         echo $post_likes['posts_id'];
//     // }

//     // UPDATE POSTS WITH LIKES

//     mysqli_query($connection,"UPDATE posts SET likes=$likes+1 WHERE posts_id = $id_post");

//     mysqli_query($connection,"INSERT posts INTO likes(user_id,post_id) VALUES($user_id,$id_post)");
//     // CREATE LIKES
//     exit();
// }


?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">



            

                <h1 class="page-header">
                  Posts
                </h1>

                <!-- First Blog Post -->

                    <?php

                        if(isset($_GET['p_id'])){
                    
                           $the_post_id = $_GET['p_id'];
  // ========================================================================= counting the number of views one has on a certain post=============
                           $query = "UPDATE posts SET posts_view_count = posts_view_count + 1 WHERE posts_id = $the_post_id ";
                           $select_all_posts_query = mysqli_query($connection,$query);
                           if(!$select_all_posts_query){
                               die("Query failed" . mysqli_error($connection));
                           }
                        //    end of counting
                           if($_SESSION['user_role'] && $_SESSION['user_role'] == 'admin'){

                            $query = "SELECT * FROM posts WHERE posts_id = $the_post_id ";


                           }else{
                            $query = "SELECT * FROM posts WHERE posts_id = $the_post_id AND posts_status = 'published'";
                           }

                        $query = "SELECT * FROM posts WHERE posts_id = $the_post_id ";
                        $select_data_from_posts = mysqli_query($connection, $query);

                        while($row = mysqli_fetch_assoc($select_data_from_posts)){
                            $posts_title = $row['posts_title'];
                            $posts_author = $row['posts_author'];
                            $posts_date = $row['posts_date'];
                            $posts_image = $row['posts_image'];
                            $posts_content = $row['posts_content'];


                            ?>
                                            
                                <h2>
                                    <a href="#"><?php echo "{$posts_title}"; ?></a>
                                </h2>
                                <p class="lead">
                                    by <a href="index.php"><?php echo "{$posts_author}"; ?></a>
                                </p>
                                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo "{$posts_date}"; ?> at 10:00 PM</p>
                                <hr>
                                <img class="img-responsive" src="/cms/images/<?php echo "{$posts_image}"; ?>" alt="">
                                <hr>
                                <p><?php echo "{$posts_content}"; ?></p>
                             

                                <hr>

                                <!-- <div class="row">
                                <p class="pull-right"><a class="like" href="#"><span class="fa fa-thumbs-o-up"></span> Like</a></p>

                                </div>
                                
                                <div class="row">
                                <p class="pull-right">Like: 10</p>

                                </div>
                                <div class="clear-fix">
                                
                                
                                </div> -->

              


                      <?php }
                    
                     ?>


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
                                    $message = "<div class='alert alert-success' role='alert'>Comment submitted and awaiting approval by the admin.</div>";

                                   $query = "UPDATE posts SET posts_comment_count = posts_comment_count + 1 ";
                                   $query .= "WHERE posts_id = $the_post_id ";
                                   $update_comment_count = mysqli_query($connection,$query);

                                }else{
                                    $message = "<div class='alert alert-danger' role='alert'>Fields Cannot be empty.</div>";
                                }

                            }else{
                                $message = "";
                            }




                            ?>
                <!-- Comments Form -->
                <div class="well">
                <?php echo $message; ?>
                    <h4>Leave a Comment:</h4>

                   
                    <form method="post" action="" role="form">

                    <div class="form-group">
                            <label for="text">Author</label>
                            <input type="text" class="form-control" name="comment_author">
                    </div>
                            <div class="form-group">
                                    <label for="Author">Email</label>
                                    <input type="email" class="form-control" name="comment_email">
                            </div>

                            <div class="form-group">
                            <label for="text">Your Comment</label>
                            <textarea name="comment_content" class="form-control" rows="10">
                            </textarea>
                        </div>

                        <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->

                        <?php 


                        $query = "SELECT * FROM comments WHERE comment_post_id = {$the_post_id} ";
                        $query .= "AND comment_status = 'Approved' ";
                        $query .= "ORDER BY comment_id DESC ";
                        $select_comment_query = mysqli_query($connection, $query);
                        if(!$select_comment_query) {

                            die('Query Failed' . mysqli_error($connection));
                        }
                        while ($row = mysqli_fetch_array($select_comment_query)) {
                        $comment_date   = $row['comment_date']; 
                        $comment_content= $row['comment_content'];
                        $comment_author = $row['comment_author'];
                            ?>


                            <!-- Comment -->
                            <div class="media">
                                <a class="pull-left" href="#">
                                    <img class="media-object" src="http://placehold.it/64x64" alt="">
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading"><?php echo $comment_author; ?>
                                        <small><?php echo $comment_date; ?> 9:30 PM</small>
                                    </h4>
                                    <?php echo $comment_content; ?>
                                </div>
                            </div>


                       <?php }   
                     }else{
                        header("Location: index.php");
                     }?>
                           


            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php"; ?>
        </div>
        <!-- /.row -->

        <hr>

      <?php include "includes/footer.php"; ?>

                     <!-- script to add an event listener to the like button -->
      <script>
        //   $(document).ready(function(){

        //       var post_id = <?php echo $the_post_id; ?>
        //       var user_id =  <?php echo $user_id; ?>

        //         $('.like').click(function(){
        //            $.ajax({
        //             url: 'cms/post.php?p_id=<?php echo $the_post_id; ?>',
        //                 type: 'post',
        //                 data: {
        //                     'liked': 1,
        //                     'post_id' : post_id,
        //                     'user_id' : user_id

        //                 }
        //            });

        //         });


        //   });
      </script>