<?php
// logout.php
include 'connect,php';
include 'header.php';

// Free all SESSION variables currently registered.
// No return value.
session_unset();

// Inform user they are being logged out.
echo 'Logging out';

// Redirect to main page after 6 seconds.
header("refresh:6;url=index.php");

include 'footer.php';
?>

