<?php 

  function queryConnect($result) {
  	global $connection;
  	if(!$result) {
  		die("QUERY FAILED ." . mysqli_error($connection));
  	}
  } 




  //--------------------------------FUNCTIONS FOR CATEGORIES ----------------------------------------------------------//
  function addCategory(){
   global $connection;
       if(isset($_POST['submit'])) {
                                 
          $cat_title = $_POST['cat_title'];
  	if($cat_title == "" || empty($cat_title)) {
      echo "This field should not be empty";

  	} else{
      
  	    $query = "INSERT INTO categories(cat_title)";
  	    $query .= "VALUES('{$cat_title}')";

  	    $create_category_query = mysqli_query($connection, $query);

  	    if(!$create_category_query){
  	        die('QUERY FAILED' . mysqli_error($connection));
  	    }
  	}
    }
  }
 

  function displayAllCategories() {
   global $connection;

   $query = "SELECT * FROM categories";
   $select_categories = mysqli_query($connection,$query);
       while ($row = mysqli_fetch_assoc($select_categories)) {
       $cat_id = $row['cat_id'];
       $cat_title = $row['cat_title'];
       echo "<tr>";
       echo "<td>{$cat_id}</td>";
       echo "<td>{$cat_title}</td>";
       echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";//Link to create a Query generated via GET to delete a category by ID
       echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
       echo "</tr>";
      }
   }


  function deleteCategories(){
  	global $connection;
  if(isset($_GET['delete'])){
   $get_cat_id = $_GET['delete'];
   $query = "DELETE FROM categories WHERE cat_id = {$get_cat_id}";
   $delete_query = mysqli_query($connection, $query);
   header("Location: categories.php");
  }
  }






  function editCategories(){
  global $connection;
   if(isset($_GET['edit'])) {
   ?>
       	<form  action="" method="post">
       		<label for="cat-title">Edit Category</label>
   <?php  
     $cat_id = $_GET['edit'];
     $query = "SELECT * FROM categories WHERE cat_id = $cat_id";
     $select_categories = mysqli_query($connection, $query);
       while ($row = mysqli_fetch_assoc($select_categories )) {
       $cat_id = $row['cat_id'];
       $cat_title = $row['cat_title'];
   ?>
          <input value="<?php if(isset($cat_title)){echo  $cat_title;} ?>" class="form-control" type="text" name="cat_title">

  <?php }}?>

  <?php 
  //EDIT CATEGORY QUERY
  if(isset($_POST['update'])){
      $update = $_POST['cat_title'];

  $query = "UPDATE categories SET cat_title = '{$update}' WHERE cat_id = {$cat_id} ";
  $update_query = mysqli_query($connection, $query);
     if(!$update_query){
      die("Query Failed to Update". mysqli_error($connection));
     }
    }
  ?>
                              

          <div class="form-group"> 
            <input class="btn btn-primary" type="submit" name="update" value="Update Category">
          </div>
          </form>
  <?php
  }
  ?>
<!-- --------------------------------------Functions For Comments ---------------------------------------------------- -->
<?php

  function updateCommentStatus(){
    global $connection;
     $get_comment_status = $_GET['status'];
    $get_comment_id=$_GET['c_id'];
    
            $query = "UPDATE comments SET comment_status = '$get_comment_status' WHERE comment_id = {$get_comment_id}";
            $status_query = mysqli_query($connection,$query);
            
            if (!$status_query) {
  die("Query failed. " . mysqli_error($connection));
}

             header("Location: comments.php");
}




function deleteComment(){
  global $connection;

  $query = "SELECT * FROM comments";
  $select_comments = mysqli_query($connection, $query);
  $row = mysqli_fetch_assoc($select_comments); 
  $comment_id = $row['comment_id'];
  
  
 $get_post_id = $_GET['delete']; //this looks weird but this is actually what we need in lieu of "WHERE comment_id = {$comment_id}". The delete parameter carries the exact id we need. If you use $comment_id, it deletes the previous comment id for some reason.
 $query = "DELETE FROM comments WHERE comment_id = {$get_post_id}";
 $delete_query = mysqli_query($connection, $query);
 if (!$delete_query) {
  die("Query failed. " . mysqli_error($connection));
 
}
header("Location: comments.php");
} 
//------------------------------------------------Functions Relating to Users -------------------------------------------------

