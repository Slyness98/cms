<?php include "db.php"; ?>
<?php include "../admin/functions.php"; ?>
<?php session_start(); ?>
<?php
if (isset($_POST['login'])){

$username = $_POST['username'];
$password = $_POST['password'];

//run username and password throught real escape function to clean input and ready it for data insertion. The function helps prevent SQL injection through fields that take in user input
$username = clean($username);
$password = clean($password);

// $query = "SELECT * FROM users WHERE user_username = '{$username}' ";
// $select_user_query = mysqli_query($connection, $query);
// queryConnect($select_user_query);
// while($row = mysqli_fetch_assoc($select_user_query)) {
// 	$user_id = $row['user_id'];
// 	$user_username = $row['user_username'];
// 	$user_password = $row['user_password'];
// 	$user_firstName = $row['user_firstName'];
// 	$user_lastName = $row['user_lastName'];
// 	$user_role = $row['user_role'];
// }
$query = "SELECT user_username, user_password, user_firstName, user_lastName, user_role FROM users WHERE user_username = ?";
$stmt = mysqli_stmt_init($connection);

mysqli_stmt_prepare($stmt, $query);
mysqli_stmt_bind_param($stmt, 's', $username);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $user_username, $user_password, $user_firstName, $user_lastName, $user_role);
mysqli_stmt_store_result($stmt);
mysqli_stmt_fetch($stmt);
mysqli_stmt_close($stmt);



if (password_verify($password, $user_password)) {
	$_SESSION['username'] = $user_username;
	$_SESSION['firstname'] = $user_firstName;
	$_SESSION['lastname'] = $user_lastName;
	$_SESSION['role'] = $user_role;
	$_SESSION['isLoggedIn'] = true; //useful for having an unlinked ('unbiased', if you will) parameter checking whether the user interacting with our site even has an account or not. If not, or if the user is not yet logged in, they will be treated as a guest. This was brought about by necessity to fix the error of conditional post viewing based upon post status and whom the user is and what their role is. The logic worked for users and admins, but not if you weren't logged in at all. Instead an undefined reference error to the session username used as the is_admin() parameter in the postsByCategory isset logic was thrown. No other option was available without conflicting with both login and sidebar widget functionalities. 
	header("Location: ../admin");
}else{
	header("Location: ../index.php");
}


}






?> 