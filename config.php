<?php

// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "momcare";
 
// Connect to MySQL database
$conn = mysqli_connect($servername, $username, $password, $dbname);
 
// Check connection
if($conn === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

?>
