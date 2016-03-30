<!DOCTYPE html>
<html>
<head>
    <title>eNanaimo.com</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h1>eNanaimo</h1>
        <?php
        session_start();
        echo ' <div id="userbar">';
           if((isset($_SESSION['signed_in'])) && ($_SESSION['signed_in']))
           {
              echo 'Hello ' . $_SESSION['user_name'] . '. Not you? <a href="logout.php">Log Out</a>';
           }
           else 
           {
              echo '<a href="signin.php">Sign In</a> or <a href="signup.php">Sign up</a>';
           }
       echo ' </div><!--userbar-->';
    ?>
    <div id="wrapper">
    <div id="menu">
        <a class="item" href="index.php">Home</a>
        <a class="item" href="create_topic.php">Create a New Topic</a>
        <a class="item" href="create_cat.php">Create a New Category</a>
        <?php
    echo '</div><!--menu-->';
    echo '<div id="content">';
        ?>
    
