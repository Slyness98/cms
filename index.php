
<?php include "includes/header.php"; ?>
    <!-- Navigation -->
   
<?php include "includes/navigation.php" ?>

    <!-- Page Content -->
    <div class="container-fluid index-container">
       <!--  <div class="container"> -->

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
            <h1 class="page-header">
                Latest Posts
            </h1>
            <?php
   //if this php code block is moved to the top of this file after the include statements (where it should be) the sidebar vanishes entirely. Leave this code block here for now as it is behaving as expected, but figure out why this is occuring later.    

//
$postCount = ceil(contentCount("posts")/5);
if (isset($_GET['page'])){
    $page = $_GET['page'];
}else {
    $page = "";
}

if($page == "" || $page == 1){
    $page_1=0; // stands for either unset or first page
} else{
    $page_1 = ($page * 5)-5;
    //else on any other page after the first, get the page we have, multiply that by the five entries per page, and subtract five posts to get the next batch of concurrent posts. 
}



$stmt = mysqli_stmt_init($connection);
$published = "published";
$five = 5;

$query = "SELECT post_id, post_title, post_author, post_date, post_image, post_content FROM posts WHERE post_status = ? LIMIT ?,?";
mysqli_stmt_prepare($stmt, $query);
mysqli_stmt_bind_param($stmt, 'sii', $published, $page_1, $five);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $post_id, $post_title, $post_author, $post_date, $post_image, $post_content);
while(mysqli_stmt_fetch($stmt)):
?>
            <!-- Blog Post Structure -->
           <!-- <h1><?php echo $page ?></h1> -->
            <h2>
               <a href="post.php?p_id=<?php echo $post_id;?>" class="blog-meta-data"><?php echo $post_title; ?></a>
            </h2>
            <p class="lead blog-meta-data">
                by <a class="blog-meta-data" href="about.php"> <?php echo $post_author ?> </a>
            </p>
            <p class="blog-meta-data"><span class="glyphicon glyphicon-time blog-meta-data"></span> Posted on <?php echo $post_date; ?></p>
            <hr>
            <a href="post.php?p_id=<?php echo $post_id?>">
            <img class="img-responsive" src="images/<?php echo $post_image;?>" alt="featured post image" width="400" height="400"></a>
            <hr>
            <p class="blog-meta-data"><?php echo substr($post_content,0,150); ?></p>
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
 <!-- This is our Pagination system. We calculate the post count with contentCount("posts") and divide it by 5, since we want to limit the posts per page to five entries. We make sure we receive an integer by wrapping this calculation in the ceil() function to round it up should we get a float. Whatever that result is, that's how many pages our content is broken up into.   -->
 <div class="container-fluid indexPagination">
 <ul class="pager">

<?php
for($i=1;$i<=$postCount;$i++){
    if($i == $page){
        echo "<li><a class='active_link' href='index.php?page={$i}'>{$i}</a></li>";

    }else{
    echo "<li><a href='index.php?page={$i}'>{$i}</a></li>";
    }
}

?>

</ul>
</div>
</div>

<?php include 'includes/footer.php'; ?>
<!-- </div> -->
 <!--footer.php includes closing div for <div class="container">. I felt it was better to only have the seemingly unclosed "container" class instance twice (once in search.php and once in index.php) than to open the class at the end of header.php across the entire CMS, should I ever need to change classes of the outermost div for a certain page. It's best to end header.php with the start of the <body> tag.        