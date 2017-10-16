<?php
	session_start();
	if(!isset($_SESSION["consumer_id"])){
		header("Location: http://localhost:8080/Project/php/consumerLogin.php");
	}
?>

<?php
	//take data from database for display consumer's personal details

	$con_id = $_SESSION["consumer_id"];
	mysql_connect("localhost","root","") or die ("Could not connect to the server");
		mysql_select_db("electricity_data") or die ("That databae could not be found!");
		$query = mysql_query("SELECT * FROM consumer_table WHERE con_id='$con_id'") or die ("The query could not be completed.");
		if(mysql_num_rows($query)!=1){
		die("That consumer Id could not be found!");
	}
		while($row = mysql_fetch_array($query, MYSQL_ASSOC)){
			$con_id1 = $row['con_id'];
			$con_title1 = $row['con_title'];
			$con_name1 = $row['con_name'];
			$con_nic1 = $row['con_nic'];
			$con_address1 = $row['con_address'];
			$con_contact1 = $row['con_contact'];
			$con_email1 = $row['con_email'];
			$con_premises1 = $row['premises_id'];
			$con_tariff1 = $row['tariff_id'];
			$con_password1 = $row['con_password'];
		}	
?>

<?php
	//get previous month bill information
	$con = mysqli_connect("localhost","root","","electricity_data");
	$get_pre_bill_info = "SELECT * FROM electricity_bill_table WHERE con_id='$con_id1'";
	$display_units = mysqli_query($con, $get_pre_bill_info);
?>

<?php
	//take previous meter reading
	$con_id = $_SESSION["consumer_id"];
	$year = date("Y");
	$month = date("m");

	$con = mysqli_connect("localhost","root","","electricity_data");

	$sql_previous = "SELECT SUM(cons_amount) AS previous_con FROM consumption_table WHERE con_id='$con_id' AND cons_year <= '$year' cons_month < '$month' ";
	
	$result_pre = mysqli_query($con, $sql_previous);
	// $row_pre = mysqli_fetch_assoc($result_pre);
	// $previous_meter_reading = $row_pre['previous_con'];
	// echo $previous_meter_reading;

		$con->close();
?>
<?php

/*create electrcity bill*/
$con=mysqli_connect("localhost","root","","electricity_data");//make connection

$con_id = $_SESSION["consumer_id"];
$year = date("Y");
$month = date("m");

$tariff = $con_tariff1;
$tariff_id = $con_tariff1;
//$tariff = 'GP-2';//fpr testing
$count = 0;
$i=0;
$gap=0;
$total = 0;
$total1=0;
$total2=0;
$remain=0;

$remain_payment=0;
$total_bill = 0;
$pre_month_bill=0;
//$bill_adj = 0;
$bill_sum = 0;
$payment_sum = 0;

$day_plan=0;
$off_peak_plan=0;
$peak_plan=0;

//for get sum of this monthly electricity consumption
$sql = "SELECT SUM(cons_amount) AS amount_sum FROM consumption_table WHERE con_id = '$con_id' AND YEAR(cons_date) = '$year' AND MONTH(cons_date) = '$month' ";
$result = mysqli_query($con, $sql); 
$row = mysqli_fetch_assoc($result); 
$sum = $row['amount_sum']; //sum of monthly electricity consumption
$sum_assign = $sum;
//echo $sum_assign;

//for get sum of previous months electricity consumption
$sql_pre = "SELECT SUM(cons_amount) AS pre_con_sum FROM consumption_table WHERE con_id = '$con_id' AND YEAR(cons_date) <= '$year' AND MONTH(cons_date) < '$month' ";
$result_pre = mysqli_query($con, $sql_pre); 
$row_pre = mysqli_fetch_assoc($result_pre); 
$pre_con_sum = $row_pre['pre_con_sum']; //sum of monthly electricity consumption
$pre_meter_reading = 1000000 + $pre_con_sum; //previous month meter reading

$this_meter_reading = $pre_meter_reading + $sum;


// //for get sum of electrcity bills
// $sql_bill = "SELECT SUM(bill_amount) AS bill_sum FROM consumer_payment WHERE con_id = '$con_id'";
// $result_bill = mysqli_query($con, $sql_bill); 
// $row_bill = mysqli_fetch_assoc($result_bill); 
// $bill_sum = $row_bill['bill_sum']; //sum of monthly electricity consumption


// //for get adjustments
// $sql_adj = "SELECT SUM(payment_value) AS payment_sum FROM consumer_payment WHERE con_id = '$con_id'";
// $result_adj = mysqli_query($con, $sql_adj); 
// $row_adj = mysqli_fetch_assoc($result_adj); 
// $bill_adj = $row_adj['payment_sum']; //sum of monthly electricity consumption

// $outstanding = $bill_sum - $bill_adj;//assign outstanding amount

//get remain payment amount
$sql_remain = "SELECT remain FROM consumer_payment WHERE con_id='$con_id' AND year<'$year' AND month<'$month' ORDER BY payment_id DESC LIMIT 1 ";
$result_remain = mysqli_query($con, $sql_remain);
if($row_remain = mysqli_fetch_assoc($result_remain)){
	
	$remain_payment = $row_remain['remain'];
}
else{
	$remain_payment=0;
}

//for get previous month issue bill amount
$sql_sum = "SELECT SUM(total_amount) AS bill_sum FROM electricity_bill_table WHERE ( con_id='$con_id' AND year <= '$year' AND month < '$month')";
$result_sum = mysqli_query($con, $sql_sum); 
$row_sum = mysqli_fetch_assoc($result_sum); 
$bill_sum = $row_sum['bill_sum']; //sum of previous outstanding bills total

//sum of bill payments
//for get sum of electrcity bills
$sql_pay = "SELECT SUM(payment_value) AS payment_sum FROM consumer_payment WHERE con_id = '$con_id'";
$result_pay_sum = mysqli_query($con, $sql_pay); 
$row_pay = mysqli_fetch_assoc($result_pay_sum); 
$payment_sum = $row_pay['payment_sum']; //sum of monthly electricity consumption

