<?php require 'vendor/autoload.php';?>
<?php include "includes/header.php"; ?>
  
<div id="home">   
	<?php include "includes/nav.php"; ?>

	<!-- Start Landing Page Image -->
		<!-- landing, home-wrap, home-inner classes defined in fixed.css. Image defined in custom.css -->




	<div class="landing">   
		<div class="home-wrap">
			<div class="home">
					<div class="home-bg-video">
		                <video id="video" autoplay muted loop>
		                    <source src="images/ip-connect.mp4" type="video/mp4">
		                    Your Browser is not supported!
		                </video>
            		</div>
			
					<div class="typewriter home-content">
						<h1 id="slide"> Our Latest Post</h1>
					</div>

			</div><!--  END .home  -->
		</div><!--END .home-wrap -->
	</div>
<!-- START home section latest post panel -->

<div class="row row-home">	

<?php
// QUERY LATEST BLOG POST
$stmt = mysqli_stmt_init($connection);
$one = 1;
$query = "SELECT post_id, post_title, post_author, cast(post_date as date), post_image, post_content FROM posts ORDER BY post_date DESC LIMIT ?";

mysqli_stmt_prepare($stmt, $query);

mysqli_stmt_bind_param($stmt, 'i', $one);

mysqli_stmt_execute($stmt);

mysqli_stmt_bind_result($stmt, $post_id, $post_title, $post_author, $post_date, $post_image, $post_content);
mysqli_stmt_store_result($stmt);


while(mysqli_stmt_fetch($stmt)):
// $sendQuery = mysqli_query($connection, $query);
// queryConnect($sendQuery);
 
// while($row = mysqli_fetch_assoc($sendQuery)) {
// $post_id = $row['post_id'];
// $post_title = $row['post_title'];
// $post_author = $row['post_author'];
// $post_date = $row['post_date'];
// $post_image = $row['post_image'];
// $post_content = $row['post_content'];
// }
?>	
	<div class="home-card-container home-card-container-panel text-center">	
		<div class="card card-panel card-front text-center os-animation" data-animation="zoomInUp">
		  <div class="card-body">
				<div class="col-12">
					<div class="card-background">
					  <a href="post.php?p_id=<?php echo $post_id;?>">
						<img class="img-responsive img-fluid" src="images/<?php echo $post_image;?>" alt="featured post image"/>
					  </a>
    	            </div>
					
					
					<div class="card-content card-content--front">		
						<h4 class="card-title text-center"><a href="articles/<?php echo $post_id;?>" class="blog-meta-data"><?php echo $post_title; ?></a></h4>
						
						<h5>Published On <?php echo $post_date;?> </h5>

						
					</div><!--END .card-content -->	
				</div>			
			</div>	
		</div><!-- END front card -->
		
		<div class="card card-panel card-back text-center os-animation">
		  <div class="card-body">
		  	<div class="col-12">
		  		<div class="card-background">
		  			  <a href="post.php?p_id=<?php echo $post_id;?>">
						<img class="img-responsive img-fluid" src="images/<?php echo $post_image;?>" alt="featured post image"/>
					  </a>
		  			
		  		</div>


		  		<div class="card-content card-content--back">
					<p class="blog-meta-data card-excerpt"><?php echo substr(file_get_contents($post_content, FILE_USE_INCLUDE_PATH),0,150)."...";?></p>
				    
				    <a class="btn btn-turquoise btn-turquoise--home btn-sm" href="articles/<?php echo $post_id;?>">View <span class="glyphicon glyphicon-chevron-right"></span></a>
				</div>
		    </div>
		  </div>

		</div>
	</div><!-- END card container -->

<?php endwhile; 
  mysqli_stmt_close($stmt);
?>

	<!-- Bouncing Arrow  -->
		<a class="down-arrow" href="#articles">
			<div class="arrow bounce"> <!-- Don't display arrow under 768px. Show only on medium breakpoints and larger. display as block  -->
			   <i class="fas fa-angle-down" aria-hidden="true"></i> <!-- ARIA-HIDDEN disables the bouncing animation for people with screen readers. ARIA attributes help us make our content more accessable and friendly to those with disabilities. -->
			</div>
		</a>

