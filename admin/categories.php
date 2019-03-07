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
                    
                    <div class="col-xs-6">
                   <!-- Add Category Form -->
<?php addCategory(); ?>
                       <form  action="" method="post">
                        <div class="form-group"> 
                        <label for="cat-title">New Category</label>
                        <input type="text" class="form-control" name="cat_title">
                        </div>
                         <div class="form-group"> 
                            <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                        </div>
                       </form>

<?php 
editCategories();
    //If edit button link in table is clicked, run this function that handles logic for updating that category
    ?>
                   </div>

                 <!-- category table --> 
                   <div class="col-xs-6">

                    <table class="table  table-hover">
                     <thead>
                         <tr>
                             
                        <th>ID</th>
                        <th>Category Title</th>
                         </tr>
                     </thead>
                     <tbody>


<?php displayAllCategories(); //put all categories in a  table with edit and delete links that triggers the other types of queries  ?>
<?php deleteCategories(); //DELETE CATEGORY QUERY ?>
   

                       
                     </tbody>
                    </table>

                   </div>
                   <!-- col-xs-6   category table -->
                    </div>
                    <!-- col-lg-12 -->
                </div>
                <!-- /.row -->

            </div>
            <!-- #page-wrapper -->

        </div>
        <!-- /#wrapper -->


<?php include "includes/admin_footer.php"; ?> 