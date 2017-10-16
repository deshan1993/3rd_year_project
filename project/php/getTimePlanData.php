<?php
//$id = $_POST['id'];
$id='plan_01'

$con = mysqli_connect("localhost","root","","electricity_data");
$sql = "SELECT * FROM time_plan WHERE time_plan_id = '$id'";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_row($result);

$peak = $row['peak'];
$off_peak = $row['off_peak'];
$day = $row['day'];
$implement = $row['implement_date'];

echo $peak;

// $data = array('peak'=>$peak,'off_peak'=>$off_peak, 'day'=>$day, 'implement'=>$implement);
// $data = json_encode($data);
// echo $data;
mysqli_close($con);
?>