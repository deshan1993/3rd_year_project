<?php
	
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "electricity_data";

	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	
	$con_id = $_POST['con_id'];
	$con_msg=$_POST["message"];
	$con_date= date("Y-m-d");
	$time1 = date("h:i:s",date_default_timezone_set("Asia/Colombo"));
	$time = new DateTime();
	$con_time = $time->format('h:i:s');

	//insert values to the database
	$insertQuery="INSERT INTO message_table (msg_info,msg_date,msg_time,con_id) VALUES ('$con_msg','$con_date','$con_time','$con_id')";
	
	if (mysqli_query($conn,$insertQuery))
	{
		//echo "<script type='text/javascript'>alert('Successfully Inserted..!');</script>";
		echo "Successfully Send message..!";
	
	} else {
		echo "Error: ". $conn->error;
	}
	$conn->close();
?>