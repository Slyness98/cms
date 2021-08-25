<?php
if(isset($_GET['p_id'])) {
$get_post_id = $_GET['p_id'];
}
 // $query = "SELECT * FROM posts WHERE post_id = $get_post_id";
 //   $select_posts_by_id = mysqli_query($connection, $query);
 //     while ($row = mysqli_fetch_assoc($select_posts_by_id)) {

$query = "SELECT post_id, post_author, post_title, post_category_id, post_status, post_image, post_tags, post_content, post_comment_count, post_date FROM posts WHERE post_id = ?";
$stmt = mysqli_stmt_init($connection);
mysqli_stmt_prepare($stmt, $query);
mysqli_stmt_bind_param($stmt, 'i', $get_post_id);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $post_id, $post_author, $post_title, $post_category_id, $post_status, $post_image, $post_tags, $post_content, $post_comment_count, $post_date);
mysqli_stmt_store_result($stmt);
mysqli_stmt_fetch($stmt);
$post_contents = file_get_contents('../'.$post_content, FILE_USE_INCLUDE_PATH);
mysqli_stmt_close($stmt);

?>

<?php

if(isset($_POST['update_post'])) {

$post_author = $_POST['post_author'];
$post_title = $_POST['post_title'];
$post_category_id = $_POST['post_category_id'];
$post_category = $_POST['post_category'];
$post_status = $_POST['post_status'];
$post_image = $_FILES['post_image']['name'];
$post_image_temp = $_FILES['post_image']['tmp_name'];
$post_tags = $_POST['post_tags'];
$post_content= $_POST['post_content'];
$post_comment_count = $_POST['post_comment_count'];
$post_date = $_POST['post_date'];




     // move_uploaded_file($post_image_temp, "../images/$post_image");



$target_dir = "../images/";
$target_file = $target_dir . basename($_FILES['post_image']['name']);
$allowedExts = array("gif", "jpeg", "jpg", "png");
$pointerResult = explode(".", $_FILES["post_image"]["name"]);
$extension = end($pointerResult);
if ((($_FILES["post_image"]["type"] == "image/gif")
|| ($_FILES["post_image"]["type"] == "image/jpeg")
|| ($_FILES["post_image"]["type"] == "image/jpg")
|| ($_FILES["post_image"]["type"] == "image/png"))
&& ($_FILES["post_image"]["size"] < 20000)
&& in_array($extension, $allowedExts)){
        if(empty($post_image)) {

        $query = "SELECT post_image FROM posts WHERE post_id = ?";
        $stmt = mysqli_stmt_init($connection);
        mysqli_stmt_prepare($stmt, $query);
        mysqli_stmt_bind_param($stmt, 'i', $get_post_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $post_image);
        mysqli_stmt_store_result($stmt);
        mysqli_stmt_fetch($stmt);
 }

}

     // $fileInfo = @getimagesize($_FILES['post_image']['tmp_name']);
    // $width = $fileInfo[0];
    // $height = $fileInfo[1];
    // $allowed_image_extension = array(
    //     "png",
    //     "jpg",
    //     "jpeg"
    // );

  //   $file_extension = pathinfo($_FILES['post_image']['name'], PATHINFO_EXTENSION);
  //   // Validate file input to check if is not empty
  //   if (! file_exists($_FILES['post_image']['tmp_name'])) {
  //       $response = array(
  //          die("Choose image file to upload.")
  //       );
  //   }    // Validate file input to check if is with valid extension
  //   else if (! in_array($file_extension, $allowed_image_extension)) {
  //       $response = array(
  //          die("Upload valid images. Only PNG and JPEG are allowed.") 
  //       );
  //       echo $result;
  //   }    // Validate image file size
  //   else if (($_FILES['post_image']['size'] > 2000000)) {
  //       $response = array(
  //          die("Image size exceeds 2MB")
  //       );
  //   }    // Validate image file dimension
  //   else if ($width > "600" || $height > "600") {
  //       $response = array(
  //           die("Image dimension should be within 600X600")
  //       );
  // } 
     // $query = "UPDATE posts SET ";
     // $query .="post_title = '{$post_title}', ";
     // $query .="post_category_id = '{$post_category}', ";
     // $query .="post_date = now(), ";
     // $query .="post_author = '{$post_author}', ";
     // $query .="post_status = '{$post_status}', ";
     // $query .="post_tags = '{$post_tags}', ";
     // $query .="post_content = '{$post_content}', ";
     // $query .="post_image = '{$post_image}' ";
     // $query .="WHERE post_id = {$get_post_id}";

     // $updatePost = mysqli_query($connection, $query);
     // queryConnect($updatePost);

    $newFileName = '../articles/'.camelCase($post_title).".php";
  

  if (file_put_contents($newFileName, $post_content) !== false) {
      echo "<p class='bg-success'>File updated (" . basename($newFileName) . ")</p>";
  } else {
      echo "<p class='bg-success'>Cannot update file (" . basename($newFileName) . ")</p>";
  }
      
     $query = "UPDATE posts SET post_title = ?, post_category_id = ?, post_date = ?, post_author = ?, post_status = ?, post_tags = ?, post_image = ? WHERE post_id = ?"; 
     date_default_timezone_set('America/Los_Angeles');
     // $now = date('Y-m-d');
     

     $stmt = mysqli_stmt_init($connection);
     mysqli_stmt_prepare($stmt, $query);
     mysqli_stmt_bind_param($stmt, 'sisssssi', $post_title, $post_category_id, $post_date, $post_author, $post_status, $post_tags, $post_image, $post_id);
     mysqli_stmt_execute($stmt);
     mysqli_stmt_close($stmt);
     echo "<p class='bg-success'>Post Updated. <a href='../post.php?p_id={$get_post_id}'>View Post, </a> or <a href='posts.php'>Edit More Posts</a></p>";

}

