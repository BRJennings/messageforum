<?php
// logout.php
include 'connect,php';
include 'header.php';

// Free all SESSION variables currently registered.
// No return value.
session_unset();

// Inform user the are beign logged out.
echo 'Logging out';

// Redirect to main page
header("refresh:6;url=index.php");

include 'footer.php';
?>

