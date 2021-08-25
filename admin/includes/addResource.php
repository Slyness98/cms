<?php
if(isset($_POST['create_resource'])) {
 $resource_name = clean($_POST['name']);
 $resource_url = clean($_POST['url']);
 $resource_description = clean($_POST['description']);
 $resource_slide = clean($_POST['slide']);
 $resource_column = clean($_POST['column']);


     $stmt = mysqli_stmt_init($connection);
     $query = "INSERT INTO resources(resource_name, resource_url, resource_description, resource_slide, resource_column) VALUES(?, ?, ?, ?, ?)";
     mysqli_stmt_prepare($stmt, $query);
     mysqli_stmt_bind_param($stmt, 'sssii', $resource_name, $resource_url, $resource_description, $resource_slide, $resource_column);
     $run = mysqli_stmt_execute($stmt);
     if(!$run){
     	echo "Error creating new resource entry!";
     }else{
     
     echo "<p class='bg-success'>Successfully created new resource entry! <a class='external' href='../index.php#resources'>Take a look, </a><a href='resources.php'>View all resources, or <a href='resources.php?source=addResource'>Add More!</a></p>";
 	  }
 }
?>


<form action="" method="post" enctype="multipart/form-data">

	<div class="form-group">
		<label for="resource_name">Resource Name </label>
		<input type="text" class="form-control" name="name" required>
	</div>

	<div class="form-group">
		<label for="resource_url">URL </label>
		<input type="text" class="form-control" name="url" required>
	</div>

	<div class="form-group">
    <div id="toolbar-container"></div>
		<label for="post_content">Description </label>
		<textarea type="text" class="form-control tinymce" name="description" id="editor" cols="30" rows="10">
		</textarea>
	</div>

	<div class="form-group">
		<label for="resource_slide">Slide Number</label>
		<input type="text" class="form-control" name="slide" required>
	</div>

	<div class="form-group">
		<label for="resource_column">Column Number (1-3)</label>
		<input type="text" class="form-control" name="column" required>
	</div>

	<div class="form-group">
		<input class="btn btn-primary" type="submit" name="create_resource" value="Add Resource">
	</div>
</form>