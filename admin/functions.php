<?php 

// =============================================================function to check whether user_role is an admin


function is_admin(){

  global $connection;

 if(isLoggedIn()){

  $result = query("SELECT user_role FROM users WHERE user_id = '".$_SESSION['user_id']."'");
  $row = fetchRecord($result);


  if($row['user_role'] == 'admin' ){
      return true;
  }else{
    return false;
  }

 }
 return false;

  

}


// ==========================count rows=============

function count_records($result){

  return mysqli_num_rows($result);
}



// ================================general helper=====================================================

function getUsername(){

   return isset($_SESSION['username']) ? $_SESSION['username'] : null;
  
}

// ========================isLoggedUserId======================

function LoggedInUserId(){

  if(isLoggedIn()){

    $result = query("SELECT * FROM users WHERE username ='".$_SESSION['username']."'");
    $user = mysqli_fetch_array($result);
    if(mysqli_num_rows($result) >= 1){

      return $user['user_id'];

    }
    
  }

  return false;
}


// ======================================user specific helper post==============================================

    function getAllUserPost(){



      return query("SELECT * FROM posts WHERE user_id =" .LoggedInUserId()."");
      // $select_number_posts = mysqli_query($connection,$query);
      // $posts_count = mysqli_num_rows($select_number_posts);

    }


// ======================================user specific helper comments==============================================

function getAllPosts_UserComments(){
  
 return query("SELECT * FROM posts INNER JOIN  comments ON posts.posts_id = comments.comment_post_id WHERE user_id =" .LoggedInUserId()."");

}



// ======================================user specific helper categories====================================================

function getAllPosts_UserCategories(){


  return query("SELECT * FROM categories WHERE user_id =" .LoggedInUserId()."");

}


// ======================================user specific helper published posts====================================================

function getAllPublishedUserPosts(){


  return query("SELECT * FROM posts WHERE user_id =" .LoggedInUserId()." AND posts_status = 'published' ");


}

// ======================================user specific helper darft posts====================================================

function getAllDraftUserPosts(){


  return query("SELECT * FROM posts WHERE user_id =" .LoggedInUserId()." AND posts_status = 'draft' ");


}

// ======================================user specific helper approved comments====================================================

function getAllCommentUserPostApprovedstatus(){


  return query("SELECT * FROM posts INNER JOIN  comments ON posts.posts_id = comments.comment_post_id WHERE user_id =" .LoggedInUserId()." AND comment_status = 'approved'");


}

// ======================================user specific helper unapproved comments====================================================

function getAllCommentUserPostUnapprovedstatus(){


  return query("SELECT * FROM posts INNER JOIN  comments ON posts.posts_id = comments.comment_post_id WHERE user_id =" .LoggedInUserId()." AND comment_status = 'unapproved'");


}
// ======================================helper function for the mysqli_fetch_array connection=====================================================

function fetchRecord($result){

  return mysqli_fetch_array($result);

}

// ======================================helper function for the database connection=====================================================

function query($query){

  global $connection;
 $result = mysqli_query($connection,$query);
 confirmQuery($result);
 return $result;

}

// =============================================a placeholder for an image incase a user didn't create one


function image_Placeholder($image = ''){
  if(!$image){
    return '2.jpg';
  }
  return $image;
}



// =================================================================================choosing who to see what in the admin


function current_User(){
  if(isset($_SESSION['username'])){

    return $_SESSION['username'];
  }

  return false;
}

//=================================================================================== function to redirect user to a certain location


function redirect($location){

  header("Location" . $location);
  exit;
  
  }


//==================started building login forgot password here============================ function to check the method


  function IsItMethod($method = null){

    if($_SERVER['REQUEST_METHOD'] == strtoupper($method)){

      return true;
    }
    return false;

  }




//===================================================================================function to check whether user is logged in

  function isLoggedIn(){

    if(isset($_SESSION['user_role'])){

      return true;

    }

    return false;


  }

//===================================function to check whether user is logged in adn redirect to a certain page



  function checkUserIsLoogedInAndRedirect($redirectlocation = null){

    if(isLoggedIn()){

      redirect($redirectlocation);
    }

  }



  
