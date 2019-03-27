 <?php ob_start(); ?>
<?php include "includes/header.php"; ?>
<?php 
if(isset($_SESSION['username'])) {
	$username = $_SESSION['username'];

	$query = "SELECT * FROM users WHERE user_username = '{$username}' ";
	$profile_query = mysqli_query($connection, $query);
	while($row = mysqli_fetch_assoc($profile_query)) {
		$user_id = $row['user_id'];
	     $user_firstName = $row['user_firstName'];
	     $user_lastName = $row['user_lastName'];
	     $user_username = $row['user_username'];
	     $user_password = $row['user_password'];
	    
	     $user_email = $row['user_email'];
	     $user_role = $row['user_role'];
	}
}


if(isset($_POST['update_profile'])) {
	 $user_firstName = mysqli_real_escape_string($connection, $_POST['user_firstName']);
 $user_lastName = mysqli_real_escape_string($connection, $_POST['user_lastName']);
 $user_username = mysqli_real_escape_string($connection, $_POST['user_username']);
 $user_email = mysqli_real_escape_string($connection, $_POST['user_email']);
 $user_role = $_POST['user_role'];
    

     $query = "UPDATE users SET ";
     $query .="user_firstName = '{$user_firstName}', ";
     $query .="user_lastName = '{$user_lastName}', ";
     $query .="user_username = '{$user_username}', ";
     $query .="user_password = '{$user_password}', ";
     $query .="user_email = '{$user_email}', ";
     $query .="user_role = '{$user_role}' ";
     $query .="WHERE user_username = '{$username}' ";

     $updateUser = mysqli_query($connection, $query);
     queryConnect($updateUser);
     $_SESSION['username'] = $user_username;
	$_SESSION['firstname'] = $user_firstName;
	$_SESSION['lastname'] = $user_lastName;
	$_SESSION['email'] = $user_email;
	header("Location: profileSubscriber.php");
     echo "<p class='bg-success'>Profile Updated. <a href='profileSubscriber.php'>Back to Your Profile Dash</a></p>";


  }
?>
 <div id="wrapper">


        <div id="page-wrapper">
<!-- Navigation -->
 <?php include "includes/navigation.php"; ?>

                <!-- Page Heading -->
                <div class="row" >
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            <?php echo $_SESSION['firstname']; ?>'s Profile.
                            <small> </small>
                        </h1>


<form action="profileSubscriber.php" method="post" enctype="multipart/form-data">

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
		<input class="btn btn-primary" type="submit" name="update_profile" value="Update Profile">
	</div>
</form>

 </table>
                  
                    </div>
                    <!-- col-lg-12 -->
                </div>
                <!-- /.row -->

        </div>
    <!-- #page-wrapper -->

    </div>
<!-- /#wrapper -->




<?php include "includes/footer.php"; ?> 