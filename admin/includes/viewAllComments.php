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
                            <th>Date</th>
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
        echo "<td>{$comment_date}</td>";
        echo "<td><a href='posts.php?edit={$post_id}'>Approved</a></td>";
        echo "<td><a href='posts.php?delete={$post_id}'>Blocked</a></td>";
        echo "<td><a href='posts.php?edit={$post_id}'>Edit</a></td>";
        echo "<td><a href='posts.php?delete={$post_id}'>Delete</a></td>";
     echo "</tr>";
}
?>

</tbody>
</table>

<?php
global $connection;
if(isset($_GET['delete'])) {
    

 $get_post_id = $_GET['delete'];
 $query = "DELETE FROM posts WHERE post_id = {$get_post_id}";
 $delete_query = mysqli_query($connection, $query);
 header("Location: posts.php");
}
?>