$pre_month_bill = $bill_sum - $payment_sum;

$outstanding = $remain_payment + $pre_month_bill;
//echo $outstanding;


/***********************************************************************************************/

//get tariff data to array
$tariffUnitArray = array(); //array for keep tariff unit table details
$tariffTimeArray = array(); //array for keep tariff time table details

//calculate electricity bill
if($tariff != "GP-2" || $tariff !="GP-3" || $tariff != "H-2" || $tariff != "H-3" || $tariff != "I-2" || $tariff !="I-3" || $tariff != "$tariff"){

	if($tariff=='D-1'){
		if($sum<=60){
			//calculate D-1 and sum less than 60 bill
				$tariffUnitArrayD = array();
		
				$query_D0 = mysqli_query($con, "SELECT * FROM tariff_unit_table WHERE tariff_unit_id ='D-0' ");
				
				while($row = mysqli_fetch_assoc($query_D0)){
				
					$tariffUnitArrayD[] = array('tariff_id'=>$row['tariff_unit_id'], 'min'=>$row['start_unit'], 'max'=>$row['end_unit'], 'unit_charge'=> $row['unit_charge'], 'fixed_charge'=> $row['fixed_charge'], 'demand_charge'=> $row['demand_charge']);
					$count++;
				}
				
				$tariffUnitArrayD[-1]['max']=0;
				while($i<$count){
					$gap = $tariffUnitArrayD[$i]['max'] - $tariffUnitArrayD[$i-1]['max'];
					if($sum<=$gap && $sum>0){
						$total1 += ($sum*$tariffUnitArrayD[$i]['unit_charge'])+($tariffUnitArrayD[$i]['fixed_charge']+$tariffUnitArrayD[$i]['demand_charge']);
						$sum = 0;
					}
					if($sum>$gap && $sum>0){
						//$remain = $sum-$gap;
						$total2 += (($tariffUnitArrayD[$i]['max']-$tariffUnitArrayD[$i-1]['max'])*$tariffUnitArrayD[$i]['unit_charge'])+($tariffUnitArrayD[$i]['fixed_charge']+$tariffUnitArrayD[$i]['demand_charge']);
						$remain = $sum - ($tariffUnitArrayD[$i]['max']-$tariffUnitArrayD[$i-1]['max']);
						$sum=$remain;
					}
					$i++;
				}
				$total += $total1+$total2;
			
		}
		else{//grater than 60 and D-1
			$query_D = mysqli_query($con, "SELECT * FROM tariff_unit_table WHERE tariff_unit_id ='D-1' ");
			
			while($row = mysqli_fetch_assoc($query_D)){
			
				$tariffUnitArray[] = array('tariff_id'=>$row['tariff_unit_id'], 'min'=>$row['start_unit'], 'max'=>$row['end_unit'], 'unit_charge'=> $row['unit_charge'], 'fixed_charge'=> $row['fixed_charge'], 'demand_charge'=> $row['demand_charge']);
				$count++;
			}
			
			$tariffUnitArray[-1]['max']=0;

			while($i<$count){

				$gap = $tariffUnitArray[$i]['max'] - $tariffUnitArray[$i-1]['max'];

				if($sum<=$gap && $sum>0){
					$total1 += ($sum*$tariffUnitArray[$i]['unit_charge'])+($tariffUnitArray[$i]['fixed_charge']+$tariffUnitArray[$i]['demand_charge']);
					$sum = 0;
				}
				if($sum>$gap && $sum>0){
			
					$total2 += (($tariffUnitArray[$i]['max']-$tariffUnitArray[$i-1]['max'])*$tariffUnitArray[$i]['unit_charge'])+($tariffUnitArray[$i]['fixed_charge']+$tariffUnitArray[$i]['demand_charge']);
					$remain = $sum - ($tariffUnitArray[$i]['max']-$tariffUnitArray[$i-1]['max']);
					$sum=$remain;
				}
				$i++;
			}
			$total += $total1+$total2;
		
		}
	
		}

	else{//other tariffs
		$query_D = mysqli_query($con, "SELECT * FROM tariff_unit_table WHERE tariff_unit_id ='$tariff' ");
		
		while($row = mysqli_fetch_assoc($query_D)){
		
			$tariffUnitArray[] = array('tariff_id'=>$row['tariff_unit_id'], 'min'=>$row['start_unit'], 'max'=>$row['end_unit'], 'unit_charge'=> $row['unit_charge'], 'fixed_charge'=> $row['fixed_charge'], 'demand_charge'=> $row['demand_charge']);
			$count++;
			
		}
		
		$tariffUnitArray[-1]['max']=0;

		while($i<$count){

			$gap = $tariffUnitArray[$i]['max'] - $tariffUnitArray[$i-1]['max'];

			if($sum<=$gap && $sum>0){
				$total1 += ($sum*$tariffUnitArray[$i]['unit_charge'])+($tariffUnitArray[$i]['fixed_charge']+$tariffUnitArray[$i]['demand_charge']);
				$sum = 0;
			}
			if($sum>$gap && $sum>0){
		
				$total2 += (($tariffUnitArray[$i]['max']-$tariffUnitArray[$i-1]['max'])*$tariffUnitArray[$i]['unit_charge'])+($tariffUnitArray[$i]['fixed_charge']+$tariffUnitArray[$i]['demand_charge']);
				$remain = $sum - ($tariffUnitArray[$i]['max']-$tariffUnitArray[$i-1]['max']);
				$sum=$remain;
			}
			$i++;
		}
		$total += $total1+$total2;
	}
}

