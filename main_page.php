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

if(isset($_POST['save'])){
	
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$age = $_POST['age'];
	$gender = $_POST['gender'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$history = $_POST['history'];
	
	$sql_query = "INSERT INTO user_details (first_name,last_name,age,gender,email,mobile,history)
	VALUES ('$first_name','$last_name','$age','$gender','$email','$phone','$history')";
	
	if (mysqli_query($conn, $sql_query)){
		
		if(isset($_POST['symptom'])){
			
			$disease_array = array();
			$disease_id_array = array();
			
			foreach ($_POST['symptom'] as $symptom){
				
				$sql = "SELECT disease_name,disease_info.disease_id FROM disease_info,disease_symptom 
				WHERE disease_info.disease_id=disease_symptom.disease_id AND symptoms= '" .($symptom) ."'";
				
				$result = $conn->query($sql);
				
				if ($result->num_rows > 0) {
					
					// output data of each row
					
					while($row = $result->fetch_assoc()) {
					
						$check =0;
						foreach($disease_array as $element){
							
							if( $element == $row['disease_name']){
								$check =1; 
							}
						}
						
						if($check == 0){
							
							array_push($disease_array,$row['disease_name']);
							array_push($disease_id_array,$row['disease_id']);
						}
					}
				}
			}
			
			echo "<h2> You have been diagnosed with </h2>";
			$index=0;
			
			foreach($disease_array as $x){
				
				$id=$disease_id_array[$index];
				echo "<a href=disease_cure_page.php?val=",$id," target='_blank'>" .$x ."</a><br/>";
				$index = $index+1;
			}
			echo "<p> Click on the disease to know how to cure it !</p>";
		}
		
		else{
			echo " <strong> Please select a symptom first</strong>";
		}
	}
	
	else{
		echo "Error: " . $sql . "" . mysqli_error($conn);
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
