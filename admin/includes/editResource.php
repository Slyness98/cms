<?php
if(isset($_GET['resource_id'])) {
$get_resource_id = clean($_GET['resource_id']);

$query = "SELECT resource_id, resource_name, resource_url, resource_description, resource_slide, resource_column FROM resources WHERE resource_id = ?";
 $stmt = mysqli_stmt_init($connection);
 mysqli_stmt_prepare($stmt, $query);
 mysqli_stmt_bind_param($stmt, 'i', $get_resource_id);
 mysqli_stmt_execute($stmt);
 mysqli_stmt_bind_result($stmt, $resource_id, $resource_name, $resource_url, $resource_description, $resource_slide, $resource_column);
 mysqli_stmt_fetch($stmt);
 mysqli_stmt_close($stmt);
 

	if(isset($_POST['update_resource'])) {
		updateResource();
	}
}else {
	echo "Error querying resource. Check your DB connection and make sure the resource with the ID you are querying exists.";
}
?>

<form action="" method="post" enctype="multipart/form-data">

	<div class="form-group">
		<label for="resource_id">ID </label>
		<input value="<?php echo $resource_id; ?>" type="text" class="form-control" name="resource_id">
	</div>

	<form action="" method="post" enctype="multipart/form-data">

	<div class="form-group">
		<label for="resource_name">Name </label>
		<input value="<?php echo $resource_name; ?>" type="text" class="form-control" name="resource_name">
	</div>

	<div class="form-group">
		<label for="resource_url">URL </label>
		<input value="<?php echo $resource_url; ?>" type="text" class="form-control" name="resource_url">
	</div>

	<div class="form-group">
    <div id="toolbar-container"></div>
		<label for="resource_description">Description </label>
		<textarea type="text" class="form-control tinymce" name="resource_description" id="editor" cols="30" rows="10"><?php echo $resource_description; ?>
		</textarea>
	</div>

	<div class="form-group">
	<label for="resource_slide">Slide </label>
	<input value="<?php echo $resource_slide; ?>" type="text" class="form-control" name="resource_slide">
	</div>

	<div class="form-group">
	<label for="resource_co,umn">Column </label>
	<input value="<?php echo $resource_column; ?>" type="text" class="form-control" name="resource_column">
	</div>

	<div class="form-group">
		<input class="btn btn-primary" type="submit" name="update_resource" value="Update Resource">
	</div>