?>


<form action="" method="post" enctype="multipart/form-data">

	<div class="form-group">
		<label for="post_title">Post Title </label>
		<input value="<?php echo $post_title; ?>" type="text" class="form-control" name="post_title">
	</div>
	<div class="form-group">
		<select name="post_category" id="">
			
<?php

$query = "SELECT * FROM categories";
$select_categories = mysqli_query($connection, $query);
queryConnect($select_categories);
     while ($row = mysqli_fetch_assoc($select_categories )) {
     $cat_id = $row['cat_id'];
     $cat_title = $row['cat_title'];

       if($cat_id == $post_category_id) {

      
        echo "<option selected value='{$cat_id}'>{$cat_title}</option>";


        } else {

          echo "<option value='{$cat_id}'>{$cat_title}</option>";


        }
 }

?>

		</select>
	</div>

	<div class="form-group">
		<label for="post_category">Post Category  ID </label>
		<input value="<?php echo $post_category_id; ?>" type="text" class="form-control" name="post_category_id">
	</div>

	<div class="form-group">
		<label for="post_author">Post Author </label>
		<input value="<?php echo $post_author; ?>" type="text" class="form-control" name="post_author">
	</div>

	<div class="form-group">
		<label for="post_status">Post Status </label>
	<select name="post_status" id="">
            <option value="draft" <?php if($post_status == 'draft'){echo "selected";} ?>>Draft</option>
            <option value="published" <?php if($post_status == 'published'){echo "selected";} ?>>Published</option>
        </select>
	</div>
	<div class="form-group">
		<label for="post_tags">Comments </label>
		<input value="<?php echo $post_comment_count; ?>" type="text" class="form-control" name="post_comment_count">
	</div>
	<div class="form-group">
		<label for="post_image">Image </label>
		<img src="../images/<?php echo $post_image;?>" alt="featured post image" width=175/>
		<input type="file" value="select image" name="post_image"> </input>
	</div>
	<div class="form-group">
		<label for="post_tags">Post Tags </label>
		<input value="<?php echo $post_tags; ?>" type="text" class="form-control" name="post_tags">
	</div>
	<div class="form-group">
		<label for="post_tags">Created On </label>
		<input value="<?php echo $post_date; ?>" type="text" class="form-control" name="post_date">
	</div>
	<div class="form-group">
    <div id="toolbar-container"></div>
		<label for="post_content">Post Content </label>
		<textarea type="text" class="form-control tinymce" name="post_content" id="editor" cols="30" rows="10"><?php echo $post_contents?>
		</textarea>
	</div>

	<div class="form-group">
		<input class="btn btn-primary" type="submit" name="update_post" value="Update Post">
	</div>
</form>