</div> <!-- END row -->

</div> <!-- END HOME SECTION -->


<!-- START ARTICLES SECTION -->
<div id="articles" class="offset">
<div class="jumbotron jumbotron--articles">
	<div class="jumbotron--articles-wrapper">
	<h3 id="paginationReload" class="heading">Recent Articles </h3>
	<div  class="heading-underline"></div>

	<div class="container-fluid content-row">
	  <div class="row narrow justify-content-md-center">
 <?php
     


$postCount = ceil(contentCount("posts")/4);
if (isset($_GET['page'])){
    $page = $_GET['page'];
}else {
    $page = "";
}

if($page == "" || $page == 1){
    $page_1=0; // stands for either unset or first page
} else{
    $page_1 = ($page * 12)-12;
    //else on any other page after the first, get the page we have, multiply that by the twelve entries per page, and subtract twelve posts to get the next batch of concurrent posts. 
}



$stmt = mysqli_stmt_init($connection);

$published = "published";

$limit = 4;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start_from = ($page-1) * $limit;

$query = "SELECT post_id, post_title, post_author, cast(post_date as date), post_update, post_image, post_content FROM posts WHERE post_status = ? ORDER BY post_id DESC LIMIT ?, ?";

mysqli_stmt_prepare($stmt, $query);

mysqli_stmt_bind_param($stmt, 'sii', $published, $start_from , $limit);

mysqli_stmt_execute($stmt);

mysqli_stmt_bind_result($stmt, $post_id, $post_title, $post_author, $post_date, $post_update, $post_image, $post_content);
mysqli_stmt_store_result($stmt);




while(mysqli_stmt_fetch($stmt)):

	

?>
		<div class="col-6 col-sm-6 col-md-6 col-lg-3">
			<div class="os-animation" data-animation="zoomInUp">
				<div class="card-container">
					<div class="card text-center" >
						<!-- <div class="card--img-wrapper bg-light">
						  <a href="post.php?p_id=<?php echo $post_id?>">
							<img class="card-img-top img-responsive img-fluid" src="images/<?php echo $post_image;?>" alt="featured post image" width="400" height="400">
						  </a>
		            	</div> -->
						<div class="card--body" style="background-image: linear-gradient(rgba(20,20,20,.5),rgba(20,20,20,.5)),url(images/<?php echo $post_image;?>);">
								<div class="container-fluid">
										<h4 class="card--title text-center"><a href="post.php?p_id=<?php echo $post_id;?>" class="blog-meta-data"><?php echo $post_title; ?></a>
										</h4>
								</div>


								<div class="container">
									<p class="blog-meta-data card--text card-excerpt"><?php  echo substr(file_get_contents($post_content, FILE_USE_INCLUDE_PATH),0,150)."..."; ?></p>
									<h5 class="card--date">Published On <?php echo $post_date;?> </h5>
								</div> 
								 
								<div class="card-clickable">
								  <a class="btn btn-sm btn-turquoise btn-turquoise--articles" href="articles/<?php echo $post_id;?>">View <span class="glyphicon glyphicon-chevron-right"></span></a>
								</div>
						</div>
						<div class="card--footer">
	     					 <small class="text-muted"><!-- <?php date_default_timezone_set('America/Los_Angeles')?> -->Last updated <?php echo TimeAgo($post_update, date("Y-m-d H:i:s")); ?></small>
	    				</div>
					</div>
				</div>
		</div>
	</div>
<!-- This is where php endWHile was -->

<?php 

endwhile;
  mysqli_stmt_close($stmt);
    //closes off the else consition and while loop querying all post information. The HTML code is now automatically replecated for each new post by being encased in this loop. 
?>
		 <hr>
 <!-- Below is our Pagination system. We calculate the post count with contentCount("posts") and divide it by 12, since we want to limit the posts per page to 12 entries. We make sure we receive an integer by wrapping this calculation in the ceil() function to round it up should we get a float. Whatever that result is, that's how many pages our content is broken up into.   -->
		 <div class="container-fluid pagination justify-content-center">
			<ul class="pager">
				<div class="column">

