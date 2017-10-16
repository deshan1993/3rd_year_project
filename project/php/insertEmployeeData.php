<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "electricity_data";

	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	
	//insert values to the database
	$insertQuery="insert into employee_table (emp_id,emp_name,emp_post,emp_telephone,emp_password) VALUES ('".$_GET["emp_id"]."','".$_GET["emp_name"]."','".$_GET["emp_post"]."','".$_GET["emp_mobile"]."','".$_GET["emp_password"]."')";
	
	if (mysqli_query($conn, $insertQuery))
	{
		echo "Successfully Inserted..!";
	} else {
		echo "Error Occured ! ";
	}
	$conn->close();
	
?>