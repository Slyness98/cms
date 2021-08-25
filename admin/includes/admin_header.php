<?php ob_start(); ?>
<?php session_start(); ?>
<?php 
    include "../includes/db.php";
    include "functions.php";
?>


<?php
// if(isset($_SESSION['role'])) {
// if($_SESSION['role'] == 'subscriber') {

//     header("Location: ../index.php");
// }

// }
if(!is_admin($_SESSION['username'])){
    header("Location: ../index.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>TCC Admin</title>

    <!-- Bootstrap Core CSS -->
   <!--  <link href="css/bootstrap-4.3.1-dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-4.3.1-dist/css/bootstrap-grid.min.css" rel="stylesheet"> -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->


 
</head>

<body>