//calculate tariff time electricity bill
	if($tariff_id == "GP-2" || $tariff_id =="GP-3" || $tariff_id == "H-2" || $tariff_id == "H-3" || $tariff_id == "I-2" || $tariff_id =="I-3" || $tariff_id == "D-2"){
							
	//assign tariff time table values to variables
	$query_time = mysqli_query($con, "SELECT * FROM tariff_time_table WHERE tariff_time_id ='$tariff_id' ");
								
	while($row = mysqli_fetch_array($query_time, MYSQL_ASSOC)){
		$tariff_id1 = $row['tariff_time_id'];
		$peak = $row['peak'];
		$off_peak = $row['off_peak'];
		$day = $row['day'];
		$fixed_charge1 = $row['fixed_charge'];
		$demand_charge1 = $row['demand_charge'];
									}
							
		//assign time plan table values to variables
		$query_plan = mysqli_query($con, "SELECT * FROM time_plan WHERE time_plan_id ='plan_01' ");
								
		while($row_plan = mysqli_fetch_array($query_plan, MYSQL_ASSOC)){
		$peak_plan = $row_plan['peak'];
		$off_peak_plan = $row_plan['off_peak'];
		$day_plan = $row_plan['day'];
		$implement_plan = $row_plan['implement_date'];
		}
					
		//get peak time sum
		$query_peak = "SELECT IFNULL(SUM(cons_amount),0) AS cons_peak FROM consumption_table WHERE (con_id = '$con_id' AND YEAR(cons_date) = '$year' AND MONTH(cons_date) = '$month' AND '$day_plan'<cons_time AND cons_time<='$peak_plan')";
		$result_peak = mysqli_query($con, $query_peak); 
		$row_peak = mysqli_fetch_assoc($result_peak); 
		$sum1 = $row_peak['cons_peak']; //sum of consumption in peak time
		$total_peak = ($sum1*$peak); //get peak bill
					
		//get off_peak time sum
		$query_off_peak = "SELECT IFNULL(SUM(cons_amount),0) AS cons_off_peak FROM consumption_table WHERE (con_id = '$con_id' AND YEAR(cons_date) = '$year' AND MONTH(cons_date) = '$month' AND '$peak_plan'>cons_time AND cons_time<='$off_peak_plan')";
		$result_off_peak = mysqli_query($con, $query_off_peak); 
		$row_off_peak = mysqli_fetch_assoc($result_off_peak); 
		$sum2 = $row_off_peak['cons_off_peak']; //sum of consumption in off peak time
		$total_off_peak = ($sum2*$off_peak);
					
		//get day time sum
		$query_day = "SELECT IFNULL(SUM(cons_amount),0) AS cons_day FROM consumption_table WHERE (con_id = '$con_id' AND YEAR(cons_date) = '$year' AND MONTH(cons_date) = '$month' AND  cons_time>'$off_peak_plan' AND cons_time<='$day_plan')";
		$result_day = mysqli_query($con, $query_day); 
		$row_day = mysqli_fetch_assoc($result_day); 
		$sum3 = $row_day['cons_day']; //sum of consumption in day time
		$total_day = ($sum3*$day);
								
		$sum = $sum1+$sum2+$sum3; //total monthly consumption
		$total = $total_peak+$total_off_peak+$total_day+($fixed_charge1 + $demand_charge1);
		//echo $totalBill = $total + $outstanding;
			
		}
		//end of calculate tariff time electricity bill

		$total_bill = $total + $outstanding;// calculate total bill
		$con->close();
?>

<?php
	//get daily consumption for display daily consumption table
	$con_id = $_SESSION["consumer_id"];
	$year = date("Y");
	$month = date("m");
	$d = date("t");
	//$i=1;
	$day_con = 0;

	$con=mysqli_connect("localhost","root","","electricity_data");
	$dataPoints = array(array());

	for($i=1;$i<=$d;$i++){
		$sql_con = "SELECT SUM(cons_amount) AS con_tot FROM consumption_table WHERE con_id='$con_id' AND YEAR(cons_date)='$year' AND MONTH(cons_date)='$month' AND DAY(cons_date)='$i'";
		$result_con = mysqli_query($con, $sql_con);
		$row_con = mysqli_fetch_assoc($result_con);
		$day_con = $row_con['con_tot'];

		$dataPoints[$i]["y"] = $day_con;
		$dataPoints[$i]["label"] = $i;

	}
    // $con=mysqli_connect("localhost","root","","electricity_data");
    // $sql = "SELECT cons_amount FROM consumption_table WHERE con_id='$con_id' AND YEAR(cons_date)='$year' AND MONTH(cons_date)='$month'";
    // if ($result=mysqli_query($con,$sql))
    // {
    // // Fetch one and one row
    // $dataPoints = array(array());
    // $i=0;
    // while($row = $result->fetch_row()) {

    //         $dataPoints[$i]["y"]=$row[0];
    //         $dataPoints[$i]["label"]=$i+1;
    //         $i++;
            
    //     }
	// }
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" href="images/ceb.png">
<title>Electricity Bill Management System/Consumer Home page</title>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="css/bootstrap1.css" rel="stylesheet" type="text/css">
<link href="css/consumerPageStyle.css" rel="stylesheet" type="text/css">

<!--jquery files for display monthly consumption table-->
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script src="./js/jquery-3.2.1.min.js"></script>

<script>
//show and hide table shown button
	var tariff = "<?php echo $tariff_id; ?>";
	if(tariff == 'GP-2' || tariff == 'GP_3' || tariff == 'H-2' || tariff == 'H-3' || tariff == 'I-2' || tariff == 'I-3' || tariff == 'D-2'){
		$(document).ready(function(){
  	  		$('.button').show();
		});
		$('#btn2').Show();
	}
	if(tariff != 'GP-2' || tariff != 'GP_3' || tariff != 'H-2' || tariff != 'H-3' || tariff != 'I-2' || tariff != 'I-3' || tariff != 'D-2'){
		$(document).ready(function(){
			$('#btn1').show();
		});
	}
	
	
