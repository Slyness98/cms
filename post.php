<?php include "includes/header.php"; ?>
    <!-- Navigation -->
   
<?php include "includes/navigation.php"; ?>
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
        <?php 
        if(isset($_GET['p_id'])){
        $post_id = clean($_GET['p_id']);  
        }
        

        
                
                // $query = "SELECT * FROM posts WHERE post_id = $post_id";

                // $query_all_posts = mysqli_query($connection, $query);

                // while ($row = mysqli_fetch_assoc($query_all_posts)) {
                //  $post_title = $row['post_title'];
                //  $post_author = $row['post_author'];
                //  $post_date = $row['post_date'];
                //  $post_image = $row['post_image'];
                //  $post_content = $row['post_content'];
            $query = "SELECT post_id, post_author, post_title, post_category_id, post_status, post_image, post_tags, post_content, post_comment_count, post_date FROM posts WHERE post_id = ?";
            $stmt = mysqli_stmt_init($connection);
            mysqli_stmt_prepare($stmt, $query);
            mysqli_stmt_bind_param($stmt, 'i', $post_id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $post_id, $post_author, $post_title, $post_category_id, $post_status, $post_image, $post_tags, $post_content, $post_comment_count, $post_date);
            mysqli_stmt_store_result($stmt);

              while(mysqli_stmt_fetch($stmt)){
            ?>
              <h1 class="page-header">
                Latest Posts
             <small>Secondary Text</small>
            </h1>
            <!-- Blog Post Structure -->
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
            

            <hr>
            <?php }  //closes off the while loop querying all post information. The HTML code is now automatically replecated for each new post by being encased in this loop.?>
            </div>
        
            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php"; ?>
          </div>
            <!-- /.row -->
 <hr>




<?php 
if(isset($_POST['create_comment'])){
  $comment_author = clean($_POST['comment_author']);
    $comment_email = clean($_POST['comment_email']);
    $comment_content = clean($_POST['comment_content']);

  if(!empty($comment_author)&&!empty($comment_email)&&!empty($comment_content)){
    // $query = "INSERT INTO comments(comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date)" ;

    // $query .= "VALUES('{$post_id}', '{$comment_author}', '{$comment_email}', '{$comment_content}', 'blocked', now())";

    // $createCommentQuery = mysqli_query($connection, $query);
    // queryConnect($createCommentQuery);
    $blocked = 'blocked';
    date_default_timezone_set('America/Los_Angeles');
     $now = date('Y-m-d');
     $query = "INSERT INTO comments(comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) VALUES(?,?,?,?,?,?)" ;
     $stmt = mysqli_stmt_init($connection);
     mysqli_stmt_prepare($stmt, $query);
     mysqli_stmt_bind_param($stmt, 'isssss', $post_id, $comment_author, $comment_email, $comment_content, $blocked, $now);
     mysqli_stmt_execute($stmt);
     mysqli_stmt_close($stmt);
      


    //$countQuery ="UPDATE posts SET post_comment_count = post_comment_count + 1 WHERE post_id = $post_id";

     // $updateCommentCount = mysqli_query($connection,$countQuery);
     $countQuery ="UPDATE posts SET post_comment_count = post_comment_count + 1 WHERE post_id = ?";
     $stmt = mysqli_stmt_init($connection);
     mysqli_stmt_prepare($stmt, $countQuery);
     mysqli_stmt_bind_param($stmt, 'i', $post_id);
     mysqli_stmt_execute($stmt);
     mysqli_stmt_close($stmt);

  }else{
    echo "<script>alert('All fields required. Please fill out all fields.')</script>";
  }
}

?>
         <!-- comment form -->
            <div class="well">
            <form action="" method="post" role="form">
                <h4>We'd love to hear from you! Drop a comment!</h4>
              <div class="form-group">
              <label for="author">Author</label>
              <input type="text" class="form-control" name="comment_author" placeholder="Your username">
              </div>

              <div class="form-group">
              <label for="email">Email</label>
              <input type="email" class="form-control" name="comment_email" placeholder="youremail@example.com">
              </div>

              <div class="form-group">
              <label>Your Comment</label>
              <textarea class="form-control" rows="5" name="comment_content"></textarea>
              </div>
              

              <div class="form-group">
              <button type="submit" class="btn btn-primary" name="create_comment">Submit</button>
              </div>
            
            </form>
            </div>
         <br>

         <!-- Start of existing comment forum -->
         <?php
         // $query = "SELECT * FROM comments WHERE comment_post_id = {$post_id} ";
         // $query .= "AND comment_status = 'approved' ";
         // $query .= "ORDER BY comment_id DESC ";
         // $select_comment_query = mysqli_query($connection , $query);
         $approved = 'approved';
         $query = "SELECT comment_author, comment_content, comment_date FROM comments WHERE comment_post_id = ? AND comment_status = ? ORDER BY comment_id DESC";
         $stmt = mysqli_stmt_init($connection);
          mysqli_stmt_prepare($stmt, $query);
          mysqli_stmt_bind_param($stmt, 'is', $post_id, $approved);
          mysqli_stmt_execute($stmt);
           if(!$stmt){
            die('QUERY FAILED' . mysqli_error($connection));
         }
          mysqli_stmt_bind_result($stmt, $comment_author, $comment_content, $comment_date);
          mysqli_stmt_store_result($stmt);
          
        
         while (mysqli_stmt_fetch($stmt)) {
            
        ?>
        

            <div class="media">
                            <a class="pull-left" href="#">
                                <img class="media-object" src="http://placehold.it/64x64" alt="">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading"><?php echo $comment_author;?>
                                    <small><?php echo $comment_date;?></small>
                                </h4>
                                <?php echo $comment_content;?>
                            </div>
                        </div>


        <?php 
          }
          mysqli_stmt_close($stmt);  
        ?>

                <!-- Comment -->
               
                        <!-- Nested Comment -->
                        <div class="media">
                            <a class="pull-left" href="#">
                                <img class="media-object" src="http://placehold.it/64x64" alt="">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading">Nested Start Bootstrap
                                    <small>August 25, 2014 at 9:30 PM</small>
                                </h4>
                                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                            </div>
                        </div>
                        <!-- End Nested Comment -->
                    </div>
                
<?php include 'includes/footer.php'; ?>
 <!--footer.php includes closing div for <div class="container">. I felt it was better to only have the seemingly unclosed "container" class instance twice (once in search.php and once in index.php) than to open the class at the end of header.php across the entire CMS, should I ever need to change classes of the outermost div for a certain page. It's best to end header.php with the start of the <body> tag.        