<?php
	
	require_once 'connection.php';
	
	$con_Id=$_POST["con_Id"];
	$con_Title=$_POST["con_Title"];
	$con_Name=$_POST["con_Name"];
	$con_Nic=$_POST["con_Nic"];
	$con_Address=$_POST["con_Address"];
	$con_Mobile=$_POST["con_Mobile"];
	$con_Email=$_POST["con_Email"];
	$premises=$_POST["premises"];
	$tariff=$_POST["tariff"];
	$con_Password=$_POST["con_Password"];

	//insert values to the database
	$insertQuery="INSERT INTO consumer_table (con_id,con_title,con_name,con_nic,con_address,con_contact,con_email,con_password,premises_id,tariff_id) VALUES ('$con_Id','$con_Title','$con_Name','$con_Nic','$con_Address','$con_Mobile','$con_Email','$con_Password','$premises','$tariff')";
	
	if (mysqli_query($conn,$insertQuery))
	{
		//echo "<script type='text/javascript'>alert('Successfully Inserted..!');</script>";
		echo "Successfully Inserted..!";
	} else {
		echo "Error: ". $conn->error;
	}
	$conn->close();
?>