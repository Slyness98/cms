<?php include "includes/header.php"; ?>
    <!-- Navigation -->
   
<?php include "includes/navigation.php" ?>
<?php  
    $query = "SELECT * FROM categories";
    $query_all_categories = mysqli_query($connection,$query);

    while ($row = mysqli_fetch_assoc($query_all_categories)) {
     $cat_id = $row['cat_id'];
     $cat_title = $row['cat_title'];
 }


  ?>
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
            <h1 class="page-header">
                Categories
             <small>Secondary Text</small>
            </h1>
            <?php  
                if(isset($_GET['category'])){
                    $category = $_GET['category'];
                    
                }
              else {
        $category = ' ';
    }
    switch($category) {
case '$category = $cat_id';// We automatically display the homepage or we grab a list of posts all with the same cat ID.
include "postsByCategory.php";
break;
default: 
  include "includes/categoriesHome.php";
break;
}
            ?>
           
          
            
           
           
            </div>
        <hr>
            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php"; ?>
          </div>
            <!-- /.row -->
 <hr>
<?php include 'includes/footer.php'; ?>
 <!--footer.php includes closing div for <div class="container">. I felt it was better to only have the seemingly unclosed "container" class instance twice (once in search.php and once in index.php) than to open the class at the end of header.php across the entire CMS, should I ever need to change classes of the outermost div for a certain page. It's best to end header.php with the start of the <body> tag.        