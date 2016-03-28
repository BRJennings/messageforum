<?php
//index.php
include 'connect.php';
include 'header.php';
$sql = "SELECT cat_id, cat_name, cat_desc 
	from FORUM.categories";

$result = mysql_query($sql);

if(!$result)
{
    echo 'Categories could not be displyed.';
}
else
{
    if(mysql_num_rows($result) == 0)
    {
        echo 'No existing categories yet. Why not make one?';
    }
    {
        //build the table to display the categories
        echo '<table border="1">
              <tr>
                  <th>Category</th>
                  <th>Description</th>
              </tr>';
        while($row = mysql_fetch_assoc($result))
        {
            echo '<tr>'; 
                echo '<td class="leftpart">';
                    echo '<h3><a href="category.php?cat_id=' . $row['cat_id'] . '">' . $row['cat_name'] .': ' . $row['cat_desc'];
                echo '</td>';
                echo '<td class="rightpart">';
                    echo '<h3>Topic Description</a>';
                echo '</td>';
            echo '</tr>';
           
        }
    }
}
include 'footer.php';
