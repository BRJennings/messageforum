<?php
// signin.php
include 'connect.php';
include 'header.php';

// Let the user knwo whats happening.
echo '<h3>Sign In</h3>';

//check if user is already signed in
if(isset($_SESSION['signed_in']) && $_SESSION['signed_in'] == true)
{
   echo 'You are already signed in. Do you want to<a href="logout.php>Sign Out?</a>';
}
else 
{
   if($_SERVER['REQUEST_METHOD'] != 'POST')
   {
      //form has not been posted, so show it
      echo '<form method="post" action="">
            Username: <input type="text" name="user_name" />
            Password: <input type="password" name="user_pass" />
            <input type="submit" value="sign in" />
            </form>';
   }
   else 
   {
      // the form has been posted, so process the user input

      $errors = array();

      if(!isset($_POST['user_name']))
      {
         $errors[] = 'User name cannot be blank.';
      }
      if(!isset($_POST['user_pass']))
      {
         $errors[] = 'User Password cannot be blank.';
      }
      
      if(!empty($errors))
      {
         echo "A couple of fields are not filled in properly";
         echo '<ul>';
         foreach($errors as $key => $value)
         {
            echo '<li>' . $value . '</li>';
         }
         echo '</ul>';
      }
      else
      {
         // form has been filled in properly. 
         $sql = "select user_id, user_name, user_level
		 from FORUM.users
	 	 where user_name = '" . mysql_real_escape_string($_POST['user_name']) . "'
                 and user_pass = '" . sha1($_POST['user_pass']) . "'"; 

         $result = mysql_query($sql);
         if(!$result)
         {
            // sql query failed
            echo 'Unable to sign you in. Please try again.';
            // echo mysql_error(); testing purposes only
         }
         else
	 {
            if(mysql_num_rows($result) == 0)
            {
               echo 'Bad username/password combination. Please try again.';
            }
            else
            {
               // set user as 'signed_in' in session variable
               $_SESSION['signed_in'] = true;

               while($row = mysql_fetch_assoc($result))
               {
                  $_SESSION['user_id'] = $row['user_id'];
                  $_SESSION['user_name'] = $row['user_name'];
                  $_SESSION['user_level'] = $row['user_level'];
               }
               echo 'Welcome ' . $_SESSION['user_name'] . '. Head to the <a href="index.php">Main Forum</a>';

               // Return user to index.php main forum page after 6 second wait, 
	       // unless they click on href.
               header("refresh:6;url=index.php");
            }
         }
      }
   }
}
include 'footer.php';
?>
