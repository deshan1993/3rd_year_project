<?php
	
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "electricity_data";

	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	
	$tariff_id = $_GET['tariff_id'];
	
	//insert values to the database
	$insertQuery="DELETE FROM tariff_time_table WHERE tariff_time_id='$tariff_id'";
	
	if (mysqli_query($conn,$insertQuery))
	{
		echo "Successfully delete tariff record!";
	
	} else {
		echo "Error: ". $conn->error;
	}
	$conn->close();
?>