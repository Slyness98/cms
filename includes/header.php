<?php session_start(); ?>
<?php include "db.php";   ?>
<?php include "admin/functions.php"; ?>
<?php 
if(!isset($_SESSION['isLoggedIn'])){
    $_SESSION['isLoggedIn']=false;
}//if we don't already have it, set it now. 
if($_SESSION['isLoggedIn']===false){
    $_SESSION['role'] = "guest";
    $_SESSION['username'] = "Guest";
    //it's best to set this logic in the header so that we have it on entry to the site, no matter who the user is or if they've visited before
}

//These three header were originally set ONLY in header.php version; i.e. the header used for "/home".
// header('Set-Cookie: cross-site-cookie=_cfduid; SameSite=None; Secure');
// header('Set-Cookie: cross-site-cookie=personalization_id; SameSite=None; Secure');
// header('Set-Cookie: cross-site-cookie=tfw_exp; SameSite=None; Secure');


$current_file = $_SERVER['PHP_SELF'];  
switch($current_file){
case "/side_projects/cmsTest/categories.php":
include "headers/indexHead.php";       
break;    

case "/side_projects/cmsTest/post.php":
include "headers/postHead.php";   
break;

case "/side_projects/cmsTest/index.php":
include "headers/indexHead.php";       
break;

case "/side_projects/cmsTest/postsByCategory.php":
include "headers/postsByCategoryHead.php";       
break;

case "/side_projects/cmsTest/registration.php":
include "headers/registrationHead.php";       
break;
} 
    
?>

