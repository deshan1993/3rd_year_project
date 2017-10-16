<?php

	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "electricity_data";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	
	$tariff_id = $_GET["tariff_id"];
	$peak = $_GET["peak"];
	$off_peak = $_GET["off_peak"];
	$day = $_GET["day"];
	$fixed_charge = $_GET["fixed_charge"];
	$demand_charge = $_GET["demand_charge"];
	
	//Update query to the database
	$insertQuery="UPDATE tariff_time_table SET peak='$peak', off_peak='$off_peak', day='$day', fixed_charge='$fixed_charge', demand_charge='$demand_charge' WHERE tariff_time_id='$tariff_id'";
	
	if (mysqli_query($conn,$insertQuery))
	{
		echo "Successfully Updated..!";
	} else {
		echo "Error: ". $conn->error;
	}
	$conn->close();

?>
	
	