<?php

//Define your host here.
$hostname = "localhost";

//Define your database username here.
$username = "root";

//Define your database password here.
$password = "";

//Define your database name here.
$dbname = "cssproject";

 $conn = mysqli_connect($hostname, $username, $password);
 
 if (!$conn)
 {
 die('Could not connect: ' . mysqli_error());
 }
 
 mysqli_select_db($conn,$dbname);

?>