</script>

<script type="text/javascript">
	function pay_bill(){
	
		var payment=$("#payment").val();
		var year="<?php echo date('Y'); ?>";
		var month="<?php echo date('m'); ?>";
		var total_bill="<?php echo $total_bill; ?>";
		var con_id="<?php echo $con_id1; ?>";
		//var data2=$("#pwd").val();
		var dataTosend='payment='+payment+'&year='+year+'&month='+month+'&total_bill='+total_bill+'&con_id='+con_id;
		$.ajax({
			url: 'php/addPayment.php',
			type: 'POST',
			data:dataTosend,
			async: true,
			success: function (data) {
				alert(data);
			},
		});
		
	}
		$(document).ready(function(){
			$( "#closeBtn" ).click(function() {
    		location.reload();
    	});
		});
</script>


</head>
<body style="padding-top: 70px" background="images/10.jpg">
<!--<p style="color:#a04000;">&nbsp;&nbsp;&nbsp;Hi, Deshan Hasantha...</p>-->
<div role="tabpanel">
  <div role="tabpanel">
    <div role="tabpanel">
      <ul class="nav nav-tabs" role="tablist">
		<li class="active"><a href="#panelOne" data-toggle="tab" role="tab"><b>Profile</b></a></li>
        <li><a href="#panelTwo" data-toggle="tab" role="tab"><b>Electricity Consumption Info</b></a></li>
        <li><a href="#panelThree" data-toggle="tab" role="tab"><b>Monthly Electricity Bill</b></a></li>
        <!--<li><a href="#panelFour" data-toggle="tab" role="tab"><b>Reconnecting Info</b></a></li>-->
		<li><a href="#panelFive" data-toggle="tab" role="tab"><b>Send Messages/Feedbacks</b></a></li>
      </ul>
      <div id="tabContent1" class="tab-content">
	  
		<div class="tab-pane fade in active" id="panelOne">
		</br>
          <div class="modal-dialog">
			<div class="loginmodal-container">
				<p align="center"><h3 style="color:#003366; font-size:18px font-family:'Gill Sans', 'Gill Sans MT', 'Myriad Pro', 'DejaVu Sans Condensed', Helvetica, Arial, sans-serif;" align="center">Your Account Details</h3></p><br>
                <!--Show consumer details by taking database data-->
				<form>
                <table width="400" align="center">
					<tr>
						<td><p><font size="3" color="#800080">Your ID : </font></p></td>
						<td><p><font size="3" color="#800080"><?php echo $con_id1;?></font></p></td>
					</tr>
					<tr>
						<td><p><font size="3" color="#800080">Name : </font></p></td>
						<td><font size="3" color="#800080"><?php echo $con_name1;?></font></p></td>
					</tr>
					<tr>
						<td><font size="3" color="#800080">NIC : </font></p></td>
						<td><font size="3" color="#800080"><?php echo $con_nic1;?></font></p></td>
					</tr>
					<tr>
						<td><font size="3" color="#800080">Address :</font></p></td>
						<td><font size="3" color="#800080"><?php echo $con_address1;?></font></p></td>
					</tr>
					<tr>
						<td><font size="3" color="#800080">Mobile Number : </font></p></td>
						<td><font size="3" color="#800080"><?php echo $con_contact1;?></font></p></td>
					</tr>
					<tr>
						<td><font size="3" color="#800080">Email Address : </font></p></td>
						<td><font size="3" color="#800080"><?php echo $con_email1;?></font></p></td>
					</tr>
					<tr>
						<td><font size="3" color="#800080">Premises ID : </font></p></td>
						<td><font size="3" color="#800080"><?php echo $con_premises1;?></font></p></td>
					</tr>
					<tr>
						<td><font size="3" color="#800080">Tariff : </font></p></td>
						<td><font size="3" color="#800080"><?php echo $con_tariff1;?></font></p></td>
					</tr>
					<tr>
						<td><font size="3" color="#800080">Password : </font></p></td>
						<td><font size="3" color="#800080"><?php echo $con_password1;?></font></p></td>
					</tr>
				</table>
				</form>
			</div>
            </div>
			</br>
			
			<div class="modal-dialog">
				<div class="loginmodal-container">
					<p align="center"><h3 style="color:#003366; font-size:18px font-family:'Gill Sans', 'Gill Sans MT', 'Myriad Pro', 'DejaVu Sans Condensed', Helvetica, Arial, sans-serif;" align="center">Change your password</h3></p><br>
					<!--Change the password-->
					<form id="form_password" method="GET">
                <table width="400" border="0" align="center">
					<tbody>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;<input type="hidden" id="con_id" name="con_id" value="<?php echo $con_id; ?>"></td>
							</tr>
						<tr>
							<td>&nbsp;<label>Old password :</label></td>
							<td>&nbsp;</td>
							<td>&nbsp;<input type="password" id="oldPassword" name="oldPassword" required></td>
							<td>&nbsp;<p style="font-style:bold; color: #fa3d4c;"><label id=""></label></p></td>
						</tr>
						<tr>
							<td>&nbsp;<label>New Password :</label></td>
							<td>&nbsp;</td>
							<td>&nbsp;<input type="password" name="newPassword" id="newPassword" required ></td>
							<td>&nbsp;<p style="font-style:bold; color: #fa3d4c;"><label id=""></label></p></td>
						</tr>
						<tr>
							<td>&nbsp;<label>Conform Password :</label></td>
							<td>&nbsp;</td>
							<td>&nbsp;<input type="password" name="newPassword1" id="newPassword1" required></td>
							<td>&nbsp;<p style="font-style:bold; color: #fa3d4c;"><label id="error_msg"></label></p></td><!--display error msg-->
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;<button type="button" class="btn btn-sm btn-default" align="center" name="change" id="change" onClick="pass_validate();">Change</button></td>
							<td>&nbsp;</td>
						</tr>
					</tbody>
				</table>
				</form>
				</div>
				</div>
        </div>
		
		
        <div class="tab-pane fade" id="panelTwo">
		<br>
		<button type="button" id="btn1" class="btn-success" onclick="load_table();" style="margin-left: 34px;padding-top: 6px;padding-bottom: 6px; margin-bottom: 35px; display:none;">Load Daily Consumption</button>
		<button class="button" id="btn2" class="btn-success" style="margin-left: 20px;padding-top: 6px;padding-bottom: 6px; display:none;" onclick="location.href='http://localhost:8080/project/php/chart.php';">Load Monthly Consumption - Time Based</button><br>
		
		<div id="chartContainer"></div>
			<script type="text/javascript">
 
            function load_table(){$(function () {
                var chart = new CanvasJS.Chart("chartContainer", {
                    theme: "theme2",
                    animationEnabled: true,
                    title: {
                        text: "Daily Electricity Consumption Data"
                    },
                    data: [
                    {
                        type: "column",                
                        dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                    }
                    ]
                });
                chart.render();
            });}
        </script>
        </div>
        
        <div class="tab-pane fade" id="panelThree">
		
		<div role="tabpanel">
		<!-- Modal for display payment window-->
		<div class="modal fade" id="myModal" role="dialog">
		<div class="modal-dialog">
			
		<!-- Modal content-->
		<div class="modal-content">
		<form id="paymentSheet" method="POST" action="">
				<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"><h4>Payment Sheet</h4>
				</div>
				<div class="modal-body">
				<form id="payment form">
					<div class="row">
						<div class="col-sm-8" style="left: 28px;padding-top: 15px;padding-bottom: 7px;">
							Consumer ID: &nbsp;<b><?php echo $con_id1; ?></b>
						</div>
						<div class="col-sm-4" style="left: 74px;">
							<?php echo date("Y/m/d"); ?>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-8" style="left: 28px;padding-top: 3px;">
							Consumer Name: &nbsp;<b><?php echo $con_name1; ?></b>
						</div>
						<div class="col-sm-4">
							
						</div>
					</div>
					<div class="row">
						<div class="col-sm-8" style="left: 28px;padding-top: 3px;top: 5px;">
							Month: &nbsp;<b><?php echo date('Y')."/"; ?><?php echo date('M'); ?></b>
						</div>
						<div class="col-sm-4">
							
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-sm-12">
							<h4 style="font:red; margin-top: 45px;">Total Amount Due: &nbsp;&nbsp;<?php echo sprintf("%.2f", $total_bill); ?></h4>
						</div>
					</div>
					
					<div class="input-group col-sm-6" style="margin-left:50%; margin-top:40px;">
						<span class="input-group-addon">Rs.</span>
						<input type="text" id="payment" class="form-control" aria-label="Amount (to the nearest dollar)"><span class="input-group-addon">.00</span>
					</div>
					<div class="input-group col-sm-6" style="margin-left:50%; margin-top:40px;">
						<button type="button" id="payBtn" style="margin-left: 130px;" onclick="pay_bill();">Pay</button>
					</div>
			
				</form>
				</div>
				<div class="modal-footer" style="margin-top:30px;">
				<button type="button" id="closeBtn" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
			</form>
			
		</div>
		</div>
            <ul class="nav nav-tabs" role="tablist">
              <li class="active"><a href="#panelThree-1" data-toggle="tab" role="tab">Electricity Bill for this Month</a></li>
              <li><a href="#panelThree-2" data-toggle="tab" role="tab">Previous Bill Info</a></li>
			  <li><a href="#panelThree-3" data-toggle="tab" role="tab" onclick="lockPay()">Monthly Bill Payment</a></li>
			  <li><a href="#panelThree-4" data-toggle="tab" role="tab">Previous Bill Payment</a></li>
            </ul>
            <div id="tabContent2" class="tab-content">
			<!--Electricity bill generate-->
              <div class="tab-pane fade in active" id="panelThree-1">
                <div class="modal-dialog1">
				<div class="loginmodal-container">
					<p align="center"><h3 style="color:#003366; font-size:18px font-family:'Gill Sans', 'Gill Sans MT', 'Myriad Pro', 'DejaVu Sans Condensed', Helvetica, Arial, sans-serif;" align="center"></h3></p><br>


				<table align="center" width="600" frame="box" style="padding: 200px;">
            	<tr bgcolor="#800000">
            		<th bgcolor="#800000" colspan="2" style="height: 80px;">
            			<p align="center" style="margin-top:10px;"><img src="images/statement1.png"></p>
            		</th>
            	</tr>
            	<tr>
            		<td bgcolor="#F7FCB1"><p><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Month :</b>&nbsp;<?php echo date('Y') ?> - <?php echo date('m') ?>
					<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Tariff :</b>&nbsp;<?php echo $con_tariff1;?></p>
					<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Premises ID :</b>&nbsp;<?php echo $con_premises1;?></p>
					</td>
					<td bgcolor="#F7FCB1" style="width:175px"><p align="left" style=""><br><br><b>Area Office:</b> Monaragala</p>
					<b>Electricity Account No :</b>&nbsp;<?php echo $con_id1;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
					</td>
            	</tr>
				<tr>
            		<td bgcolor="#F7FCB1"></td>
					<td bgcolor="#F7FCB1"></td>
            	</tr>
				<tr>
            		<td bgcolor="#F7FCB1"></td>
					<td bgcolor="#F7FCB1"></td>
            	</tr>
				<tr>
            		<td bgcolor="#F7FCB1"><p style="padding-left:50px"><br><b><i><?php echo $con_title1; ?>.&nbsp;<?php echo $con_name1;?></i></b></p></td>
					<td bgcolor="#F7FCB1"><p></p></td>
            	</tr>
				<tr>
            		<td bgcolor="#F7FCB1"><p style="padding-left:50px"><b><i><?php echo $con_address1;?></i></b><br><br></p></td>
					<td bgcolor="#F7FCB1"><p></p></td>
            	</tr>
				<tr bgcolor="#F7FCB1">
					<td colspan="2">
						<table border="2" align="center" width="400">
							<tr>
								<th><p align="center">Date</p></th>
								<th><p align="right">Meter Reading&nbsp;</p></th>
							</tr>
							<tr>
								<td><p align="center"><?php echo date("Y-M-d");?></p></td>
								<td><p align="right"><?php echo $this_meter_reading;?>&nbsp;</p></td>	
							</tr>
							<tr>
								<td><p align="center"><?php 
									echo date("Y-M-d", strtotime("last day of previous month"));
									?></p></td>
								<td><p align="right"><?php echo $pre_meter_reading;?>&nbsp;</p></td>	
							</tr>
							<tr>
								<td><p align="center">No. of units consumed</p></td>
								<td><p align="right"><b><font style="color:#FA5858;"><?php echo $sum_assign; ?>&nbsp;</font></b></p></td>	
							</tr>
						</table>
						<br>
						
					<table width="100%" class="table table-hover">
                    <thead>
                        <tr>
                            <th></th>
                            <th></th>
                            <th class="text-center">No. unit</th>
                            <th class="text-right">Total&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="col-md-9"><b><em>Charge for electricity consumed (Rs.)</em></b></td>
                            <td class="col-md-1" style="text-align: center"></td>
                            <td class="col-md-1 text-center"><?php echo $sum_assign; ?></td>
                            <td class="col-md-1 text-right"><?php echo sprintf("%.2f", $total); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        </tr>
                        <tr>
                            <td class="col-md-9"><b><em>Adjustment/Rebates (Rs.)</em></b></td>
                            <td class="col-md-1" style="text-align: center"></td>
                            <td class="col-md-1 text-center"></td>
							<td class="col-md-1 text-right"><?php
								$tax = 0;
								echo sprintf("%.2f", $tax);
							?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        </tr>
                        <tr>
                            <td class="col-md-9"><b><em>Outstanding amount (Rs.)</em></b></td>
                            <td class="col-md-1" style="text-align: center"></td>
                            <td class="col-md-1 text-center"></td>
                            <td class="col-md-1 text-right"><?php echo sprintf("%.2f", $outstanding); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        </tr>
						<tr>
                            <td class="col-md-9"><b><em>Total Amount due (Rs.)</em></b></h4></td>
                            <td class="col-md-1" style="text-align: center"></td>
                            <td class="col-md-1 text-center"></td>
                            <td class="col-md-1 text-right">
								<?php 
									
									echo sprintf("%.2f", $total_bill);?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        </tr>
                        <!--<tr>
                            <td>   </td>
                            <td>   </td>
                            <td class="text-right">
                            <p>
                                <strong>Subtotal: </strong>
                            </p>
                            <p>
                                <strong>Tax: </strong>
                            </p></td>
                            <td class="text-center">
                            <p>
                                <strong>$6.94</strong>
                            </p>
                            <p>
                                <strong>$6.94</strong>
                            </p></td>
                        </tr>-->
                        <tr>
                            <td>   </td>
                            <td>   </td>
                            <td class="text-right"><h4><strong>Total: </strong></h4></td>
                            <td class="text-center text-danger"><h4><strong>Rs.&nbsp;<?php echo sprintf("%.2f", $total_bill); ?>&nbsp;&nbsp;&nbsp;&nbsp;</strong></h4></td>
                        </tr>
                    </tbody>
                </table>
				
					</td>
				</tr>
				<tr>
            		<td bgcolor="#F7FCB1"><p><br><br></p></td>
					<td bgcolor="#F7FCB1"><p></p></td>
            	</tr>
				</table>
					<br>
					<!--<p align="right"><button type="button" class="btn btn-default" name="pay"   data-toggle="modal" data-target="#myModal">Pay Bill</button></p>-->
				</div>
				</div>
				</div>
			
              <div class="tab-pane fade" id="panelThree-2">
                   <div class="modal-dialog">
					<div class="loginmodal-container">
						<p align="center"><h3 style="color:#003366; font-size:18px font-family:'Gill Sans', 'Gill Sans MT', 'Myriad Pro', 'DejaVu Sans Condensed', Helvetica, Arial, sans-serif;" align="center">Previous Electricity Bills Info</h3></p><br>
						<table align="center" width="500" border="2">
							<tr bgcolor="#FFEEB8">
								<th><p align="center">Year</p></th>
								<th><p align="center">Month</p></th>
								<th><p align="center">Consumed units</p></th>
								<th><p align="center">Bill Amount</p></th>
								<th><p align="center">Outstanding</p></th>
								<th><p align="center">Total Amount</p></th>
							</tr>
							<?php
								if (mysqli_num_rows($display_units) > 0) {
									// output data of each row
									while($value = mysqli_fetch_assoc($display_units)) {
										echo "<tr>";
										echo "<td bgcolor='#F7FCB1'><p align='left'>&nbsp;&nbsp;".$value['year']."</td>";
										echo "<td bgcolor='#E5FCAB'><p align='right'>".$value['month']."&nbsp;&nbsp;</p></td>";
										echo "<td bgcolor='#E5FCAB'><p align='right'>".$value['consumption']."&nbsp;&nbsp;</p></td>";
										echo "<td bgcolor='#E5FCAB'><p align='right'>".$value['bill_amount']."&nbsp;&nbsp;</p></td>";
										echo "<td bgcolor='#E5FCAB'><p align='right'>".$value['outstanding']."&nbsp;&nbsp;</p></td>";
										echo "<td bgcolor='#E5FCAB'><p align='right'>".$value['total_amount']."&nbsp;&nbsp;</p></td>";
										echo "</tr>";
									}
								}
								//mysqli_close($con);
							?>
						</table>
					</div>
					</div>
              </div>
			  
			  <!--Electricity bill payments-->
			    <div class="tab-pane fade" id="panelThree-3">
                <div class="modal-dialog1">
				<div class="loginmodal-container">
					<p align="center"><h3 style="color:#003366; font-size:18px font-family:'Gill Sans', 'Gill Sans MT', 'Myriad Pro', 'DejaVu Sans Condensed', Helvetica, Arial, sans-serif;" align="center"></h3></p><br>


				<table align="center" width="600" frame="box" style="padding: 200px;">
            	<tr bgcolor="#800000">
            		<th bgcolor="#800000" colspan="2" style="height: 80px;">
            			<p align="center" style="margin-top:10px;"><img src="images/statement1.png"></p>
            		</th>
            	</tr>
            	<tr>
            		<td bgcolor="#F7FCB1"><p><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Month :</b>&nbsp;<?php echo date('Y') ?> - <?php echo date('m') ?>
					<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Tariff :</b>&nbsp;<?php echo $con_tariff1;?></p>
					<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Premises ID :</b>&nbsp;<?php echo $con_premises1;?></p>
					</td>
					<td bgcolor="#F7FCB1" style="width:175px"><p align="left" style=""><br><br><b>Area Office:</b> Monaragala</p>
					<b>Electricity Account No :</b>&nbsp;<?php echo $con_id1;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
					</td>
            	</tr>
				<tr>
            		<td bgcolor="#F7FCB1"></td>
					<td bgcolor="#F7FCB1"></td>
            	</tr>
				<tr>
            		<td bgcolor="#F7FCB1"></td>
					<td bgcolor="#F7FCB1"></td>
            	</tr>
				<tr>
            		<td bgcolor="#F7FCB1"><p style="padding-left:50px"><br><b><i><?php echo $con_title1; ?>.&nbsp;<?php echo $con_name1;?></i></b></p></td>
					<td bgcolor="#F7FCB1"><p></p></td>
            	</tr>
				<tr>
            		<td bgcolor="#F7FCB1"><p style="padding-left:50px"><b><i><?php echo $con_address1;?></i></b><br><br></p></td>
					<td bgcolor="#F7FCB1"><p></p></td>
            	</tr>
				<tr bgcolor="#F7FCB1">
					<td colspan="2">
						<table border="2" align="center" width="400">
							<tr>
								<th><p align="center">Date</p></th>
								<th><p align="right">Meter Reading&nbsp;</p></th>
							</tr>
							<tr>
								<td><p align="center"><?php echo date("Y-M-d");?></p></td>
								<td><p align="right"><?php echo $this_meter_reading;?>&nbsp;</p></td>	
							</tr>
							<tr>
								<td><p align="center"><?php 
									echo date("Y-M-d", strtotime("last day of previous month"));
									?></p></td>
								<td><p align="right"><?php echo $pre_meter_reading;?>&nbsp;</p></td>	
							</tr>
							<tr>
								<td><p align="center">No. of units consumed</p></td>
								<td><p align="right"><b><font style="color:#FA5858;"><?php echo $sum_assign; ?>&nbsp;</font></b></p></td>	
							</tr>
						</table>
						<br>
						
					<table width="100%" class="table table-hover">
                    <thead>
                        <tr>
                            <th></th>
                            <th></th>
                            <th class="text-center">No. unit</th>
                            <th class="text-right">Total&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="col-md-9"><b><em>Charge for electricity consumed (Rs.)</em></b></td>
                            <td class="col-md-1" style="text-align: center"></td>
                            <td class="col-md-1 text-center"><?php echo $sum_assign; ?></td>
                            <td class="col-md-1 text-right"><?php echo sprintf("%.2f", $total); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        </tr>
                        <tr>
                            <td class="col-md-9"><b><em>Adjustment/Rebates (Rs.)</em></b></td>
                            <td class="col-md-1" style="text-align: center"></td>
                            <td class="col-md-1 text-center"></td>
							<td class="col-md-1 text-right"><?php
								$tax = 0;
								echo sprintf("%.2f", $tax);
							?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        </tr>
                        <tr>
                            <td class="col-md-9"><b><em>Outstanding amount (Rs.)</em></b></td>
                            <td class="col-md-1" style="text-align: center"></td>
                            <td class="col-md-1 text-center"></td>
                            <td class="col-md-1 text-right"><?php echo sprintf("%.2f", $outstanding); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        </tr>
						<tr>
                            <td class="col-md-9"><b><em>Total Amount due (Rs.)</em></b></h4></td>
                            <td class="col-md-1" style="text-align: center"></td>
                            <td class="col-md-1 text-center"></td>
                            <td class="col-md-1 text-right">
								<?php 
									
									echo sprintf("%.2f", $total_bill);?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        </tr>
                        <!--<tr>
                            <td>   </td>
                            <td>   </td>
                            <td class="text-right">
                            <p>
                                <strong>Subtotal: </strong>
                            </p>
                            <p>
                                <strong>Tax: </strong>
                            </p></td>
                            <td class="text-center">
                            <p>
                                <strong>$6.94</strong>
                            </p>
                            <p>
                                <strong>$6.94</strong>
                            </p></td>
                        </tr>-->
                        <tr>
                            <td>   </td>
                            <td>   </td>
                            <td class="text-right"><h4><strong>Total: </strong></h4></td>
                            <td class="text-center text-danger"><h4><strong>Rs.&nbsp;<?php echo sprintf("%.2f", $total_bill); ?>&nbsp;&nbsp;&nbsp;&nbsp;</strong></h4></td>
                        </tr>
                    </tbody>
                </table>
				
					</td>
				</tr>
				<tr>
            		<td bgcolor="#F7FCB1"><p><br><br></p></td>
					<td bgcolor="#F7FCB1"><p></p></td>
            	</tr>
				</table>
					<br>
					<p align="right"><button type="button" class="btn btn-default" name="pay"   data-toggle="modal" data-target="#myModal">Pay Bill</button></p>
				</div>
				</div>
				</div>
				
				<!--Previous bill payment info-->
				<div class="tab-pane fade" id="panelThree-4">
                   <div class="modal-dialog">
					<div class="loginmodal-container">
						<p align="center"><h3 style="color:#003366; font-size:18px font-family:'Gill Sans', 'Gill Sans MT', 'Myriad Pro', 'DejaVu Sans Condensed', Helvetica, Arial, sans-serif;" align="center">Previous Electricity Bill Payments Info</h3></p><br>
						<table align="center" width="100%" border="2">
							<tr bgcolor="#FFEEB8">
								<th><p align="center">Payment Date</p></th>
								<th><p align="center">Bill Amount (Rs.)</p></th>
								<th><p align="center">Payment Amount (Rs.)</p></th>
								<th><p align="center">Remain (Rs.)</p></th>
							</tr>
							<?php
								$con = mysqli_connect("localhost","root","","electricity_data");
								$get_pre_payment = "SELECT * FROM consumer_payment WHERE con_id='$con_id1'";
								$display_payment = mysqli_query($con, $get_pre_payment);
								if (mysqli_num_rows($display_payment) > 0) {
									// output data of each row
									while($value = mysqli_fetch_assoc($display_payment)) {
										echo "<tr>";
										echo "<td bgcolor='#F7FCB1'><p align='center'>&nbsp;&nbsp;".$value['payment_date']."</td>";
										echo "<td bgcolor='#E5FCAB'><p align='right'>".$value['bill_amount']."&nbsp;&nbsp;</p></td>";
										echo "<td bgcolor='#E5FCAB'><p align='right'>".$value['payment_value']."&nbsp;&nbsp;</p></td>";
										echo "<td bgcolor='#E5FCAB'><p align='right'>".$value['remain']."&nbsp;&nbsp;</p></td>";
										echo "</tr>";
									}
								}
								//mysqli_close($con);
							?>
						</table>
					</div>
					</div>
              </div>
			
        </div>
		</div>
        </div>

        
        <!--<div class="tab-pane fade" id="panelFour">
        <div class="modal-dialog">
		<div class="loginmodal-container">
		<p align="center"><h3 style="color:#003366; font-size:18px font-family:'Gill Sans', 'Gill Sans MT', 'Myriad Pro', 'DejaVu Sans Condensed', Helvetica, Arial, sans-serif;" align="center">Reconnecting Payment</h3></p><br>
        	<form>
            <table width="400" border="1" align="center">
			<tbody>
			<tr>
				<td>Charge for electricity consumed (Rs.)</td>
				<td><p align="right">15000.00</p></td>
			</tr>
			<tr>
				<td>Payments/Adjustments/Rebates (Rs.)</td>
				<td><p align="right">100.00</p></td>
			</tr>
			<tr>
				<td>Charge for reconnecting (Rs.)</td>
				<td><p align="right">2500.00</p></td>
			</tr>
			<tr>
				<td>Total Amount due (Rs.)</td>
				<td><p style="color: #922b21; font-style:bold;"align="right">17400.00</p></td>
			</tr>
			</tbody>
			</table>
			</form>
			</div>
			</div>
			</div>-->
		
		<div class="tab-pane fade" id="panelFive">
        <div class="modal-dialog">
		<div class="loginmodal-container">
		<p><h3 style="color:#003366; font-size:18px font-family:'Gill Sans', 'Gill Sans MT', 'Myriad Pro', 'DejaVu Sans Condensed', Helvetica, Arial, sans-serif;" align="center">Messages &amp; Feedbacks</h3></p><br>
        	
			
			<label><b><?php echo "Date : " . date("Y/m/d") . " "; ?> &nbsp; &nbsp; <?php date_default_timezone_set("Asia/Colombo"); echo "Time :". date("h:i:s")."<br>";?></b><label>
			</br>
			
			<!--mesage textfield-->
			<form id="msg_form" method="POST" action="php/insertConsumerMessage.php">
			<input type="hidden" id="con_id" name="con_id" value="<?php echo $con_id; ?>" readonly />
			<div class="form-group">
            <table width="200" border="0">
			<tbody>
				<td><textarea id="message" name="message" cols="60" rows="6" placeholder="Enter your message."></textarea></td>
				<td></td>
			</tbody>
			</table>
			</div>
			<button type="submit" class="btn btn-default" align="center" name="send" onclick="submitForm()">Send</button>
			
			<script type="text/javascript">
			<!--Clear message form after send messages-->
				function submitForm() {
					document.getElementById("message").innerHTML="";
				}
			</script>
			</form>
			</div>
			</div>
			</div>
        
<nav class="navbar navbar-default navbar-fixed-top">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#topFixedNavbar1"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
        <a class="navbar-brand page-scroll" href="#page-top"><img src="images/consumerTitle.png" alt="Data Entry Clerk"></a></div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="topFixedNavbar1">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="home page.html">Home<span class="sr-only">(current)</span></a></li>
            <li><a href="http://www.ceb.lk/about-us/">About Us</a></li>
            <li><a href="http://www.ceb.lk/co-contact/">Contact Us</a></li>
            <li><a href="php/consumerLogout.php">Log out</a></li>
          </ul>
        </div>
        <!-- /.navbar-collapse -->
      </div>
      <!-- /.container-fluid -->
    </nav>
    
    <br>
    <footer style="align-content:center; text-align:center;">&copy; <i>Copyright Electricity Bill Management System All Rights Reserved</i></footer>
    <script src="js/jquery-1.11.2.min.js" type="text/javascript"></script>
    <script src="js/bootstrap.js" type="text/javascript"></script>
	<script src="js/main.js"</script>
	
	
	
  </div>
</div>
</div>
</div>

</body>
</html>
