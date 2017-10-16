<?php
	
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "electricity_data";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	
	$con_id_up=$_POST["con_id_up"];
	$con_title_up=$_POST["con_title_up"];
	$con_name_up=$_POST["con_name_up"];
	$con_nic_up=$_POST["con_nic_up"];
	$con_address_up=$_POST["con_address_up"];
	$con_contact_up=$_POST["con_contact_up"];
	$con_email_up=$_POST["con_email_up"];
	$con_premises_up=$_POST["con_premises_up"];
	$con_tariff_up=$_POST["con_tariff_up"];
	$con_password_up=$_POST["con_password_up"];
	
	//Update query to the database
	$insertQuery="UPDATE consumer_table SET con_title='$con_title_up', con_name='$con_name_up', con_nic='$con_nic_up', con_address='$con_address_up', con_contact='$con_contact_up', con_email='$con_email_up', con_password='$con_password_up', premises_id='$con_premises_up', tariff_id='$con_tariff_up' WHERE con_id='$con_id_up'";
	
	if (mysqli_query($conn,$insertQuery))
	{
		//echo "<script type='text/javascript'>alert('Successfully Inserted..!');</script>";
		echo "Successfully Updated..!";
	} else {
		echo "Error: ". $conn->error;
	}
	$conn->close();
?>