function addUser(){
  global $connection;
  $user_firstName=mysqli_real_escape_string($connection, $_POST['user_firstName']);
     $user_lastName=mysqli_real_escape_string($connection, $_POST['user_lastName']);
     $user_role = $_POST['user_role'];
     // $post_image = $_FILES['image']['name'];
     // $post_image_temp = $_FILES['image']['tmp_name'];
     $user_username=mysqli_real_escape_string($connection, $_POST['user_username']);
     $user_password=mysqli_real_escape_string($connection, $_POST['user_password']);
     $user_email=mysqli_real_escape_string($connection, $_POST['user_email']);
     
     
     // move_uploaded_file($post_image_temp, "../images/$post_image");

     $query = "INSERT INTO users(user_id, user_firstName, user_lastName, user_role, user_username, user_password, user_email)";

     $query .= "VALUES('{$user_id}', '{$user_firstName}', '{$user_lastName}', '{$user_role}', '{$user_username}', '{$user_password}', '{$user_email}')";
     $createUserQuery = mysqli_query($connection, $query);

     queryConnect($createUserQuery); //from functions.php - runs a die() function with mysqli_query() function stored as a parameter containing our connection and query
     header("Location: users.php");
}


function updateUser(){
    global $connection;
    $get_user_id = $_GET['u_id'];
     $user_id = $_POST['user_id'];
     $user_firstName = mysqli_real_escape_string($connection, $_POST['user_firstName']);
     $user_lastName = mysqli_real_escape_string($connection, $_POST['user_lastName']);
     $user_username = mysqli_real_escape_string($connection, $_POST['user_username']);
     $user_password = mysqli_real_escape_string($connection, $_POST['user_password']);
     //$user_profilePicture = $_POST['user_profilePicture'];
     $user_email = mysqli_real_escape_string($connection, $_POST['user_email']);
     $user_role = $_POST['user_role'];


     // move_uploaded_file($post_image_temp, "../images/$post_image");
     // if(empty($post_image)) {

     //   $query = "SELECT * FROM posts WHERE post_id = $get_post_id";
     //   $select_image = mysqli_query($connection,$query);

     //   while($row = mysqli_fetch_array($select_image)) {
     //     $post_image = $row['post_image'];
     //   }
  
     // }
     $query = "UPDATE users SET ";
     $query .="user_id = '{$user_id}', ";
     $query .="user_firstName = '{$user_firstName}', ";
     $query .="user_lastName = '{$user_lastName}', ";
     $query .="user_username = '{$user_username}', ";
     $query .="user_password = '{$user_password}', ";
     $query .="user_email = '{$user_email}', ";
     $query .="user_role = '{$user_role}' ";
     $query .="WHERE user_id = {$get_user_id}";

     $updateUser = mysqli_query($connection, $query);
     queryConnect($updateUser);
     echo "<p class='bg-success'>User Updated. <a href='../admin/users.php'>Back to users table</a></p>";
}


function deleteUser(){
    global $connection;

  $query = "SELECT * FROM users";
  $select_users = mysqli_query($connection, $query);
  $row = mysqli_fetch_assoc($select_users); 
  $user_id = $row['user_id'];
  
  
 $get_user_id = $_GET['delete']; //this looks weird but this is actually what we need in lieu of "WHERE user_id = {$user_id}". The delete parameter already carries the exact user id we need. If you use regular $user_id, it deletes the previous user insteadnfor some reason.
 $query = "DELETE FROM users WHERE user_id = {$get_user_id}";
 $delete_query = mysqli_query($connection, $query);
 if (!$delete_query) {
  die("Query failed. " . mysqli_error($connection));
 
}
header("Location: users.php");
}
?>