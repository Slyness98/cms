<?php

if(isset($_POST['create_user'])) {
 	addUser();
}
?>


<form action="" method="post" enctype="multipart/form-data">

	<div class="form-group">
		<label for="first_name">First Name </label>
		<input type="text" class="form-control" name="user_firstName" required>
	</div>
	<div class="form-group">
		<label for="user_lastName">Last Name</label>
		<input type="text" class="form-control" name="user_lastName" required>
	</div>

	<div class="form-group">
		<select name="user_role">
		  <option value="subscriber">Subscriber</option>
		  <option value="admin">Admin</option>

	   </select>


	

	<div class="form-group">
		<label for="user_username">Username </label>
		<input type="text" class="form-control" name="user_username" required>
	</div>
	<div class="form-group">
		<label for="email">Email </label>
		<input type="email" name="user_email" required="">
	</div>
	<div class="form-group">
		<label for="user_password">Password </label>
		<input type="password" class="form-control" name="user_password" required>
	</div>

	<div class="form-group">
		<input class="btn btn-primary" type="submit" name="create_user" value="Create User">
	</div>
</form>