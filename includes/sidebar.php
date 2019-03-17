

 <div class="col-md-4">

    <?php 
    if(!isset($_SESSION['username'])){
        echo "
            <div class='well'>
            <h4>Login</h4>
            <form action='includes/login.php' method='post'>
            <div class='form-group'>
                <input name='username' type='text' class='form-control' placeholder='username'>
            </div>
            <div class='input-group'>
                <input name='password' type='password' class='form-control' placeholder='password'>
                <span class='input-group-btn'>
                    <button class='btn btn-primary' name='login' type='submit'>Login</button>
                </span>
            </div>
            </div>
            <!-- /.input-group -->
        </form><!-- search from -->
        ";
    }elseif (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
        echo "
        <div class='well'
        <h4>Your Account</h4>
        <ul class='nav navbar-right top-nav'>
         <li class='dropdown'>
                    <a href='#'' class='dropdown-toggle' data-toggle='dropdown'><i class='fa fa-user'></i> $username <b class='caret'></b></a>
                    <ul class='dropdown-menu'>
                        <li>
                            <a href='#'><i class='fa fa-fw fa-user'></i> Profile</a>
                        </li>
                     
                        <li class='divider'></li>
                        <li>
                            <a href='includes/logout.php'><i class='fa fa-fw fa-power-off'></i> Log Out</a>
                        </li>
                    </ul>
                </li>
                </ul>
            </div>";
    }
    ?>

	    <!--Submit-- Blog Search Well -->
	    <div class="well">
	        <h4>Blog Search</h4>
	        <form action="search.php" method="post">
	        <div class="input-group">
	            <input name="search" type="text" class="form-control">
	            <span class="input-group-btn">
	                <button name="submit" class="btn btn-default" type="submit">
	                    <span class="glyphicon glyphicon-search"></span>
	            </button>
	            </span>
	        </div>
	        <!-- /.input-group -->
	    </form><!-- search from -->
	    </div>

	     <!-- Blog Categories Well -->
<?php
 $query = "SELECT * FROM categories";
    $select_all = mysqli_query($connection,$query);
?>
               
        <div class="well">
            <h4>Blog Categories</h4>
            <div class="row">
                <div class="col-lg-12">
                    <ul class="list-unstyled">

 <?php  
 	 while ($row = mysqli_fetch_assoc($select_all)) {
     $cat_title = $row['cat_title'];
     $cat_id = $row['cat_id'];
     echo "<li name='category'><a href='postsByCategory.php?category=$cat_id'>{$cat_title}</a></li>";

    }
 ?>
                             
                    </ul>
                </div>
                <!-- /.col-lg-12 -->
          
            </div>
            <!-- /.row -->
        </div>

                <!-- Side Widget Well -->
                <div class="well">
                    <h4>Side Widget Well</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
                </div>

            </div>