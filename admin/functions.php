<?php 
//GENERAL FUNCTIONS

  function queryConnect($result) {
    //this function takes the connection and query parameters passed through mysqli_query() and should either one of them cause an error when attempting
    // to run the SQL statement, we make sure we recieve an error report about what went wrong with our connection at runtime.
  	global $connection;
  	if(!$result) {
  		die("QUERY FAILED ." . mysqli_error($connection));
  	}
  } 


function generateQuery($sql){
  global $connection;
  //Pass a query as a parameter and it runs through the DB. General purpose function to avoid this repetitive PHP pattern all over the CMS. It's used often enough to warrant its own function in order to avoid expressing the following lines EVERYWHERE. 

    $sendQuery = mysqli_query($connection, $sql);
    queryConnect($sendQuery); 
    

  
}

function selectQuery($column, $table){
  $query = "SELECT {$column} FROM {$table}";
  generateQuery($query);

}



 
function camelCase($str, $noStrip = []){
        // non-alpha and non-numeric characters become spaces
        $str = preg_replace('/[^a-z0-9' . implode("", $noStrip) . ']+/i', ' ', $str);
        $str = trim($str);
        // uppercase the first character of each word
        $str = ucwords($str);
        $str = str_replace(" ", "", $str);
        $str = lcfirst($str);

        return $str;
}




