 <?php
 

if(isset($_POST['checkboxArray'])){
    foreach($_POST['checkboxArray'] as $checkboxValue) {
       global $checkboxValue;
      $bulk_options = clean($_POST['bulk_options']);
  //checkboxValue carries our post id's from every selected checkbox. 
    //We use a prepared statement that seperates values that would've been directly injected into SQL using deprecated mysql_* and naked mysqli functions.
    //We make a hardcoded SQL statement template that then binds the intended values at runtime(based on our switch statement). 
    //Tampering via SQL injection is rendered impossible. You'd have to gain access to the code through other means in order to tamper with database relations or any of its contents  
switch ($bulk_options) {
    case 'published':
   $sql = "UPDATE posts SET post_status = 'published' WHERE post_id=?";
    $stmt = mysqli_prepare($connection, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $checkboxValue);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    break;



    case 'draft':
    $sql = "UPDATE posts SET post_status = 'draft' WHERE post_id=?";
    $stmt = mysqli_prepare($connection, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $checkboxValue);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    break;
     


    case 'delete':
    $sql = "DELETE FROM posts WHERE post_id=?";
    $stmt = mysqli_prepare($connection, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $checkboxValue);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    break;
    


    default:
        break;
}
}
}
 ?>



 <form action="" method="post">
    <div id="bulkOptionsContainer" class="col-xs-4">
        <select class="form-control" name="bulk_options">
        <option value="">Select Options</option>    
        <option value="published">Publish</option> 
        <option value="draft">Draft</option> 
        <option value="delete">Delete</option> 
        </select>
    </div>


    <div class="col-xs-4">
        <input type="submit" name="submit" class="btn btn-success" value="Apply">
        <a class="btn btn-primary" href="posts.php?source=add_post">Add New</a>
    </div>
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th><input id="selectAllBoxes" type="checkbox">Select All</input></th>
                            <th>ID</th>
                            <th>Author</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Image</th>
                            <th>Tags</th>
                            <th>Comments</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
<?php
 $query = "SELECT * FROM posts";
   $select_posts = mysqli_query($connection, $query);
     while ($row = mysqli_fetch_assoc($select_posts )) {

     $post_id = $row['post_id'];
     $post_author = $row['post_author'];
     $post_title = $row['post_title'];
     $post_category_id = $row['post_category_id'];
     $post_status = $row['post_status'];
     $post_image = $row['post_image'];
     $post_tags = $row['post_tags'];
     $post_comment_count = $row['post_comment_count'];
     $post_date = $row['post_date'];

    
     echo "<tr>";
        echo "<td><input class='checkboxes' type='checkbox' name='checkboxArray[]' value='$post_id'></td>";
        echo "<td>{$post_id}</td>";
        echo "<td>{$post_author}</td>";
        echo "<td><a href='../post.php?p_id={$post_id}'>{$post_title}</a></td>";
        
 $query = "SELECT * FROM categories WHERE cat_id = $post_category_id";
 $select_categories = mysqli_query($connection, $query);
     while ($row = mysqli_fetch_assoc($select_categories )) {
     $cat_id = $row['cat_id'];
     $cat_title = $row['cat_title'];
        echo "<td>{$cat_title}</td>";
       
    }


        echo "<td>{$post_status}</td>";
        echo "<td><img width=100 src='../images/$post_image' /></td>";
        echo "<td>{$post_tags}</td>";
        echo "<td>{$post_comment_count}</td>";
        echo "<td>{$post_date}</td>";
        echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
        echo "<td><a href='posts.php?delete={$post_id}'>Delete</a></td>";
     echo "</tr>";
}
?>

</tbody>
</table>
</form>
<?php
global $connection;
if(isset($_GET['delete'])) {
    

 $get_post_id = $_GET['delete'];
 $query = "DELETE FROM posts WHERE post_id = {$get_post_id}";
 $delete_query = mysqli_query($connection, $query);
 header("Location: posts.php");
}
?>