<?php 
for($i=1;$i<=$postCount;$i++){
    if($i == $page){
        echo "<li class='nav-link paginationLink'><a class='active_link' onclick=";echo "(paginateArticles('index.php?page=$i#paginationReload')) >$i</a></li>";

    }else{
    echo "<li class='nav-link paginationLink'><a onclick=";echo "(paginateArticles('index.php?page=$i#paginationReload'))>$i</a></li>";
    }
}
?>
			  </div>
			</ul>
		  </div>
	    </div><!-- end .row .narrow -->
      </div> <!--END .container-fluid .content-row -->
     </div><!-- END .jumbotron--articles-wrapper-->
   </div><!--END jumbotron--articles  -->
  </div><!-- END jumbotron -->




<div id="resources" class="offset">
	<div class="jumbotron jumbotron--resources">
		<h3 class="heading--secondary">Featured Tools & Resources</h3>
		<div class="heading-underline"></div>

		<div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-ride="carousel" data-interval="10000" data-pause="hover" data-touch="true">
			  <ol class="carousel-indicators">
			    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
			    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
			    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
			  </ol>
			  <div class="carousel-inner" role="listbox">
			    <div class="carousel-item active">
			        <div class="bg-video">
		                <video class="bg-video-content" autoplay muted loop>
		                    <source src="images/lines.mp4" type="video/mp4">
		                    Your Browser is not supported!
		                </video>
            		</div>
	    			<h1 class="carousel-heading"> Plugins & Workflow Essenstials </h1>
	    			<div class="carousel-heading-underline carousel-heading-underline-1"></div>
	    			
	    			 <div class="resources-list">
						
						  <ul class="resources-list-inner">
						  	<div class="col-md-4 resources-list-container">
						  		<?php queryResources(1,1) ?>
							</div>

						
							<div class="col-md-4 resources-list-container">
		                	<?php queryResources(1,2) ?>
							</div>
		                	

							<div class="col-md-4 resources-list-container">
		                		<?php queryResources(1,3); ?>
							</div>
		                  </ul>
	                 </div>				 			
			    </div> -->
		

			    <div class="carousel-item">
			      	<div class="bg-video">
		                <video class="bg-video-content" autoplay muted>
		                    <source src="images/code.mp4" type="video/mp4">
		                    Your Browser is not supported!
		                </video>
            	  	</div> 
	    			<h1 class="carousel-heading"> APIs </h1>
	    			<div class="carousel-heading-underline carousel-heading-underline-3"></div>
		    			 <div class="resources-list">
							  <ul class="resources-list-inner">
							  	<div class="col-md-4 resources-list-container">
				                    <?php queryResources(2,1); ?>
				                 </div>
				                 <div class="col-md-4 resources-list-container">
				               		<?php queryResources(2,2); ?>
				                 </div>
				                 <div class="col-md-4 resources-list-container">
				                    <?php queryResources(2,3); ?>
				                 </div>

			                  </ul>
		                 </div>   
			    </div>
			   

			   

			    <div class="carousel-item">
			        <div class="bg-video">
		                <video class="bg-video-content" autoplay muted loop>
		                    <source src="images/circuits.mp4" type="video/mp4">
		                    Your Browser is not supported!
		                </video>
            		</div>
	    			<h1 class="carousel-heading"> Node.js / NPM </h1>
	    			<div class="carousel-heading-underline carousel-heading-underline-2"></div>
    	    			 <div class="resources-list">
    						  <ul class="resources-list-inner">
    						  	<div class="col-md-4 resources-list-container">
    			                    <?php queryResources(3,1); ?>
    		                    </div>
    		                    <div class="col-md-4 resources-list-container">
    			                    <?php queryResources(3,2); ?>
    		                    </div>
    		                    <div class="col-md-4 resources-list-container">
    			                   <?php queryResources(3,3); ?>
    		                    </div>
    		                  </ul>
    	                 </div>
				</div>
		     </div><!-- END carousel-inner -->
	 </div><!-- END example indicators -->
	</div><!-- END JUMBOTRON -->
</div> <!-- END RESOURCES SECTION -->




<?php include "includes/footer.php"; ?>  