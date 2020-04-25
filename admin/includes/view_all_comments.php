<?php


if(isset($_POST['checkBoxArray'])){


  foreach($_POST['checkBoxArray'] as $commentValueId ){

   $bulk_options = $_POST['bulk_options'];

      switch($bulk_options) {

        case 'Approved':

        $query = "UPDATE comments SET comment_status = '{$bulk_options}' WHERE comment_id = {$commentValueId} ";
        $update_comment_query = mysqli_query($connection,$query);
        confirmQuery($update_comment_query );
        break;

        case 'Unapproved':

          $query = "UPDATE comments SET comment_status = '{$bulk_options}' WHERE comment_id = {$commentValueId} ";
          $update_comment_unapprove_query = mysqli_query($connection,$query);
          confirmQuery($update_comment_unapprove_query);
          break;

          case 'Delete':
            $query = "DELETE FROM comments WHERE comment_id = {$commentValueId} ";
            $delete_comment_query = mysqli_query($connection,$query);
            confirmQuery($delete_comment_query);
            break;
    

      }
    

  }
}


?>


<form action="" method="post">
     <table class = 'table table-striped table-bordered table-hover'>

     <div id="bulkOptionContainer" class="col-xs-2">

<select class="form-control" name="bulk_options" id="">
<option value="">Select Option</option>
<option value="Approved">Approved</option>
<option value="Unapproved">Unapproved</option>
<option value="Delete">Delete</option>

</select>

</div> 
             
            
<div class="col-xs-4">

<input type="submit" name="submit" class="btn btn-success" value="Apply">

 </div>
 
 
<thead>
<tr>
<th><input id="selectAllBoxes" type="checkbox"></th>
<th>Id</th>
<th>Author</th>
<th>Comment</th>
<th>Email</th>
<th>In Response to</th>
<th>Status</th>
<th>Date</th>
<th>Approve</th>
<th>Unapprove</th>
<th>Delete</th>

</tr>

</thead>
<tbody>

<?php

$query = "SELECT * FROM comments";

$select_comment = mysqli_query($connection, $query);

while($row = mysqli_fetch_assoc( $select_comment)){

    $comment_id = $row['comment_id'];
    $comment_post_id = $row['comment_post_id'];
    $comment_author = $row['comment_author'];
    $comment_email = $row['comment_email'];
    $comment_content = substr($row['comment_content'],0,50) ;
    $comment_status = $row['comment_status'];
    $comment_date = $row['comment_date'];

    echo "<tr>";
          ?>

              <!-- echoing to every post with the name value -->

            <td><input class="checkBoxes" type="checkbox" name="checkBoxArray[]" value="<?php echo $comment_id; ?>"></td>


            <?php
    echo "<td>$comment_id</td>";
    echo "<td>$comment_author</td>";
    echo "<td> $comment_content</td>";
    echo "<td>$comment_email </td>";
    

    $query = "SELECT * FROM posts WHERE posts_id = $comment_post_id ";
    $select_post_id_query = mysqli_query($connection,$query);
    while($row =  mysqli_fetch_assoc($select_post_id_query) ){
      $post_id = $row['posts_id'];
      $post_title = $row['posts_title'];
      echo "<td><a href='../post.php?p_id=$post_id'> $post_title</a></td>";

    }

    echo "<td>$comment_status</td>";
    echo "<td>$comment_date</td>";

    echo "<td> <a class='btn btn-danger' href='comments.php?approve=$comment_id'> Approve</a></td>";
    echo "<td> <a class='btn btn-info' href='comments.php?unapprove=$comment_id'>Unapprove</a></td>";

    echo "<td> <a class='btn btn-danger' href='comments.php?delete=$comment_id'> Delete</a></td>";

    echo "</tr>";

}
?>

</tbody>
</table>
</form>

    <?php 

    //to approve the comment status
    if(isset($_GET['approve'])){
      $approve_comment_status = $_GET['approve'];
      $query = "UPDATE comments SET comment_status = 'Approved' WHERE comment_id = $approve_comment_status ";
      $approve_comment_query = mysqli_query($connection,$query);
      header("Location: comments.php");
      }

    //to unapprove the comments



    if(isset($_GET['unapprove'])){
      $update_comment_status = $_GET['unapprove'];
      $query = "UPDATE comments SET comment_status = 'Unapproved' WHERE comment_id = $update_comment_status ";
      $unapprove_comment_query = mysqli_query($connection,$query);
      header("Location: comments.php");
      }







      //code to delete the comment from the table
    if(isset($_GET['delete'])){
    $delete_comment_id = $_GET['delete'];
    $query = "DELETE FROM comments WHERE comment_id = {$delete_comment_id}";
    $delete_comment_query = mysqli_query($connection,$query);
    header("Location: comments.php");
    }



    
    ?>


