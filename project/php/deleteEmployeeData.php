	<?php

	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "electricity_data";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	
	$str = $_GET["emp_id"];
	
	// sql to delete a record
	$deleteQuery="DELETE FROM employee_table WHERE emp_id='$str'";
	
	
	if (mysqli_query($conn, $deleteQuery))
	{
		echo "Successfully Deleted..!";
	} else {
		echo "Unvalid Employee ID ! ";
	}
	$conn->close();
	?>
