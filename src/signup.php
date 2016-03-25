<?php
//signup.php
include 'connect.php';
include 'header.php';

echo '<h3>Sign Up</h3>';

if($_SERVER['REQUEST_METHOD'] != 'POST')
//form hasnt been posted yet so post it
{
    echo '<form action="" method="post">
        Username: <input type="text" name="user_name"><br>
        Password: <input type="password" name="user_pass"><br>
        Password Again: <input type="password" name="user_pass_check"><br>
        Email: <input type="email" name="user_email"><br>
        <input type="submit" value="Add Category"/>
    </form>';
}
else 
{
    $errors = array(); 
    
    if(isset($_POST['user_name']))	
    {
        if(!ctype_alnum($_POST['user_name']))
        {
            $errors[] = 'The username can only contain letters and numbers.';
        }
        if(strlen($_POST['user_name']) > 30)
        {
            $errors[] = 'The username cannot be longer than 30 characters.';
        }	
    }
    else
    {
        $errors[] = 'The username must not be empty.';
    }
    //Check the password has been set, and matches
    if(isset($_POST['user_pass']))
    {
        if($_POST['user_pass'] != $_POST['user_pass_check'])
        {
           $errors[] = 'The passwords did not match.';
        }
    }
    else
    {
        $errors[] = 'The password must not be blank';
    }
    //Come back here some time and implement email checking
    // if(preg_match('^*[@]*[.]*', $_POST['user_email'])) then good
    //if(!isset($_POST['user_email'])) 
    //{
    //    $errors[] = 'Email cannot be blank';
    //}
    //Check if error array is empty or has error message
    if(!empty($errors))
    {
        echo 'A couple of fields are not filled out correctly.';
        echo '<ul>';

        foreach($errors as $key => $value)
        {
            echo '<li>' . $value . '</li>';
        }
        echo '</ul>';
    }
    else
    {
        //sha1 hashes the password, real_escape_string escapes special characters
        $sql = "INSERT INTO FORUM.users(user_name, user_pass, user_email, user_date, user_level) 
                VALUES('" . mysql_real_escape_string($_POST['user_name']) . "', 
                       '" . sha1($_POST['user_pass']) . "', 
                       '" . mysql_real_escape_string($_POST['user_email']) ."', 
                        NOW(), 0)";
        $result = mysql_query($sql);
        if(!$result)
        {
            echo 'Registration failed. Please try again.';
            echo mysql_error();
        }
        else
        {
            echo 'Success. You are now registered. You can now <a href="signin.php">Sign In</a>';
        }
    }

}

include 'footer.php';
?>
