<?php

 $query = "SELECT * FROM categories";
                $query_all_categories = mysqli_query($connection,$query);

                while ($row = mysqli_fetch_assoc($query_all_categories)) {
                 $cat_id = $row['cat_id'];
                 $cat_title = $row['cat_title'];


?>

  <h2>
                <a href="../cms/postsByCategory?category=<?php echo $cat_id;?>"><?php echo $cat_title; ?></a>
            </h2>
<?php } ?>