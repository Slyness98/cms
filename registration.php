<?php  include "includes/header.php"; ?>
<?php  include "includes/navigation.php"; ?>

<?php
if(isset($_POST['submit'])){

$username = clean($_POST['username']);
$firstName = clean($_POST['firstName']);
$lastName = clean($_POST['lastName']);
$email    = clean($_POST['email']);
$password = clean($_POST['password']);


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





?>    
 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
                        </div>
                         <div class="form-group">
                            <label for="firstName" class="sr-only">First Name</label>
                            <input type="text" name="firstName" id="firstName" class="form-control" placeholder="First Name" required>
                        </div>
                        <div class="form-group">
                            <label for="lastName" class="sr-only">Last Name</label>
                            <input type="text" name="lastName" id="lastName" class="form-control" placeholder="Last Name" required>
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
