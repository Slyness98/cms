<?php

if(isset($_POST['create_post'])) {
 
    
     $post_title = $_POST['title'];
     $post_author = $_POST['author'];
     $post_category_id = $_POST['post_category'];
     $post_status = $_POST['post_status'];
     $post_image = $_FILES['image']['name'];
     $post_image_temp = $_FILES['image']['tmp_name'];
     $post_tags = $_POST['post_tags'];
     $post_content=mysqli_real_escape_string($connection, $_POST['post_content']);
     $post_date = date('d-m-y');
     
     
     move_uploaded_file($post_image_temp, "../images/$post_image");

     $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status)";

     $query .= "VALUES('{$post_category_id}', '{$post_title}', '{$post_author}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_status}')";
     $sendPostQuery = mysqli_query($connection, $query);

     queryConnect($sendPostQuery); //from functions.php - runs a die() function with mysqli_query() function stored as a parameter containing our connection and query
     //header("Location: posts.php");

     $get_post_id = mysqli_insert_id($connection); //this mysqli function grabs the latest ID created and makes the ID of the post just published available to us. We don't have to worry about other types of IDs being grabbed because this fires instantaneously after creating a new post. Nothing in our DB can be more up-to-date. Therefore, only the latest post id can be selected, which is what we want. 
     echo "<p class='bg-success'>New post created successfully! <a href='../post.php?p_id={$get_post_id}'>View your latest creation, </a><a href='posts.php'>View all publications, or <a href='posts.php?source=add_post'>Add More Posts!</a></p>";

	}
?>


<form action="" method="post" enctype="multipart/form-data">

	<div class="form-group">
		<label for="post_title">Post Title </label>
		<input type="text" class="form-control" name="title" required>
	</div>
	<div class="form-group">
		
		<select name="post_category" id="" required>
			<option value="">Post Category</option>
			
<?php

$query = "SELECT * FROM categories";
$select_categories = mysqli_query($connection, $query);
queryConnect($select_categories);
     while ($row = mysqli_fetch_assoc($select_categories )) {
     $cat_id = $row['cat_id'];
     $cat_title = $row['cat_title'];

     echo "<option name='category_update' value='$cat_id'>$cat_title</option>";
 }

?>

		</select>
	</div>

	<!-- <div class="form-group">
		<label for="post_category">Post Category  ID </label>
		<input type="text" class="form-control" name="post_category_id">
	</div> -->

	<div class="form-group">
		<label for="post_author">Post Author </label>
		<input type="text" class="form-control" name="author" required>
	</div>

	<div class="form-group">
		<select name="post_status" required>
			<option value="">Post Status</option>
			<option value="published">Publish</option>
			<option value="draft">Draft</option>
		</select>
	</div>
	<div class="form-group">
		<label for="post_image">Image </label>
		<input type="file" name="image">
	</div>
	<div class="form-group">
		<label for="post_tags">Post Tags </label>
		<input type="text" class="form-control" name="post_tags">
	</div>
	<div class="form-group">
		<label for="post_content">Post Content </label>
		<textarea type="text" class="form-control" name="post_content" id="body" cols="30" rows="10">
		</textarea>
	</div>

	<div class="form-group">
		<input class="btn btn-primary" type="submit" name="create_post" value="Publish Post">
	</div>
</form>