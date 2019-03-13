<?php ob_start(); ?>
<?php include "includes/admin_header.php"; ?>

    <div id="wrapper">


        <div id="page-wrapper">
<!-- Navigation -->
 <?php include "includes/admin_navigation.php"; ?>

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome, Admin. Manage Your Mischief.
                            <small> I Solemnly Swear That I am Up to No Good</small>
                        </h1>
                    
  <?php 
    if(isset($_GET['source'])) {
        $source = $_GET['source'];
    }else {
        $source = '';
    }
    switch($source) {
case 'add_post';
include "includes/addPost.php";
break;
case 'edit_post';
include "includes/edit.php";
break; 
default:
include "includes/viewAllComments.php";

break;
    }
  ?>                  


                    
                        
                </table>
                  
                    </div>
                    <!-- col-lg-12 -->
                </div>
                <!-- /.row -->

        </div>
    <!-- #page-wrapper -->

    </div>
<!-- /#wrapper -->


<?php include "includes/admin_footer.php"; ?> 