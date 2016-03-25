<?php
// category.php

include 'connect.php';
include 'header.php';

// select category based on cat_id
$sql = "SELECT cat_id, cat_name, cat_desc 
        FROM FORUM.categories
        WHERE cat_id = " . mysql_real_escape_string($_GET['cat_id']);

// Get category information from the database.
$result = mysql_query($sql);

if(!$result)
{
    // Something went wrong connecting to the database.
    echo 'This category could be displayed';
}
else 
{
    // Nothing returned from query.
    if(mysql_num_rows($result) == 0)
    {
        echo 'This category does not exist';
    }
    
    else
    {
        // Display category name.
        while($row = mysql_fetch_assoc($result))
        {
            echo '<h2>Topics in ' . $row['cat_name'] . '</h2>';
        }

        // Get all topic posts in this category
        $sql = "SELECT topic_id, topic_subj, topic_date, topic_cat
		FROM FORUM.topics
		WHERE topic_cat = " . mysql_real_escape_string($_GET['cat_id']);

        $result = mysql_query($sql);

        if(!$result)
	{
	    // Something went wrong.
	    echo 'Error with Topics. Please try again later.';
	}
        else if(mysql_num_rows($result) == 0)
	{
            // Nothing has been posted in this category.
	    echo 'There are no posts in this category yet.';
	}
        else
	{
	    // Set up the table to display posts
            echo  '<table border="1">
	          <tr>
                  <th>Topics</th>
                  <th>Created on</th>
                  </tr>';

            while($row = mysql_fetch_assoc($result))
	    {
	        echo '<tr>';
                    echo '<td class="leftpart">';
                        echo '<a href="topic.php?id="' . $row['topic_id'] , '">' . $row['topic_subj'] . '</a>';
	        echo '</tr>';
	    }
	}

    }
}
include 'footer.php';
?>
