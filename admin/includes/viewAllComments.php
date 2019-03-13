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
                            <th>Edit</th>
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
       
        $postRespondedTo = "SELECT post_title FROM posts WHERE post_id = $comment_post_id";
        $select_post_id = mysqli_query($connection, $postRespondedTo);
        $row = mysqli_fetch_assoc($select_post_id);
        $related_post= $row['post_title'];
        echo "<td><a href='../post.php?p_id={$comment_post_id}'>{$related_post}</a></td>";
        echo "<td>{$comment_date}</td>";
       echo "<td><a href='comments.php?status=approved&c_id={$comment_id}' class='btn btn-primary'>Approved</a></td>";
echo "<td><a href='comments.php?status=blocked&c_id={$comment_id}' class='btn btn-warning'>Blocked</a></td>";
        echo "<td><a href='comments.php?edit={$comment_id}'>Edit</a></td>";
        echo "<td><a href='comments.php?delete={$comment_id}'>Delete</a></td>";
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
if(isset($_GET['delete'])) {
    deleteComment();
}
?>