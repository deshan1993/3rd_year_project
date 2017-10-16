<?php

	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "electricity_data";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	$emp_id=$_GET["emp_id"];
	$emp_name=$_GET["emp_name"];
	$emp_post=$_GET["emp_post"];
	$emp_mobile=$_GET["emp_mobile"];
	$emp_password=$_GET["emp_password"];
	
	//Update query to the database
	$insertQuery="UPDATE employee_table SET emp_name='$emp_name', emp_post='$emp_post', emp_telephone='$emp_mobile', emp_password='$emp_password' WHERE emp_id='$emp_id'";
	
	if (mysqli_query($conn,$insertQuery))
	{
		echo "Successfully Updated..!";
	} else {
		echo "Error: ". $conn->error;
	}
	$conn->close();

?>
	
	