	<?php

	include 'connection.php';
	
	$con_Id = $_POST['con_Id'];
	
	// sql to delete a record
	$deleteQuery="DELETE FROM consumer_table WHERE con_id='$con_Id'";
	
	if (mysqli_query($conn, $deleteQuery))
	{
		echo "Successfully Deleted..!";
	} else {
		echo "Error Occured ! ";
	}
	$conn->close();
	?>
