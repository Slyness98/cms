 <nav class="navbar navbar-expand-md navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container-fluid">
           
            <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">The Contriving Coder</a>
        </div>
        
        
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
         
             



                <!-- <li>
                   <a href="../cms/categories.php">Categories</a>
                </li> -->
                <li class="dropdown">
                 <a href="../cms/categories.php" 
                    class="dropdown-toggle" 
                    data-toggle="dropdown" 
                    role="button" 
                    aria-expanded="false">Categories <span class="caret"></span>
                 </a>
                    <ul class="dropdown-menu" >
                  
                   <?php 
                    $query = "SELECT * FROM categories";
                    $select_all = mysqli_query($connection,$query);

                    while ($row = mysqli_fetch_assoc($select_all)) {
                     $cat_title = $row['cat_title'];
                     $cat_id = $row['cat_id'];
                              
                              echo "<li> <a href='../cms/postsByCategory.php?category={$cat_id}'> {$cat_title} </a> </li>";
                        }
                        ?>
                    </ul>
                 </li>
         
                 <li>
                   <a href="../cms/registration.php">Registration</a>
                </li>

               
<?php if(isset($_SESSION['role'])) {
if($_SESSION['role'] == 'admin'){
            
           echo" <li>  <a href='admin'> Admin </a>  </li>";
                }}


if(isset($_SESSION['role']) && isset($_GET['p_id'])) {
    $p_id = $_GET['p_id'];
    if($_SESSION['role'] == 'admin'){

           echo" <li> <a href='admin/posts.php?source=edit_post&p_id=$p_id'>Edit Article  </a> </li>";

                }}
                ?>

                 <!-- <li>
                   <a href="../cms/registration.php">Join Our Community</a>
                </li> -->

            </ul>
        
         </div>
            <!-- /.navbar-collapse -->
    </div>
        <!-- /.container -->
</nav>


