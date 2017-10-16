<?php

session_start();
//$_SESSION['consumer_id'];

$con_id = $_SESSION["consumer_id"];
$con=mysqli_connect("localhost","root","","electricity_data");
$year = date("Y");
$month = date("m");
$sum1=0;
$sum2=0;
$sum3=0;
$x=0;
$y=0;
$z=0;

mysql_connect("localhost","root","") or die ("Could not connect to the server");
mysql_select_db("electricity_data") or die ("That databae could not be found!");
$query = mysql_query("SELECT * FROM consumer_table WHERE con_id='$con_id'") or die ("The query could not be completed.");
if(mysql_num_rows($query)!=1){
die("That consumer Id could not be found!");
}
    while($row = mysql_fetch_array($query, MYSQL_ASSOC)){
        //$con_id = $row['con_id'];
        $con_tariff = $row['tariff_id'];
       
    }
    
    $query_plan = mysqli_query($con, "SELECT * FROM time_plan WHERE time_plan_id ='plan_01' ");
    
        while($row_plan = mysqli_fetch_array($query_plan, MYSQL_ASSOC)){
            $peak_plan = $row_plan['peak'];
            $off_peak_plan = $row_plan['off_peak'];
            $day_plan = $row_plan['day'];
            $implement_plan = $row_plan['implement_date'];
        }

    //get peak time sum
    $query_peak = "SELECT SUM(cons_amount) AS cons_peak FROM consumption_table WHERE (con_id = '$con_id' AND YEAR(cons_date) = '$year' AND MONTH(cons_date) = '$month' AND '$day_plan'<cons_time AND cons_time<='$peak_plan')";
    $result_peak = mysqli_query($con, $query_peak); 
    $row_peak = mysqli_fetch_assoc($result_peak); 
    $sum1 = $row_peak['cons_peak']; //sum of consumption in peak time

    //get off_peak time sum
    $query_off_peak = "SELECT SUM(cons_amount) AS cons_off_peak FROM consumption_table WHERE (con_id = '$con_id' AND YEAR(cons_date) = '$year' AND MONTH(cons_date) = '$month' AND '$peak_plan'>cons_time AND cons_time<='$off_peak_plan')";
    $result_off_peak = mysqli_query($con, $query_off_peak); 
    $row_off_peak = mysqli_fetch_assoc($result_off_peak); 
    $sum2 = $row_off_peak['cons_off_peak']; //sum of consumption in off peak time

    //get day time sum
    $query_day = "SELECT SUM(cons_amount) AS cons_day FROM consumption_table WHERE (con_id = '$con_id' AND YEAR(cons_date) = '$year' AND MONTH(cons_date) = '$month' AND  cons_time>'$off_peak_plan' AND cons_time<='$day_plan')";
    $result_day = mysqli_query($con, $query_day); 
    $row_day = mysqli_fetch_assoc($result_day); 
    $sum3 = $row_day['cons_day']; //sum of consumption in day time


    $x=$sum1/($sum1+$sum2+$sum3)*360;
    $y=$sum2/($sum1+$sum2+$sum3)*360;
    $z=$sum3/($sum1+$sum2+$sum3)*360;

    $rating_data = array(array('Employee', 'Rating'),array('Peak',$x),array('Off Peak',$y),array('Day',$z));
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