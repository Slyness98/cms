<!-- Footer -->

    <?php 
       $current_file = $_SERVER['PHP_SELF'];  
       switch($current_file){
        case "/side_projects/cmsTest/index.php":
        include "footers/indexFooter.php";   
        break;

        case "/side_projects/cmsTest/post.php":
        include "footers/postFooter.php";   
        break;

        case "/side_projects/cmsTest/postsByCategory.php":
        include "footers/postFooter.php";   
        break;

        case "/side_projects/cmsTest/registration.php":
        include "footers/indexFooter.php";   
        break;
       } 
    ?>
   