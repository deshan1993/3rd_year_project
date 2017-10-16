<?php
	
	//print_r($_POST);
	//echo $_POST['min_value'];

	// $insert_id_array = $_POST['tariff_id_insert'];
	// echo $insert_id_array;
	
	$con = mysqli_connect("localhost","root","","electricity_data");
	
	$rowCount = count($_POST['peak_value']);

	$insert_id_array = $_POST['time_id_insert'];
	$drop_id_array = $_POST['tariff_id_drop'];
	$peakArray = $_POST['peak_value'];
	$offArray = $_POST['off_peak_value'];
	$dayArray = $_POST['day_value'];
	$fixedArray = $_POST['fixed_charge2'];
	$demandArray = $_POST['demand_charge2'];

	//check drop down input
	if($drop_id_array != "" && $insert_id_array ==""){
		$i=0;
		$tariff_id = $drop_id_array;
		for($i=0;$i<$rowCount;$i++){
			$sql = "INSERT INTO tariff_time_table (tariff_time_id,peak,off_peak,day,fixed_charge,demand_charge) VALUES 
			('$tariff_id','$peakArray[$i]','$offArray[$i]','$dayArray[$i]','$fixedArray[$i]','$demandArray[$i]')";
			if(mysqli_query($con,$sql) === TRUE){
				$data = "Successfully added";
			}
			else{
				$data = "Error occur";
			}
		}
	}

	//check input
	elseif($insert_id_array != ""){
		$i=0;
		$tariff_id = $insert_id_array;
		for($i=0;$i<$rowCount;$i++){
			$sql1 = "INSERT INTO tariff_time_table (tariff_time_id,peak,off_peak,day,fixed_charge,demand_charge) VALUES 
			('$tariff_id','$peakArray[$i]','$offArray[$i]','$dayArray[$i]','$fixedArray[$i]','$demandArray[$i]')";
			if(mysqli_query($con,$sql1) === TRUE){
				$data = "Successfully added";
			}
			else{
				$data = "Error occur";
			}
		}
	 }
	else{
		$data = "Not inserted tariff id";
	}
	
	echo $data;
	$con->close();
	
?>