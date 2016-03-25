<?php
//create_categories

include 'connect.php';
include 'header.php';

echo '<h2>Create a new Category</h2>';

if((!isset($_SESSION['signed_in'])) || ($_SESSION['signed_in'] == false))
{
    echo 'You must be signed in to create a new category';
}
else 
{



if($_SERVER['REQUEST_METHOD'] != 'POST')
{
    //echo the form, it hasnt been posted yet
    echo '<form method="post" action="">
           Category name: <input type="text" name="cat_name"/>
           Description: <textarea name="cat_desc"/></textarea>
           <input type="submit" value="Add category"/>
          </form>';
}
else
{
    $sql ="INSERT INTO FORUM.categories(cat_name, cat_desc) 
           VALUES('" . mysql_real_escape_string($_POST['cat_name']) 
          . "', '" . mysql_real_escape_string($_POST['cat_desc']) . "')";

    $result = mysql_query($sql);

    if(!$result)
    {
        //somethign went wrong with inserting the category
        echo 'Error: Could not create new category.';
        echo mysql_error();
    }
    else
    {
        echo 'Category successfully created.';
    }
}
}
include 'footer.php'
?>
