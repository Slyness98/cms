
<?php include "includes/header.php"; ?>
    <!-- Navigation -->
   
<?php include "includes/navigation.php" ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
            <h1 class="page-header">
                Latest Posts
             <small>Secondary Text</small>
            </h1>
            <?php
   //if this php code block is moved to the top of this file after the include statements (where it should be) the sidebar vanishes entirely. Leave this code block here for now as it is behaving as expected, but figure out why this is occuring later.          
$stmt = mysqli_stmt_init($connection);
$published = "published";
$query = "SELECT post_id, post_title, post_author, post_date, post_image, post_content FROM posts WHERE post_status = ? ORDER BY post_id DESC";
mysqli_stmt_prepare($stmt, $query);
mysqli_stmt_bind_param($stmt, 's', $published);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $post_id, $post_title, $post_author, $post_date, $post_image, $post_content);
while(mysqli_stmt_fetch($stmt)):
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
            <p><?php echo substr($post_content,0,150); ?></p>
            <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id;?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

            <hr>
           <?php endwhile;
           mysqli_stmt_close($stmt);
           //closes off the else consition and while loop querying all post information. The HTML code is now automatically replecated for each new post by being encased in this loop. 
             
             ?>
            </div>
        
            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php"; ?>
          </div>
            <!-- /.row -->
 <hr>
<?php include 'includes/footer.php'; ?>
 <!--footer.php includes closing div for <div class="container">. I felt it was better to only have the seemingly unclosed "container" class instance twice (once in search.php and once in index.php) than to open the class at the end of header.php across the entire CMS, should I ever need to change classes of the outermost div for a certain page. It's best to end header.php with the start of the <body> tag.        