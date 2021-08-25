<a class='navbar-brand' href='../home'>
		<img src='../images/cclogo.png' alt='site logo'>
</a>

<button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarResponsive'>
    <span class='custom-toggler-icon'><i class='fas fa-bars'></i></span>
</button>
      
<div class='collapse navbar-collapse' id='navbarResponsive'>
	<ul class='navbar-nav mr-auto navbar-clip-align'> <!-- ML auto aligns nav menu items to the right --> 

		 	<li class='nav-item'>
			 		<a 
			 			class='nav-link' 
			 			href='../home'>

			 				Home
			 		</a>
		 	</li>
	<!-- ------------------- -->
		 	<li class='nav-item'>
			 		<a 
			 			class='nav-link' 
			 			href='../home#articles'> 

			 				Recent Articles
			 		</a>
		 	</li>

	<!-- ------------------- -->
		 	 <li class='nav-item'>
			 		<a 
			 		   class='nav-link external' 
			 		   href='../home#resources'>

			 		    Resources
			 		</a>
		 	 </li>
	<!-- ------------------- -->
		 	<li class='nav-item dropdown'>
	                <a 
	                    href='../category' 
	                    class='dropdown-toggle nav-link' 
	                    data-toggle='dropdown' 
	                    role='button' 
	                    aria-expanded='false'>Categories <span class='caret'></span>
	                </a>
                    
                    <ul class='dropdown-menu dropdown-menu-categories' role='menu'>
					<?php		                
					$query = 'SELECT cat_id, cat_title FROM categories';
					$select_all = mysqli_query($connection,$query);

					while ($row = mysqli_fetch_assoc($select_all)) {
					 $cat_title = $row['cat_title'];
					 $cat_id = $row['cat_id'];
                              
	                 echo " <li>
		              			 <a 
		              			 	class='dropdown-item' 
		              				href='../categories/{$cat_id}'> 
		              						
		              				  {$cat_title} 
		              			 </a> 
                      	    </li>";
					}?> <!--END WHILE LOOP FOR CATEGORY DROPDOWN.-->	    					
				    </ul>
        	 </li>
	<!-- ------------------- -->
			
<?php 
if(isset($_SESSION['role'])) {
  if($_SESSION['role'] == 'admin'){  
	 echo"
			<li class='nav-item'>
					<a 
	   				   class='nav-link' 
	   				   href='../admin'> 
	   				      
	   				     Admin 
	       			</a>  
   		 	</li>";
   }
}

if(isset($_SESSION['role']) && isset($_GET['p_id'])) {
   $p_id = $_GET['p_id'];
   if($_SESSION['role'] == 'admin'){
      echo " 			
			<li class='nav-item'> 
	       			<a 
	       			   class='nav-link'
	       			   href='admin/posts.php?source=edit_post&p_id=$p_id'>
	       			   		
	       			   	  Edit Article 
	       		    </a> 
   		 	</li>";
   }
}
?>
	</ul> <!--End left-aligned nav-items-->
			  
<!-- !!!--- Start of Right-aligned nav-items ---!!! -->
	<ul class='navbar-nav ml-auto'>
<?php 
if(!$_SESSION['isLoggedIn']){ 
    echo "  		
			<li class='nav-item dropdown'>
			 		<a 
			 		  class='dropdown-toggle nav-link' 
			 		  href='#'
	                  data-toggle='dropdown' 
	                  role='button' 
	                  aria-expanded='false'>

	                    Login
			 		</a>
			 		<div class='dropdown-menu dropdown-menu--login'>
			 			<div class='col-md-12'>
				 			<form 
				 				class='form--login' 
				 				role='form' 
				 				action='../includes/login.php' 
				 				method='post' 
				 				accept-charset='UTF-8' 
				 				autocomplete='on'>

					            <div class='form-group form-group--login'>	
					                <input 
					                	  name='username' 
					                	  type='text' 
					                	  class='form-control login-item' 
					                	  placeholder='username'>
					            </div>
					            
					            <div class='form-group form-group--login'>
					                <input 
					                       name='password' 
					                       type='password' 
					                       class='form-control login-item' 
					                       placeholder='password'>
					            </div>
					            
					            <div class='form-group form-group--login'>
					                <span class='input-group-btn'>
					                    <button 
					                    	   class='btn btn-primary' 
					                    	   name='login' 
					                    	   type='submit'>
					                      
					                       Login
					                    </button>
					                </span>
					            </div>
					         
					         </form>
				     	 </div>
			 		</div>
		 		</li>";
} elseif($_SESSION['isLoggedIn']){// (isset($_SESSION['username'])) {
	$username = $_SESSION['username'];
	echo "          
			<ul class='nav navbar-right top-nav'>
		        <li class='nav-item dropdown text-center'>
	                    <a href='#' class='dropdown-toggle nav-link' data-toggle='dropdown'>Your Account<br><i class='fa fa-user'></i> $username <b class='caret'></b>
	                    </a>
	                    <ul class='dropdown-menu'>
	                        <li class='dropdown-item'>
	                            <a class='nav-link' href='profileSubscriber.php'><i class='fa fa-fw fa-user'></i> Profile
	                            </a>
	                        </li>
	                     
	                        <li class='divider'></li>
	                        
	                        <li class='dropdown-item'>
	                            <a class='nav-link' href='../includes/logout.php'><i class='fa fa-fw fa-power-off'></i> Log Out</a>
	                        </li>
	                    </ul>
	             </li>
            </ul>";
}
?>		
			<li class='nav-item'>
			 		<a class='nav-link' href='../register'>Registration</a>
			</li>
	 </ul>
 </div>