//--------------------------------FUNCTIONS FOR CATEGORIES ---------------------------------------------------------------------------------------------------//
//client-
 function getCatTitle(){
  global $connection;

  if(isset($_GET['category'])){
    $category = clean($_GET['category']);
  $catQuery= "SELECT cat_title FROM categories WHERE cat_id = ?";  
  $titleStmt = mysqli_stmt_init($connection);
  mysqli_stmt_prepare($titleStmt, $catQuery);
  mysqli_stmt_bind_param($titleStmt, 'i', $category);
  mysqli_stmt_execute($titleStmt);
  mysqli_stmt_bind_result($titleStmt, $cat_title);
  mysqli_stmt_store_result($titleStmt);
  mysqli_stmt_fetch($titleStmt);
  mysqli_stmt_close($titleStmt);
  }  
}


  //-----------Admin Category Functions------------------------------------------------------------------
  function addCategory(){
   global $connection;
       if(isset($_POST['submit'])) {
                                 
          $cat_title = clean($_POST['cat_title']);
  	if($cat_title == "" || empty($cat_title)) {
      echo "This field should not be empty";

  	} else{
     $stmt= mysqli_stmt_init($connection);

  	    $query = "INSERT INTO categories(cat_title) VALUES(?)";
  	  mysqli_stmt_prepare($stmt, $query);
       mysqli_stmt_bind_param($stmt,'s',$cat_title);
       mysqli_stmt_execute($stmt);




  	   // $create_category_query = mysqli_query($connection, $query);

  	    if(!$stmt){
  	        die('QUERY FAILED' . mysqli_error($connection));
  	    }
        mysqli_stmt_close($stmt);
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
       echo "<div class='form-group'>";
       echo "<tr>";
       echo "<td>{$cat_id}</td>";
       echo "<td>{$cat_title}</td>";
       //Link activating deleteCategories()
       echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>"; 
       //Link activating showEditCategories() and, by extension, editCategories()
       echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";

       echo "</tr>";
       echo "</div>";
      }
   }

    //The following functions are given some margins to emphasize their relationship to displayAllCategories(), 
   //as well as the overall flow of the admin categories.php file, in which all of these functions are used. 
            function deleteCategories(){
            	global $connection;
            if(isset($_GET['delete'])){
             $get_cat_id = $_GET['delete'];
             $stmt= mysqli_stmt_init($connection);
             $query = "DELETE FROM categories WHERE cat_id = ?";
             mysqli_stmt_prepare($stmt, $query);
             //$query = "DELETE FROM categories WHERE cat_id = {$get_cat_id}";
             // $delete_query = mysqli_query($connection, $query);
             mysqli_stmt_bind_param($stmt, 'i', $get_cat_id);
             mysqli_stmt_execute($stmt);
             mysqli_stmt_close($stmt);
             header("Location: categories.php");
            }
            }






            function showEditCategories(){
            global $connection;
             if(isset($_GET['edit'])) {
             ?>
          <div class="row d-flex justify-content-start flex-direction: column">
                 	<form action="" method="post">
                 		<label for="cat-title">Edit Category</label>
             <?php  
               $cat_id = clean($_GET['edit']);
               
               $stmtSelect= mysqli_stmt_init($connection);
             $query = "SELECT cat_id, cat_title FROM categories WHERE cat_id = ?";
             mysqli_stmt_prepare($stmtSelect, $query);
             mysqli_stmt_bind_param($stmtSelect, 'i', $cat_id);
             mysqli_stmt_execute($stmtSelect);
             mysqli_stmt_bind_result($stmtSelect, $cat_id, $cat_title);
             mysqli_stmt_store_result($stmtSelect);
               
              while ($row = mysqli_stmt_fetch($stmtSelect)) {
                

                  echo "<input value='$cat_title' class='form-control' type='text' name='cat_title'>";


              }
            mysqli_stmt_close($stmtSelect);  
            editCategories();
            } 
            }


                      function editCategories(){

                       global $connection; 
                        //EDIT CATEGORY QUERY
                        if(isset($_POST['update'])){
                            $update = clean($_POST['cat_title']);
                            $cat_id = $_GET['edit'];


                      $stmt = mysqli_stmt_init($connection);
                       // $query = "UPDATE categories SET cat_title = '{$update}' WHERE cat_id = {$cat_id} ";
                       mysqli_stmt_prepare($stmt, "UPDATE categories SET cat_title = ? WHERE cat_id = ? ");
                      mysqli_stmt_bind_param($stmt, 'si', $update, $cat_id);
                      mysqli_stmt_execute($stmt);
                      //mysqli_stmt_close($stmt);

                        //$update_query = mysqli_query($connection, $query);
                           if(!$stmt){
                            die("Query Failed to Update". mysqli_error($connection));
                           }
                          header("Location: categories.php");
                        }
                      ?>
                                                    

                                <div class="form-group"> 
                                  <input class="btn btn-primary" type="submit" name="update" value="Update Category">
                                </div>
                                <div class="form-group"> 
                                 <input class="btn btn-warning"  type="submit" name="cancelUpdate" value="Cancel">
                                 <?php if(isset($_POST['cancelUpdate'])) {header("Location: categories.php");}   //if we click the cancel btn we back out to categories.php without the $_GET['edit'] in the URL, rendering the editCategories function inactive on the parent page, admin/categories.php


                                 ?>
                               </div>
                               
                                </form>
                              </div>

                       <?php
                        } //end editCategories() 
                       ?> 








<?php
function updateCommentStatus(){
  global $connection;
  $get_comment_status = clean($_GET['status']);
  $get_comment_id=clean($_GET['c_id']);
    
            // $query = "UPDATE comments SET comment_status = '$get_comment_status' WHERE comment_id = {$get_comment_id}";
            // $status_query = mysqli_query($connection,$query);
  $query = "UPDATE comments SET comment_status = ? WHERE comment_id = ?";
  $stmt = mysqli_stmt_init($connection);  
   
   mysqli_stmt_prepare($stmt, $query);
   mysqli_stmt_bind_param($stmt, 'si', $get_comment_status, $get_comment_id);
   mysqli_stmt_execute($stmt); 


 if (!$stmt) {
  die("Query failed. " . mysqli_error($connection));
 }

  mysqli_stmt_close($stmt);

             header("Location: comments.php");
//No need to update post_comment_count when a new comment is created. PHPMyAdmin auto increments this column for us. 
}




function deleteComment(){
  global $connection;

  $query = "SELECT * FROM comments";
  $select_comments = mysqli_query($connection, $query);
  $row = mysqli_fetch_assoc($select_comments); 
  $comment_id = $row['comment_id'];
  
  
 $get_comment_id = clean($_GET['delete']);
  //this looks weird but this is actually what we need in lieu of "WHERE comment_id = {$comment_id}". The delete parameter carries the exact id we need. If you use $comment_id, it deletes the previous comment id for some reason.
 
 $query = "DELETE FROM comments WHERE comment_id = ?";
 $stmt =mysqli_stmt_init($connection);
 mysqli_stmt_prepare($stmt, $query);
 mysqli_stmt_bind_param($stmt, 'i', $get_comment_id);
 mysqli_stmt_execute($stmt);
 if (!$stmt) {
  die("Query failed. " . mysqli_error($connection));
 
}
mysqli_stmt_close($stmt);
header("Location: comments.php");


$countQuery ="UPDATE posts SET post_comment_count = post_comment_count - 1 WHERE post_id = ?";
$get_post_id = clean($_GET['postAffected']);
     $stmt = mysqli_stmt_init($connection);
     mysqli_stmt_prepare($stmt, $countQuery);
     mysqli_stmt_bind_param($stmt, 'i', $get_post_id);
     mysqli_stmt_execute($stmt);
     mysqli_stmt_close($stmt);

} 











//------------------------------------------------Functions Relating to Users ----------------------------------------------------------------------------------------------






function addUser(){
  global $connection;
  $user_firstName=clean($_POST['user_firstName']);
     $user_lastName=clean($_POST['user_lastName']);
     $user_role =clean($_POST['user_role']);
     // $post_image = $_FILES['image']['name'];
     // $post_image_temp = $_FILES['image']['tmp_name'];
     $user_username=clean($_POST['user_username']);
     $user_password=clean($_POST['user_password']);
     $user_email=clean($_POST['user_email']);
     

    

     $user_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 12)); //re-assign $user_password as the hashed form of the password we take from $POST['user_password']
     $query = "INSERT INTO users(user_id, user_firstName, user_lastName, user_role, user_username, user_password, user_email) VALUES(?,?,?,?,?,?,?)";
     $stmt = mysqli_stmt_init($connection);
     mysqli_stmt_prepare($stmt, $query);
     mysqli_stmt_bind_param($stmt, 'issssss', $user_id, $user_firstName, $user_lastName, $user_role, $user_username, $user_password, $user_email);
     mysqli_stmt_execute($stmt);
     mysqli_stmt_close($stmt);
     header("Location: users.php");
}