//=================================================================================== escaping the string
function escape($string){

  global $connection;
  return  mysqli_real_escape_string($connection,trim(strip_tags($string)));

}


// 

function confirmQuery($result){
  global $connection;

  if(!$result){
    die("Query failed". mysqli_error($connection));
}
return $result;

}

// ===================================================================================edit categories


// before prepaer statement


// function edit_categories(){

//   global $connection;

// if(isset($_POST['submit'])){
//   $cat_title = $_POST['cat_title'];
//   if($cat_title == '' || empty($cat_title)){
//       echo '<div class="alert alert-danger" role="alert">
//       Please fill in the form!
//     </div>';
//   }else{
//       echo '<div class="alert alert-success" role="alert">
//       Successfully submitted!
//     </div>';
//     $query ="INSERT INTO categories(cat_title)";
//     $query .= "VALUE('{$cat_title}')";
//     $query_add_category = mysqli_query($connection,$query);

//     if(!$query_add_category){
//         die("Not successfull" .mysqli_error($connection));
//     }
//   }

// }
// }


// using prepare statement to prevent mysqli injection.............................

function edit_categories(){

        global $connection;

    if(isset($_POST['submit'])){
        $cat_title = $_POST['cat_title'];
        if($cat_title == '' || empty($cat_title)){
            echo '<div class="alert alert-danger" role="alert">
            Please fill in the form!
          </div>';
        }else{
            echo '<div class="alert alert-success" role="alert">
            Successfully submitted!
          </div>';

          $query ="INSERT INTO categories(cat_title)";
         $query .= "VALUE('{$cat_title}')";
         $query_add_category = mysqli_query($connection,$query);
         confirmQuery($query_add_category);

          // $stmt = mysqli_prepare($connection,"INSERT INTO categories(cat_title) VALUES(?)");
          // mysqli_stmt_bind_param($stmt,'s',$cat_title);
          // mysqli_stmt_execute($stmt);

          // confirmQuery($stmt);
          // closing the database manually
          // mysqli_stmt_close($stmt);

          
        
        }

    }
}




// =========================================================find all categories

function findall_categories(){
    global $connection;
// $query  = "SELECT * FROM posts INNER JOIN categories ON posts.posts_id = categories.cat_id";

    $query = "SELECT * FROM categories";
    $display_to_table = mysqli_query($connection,$query);

       while($row = mysqli_fetch_assoc($display_to_table)){

       $cat_id = $row['cat_id'];
       $cat_title = $row['cat_title'];
       
         echo '<tr>';
           echo "<td> {$cat_id}</td>";
           echo "<td> {$cat_title}</td>";


           echo "<td> <a href='categories.php?delete={$cat_id} '> Delete</a></td>";
           echo "<td> <a href='categories.php?edit={$cat_id} '> Edit</a></td>";
           echo '</tr>';
   }

}


// ==================================================================delete categories


function delete_categories(){
    global $connection;
    if(isset($_GET['delete'])){
        $the_cat_id = $_GET['delete'];
        $query = "DELETE FROM categories WHERE cat_id = {$the_cat_id} ";
        $delete_query = mysqli_query($connection,$query);
        header("Location: categories.php");
     }
}


// =====================================function to load users online and refresh direct from the database by use of Ajax



function users_online() {

if(isset($_GET['onlineusers'])){
  global $connection;
    
  if(!$connection){

    session_start();
    include("../includes/db.php");

    

  $session                = session_id();
  $time                   = time();
  $time_out_in_seconds    = 05;
  $time_out               = $time - $time_out_in_seconds;

  $query = "SELECT * FROM users_online WHERE session = '$session' ";
  $send_query = mysqli_query($connection,$query);
  $count = mysqli_num_rows($send_query);

  if($count == NULL){
      mysqli_query($connection,"INSERT INTO users_online(session, time) VALUES('$session','$time')");
  }else{
      mysqli_query($connection,"UPDATE users_online SET time = '$time' WHERE session = '$session'");

  }
$query_users_online = mysqli_query($connection, "SELECT * FROM users_online WHERE time > '$time_out'");
echo $count_users = mysqli_num_rows($query_users_online);


  }




    }//get request isset()

  }
  users_online();

  // end of load function




?>