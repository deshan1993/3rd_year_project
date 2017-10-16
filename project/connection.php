<?php
	
	$server_name = "localhost";
	$user_name = "root";
	$password = "";
	$dbname = "electricity_data";

	// Create connection
	$conn = new mysqli($server_name, $user_name, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}


?>