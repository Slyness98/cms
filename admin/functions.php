<?php 

function queryConnect($result) {
	global $connection;
	if(!$result) {
		die("QUERY FAILED ." . mysqli_error($connection));
	}
} 
function addCategory(){
 global $connection;
     if(isset($_POST['submit'])) {
                               
        $cat_title = $_POST['cat_title'];
	if($cat_title == "" || empty($cat_title)) {
    echo "This field should not be empty";

	} else{
    
	    $query = "INSERT INTO categories(cat_title)";
	    $query .= "VALUES('{$cat_title}')";

	    $create_category_query = mysqli_query($connection, $query);

	    if(!$create_category_query){
	        die('QUERY FAILED' . mysqli_error($connection));
	    }
	}
  }
}
 

function displayAllCategories() {
 global $connection;

 $query = "SELECT * FROM categories";
 $select_categories = mysqli_query($connection,$query);
     while ($row = mysqli_fetch_assoc($select_categories)) {
     $cat_id = $row['cat_id'];
     $cat_title = $row['cat_title'];
     echo "<tr>";
     echo "<td>{$cat_id}</td>";
     echo "<td>{$cat_title}</td>";
     echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";//Link to create a Query generated via GET to delete a category by ID
     echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
     echo "</tr>";
    }
 }


function deleteCategories(){
	global $connection;
if(isset($_GET['delete'])){
 $get_cat_id = $_GET['delete'];
 $query = "DELETE FROM categories WHERE cat_id = {$get_cat_id}";
 $delete_query = mysqli_query($connection, $query);
 header("Location: categories.php");
}
}






function editCategories(){
global $connection;
 if(isset($_GET['edit'])) {
 ?>
 	<form  action="" method="post">
 		<label for="cat-title">Edit Category</label>
 <?php  
   $cat_id = $_GET['edit'];
   $query = "SELECT * FROM categories WHERE cat_id = $cat_id";
   $select_categories = mysqli_query($connection, $query);
     while ($row = mysqli_fetch_assoc($select_categories )) {
     $cat_id = $row['cat_id'];
     $cat_title = $row['cat_title'];
 ?>
        <input value="<?php if(isset($cat_title)){echo  $cat_title;} ?>" class="form-control" type="text" name="cat_title">

<?php }}?>

<?php 
//EDIT CATEGORY QUERY
if(isset($_POST['update'])){
    $update = $_POST['cat_title'];

$query = "UPDATE categories SET cat_title = '{$update}' WHERE cat_id = {$cat_id} ";
$update_query = mysqli_query($connection, $query);
   if(!$update_query){
    die("Query Failed to Update". mysqli_error($connection));
   }
  }
?>
                            

<div class="form-group"> 
  <input class="btn btn-primary" type="submit" name="update" value="Update Category">
</div>
</form>
<?php
}
?>