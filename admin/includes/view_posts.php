
<?php ob_start(); ?>
         <?php
          include "delete_modal.php";

          if(isset($_POST['checkBoxArray'])){


          foreach($_POST['checkBoxArray'] as $postValueId ){

          $bulk_options = $_POST['bulk_options'];

          switch($bulk_options) {

          case 'published':

          $query = "UPDATE posts SET posts_status = '{$bulk_options}' WHERE posts_id = {$postValueId} ";
          $update_publish_query = mysqli_query($connection,$query);
          confirmQuery($update_publish_query);
          break;

          case 'draft':

          $query = "UPDATE posts SET posts_status = '{$bulk_options}' WHERE posts_id = {$postValueId} ";
          $update_draft_query = mysqli_query($connection,$query);
          confirmQuery($update_draft_query);
          break;

          case 'delete':
          $query = "DELETE FROM posts WHERE posts_id = {$postValueId} ";
          $delete_query = mysqli_query($connection,$query);
          confirmQuery($delete_query);
          break;
          case'clone':

          $query = "SELECT * FROM posts WHERE posts_id = '{$postValueId}' ";

          $select_posts_query = mysqli_query($connection, $query);

          while($row = mysqli_fetch_assoc($select_posts_query)){
          $posts_author = $row['posts_author'];
          $posts_title = $row['posts_title'];
          $posts_category_id = $row['post_category_id'];
          $posts_status = $row['posts_status'];
          $posts_image = $row['posts_image'];
          $posts_tags = $row['posts_tag'];
          $posts_date = $row['posts_date'];
          $posts_content = $row['posts_content'];

          if(empty($posts_tags)){
            
            $posts_tags = "No tags";
          }
          

          }

          $query = "INSERT INTO posts (post_category_id, posts_title, posts_author, posts_date, posts_image, posts_content, posts_tag, posts_status) ";
          $query .= "VALUES({$posts_category_id}, '{$posts_title}', '{$posts_author}', now(), '{$posts_image}', '{$posts_content}','{$posts_tags}', '{$posts_status}') ";
          $copy_query = mysqli_query($connection,$query);

          if(!$copy_query){
          die("Query failed" . mysqli_error($connection));
          }



          break;



          }


          }
          }


          ?>
          <form action="" method='post'>

          <table class="table table-bordered table-hover">


          <div id="bulkOptionContainer" class="col-xs-2">

          <select class="form-control" name="bulk_options" id="">
          <option value="">Select Options</option>
          <option value="published">Publish</option>
          <option value="draft">Draft</option>
          <option value="delete">Delete</option>
          <option value="clone">Clone</option>

          </select>

          </div> 


          <div class="col-xs-4">

          <input type="submit" name="submit" class="btn btn-success" value="Apply">
          <a class="btn btn-primary" href="posts.php?source=add_posts">Add New</a>

          </div>
                  
                                        
                    <thead>
                    <tr>
                    <th><input id="selectAllBoxes" type="checkbox"></th>
                    <th>Id</th>
                    <th>User</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Image</th>
                    <th>Tags</th>
                    <th>Comments</th>
                    <th>Date</th>
                    <th>Views Countdown</th>
                    <th>View post</th>
                    <th>Edit</th>
                    <th>Delete</th>
                    
                    </tr>

                    </thead>
                    <tbody>




                    <?php
                            // start of the pagination
                          //   if(isset($_GET['page'])){
                          //     $page = $_GET['page'];
  
                          // }else{
                          //     $page = "";
                          // }
  
                          // if($page == "" || $page == 5){
  
                          //     $page_1 = 0;
  
                          // }else{
                          //     $page_1 = ($page * 5) - 5;
                          // }
  
  
                          // $count_posts = "SELECT * FROM posts ";
                          // $query_count = mysqli_query($connection, $count_posts);
                          // $find = mysqli_num_rows($query_count);
                          // $find = ceil($find/5);
  
  
                          // end of the pagination
                      //  $currentUser = currentUser('username');
                       $query = "SELECT * FROM posts WHERE post_user = '$_SESSION[username]'  ORDER BY posts_id ASC ";

                      //  jioning tables together
                      //  $query = "SELECT posts.posts_id,posts.posts_author, posts.post_user, posts.posts_title, posts.post_category_id, posts.posts_status, posts.posts_image, posts.posts_tag, posts.posts_comment_count,";
                      //  $query .= "posts.posts_date,posts.posts_view_count,categories.cat_id,categories.cat_title ";
                      //  $query .= "FROM posts ";
                      //  $query -= "LEFT JION categories ON posts.post_category_id = categories.cat_id ORDER BY posts.posts_id ASC";
                       $select_posts = mysqli_query($connection, $query);

                    while($row = mysqli_fetch_assoc($select_posts)){
                        $posts_id = $row['posts_id'];
                        $posts_author = $row['posts_author'];
                        $posts_user = $row['post_user'];
                        $posts_title = $row['posts_title'];
                        $posts_category_id = $row['post_category_id'];
                        $posts_status = $row['posts_status'];
                        $posts_image = $row['posts_image'];
                        $posts_tags = $row['posts_tag'];
                        $posts_comments = $row['posts_comment_count'];
                        $posts_date = $row['posts_date'];
                        $posts_view_count = $row['posts_view_count'];

                        // $category_id = $row['cat_id'];
                        // $category_title = $row['cat_title'];

                        echo "<tr>";
                        ?>

                          <!-- echoing to every post with the name value -->

                        <td><input class="checkBoxes" type="checkbox" name="checkBoxArray[]" value="<?php echo $posts_id; ?>"></td>


                        <?php
                        echo "<td>$posts_id</td>";

                        if((!empty($posts_author))){

                          echo "<td>$posts_author</td>";

                        }else if((!empty($posts_user))){

                          echo "<td>$posts_user</td>";


                        }






                        echo "<td>$posts_title</td>";

                          
                          $query = "SELECT * FROM categories WHERE cat_id = {$posts_category_id} ";

                          $display_to_table = mysqli_query($connection,$query);

                          while($row = mysqli_fetch_assoc($display_to_table)){

                            $cat_id = $row['cat_id'];
                            $cat_title = $row['cat_title'];
                                              
                            echo "<td>{$cat_title}</td>";
                            
                        }

                          // posting a post depending on the status
                          $the_post_id =  mysqli_insert_id($connection);
                        $query = "SELECT * FROM posts WHERE posts_id =  $posts_id ";
                        $select_post_id = mysqli_query($connection,$query);
                        while($row =  mysqli_fetch_assoc($select_post_id) ){
                          $post_id = $row['posts_id'];
                          $posts_status = $row['posts_status'];
                          echo "<td>$posts_status</td>";

                        }
                        echo "<td><img width='100' src ='../images/$posts_image'></td>";
                        echo "<td>$posts_tags</td>";

                        $query = "SELECT * FROM comments WHERE comment_post_id =  $posts_id ";
                        $query_posts_count = mysqli_query($connection,$query);
                        
                        $row = mysqli_fetch_array($query_posts_count);
                     //   $comment_count = $row['comment_id'];
                        $posts_count_comment = mysqli_num_rows($query_posts_count);

                        echo "<td><a href = 'post_comments.php?id={$posts_id}' >$posts_count_comment</a> </td>";
                        echo "<td>$posts_date</td>";
                        echo "<td><a href='posts.php?reset={$posts_id}'>$posts_view_count</a></td>";
                         echo "<td> <a class='btn btn-info' href='../post.php?p_id ={$posts_id}'>View Post</a></td>";
                        echo "<td><a class='btn btn-info' href='posts.php?source=edit_posts&p_id={$posts_id}'>Edit</a></td>";

                        ?>


                        <form method="post">
                
                            <input type="hidden" name="posts_id" value="<?php echo $post_id ?>">
                
                         <?php   
                
                            echo '<td><input class="btn btn-danger" type="submit" name="delete" value="Delete"></td>';
                
                          ?>
                
                
                        </form>
                
                
                
                
                        <?php
                
                
                


                        // echo "<td> <a rel='$posts_id' href ='javascript:void(0)' class='delete_link btn btn-danger' > Delete</a></td>";
                        // echo "<td> <a onClick=\" javascript: return confirm('Are you sure you want to delete');\" class='btn btn-danger' href='posts.php?delete={$posts_id} '> Delete</a></td>";
                        echo "</tr>";

                    }
                    ?>



                  

                    </tbody>
                    </table>
                    <!-- <ul class="pager"> -->
                                <?php
                                //  for($i = 1; $i <= $find; $i ++){

                                //     if($i == $page){

                                //         echo "<li ><a class= 'active_link' href = 'posts.php?page={$i}'>{$i}</a></li>";
                                //     }else{
                                //         echo "<li ><a href = 'posts.php?page={$i}'>{$i}</a></li>";
                                //     }
                                    

                                //  }
                                 ?>
                                <!-- </ul> -->
                  </form>

                      <!-- code to delete the posts from the table -->
                        <?php 

                      if(isset($_POST['delete'])){
                        $delete_posts_id = $_POST['posts_id'];
                        $query = "DELETE FROM posts WHERE posts_id = {$delete_posts_id}";
                        $delete_query = mysqli_query($connection,$query);
                        header("Location: posts.php");
                        }

                        // if(isset($_GET['delete'])){
                        // $delete_posts_id = $_GET['delete'];
                        // $query = "DELETE FROM posts WHERE posts_id = {$delete_posts_id}";
                        // $delete_query = mysqli_query($connection,$query);
                        // header("Location: posts.php");
                        // }

                        if(isset($_GET['reset'])){
                          $update_posts_id = $_GET['reset'];
                          $query = "UPDATE posts SET posts_view_count = 0 WHERE posts_id =" . mysqli_real_escape_string($connection,$_GET['reset']) . "";
                          $delete_query = mysqli_query($connection,$query);
                          header("Location: posts.php");
                          }



                        
                        ?>


<script>

$(document).ready(function() {

$(".delete_link").on("click" , function(){

  var id = $(this).attr("rel");

  var delete_url = "posts.php?delete=" + id + "";
  $(".modal_delete_link").attr("href",delete_url);
  $("#myModal").modal("show");


})

});
</script>