<?php
$con = mysqli_connect("localhost","root","","electricity_data");
$sum1=0;
$sum2=0;
$sum3=0;
$x=0;
$y=0;
$z=0;

$year = date("Y");
$month = date("m");

    //get income from peak time
    $query_peak = "SELECT SUM(peak_con) AS peak_tot FROM consumption_time_table WHERE (year = '$year' AND month = '$month')";
    $result_peak = mysqli_query($con, $query_peak); 
    $row_peak = mysqli_fetch_assoc($result_peak); 
    $sum1 = $row_peak['peak_tot'];

    //get income from  off peak time
    $query_off_peak = "SELECT SUM(off_peak_con) AS off_peak_tot FROM consumption_time_table WHERE (year = '$year' AND month = '$month')";
    $result_off_peak = mysqli_query($con, $query_off_peak); 
    $row_off_peak = mysqli_fetch_assoc($result_off_peak); 
    $sum2 = $row_off_peak['off_peak_tot'];

    //get income from  day time
    $query_day = "SELECT SUM(day_con) AS day_tot FROM consumption_time_table WHERE year = '$year' AND month = '$month'";
    $result_day = mysqli_query($con, $query_day); 
    $row_day = mysqli_fetch_assoc($result_day); 
    $sum3 = $row_day['day_tot'];

    $x=$sum1/($sum1+$sum2+$sum3)*360;
    $y=$sum2/($sum1+$sum2+$sum3)*360;
    $z=$sum3/($sum1+$sum2+$sum3)*360;

    $rating_data = array(array('Employee', 'Rating'),array('Peak Units',$x),array('Off Peak Units',$y),array('Day Units',$z));
    //echo $rating_data[0]['Peak'];
    
       
    $encoded_data = json_encode($rating_data);
?>

<html>
<head>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script type="text/javascript">
google.load("visualization", "1", {packages:["corechart"]});
google.setOnLoadCallback(drawChart);
function drawChart() 
{
 var data = google.visualization.arrayToDataTable(
 <?php  echo $encoded_data; ?>
 );
 var options = {
  title: ""
 };
 var chart = new google.visualization.PieChart(document.getElementById("employee_piechart"));
 chart.draw(data, options);
}
</script>
<style>
body
{
 margin:0 auto;
 padding:0px;
 text-align:center;
 width:100%;
 font-family: "Myriad Pro","Helvetica Neue",Helvetica,Arial,Sans-Serif;
 background-color:#FAFAFA;
}
#wrapper
{
 margin:0 auto;
 padding:0px;
 text-align:center;
 width:995px;
}
#wrapper h1
{
 margin-top:50px;
 font-size:45px;
 color:#585858;
}
#wrapper h1 p
{
 font-size:18px;
}
#employee_piechart
{
    padding:0px;
    width:100%;
    height:100%;
    margin-left:250px;
}
</style>
</head>
<body>
<h2 style="margin-top: 27.92;">Monthly Electricity Consumption - Time Based</h2>
<div id="employee_piechart" style="width: 900px; height: 450px; border:1px solid black;"></div>
<h5>Peak (18:30hr-22:30hr)&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;Peak (18:30hr-22:30hr)&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;Peak (18:30hr-22:30hr)</h5>
<button onclick="goBack()">Go Back</button>

<script>
function goBack() {
    window.history.back();
}
</script>
</body>
</html>