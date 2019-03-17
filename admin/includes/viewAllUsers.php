  <!-- header.php is rendered in categories.php file, which this file is rendered in. By extension, we already have access to the db config and our functions.php file -->
  <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>First Name</th>
                            <th>Last name</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Profile Picture</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
<?php
 $query = "SELECT * FROM users";
   $select_users = mysqli_query($connection, $query);


     while ($row = mysqli_fetch_assoc($select_users )) {

     $user_id = $row['user_id'];
     $user_firstName = $row['user_firstName'];
     $user_lastName = $row['user_lastName'];
     $user_username = $row['user_username'];
     $user_password = $row['user_password'];
     $user_profilePicture = $row['user_profilePicture'];
     $user_email = $row['user_email'];
     $user_role = $row['user_role'];


    
     echo "<tr>";
        echo "<td>{$user_id}</td>";
        echo "<td>{$user_firstName}</td>";
        echo "<td>{$user_lastName}</td>";
        echo "<td>{$user_username}</td>";
        echo "<td>{$user_password}</td>";
        echo "<td><img width=100 src='{$user_profilePicture}'></td>";
        echo "<td>{$user_email}</td>";
       echo "<td>{$user_role}</td>";
        echo "<td><a href='users.php?source=editUser&u_id={$user_id}'>Edit</a></td>";
        echo "<td><a href='users.php?delete={$user_id}'>Delete</a></td>";
     echo "</tr>";
}
?>

</tbody>
</table>

<?php
if(isset($_GET['delete'])) {
    deleteUser();
}
?>