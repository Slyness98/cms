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
                        <label for="cat-title">New Category</label>
                    
                    <!-- Add Category Form -->
<?php
if(isset($_POST['submit'])) {
$cat_title = $_POST['cat_title'];
if($cat_title == "" || empty($cat_title)) {
    echo "This field should not be empty";
}else{
    $query = "INSERT INTO categories(cat_title)";
    $query .= "VALUES('{$cat_title}')";

    $create_category_query = mysqli_query($connection, $query);

    if(!$create_category_query){
        die('QUERY FAILED' . mysqli_error($connection));
    }
}

}
 ?>
                       <form  action="" method="post">
                        <div class="form-group"> 
                        
                         <div class="form-group"> 
                            <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                        </div>
                       </form>

<?php if(isset($_GET['edit'])){
    $cat_id = $_GET['edit'];
    include "includes/update_categories.php";
    } ?>
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
<?php 

// FIND ALL CATEGORIES QUERY AND DISPLAY IN TABLE 
$query = "SELECT * FROM categories";
$select_categories = mysqli_query($connection,$query);
     while ($row = mysqli_fetch_assoc($select_categories )) {
     $cat_id = $row['cat_id'];
     $cat_title = $row['cat_title'];
     echo "<tr>";
     echo "<td>{$cat_id}</td>";
     echo "<td>{$cat_title}</td>";
     echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";//Link to create a Query generated via GET to delete a category by ID
     echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
     echo "</tr>";
    }
 ?>

 <?php
 //DELETE CATEGORY QUERY
if(isset($_GET['delete'])){
 $get_cat_id = $_GET['delete'];
 $query = "DELETE FROM categories WHERE cat_id = {$get_cat_id}";
 $delete_query = mysqli_query($connection, $query);
 header("Location: categories.php");
}
 ?>
                       
                     </tbody>
                    </table>

                   </div>
                   <!-- col-xs-6   category table -->
                    </div>
                    <!-- col-lg-12 -->
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->


<?php include "includes/admin_footer.php"; ?> 