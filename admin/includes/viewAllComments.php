  <!-- header.php is rendered in categories.php file, which this file is rendered in. By extension, we already have access to the db config and our functions.php file -->
  <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Author</th>
                            <th>Comment</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>In Response To</th>
                            <th>Date</th>
                            <th>Approved</th>
                            <th>Blocked</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
<?php
 $query = "SELECT * FROM comments";
   $select_comments = mysqli_query($connection, $query);


     while ($row = mysqli_fetch_assoc($select_comments )) {

     $comment_id = $row['comment_id'];
     $comment_post_id = $row['comment_post_id'];
     $comment_author = $row['comment_author'];
     $comment_content = $row['comment_content'];
     $comment_email = $row['comment_email'];
     $comment_status = $row['comment_status'];
     $comment_date = $row['comment_date'];


    
     echo "<tr>";
        echo "<td>{$comment_id}</td>";
        echo "<td>{$comment_author}</td>";
        echo "<td>{$comment_content}</td>";
        echo "<td>{$comment_email}</td>";
        echo "<td>{$comment_status}</td>";

//It kills me to put this prepared statement for the link to the related post's title in the while loop but I can't get it to run properly if I make it a seperate function. It's incredibly inefficient on memory and I should come back to try to implement a solution that doesn't loop as many times as there are comments. 

$stmt = mysqli_stmt_init($connection);
$postRespondedTo = "SELECT post_title FROM posts WHERE post_id = ?";
mysqli_stmt_prepare($stmt, $postRespondedTo);
mysqli_stmt_bind_param($stmt, 'i', $comment_post_id);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $post_title);
mysqli_stmt_store_result($stmt);
mysqli_stmt_fetch($stmt); 
         echo "<td><a href='../post.php?p_id={$comment_post_id}'>{$post_title}</a></td>";
        echo "<td>{$comment_date}</td>";
       echo "<td><a href='comments.php?status=approved&c_id={$comment_id}' class='btn btn-success'>Approved</a></td>";
echo "<td><a href='comments.php?status=blocked&c_id={$comment_id}' class='btn btn-danger'>Blocked</a></td>";
        echo "<td><a href='comments.php?delete={$comment_id}&postAffected={$comment_post_id}'>Delete</a></td>";
     echo "</tr>";
}
?>

</tbody>
</table>
<?php

if(isset($_GET['status'])){
   updateCommentStatus();
   }
?>

<?php
if(isset($_GET['delete'])&&isset($_GET['postAffected'])) {
    deleteComment();
}
?>