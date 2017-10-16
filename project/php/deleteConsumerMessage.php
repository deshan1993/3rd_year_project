<?php
	
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "electricity_data";

	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $dbname);

	//insert values to the database
	$insertQuery="DELETE FROM message_table";
	
	if (mysqli_query($conn,$insertQuery))
	{
		echo "Successfully clear table!";
	
	} else {
		echo "Error: ". $conn->error;
	}
	$conn->close();
?>