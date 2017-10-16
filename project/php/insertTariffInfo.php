<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "electricity_data";

	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	
	//insert values to the database
	$insertQuery="insert into tariff_table (tariff_id,tariff_name) VALUES ('".$_GET["tariff_id"]."','".$_GET["tariff_desc"]."')";
	
	if (mysqli_query($conn, $insertQuery))
	{
		echo "Successfully Inserted Tariff ID..!";
	} else {
		echo "Error Occured ! ";
	}
	$conn->close();
	
?>