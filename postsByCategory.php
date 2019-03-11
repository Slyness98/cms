<?php include "includes/header.php"; ?>
    <!-- Navigation -->
   
<?php include "includes/navigation.php" ?>
    <!-- Page Content -->
    <?php 
    //fetch the category URL parameter we pass
     if(isset($_GET['category'])){
                $category = $_GET['category'];
            }
                
                //Preload the post information for further usage in the while loop down below
                $query = "SELECT * FROM posts WHERE post_category_id = $category";
                $query_all_posts = mysqli_query($connection,$query);
    
//seperate query for selecting the category title so we can dynamically change the heading title on the fly and match it to the category the user is viewing
    $catQuery= "SELECT * FROM categories WHERE cat_id = $category ";
    $query_cat_title = mysqli_query($connection,$catQuery);
    while ($catRow = mysqli_fetch_assoc($query_cat_title)) {
                 $cat_title = $catRow['cat_title'];
}
    ?>
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
            <h1 class="page-header">
                <?php echo $cat_title ?>
             <small>Secondary Text</small>
            </h1>
            <?php  
           

                while ($row = mysqli_fetch_assoc($query_all_posts)) {
                 $post_id = $row['post_id'];
                 $post_title = $row['post_title'];
                 $post_author = $row['post_author'];
                 $post_date = $row['post_date'];
                 $post_image = $row['post_image'];
                 $post_content = substr($row['post_content'],0,100); //display an excerpt by taking the content and only displaying a substring of the first 100 characters
            ?>
            <!-- Blog Post Structure -->
            <h2>
                <a href="post.php?p_id=<?php echo $post_id;?>"><?php echo $post_title; ?></a>
            </h2>
            <p class="lead">
                by <a href="about.php"> <?php echo $post_author ?> </a>
            </p>
            <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
            <hr>
            <a href="post.php?p_id=<?php echo $post_id?>">
            <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="featured post image"></a>
            <hr>
            <p><?php echo $post_content; ?></p>
            <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

            <hr>
            <?php }  //closes off the while loop querying all post information. The HTML code is now automatically replecated for each new post by being encased in this loop.  ?>
            </div>
        
            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php"; ?>
          </div>
            <!-- /.row -->
 <hr>
<?php include 'includes/footer.php'; ?>
 <!--footer.php includes closing div for <div class="container">. I felt it was better to only have the seemingly unclosed "container" class instance twice (once in search.php and once in index.php) than to open the class at the end of header.php across the entire CMS, should I ever need to change classes of the outermost div for a certain page. It's best to end header.php with the start of the <body> tag.        