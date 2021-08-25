<div class="container-fluid">
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
		<?php 
		   $current_file = $_SERVER['PHP_SELF'];  
		   switch($current_file){
		    case "/side_projects/cmsTest/categories.php":
		    include "navigation/homeNav.php";   	
		    break;
		    
		   	case "/side_projects/cmsTest/post.php":
		   	include "navigation/categoryNav.php";  	
		    break;

		    case "/side_projects/cmsTest/postsByCategory.php":
		    include "navigation/categoryNav.php";   	
		    break;
		    
		    case "/side_projects/cmsTest/index.php":
		    include "navigation/homeNav.php";   	
		    break;

		     case "/side_projects/cmsTest/registration.php":
		    include "navigation/homeNav.php";   	
		    break;
		   } 
		?>
	</nav>
</div>