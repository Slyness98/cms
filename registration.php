<?php  include "includes/header.php"; ?> 
<?php  include "includes/nav.php"; ?>

<?php
if(isset($_POST['submit'])){



$matchUsername = clean($_POST['username']);
$firstName = clean($_POST['firstName']);
$lastName = clean($_POST['lastName']);
$matchEmail    = clean($_POST['email']);
$password = clean($_POST['password']);


$stmt = mysqli_stmt_init($connection);
$query = "SELECT user_username, user_email FROM users WHERE user_username = ? OR user_email = ?";
mysqli_stmt_prepare($stmt, $query);
mysqli_stmt_bind_param($stmt, 'ss', $matchUsername, $matchEmail);
mysqli_stmt_execute($stmt);
// mysqli_stmt_bind_result($stmt, $matchUsername, $matchEmail);
mysqli_stmt_store_result($stmt);
// mysqli_stmt_fetch($stmt);
if($stmt->num_rows > 0){
 echo"<p class='bg-danger'>Sorry, that username and/or email have been taken</p>";
}else{
   
  
$password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));

$query="INSERT INTO users (user_username, user_firstName, user_lastName, user_email, user_password, user_role) VALUES (?, ?, ?, ?, ?, ?)";
$subscriber = "subscriber";
 $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, 'ssssss', $username, $firstName, $lastName, $email, $password, $subscriber);
    $run = mysqli_stmt_execute($stmt);
    queryConnect($run);
    mysqli_stmt_close($stmt);
     if($run){
    $_SESSION['username'] = $username;
    $_SESSION['password'] = $password;
    $_SESSION['firstname'] = $firstName;
    $_SESSION['lastname'] = $lastName;
    $_SESSION['email']= $email;
    $_SESSION['role'] = $subscriber; //We're assigning a SESSION variable to a new record. We must explicitely give their role to the SESSION for this first time login

        echo "<p class='bg-success text-center'>Welcome to the community, {$username}!. <a href='profileSubscriber.php'> View your profile </a>, or get back to the content and <a href='index.php'> view our latest posts </a></p>";
    }else{
         echo "<p class='bg-danger'>Uh, oh! Sorry, but your registration did not process. Make sure all fields are filled out and that the email field follows the correct format, 'someemailaddress@example.com'.</p>";
    }

  }
}





?>    
 
    <!-- Page Content -->   
<section id="register" class="offset">
	 <div class="row row-registration">
	 	
            <div class="col-xs-12 col-sm-3 col-md-4 col-lg-12 row-background">
              <div class="jumbotron jumbotron-registration">
              	<div class="jumbotron-registration-gradient">
              	<h1  class="heading heading--registration">Register</h1>
	                <div class="heading-underline heading-underline--registration"></div>
    			<div class="registration">
	                <div class="form-wrap">
	                    <form role="form" action="registration.php" method="post" id="login-form" class="form-registration" autocomplete="off">
	                        <div class="form-group form-group--registration">
	                            <label for="username" class="sr-only">username</label>
	                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username" autocomplete="off" required>
	                        </div>
	                         <div class="form-group form-group--registration">
	                            <label for="firstName" class="sr-only">First Name</label>
	                            <input type="text" name="firstName" id="firstName" class="form-control" placeholder="First Name" autocomplete="off" required>
	                        </div>
	                        <div class="form-group form-group--registration">
	                            <label for="lastName" class="sr-only">Last Name</label>
	                            <input type="text" name="lastName" id="lastName" class="form-control" placeholder="Last Name" autocomplete="off" required>
	                        </div>
	                         <div class="form-group form-group--registration">
	                            <label for="email" class="sr-only">Email</label>
	                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com" autocomplete="off" required>
	                        </div>
	                         <div class="form-group form-group--registration">
	                            <label for="password" class="sr-only">Password</label>
	                            <input type="password" name="password" id="key" class="form-control" placeholder="Password" required>
	                        </div>
	                
	                        <input type="submit" name="submit" id="btn-login" class="btn btn-turquoise btn-turquoise--register btn-sm " value="Register">
	                    </form> 
	                </div><!-- END form-wrap -->
            </div> <!-- /.registration -->
        </div>
           </div><!-- END jumbotron -->
        </div><!-- /.col-xs-12 -->

    </div>  <!-- /.row -->
</section>

<?php include "includes/footer.php";?>