function updateUser(){
    global $connection;
    $get_user_id = clean($_GET['u_id']);
     $user_id = clean($_POST['user_id']);
     $user_firstName = clean($_POST['user_firstName']);
     $user_lastName = clean($_POST['user_lastName']);
     $user_username = clean($_POST['user_username']);
     $user_password =  clean($_POST['user_password']);
     //$user_profilePicture = $_POST['user_profilePicture'];
     $user_email = clean($_POST['user_email']);
     $user_role = clean($_POST['user_role']);


     // move_uploaded_file($post_image_temp, "../images/$post_image");
     // if(empty($post_image)) {

     //   $query = "SELECT * FROM posts WHERE post_id = $get_post_id";
     //   $select_image = mysqli_query($connection,$query);

     //   while($row = mysqli_fetch_array($select_image)) {
     //     $post_image = $row['post_image'];
     //   }
  
     // }
     

       $user_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 12));
   ;
    $query = "UPDATE users SET user_id = ?, user_firstName = ?, user_lastName = ?, user_username = ?, user_password = ?, user_email = ?, user_role = ? WHERE user_id = ?";

    $stmt = mysqli_stmt_init($connection);
    mysqli_stmt_prepare($stmt, $query);
    mysqli_stmt_bind_param($stmt, 'issssssi', $user_id, $user_firstName, $user_lastName, $user_username, $user_password, $user_email, $user_role, $get_user_id);
    mysqli_stmt_execute($stmt);

     echo "<p class='bg-success'>User Updated. <a href='../admin/users.php'>Back to users table</a></p>";
     mysqli_stmt_close($stmt);
     
}


function deleteUser(){
    global $connection;
  
$get_user_id = clean($_GET['delete']); //this looks weird because we're grabbing the delete URL parameter rather than the u_id URL parameter, but this is actually what we need in lieu of the normal "WHERE user_id = {$user_id}". The delete parameter already carries the exact user id we need. If you use regular $user_id, it deletes the previous user instead, for some reason.
 

$deleteQuery = "DELETE FROM users WHERE user_id = ?";
 $stmt = mysqli_stmt_init($connection);
 mysqli_stmt_prepare($stmt, $deleteQuery);
 mysqli_stmt_bind_param($stmt,'i',$get_user_id);
 mysqli_stmt_execute($stmt);
 if (!$stmt) {
  die("Query failed. " . mysqli_error($connection));
 }
 mysqli_stmt_close($stmt);
header("Location: users.php");
}



//----------------  Resource Section Functions -----------------------------------------

function updateResource() {
  global $connection;
    $get_resource_id = clean($_GET['resource_id']);
     $resource_id = clean($_POST['resource_id']);
     $resource_name = clean($_POST['resource_name']);
     $resource_url = clean($_POST['resource_url']);
     $resource_description = clean($_POST['resource_description']);
     $resource_slide =  clean($_POST['resource_slide']);
     $resource_column =  clean($_POST['resource_column']);

      $query = "UPDATE resources SET resource_id = ?, resource_name = ?, resource_url = ?, resource_description = ?, resource_slide = ?, resource_column = ? WHERE resource_id = ?";

    $stmt = mysqli_stmt_init($connection);
    mysqli_stmt_prepare($stmt, $query);
    mysqli_stmt_bind_param($stmt, 'isssiii', $resource_id, $resource_name, $resource_url, $resource_description, $resource_slide, $resource_column, $get_resource_id);
    mysqli_stmt_execute($stmt);

     echo "<p class='bg-success'>Resource Updated. <a href='../admin/resources.php'>Back to resources table</a></p>";
     mysqli_stmt_close($stmt);
}


