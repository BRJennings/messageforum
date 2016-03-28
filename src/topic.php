<?php
// topic.php
include 'connect.php';
include 'header.php';

// Retrieve information about the topic.
$sql = "SELECT topic_id, topic_subj
	FROM FORUM.topics
	WHERE topic_id = " . mysql_real_escape_string($_GET['id']);

echo mysql_error(); // testing only

// Execute topic query.
$result = mysql_query($sql);

// Something went wrong with the database.
if(!$result)
{
    echo 'Topic posts could not be displayed. Please try again later.';
}

// Continue with displaying query results.
else
{
    if(mysql_num_rows($result) == 0)
    {
        echo 'Could not retrieve the post.';
    }

    // Display the topic information from the query and display it.
    else
    {


        // Display post description at head of table.
        while($row = mysql_fetch_assoc($result))
        {
            // Set up table to display topic posts
            echo '<table border="1">
                  <tr>
                  <th>Topic: ' . $row['topic_subj'] .
                 '<th>Content</th>
                  </tr>';
        }

        // Get post content in this topic to display.
        $sql = "SELECT posts.post_topic,
                       posts.post_content,
                       posts.post_date,
                       posts.post_by,
                       users.user_id,
                       users.user_name
		FROM FORUM.posts
		LEFT JOIN FORUM.users
		ON posts.post_by = users.user_id
		WHERE posts.post_topic = " . mysql_real_escape_string($_GET['id']);

        $result = mysql_query($sql);

        // Display posts in this topic.
        while($row = mysql_fetch_assoc($result))
        {
            echo '<tr>';
                echo '<td>Post by: ' . $row['user_name'] . '<br>' . $row['post_date'];
                echo '</td>';
                echo '<td>' . $row['post_content']; 
                echo '</td>';
            echo '</tr>';
        }
    }
}

include 'footer.php';
?>

