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
            <small> I Solemnly Swear That I am Up to No Good</small>
        </h1>
       
    </div>
    <!-- col-lg-12 -->
</div>
<!-- /.row -->

      


<!-- .row widgets -->
                
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-text fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
<?php 
echo "<div class='huge'>" . contentCount('posts') . "</div>";
?>
                  
                        <div>Posts</div>
                    </div>
                </div>
            </div>
            <a href="posts.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
<?php 
echo "<div class='huge'>" . contentCount('comments') . "</div>";
?>
                     
                      <div>Comments</div>
                    </div>
                </div>
            </div>
            <a href="comments.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
<?php 
echo "<div class='huge'>" . contentCount('users') . "</div>";
?>
                        <div> Users</div>
                    </div>
                </div>
            </div>
            <a href="users.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-list fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
<?php 
echo "<div class='huge'>" . contentCount('categories') . "</div>";
?>
                         <div>Categories</div>
                    </div>
                </div>
            </div>
            <a href="categories.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
 <!-- /.row  widgets-->

 
     <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Data', 'Count'],
      

<?php
$post_count= contentCount('posts');
$draft_post_count= customContentCount('posts', 'post_status', '\'draft\'');
$published_post_count= customContentCount('posts', 'post_status', '\'published\'');
$category_count= contentCount('categories');   //array variable declarations 
$user_count= contentCount('users');
$comment_count= contentCount('comments'); // contentCount() accepts a table from our DB as a parameter to run a "SELECT * FROM" query through num_rows for a count return. 
$subscriber_count = customContentCount('users','user_role','\'subscriber\'');


// $content_type = ['Active Posts','Categories','Users','Comments'];
// $content_count = [$post_count, $category_count, $user_count, $comment_count];
$content_type = ['All Posts', 'Published Posts', 'Draft Posts', 'Categories','Users','Subscribers','Comments'];
$content_count = [$post_count, $published_post_count, $draft_post_count,  $category_count, $user_count, $subscriber_count, $comment_count];
$arrayLength= sizeof($content_type);

for($i=0; $i<$arrayLength; $i++){
    echo "[ '{$content_type[$i]}', {$content_count[$i]}],";

}

?>
          // ['Posts', 1000]
      
        ]);

        var options = {
          chart: {
            title: 'By The Numbers:',
            subtitle: 'Basic Site Stats Measuring Current Content',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>

     <div id="columnchart_material" style="width: auto; height: 500px; display: block; margin: 0 auto;"></div>


            </div>
            <!-- #page-wrapper-->

        </div>
        <!-- /wrapper -->

<?php include "includes/admin_footer.php"; ?> 