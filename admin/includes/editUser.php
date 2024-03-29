<?php
if(isset($_GET['u_id'])) {
$get_user_id = clean($_GET['u_id']);
}
 // $query = "SELECT user_id, user_firstName, user_lastName, user_username, user_password, user_email, user_role FROM users WHERE user_id = $get_user_id";
 //   $select_users_by_id = mysqli_query($connection, $query);
 //     while ($row = mysqli_fetch_assoc($select_users_by_id)) {
 $query = "SELECT user_id, user_firstName, user_lastName, user_username, user_password, user_email, user_role FROM users WHERE user_id = ?";
 $stmt = mysqli_stmt_init($connection);
 mysqli_stmt_prepare($stmt, $query);
 mysqli_stmt_bind_param($stmt, 'i', $get_user_id);
 mysqli_stmt_execute($stmt);
 mysqli_stmt_bind_result($stmt, $user_id, $user_firstName, $user_lastName, $user_username, $user_password, $user_email, $user_role);
 mysqli_stmt_fetch($stmt);
 mysqli_stmt_close($stmt);


if(isset($_POST['update_user'])) {
updateUser();
}
?>


<form action="" method="post" enctype="multipart/form-data">

	<div class="form-group">
		<label for="user_id">User_id </label>
		<input value="<?php echo $user_id; ?>" type="text" class="form-control" name="user_id">
	</div>
     <div class="form-group">
          <label>Role:</label>
          <select name="user_role" id="">
               

     <option name='user_role' value='subscriber'>Subscriber</option>;
     <option name='user_role' value='admin'>Admin</option>;
     
 

          </select>
     </div>

	<div class="form-group">
		<label for="user_firstName">First Name </label>
		<input value="<?php echo $user_firstName; ?>" type="text" class="form-control" name="user_firstName" required>
	</div>

	<div class="form-group">
		<label for="user_lastName">Last Name </label>
		<input value="<?php echo $user_lastName; ?>" type="text" class="form-control" name="user_lastName" required>
	</div>

	<div class="form-group">
		<label for="user_username">Username </label>
		<input value="<?php echo $user_username; ?>" type="text" class="form-control" name="user_username" required>
	</div>
	<div class="form-group">
		<label for="user_password">Password </label>
		<input value="<?php echo $user_password; ?>" type="Password" class="form-control" name="user_password" required>
	</div>
	<!-- <div class="form-group">
		<label for="post_image">Image </label>
		<img src="../images/<?php echo $post_image;?>" alt="featured post image" width=175/>
		<input type="file" value="select image" name="post_image"> </input>
	</div> -->
	<div class="form-group">
		<label for="user_email">Email </label>
		<input value="<?php echo $user_email; ?>" type="Email" class="form-control" name="user_email" required>
	</div>

	<div class="form-group">
		<input class="btn btn-primary" type="submit" name="update_user" value="Update User">
	</div>
</form>