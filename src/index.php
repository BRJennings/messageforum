<?php
//index.php
include 'connect.php';
include 'header.php';

// Retrieve category information from the database.
$sql = "SELECT cat_id, cat_name, cat_desc 
	from FORUM.categories";

$result = mysql_query($sql);

// Query went wrong.
if(!$result)
{
    echo 'Categories could not be displyed.';
}
else
{
    // Nothing returned from database.
    if(mysql_num_rows($result) == 0)
    {
        echo 'No existing categories yet. Why not make one?';
    }
    {
        // Build the table to display the categories
        echo '<table border="1">
              <tr>
                  <th>Category</th>
                  <th>Description</th>
              </tr>';
        while($row = mysql_fetch_assoc($result))
        {
            echo '<tr>'; 
                echo '<td class="leftpart">';
                    echo '<h3><a href="category.php?cat_id=' . $row['cat_id'] . '">' . $row['cat_name'] . '</h3>';
                echo '</td>';
                echo '<td class="rightpart">';
                    echo '<h3>' . $row['cat_desc'] . '</a>';
                echo '</td>';
            echo '</tr>';
           
        }
    }
}
include 'footer.php';
