<?php
// reply.php
include 'connect.php';
include 'header.php';

//echo $_POST['content'];

// Reply wasn't posted properly from topics page.
if($_SERVER['REQUEST_METHOD'] != 'POST')
{
    echo 'Something went wrong. You shouldn\'t be here.';
}
// Reply was posted from topics page.
else
{
    // Check if user is signed in.
    if(!$_SESSION['signed_in'])
    {
        echo 'You must be signed in to post a reply.';
    }
    else
    {
        // The user is signed in. Let them post reply.'
        $sql = "INSERT INTO FORUM.posts(post_content, 
				  post_date,
				  post_topic,
				  post_by)
                VALUES('" . $_POST['content'] 
                       . "', NOW(), '" . $_GET['id'] 
                       . "', '" . $_SESSION['user_id']
                       . "')"; 
        
        // Send reply content query to database.
        $result = mysql_query($sql);

        if(!$result)
        {
	    echo 'Could not save reply.';
        }
        else
	{
	    echo 'Reply succesful.';
	}

    }

}
include 'footer.php';
?>
