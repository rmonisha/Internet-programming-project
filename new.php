<?php
$server_name = "localhost";
$username = "username";
$password = "password";
$database_name = "disease";
$conn = mysqli_connect($server_name,$username,$password,$database_name);

// checking the connection
if(!$conn){
	die("Connection Failed:" . mysqli_connect_error());
}
else{
	echo "Done";
}
?>