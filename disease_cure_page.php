<?php

	$server_name = "localhost";
	$username = "username";
	$password = "password";
	$database_name = "disease";
	$conn=mysqli_connect($server_name,$username,$password,$database_name);

	// checking the connection
	
	if(!$conn){
		die("Connection Failed:" . mysqli_connect_error());
	}
	else{
		
		$val=$_GET["val"];
		$sql = "SELECT disease_cure FROM disease_info WHERE disease_info.disease_id= '" .($val) ."'";
		$result = $conn->query($sql);
		
		if ($result->num_rows > 0) {
			
				// output data of each row
				
				while($row = $result->fetch_assoc()) {
					
					echo $row['disease_cure'];
				}
		}
	}
?>

<html>
<head>
	<style>
			body {
				
			  background-image: url('white.jpg');
			  background-repeat: no-repeat;
			  background-attachment: fixed;  
			  background-size: cover;
			}
	</style>
</head>
</html>