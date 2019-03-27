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

$query = "SELECT * FROM users WHERE user_username = '{$username}' ";
$select_user_query = mysqli_query($connection, $query);
queryConnect($select_user_query);
while($row = mysqli_fetch_assoc($select_user_query)) {
	$user_id = $row['user_id'];
	$user_username = $row['user_username'];
	$user_password = $row['user_password'];
	$user_firstName = $row['user_firstName'];
	$user_lastName = $row['user_lastName'];
	$user_role = $row['user_role'];
}
// $salt='$2y$10$38ZXqVh68gKdqiKhBoHBBa';
// $password = crypt($password, $salt);

// if($username !== $user_username && $password !== $user_password){
// 	header("Location: ../index.php");
// } elseif ($username == $user_username && $password == $user_password) {
if (password_verify($password, $user_password)) {
	$_SESSION['username'] = $user_username;
	$_SESSION['firstname'] = $user_firstName;
	$_SESSION['lastname'] = $user_lastName;
	$_SESSION['role'] = $user_role;
	header("Location: ../admin");
}else{
	header("Location: ../index.php");
}


}






?> 