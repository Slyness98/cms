<?php include "includes/header.php"; ?>
    <!-- Navigation -->
   
<?php include "includes/navigation.php" ?>
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
            <h1 class="page-header"> Results</h1>

    <?php
    if(isset($_POST['submit'])){
     $search = $_POST['search'];

     $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%'"; //find posts containing or relating to inputed search phrase

     $search_query = mysqli_query($connection, $query);
     if(!$search_query) {
        die("Query Failed" . mysqli_error($connection));
     }                                                                //if the connection fails, kill the query

     $count = mysqli_num_rows($search_query);           //if you do receive a connection, start a count of rows matching our query

     if($count == 0) {
        echo "<h1> NO RESULT </h1>";                      
     }else{
         

                while ($row = mysqli_fetch_assoc($search_query)) {
                 $post_title = $row['post_title'];
                 $post_author = $row['post_author'];
                 $post_date = $row['post_date'];
                 $post_image = $row['post_image'];
                 $post_content = $row['post_content'];
    
    ?>    <!-- Blog Post Structure -->
            <h2>
                <a href="#"><?php echo $post_title; ?></a>
            </h2>
            <p class="lead">
                by <a href="about.php"> <?php echo $post_author ?> </a>
            </p>
            <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
            <hr>
            <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="featured post image">
            <hr>
            <p><?php echo $post_content; ?></p>
            <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

            <hr>
    <?php 
                } //closes off the while loop querying all post information. The HTML code is now automatically replecated for each relevant search result by being encased in this loop.
            } // close else condition
    } //close if statement
    ?>

            </div>
        <!-- /.col-md-8 -->
<!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php"; ?>
        </div>
     <!-- /.row -->


    <hr>
<?php include 'includes/footer.php'; ?>
<!--footer.php includes closing div for <div class="container">. I felt it was better to only have the seemingly unclosed "container" class instance twice (once in search.php and once in index.php) than to include it at the end of header.php across the entire CMS, should I ever need to change classes of the outermost div for a certain page. It's best to end header.php with the start of the <body> tag.       