<?php


if(isset($_POST['checkBoxArray'])){


  foreach($_POST['checkBoxArray'] as $userValueId ){

   $bulk_options = $_POST['bulk_options'];

      switch($bulk_options) {

        case 'admin':

        $query = "UPDATE users SET user_role = '{$bulk_options}' WHERE user_id = {$userValueId} ";
        $update_admin_user_query = mysqli_query($connection,$query);
        confirmQuery($update_admin_user_query);
        break;

        case 'subscriber':

          $query = "UPDATE users SET user_role = '{$bulk_options}' WHERE user_id = {$userValueId} ";
          $update_user_subscriber_query = mysqli_query($connection,$query);
          confirmQuery($update_user_subscriber_query);
          break;

          case 'Delete':
            $query = "DELETE FROM users WHERE user_id = {$userValueId} ";
            $delete_user_query = mysqli_query($connection,$query);
            confirmQuery($delete_user_query);
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
    <option value="admin">Admin</option>
    <option value="subscriber">Subscriber</option>
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
<th>Username</th>
<th>Firstname</th>
<th>Lastname</th>
<th>Email</th>
<th>Role</th>
<th>Admin</th>
<th>Subscriber</th>
<th>Edit</th>
<th>Delete</th>


</tr>

</thead>
<tbody>

<?php

$query = "SELECT * FROM users";

$select_users = mysqli_query($connection, $query);

while($row = mysqli_fetch_assoc($select_users)){

    $user_id = $row['user_id'];
    $username = $row['username'];
    $user_password = $row['user_password'];
    $user_firstname = $row['user_firstname'];
    $user_lastname = $row['user_lastname'];
    $user_email = $row['user_email'];
    $user_image = $row['user_image'];
    $user_role = $row['user_role'];
   // $date_date = $row['date_date'];

    echo "<tr>";
    ?>

    <!-- echoing to every post with the name value -->

  <td><input class="checkBoxes" type="checkbox" name="checkBoxArray[]" value="<?php echo $user_id; ?>"></td>


  <?php
    echo "<td>$user_id</td>";
    echo "<td>$username</td>";
    echo "<td>$user_firstname</td>";
    echo "<td>$user_lastname</td>";
    

    // $query = "SELECT * FROM posts WHERE posts_id = $comment_post_id ";
    // $select_post_id_query = mysqli_query($connection,$query);
    // while($row =  mysqli_fetch_assoc($select_post_id_query) ){
    //   $post_id = $row['posts_id'];
    //   $post_title = $row['posts_title'];
    //   echo "<td><a href='../post.php?p_id=$post_id'> $post_title</a></td>";

    // }

    echo "<td>$user_email</td>";
    echo "<td>$user_role</td>";

    echo "<td> <a class='btn btn-info' href='users.php?change_to_admin=$user_id'> Admin</a></td>";
    echo "<td> <a class='btn btn-info' href='users.php?change_to_subscriber=$user_id'>Subscriber</a></td>";
    echo "<td> <a class='btn btn-danger' href='users.php?source=edit_user&edit_user=$user_id'> Edit</a></td>";
    echo "<td> <a class='btn btn-danger' href='users.php?delete=$user_id'> Delete</a></td>";

    echo "</tr>";

}
?>

</tbody>
</table>
</form>

    <?php 

   // to change to admin
    if(isset($_GET['change_to_admin'])){
      $admin_role = $_GET['change_to_admin'];
      $query = "UPDATE users SET user_role = 'admin' WHERE user_id = $admin_role ";
      $user_admin_query = mysqli_query($connection,$query);
      header("Location: users.php");
      }

  //  to change to subscriber



  if(isset($_GET['change_to_subscriber'])){
    $subscriber_role = $_GET['change_to_subscriber'];
    $query = "UPDATE users SET user_role = 'subscriber' WHERE user_id = $subscriber_role ";
    $user_subscriber_query = mysqli_query($connection,$query);
    header("Location: users.php");
    }







   
     // code to delete the comment from the table
    if(isset($_GET['delete'])){

       if($_SESSION['user_role']){
        if($_SESSION['user_role'] == "admin"){
    $delete_user_id = mysqli_escape_string($connection,$_GET['delete']);
    $query = "DELETE FROM users WHERE user_id = {$delete_user_id}";
    $delete_user_query = mysqli_query($connection,$query);
    header("Location: users.php");
  }
    }

  }

    
    ?>


