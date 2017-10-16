<?php

	$con_id = $_GET["con_id"];
	$con_password = $_GET["con_password"];
	
    $servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "electricity_data";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	$sql = "UPDATE consumer_table SET con_password='$con_password' WHERE con_id='$con_id'";

	if ($conn->query($sql) === TRUE) {
		echo "New password was changed successfully.";
	} else {
		echo "Error updating record: " . $conn->error;
	}

	$conn->close();
		
		
?>