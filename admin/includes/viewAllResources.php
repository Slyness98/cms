
    <div class="col-xs-4">
        <!-- <input type="submit" name="submit" class="btn btn-success" value="Apply"> -->
        <a class="btn btn-primary" href="resources.php?source=addResource">Add New</a>
    </div>
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <!-- <th><input id="selectAllBoxes" type="checkbox">Select All</input></th> -->
                            <th>ID</th>
                            <th>Resource</th>
                            <th>URL</th>
                            <th>Description</th>
                            <th>Slide # </th>
                            <th>Column # </th>
                            <th>Edit </th>
                            <th>Delete </th>
                            
                        </tr>
                    </thead>
                    <tbody>

                <?php 
                    $query = "SELECT * FROM resources";
                    $select_resources = mysqli_query($connection, $query);
                        
                        while ($row = mysqli_fetch_assoc($select_resources )) {

                            $resource_id = $row['resource_id'];
                            $resource_name = $row['resource_name'];
                            $resource_url = $row['resource_url'];
                            $resource_description = $row['resource_description'];
                            $resource_slide = $row['resource_slide'];
                            $resource_column = $row['resource_column'];


                              echo "<tr>";
                              // echo "<td><input class='checkboxes' type='checkbox' name='checkboxArray[]' value='$resource_id'></td>";
                              echo "<td>{$resource_id}</td>";
                              echo "<td><a href={$resource_url} target='_blank'>{$resource_name}</a></td>";
                              echo "<td><a href={$resource_url} target='_blank'>{$resource_url}</a></td>";
                              echo "<td>{$resource_description}</td>";
                              echo "<td>{$resource_slide}</td>";
                              echo "<td>{$resource_column}</td>";
                              echo "<td><a href='resources.php?source=editResource&resource_id={$resource_id}'>Edit</a></td>";
                              echo "<td><a href='resources.php?delete={$resource_id}'>Delete</a></td>";

                        }

                        if(isset($_GET['delete'])) {
                            deleteResource();
                        }
                ?>