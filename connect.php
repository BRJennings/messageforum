<?php
//connect.php connects to mysql db FORUM

$server = 'localhost';
$username = 'root';
$password = 'signals';
$database = 'FORUM';

if(!mysql_connect($server, $username, $password))
{
    exit("Error: Could not connect to the database");
}
if(!mysql_select_db){
    exit("Error: Could not find database");
}

?>
