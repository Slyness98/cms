<?php ob_start(); ?>
<?php include "includes/admin_header.php"; ?>

    <div id="wrapper">


        <div id="page-wrapper">
<!-- Navigation -->
 <?php include "includes/admin_navigation.php"; ?>

                <!-- Page Heading -->
                 <h1 class="page-header">
                            Welcome, <?php echo $_SESSION['firstname']; ?>. Manage Your Mischief.
                            <small> I Solemnly Swear That I Am Up to No Good</small>
                        </h1>
                <div class="row">
                    <div class="col-lg-12">
                       
                    
  <?php 
    if(isset($_GET['source'])) {
        $source = $_GET['source'];
    }else {
        $source = '';
    }
    switch($source) {
case 'addUser';
include "includes/addUser.php";
break;
case 'editUser';
include "includes/editUser.php";
break;
default: 
  include "includes/viewAllUsers.php";
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