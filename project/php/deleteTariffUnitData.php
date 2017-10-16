<?php
	
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "electricity_data";

	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	
	$tariff_id = $_GET['tariff_id'];
	$min = $_GET['min'];
	$max = $_GET['max'];
	
	//insert values to the database
	$insertQuery="DELETE FROM tariff_unit_table WHERE (tariff_unit_id='$tariff_id' AND start_unit='$min' AND end_unit='$max')";
	
	if (mysqli_query($conn,$insertQuery))
	{
		echo "Successfully delete tariff record!";
	
	} else {
		echo "Error: ". $conn->error;
	}
	$conn->close();
?>