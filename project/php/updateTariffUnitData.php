<?php

	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "electricity_data";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	
	$tariff_id = $_GET["tariff_id"];
	$min = $_GET["min"];
	$max = $_GET["max"];
	$unit_charge = $_GET["unit_charge"];
	$fixed_charge = $_GET["fixed_charge"];
	$demand_charge = $_GET["demand_charge"];
	
	//Update query to the database
	$insertQuery="UPDATE tariff_unit_table SET unit_charge='$unit_charge', fixed_charge='$fixed_charge', demand_charge='$demand_charge' WHERE (tariff_unit_id='$tariff_id' AND start_unit='$min' AND end_unit='$max')";
	
	if (mysqli_query($conn,$insertQuery))
	{
		echo "Successfully Updated..!";
	} else {
		echo "Error: ". $conn->error;
	}
	$conn->close();

?>
	
	