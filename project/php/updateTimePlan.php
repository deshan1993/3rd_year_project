<?php
    $id = $_POST['id'];
    $peak = $_POST['peak'];
    $off_peak = $_POST['off_peak'];
    $day = $_POST['day'];
    $implement = $_POST['implement'];

    $con = mysqli_connect("localhost","root","","electricity_data");

    $sql = "UPDATE time_plan SET time_plan_id='$id', peak='$peak', off_peak='$off_peak', day='$day', implement_date='$implement'";


    if (mysqli_query($con, $sql))
	{
		echo "Successfully Updated..!";
	} else {
		echo "Error: ". $con->error;
	}
	$con->close();


?>