function deleteResource() {
  global $connection;
  $get_resource_id = clean($_GET['delete']);

  $deleteQuery = "DELETE FROM resources WHERE resource_id = ?";
 $stmt = mysqli_stmt_init($connection);
 mysqli_stmt_prepare($stmt, $deleteQuery);
 mysqli_stmt_bind_param($stmt,'i',$get_resource_id);
 mysqli_stmt_execute($stmt);
 if (!$stmt) {
  die("Query failed. " . mysqli_error($connection));
 }
 mysqli_stmt_close($stmt);
header("Location: resources.php");
}



function queryResources($slide, $column) {
  global $connection;

  $stmt = mysqli_stmt_init($connection);
                  $resource_slide = $slide;
                  $resource_column = $column;

                  $query = "SELECT resource_id, resource_name, resource_url, resource_description, resource_slide, resource_column FROM resources WHERE resource_slide=? && resource_column=?";

                  mysqli_stmt_prepare($stmt, $query);

                mysqli_stmt_bind_param($stmt, 'ii', $resource_slide , $resource_column);

                mysqli_stmt_execute($stmt);

                mysqli_stmt_bind_result($stmt, $resource_id, $resource_name, $resource_url, $resource_description, $resource_slide, $resource_column);
                mysqli_stmt_store_result($stmt);
                while(mysqli_stmt_fetch($stmt)):

                  echo"<li class='resources-list-item'>
                  <a href='$resource_url' tooltip='$resource_description' class='resources-link'>

                  <span>$resource_name</span>
                </a>
                </li>";
                endwhile;
              mysqli_stmt_close($stmt);

}


// -------------------------------------------Stat Funtions--------------------------------------------------------------------------







function contentCount($table){
  global $connection;
  $query = "SELECT * FROM {$table}";
  $select_all = mysqli_query($connection, $query);
  queryConnect($select_all);

  $count = mysqli_num_rows($select_all);
  return $count;
}

function customContentCount($table, $column, $value){
  global $connection;
  $query = "SELECT * FROM {$table} WHERE {$column} = {$value}";

  $sendQuery = mysqli_query($connection, $query);
  queryConnect($sendQuery);
  $count = mysqli_num_rows($sendQuery);
  return $count;
}


function TimeAgo ($oldTime, $newTime) {
$timeCalc = strtotime($newTime) - strtotime($oldTime);
if ($timeCalc >= (60*60*24*30*12*2)){
 $timeCalc = intval($timeCalc/60/60/24/30/12) . " years ago";
 }else if ($timeCalc >= (60*60*24*30*12)){
 $timeCalc = intval($timeCalc/60/60/24/30/12) . " year ago";
 }else if ($timeCalc >= (60*60*24*30*2)){
 $timeCalc = intval($timeCalc/60/60/24/30) . " months ago";
 }else if ($timeCalc >= (60*60*24*30)){
 $timeCalc = intval($timeCalc/60/60/24/30) . " month ago";
 }else if ($timeCalc >= (60*60*24*2)){
 $timeCalc = intval($timeCalc/60/60/24) . " days ago";
 }else if ($timeCalc >= (60*60*24)){
 $timeCalc = " Yesterday";
 }else if ($timeCalc >= (60*60*2)){
 $timeCalc = intval($timeCalc/60/60) . " hours ago";
 }else if ($timeCalc >= (60*60)){
 $timeCalc = intval($timeCalc/60/60) . " hour ago";
 }else if ($timeCalc >= 60*2){
 $timeCalc = intval($timeCalc/60) . " minutes ago";
 }else if ($timeCalc >= 60){
 $timeCalc = intval($timeCalc/60) . " minute ago";
 }else if ($timeCalc > 0){
 $timeCalc .= " seconds ago";
 }
return $timeCalc;
}







// --------------------------------------Security Functions---------------------------------------------------------------







function clean($param){
global $connection;
$cleaned = mysqli_real_escape_string($connection, trim(strip_tags($param))); //escape in context to our connection and trim excess tags maliciously added on, leaving only the data that was meant to be processed. 
return $cleaned;

}

function is_admin($username){
global $connection;
if(isset($_SESSION['username'])){

  $query = "SELECT user_role FROM users WHERE user_username = ?";
  $stmt = mysqli_stmt_init($connection);
  mysqli_stmt_prepare($stmt, $query);
  mysqli_stmt_bind_param($stmt, 's', $username);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_bind_result($stmt, $user_role);
  mysqli_stmt_store_result($stmt);
  mysqli_stmt_fetch($stmt);
    if( $user_role == 'admin'){
      return true;
    }else{
      return false;
    }
}else{
  exit;
}
}

?>