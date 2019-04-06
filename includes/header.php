<?php include "db.php";   ?>
<?php include "admin/functions.php"; ?>

<?php 
  session_start();
  //header("X-XSS-Protection: 1; mode=block");
?>
<?php 
if(!isset($_SESSION['isLoggedIn'])){
    $_SESSION['isLoggedIn']=false;
}//if we don't already have it, set it now. 
if($_SESSION['isLoggedIn']===false){
    $_SESSION['role'] = "guest";
    $_SESSION['username'] = "Guest";
    //it's best to set this logic in the header so that we have it on entry to the site, no matter who the user is or if they've visited before
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>The Contriving Coder</title>
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link href="css/blog-home.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
