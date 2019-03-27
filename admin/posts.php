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
                            Welcome, <?php echo $_SESSION['firstname']; ?>. Manage Your Mischief.
                            <small> I Solemnly Swear That I Am Up to No Good</small>
                        </h1>
                    
  <?php 
    if(isset($_GET['source'])) {
        $source = clean($_GET['source']); 
    }else {
        $source = clean('');
    }
    switch($source) {
case 'add_post';
include "includes/addPost.php";
break;
case 'edit_post';
include "includes/editPost.php";
break;
default:
include "includes/viewAllPosts.php";

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