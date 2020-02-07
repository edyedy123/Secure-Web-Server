<?php
require "lib/password.php";
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'lessPower' with  password) */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'lessPower');
define('DB_PASSWORD', 'G00gleCrome!23');
define('DB_NAME', 'assignment');
 
/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>