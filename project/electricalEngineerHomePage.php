<?php
	session_start();
	if(!isset($_SESSION["emp_post"])){
		header("Location: http://localhost:8080/Project/php/staffLogin.php");
		
	}
?>

<?php
	//get daily consumption for display daily consumption table
	$year = date("Y");
	$month = date("m");
	$d = date("t");
	//$i=1;
	$day_con = 0;

	$con=mysqli_connect("localhost","root","","electricity_data");
	$dataPoints = array(array());

	for($i=1;$i<=$d;$i++){
		$sql_con = "SELECT SUM(cons_amount) AS con_tot FROM consumption_table WHERE YEAR(cons_date)='$year' AND MONTH(cons_date)='$month' AND DAY(cons_date)='$i'";
		$result_con = mysqli_query($con, $sql_con);
		$row_con = mysqli_fetch_assoc($result_con);
		$day_con = $row_con['con_tot'];

		$dataPoints[$i]["y"] = $day_con;
		$dataPoints[$i]["label"] = $i;

	}
?>

<?php
    require_once 'connection.php';
	
	//show transformer id
    $sql="SELECT transformer_id FROM transformer";
    $result=$conn->query($sql);

    if(mysqli_num_rows($result)){
        $trans_id_drop= '<select id ="transformer" name="transformer" style="width:175px; height:30px">';
		$trans_id_drop.='<option value=" ">--Select--</option>';
    while($rs = $result->fetch_assoc()){
      $trans_id_drop.='<option value="'.$rs['transformer_id'].'">'.$rs['transformer_id'].'</option>';
        }
    }
    $trans_id_drop.='</select>';
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" href="images/ceb.png">
<title>Electricity Bill Management System/Electrical Engineer Home page</title>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="css/bootstrap1.css" rel="stylesheet" type="text/css">
<link href="css/consumerPageStyle.css" rel="stylesheet" type="text/css">
<link href="css/handleStaffAccount.css" rel="stylesheet" type="text/css">
<script src="js/jquery-3.2.1.min.js"></script>
<!--jquery files for display monthly consumption table-->
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
    $("#loadReport").click(function(){
        $("#report1").slideDown(1500);
    });
    });

    function send_details(){
		var year=$("#year").val();
        var month=$("#month").val();
		var dataTosend='year='+year+'&month='+month;
		$.ajax({
			url: 'php/getConsumptionInfo.php',
			type: 'POST',
			data:dataTosend,
			async: true,
			success: function (data) {
				var data = JSON.parse(data);
				//alert(data);
				$('#con_unit_charge1').html(data.con_unit_charge1);
                $('#con_unit_total1').html(data.con_unit_total1);
                $('#con_time_total').html(data.con_time_total);
                $('#con_time_charge1').html(data.con_time_charge1);
                $('#peak_total').html(data.peak_total);
                $('#peak_charge1').html(data.peak_charge1);
                $('#off_peak_total').html(data.off_peak_total);
                $('#off_peak_charge1').html(data.off_peak_charge1);
                $('#day_total').html(data.day_total);
                $('#day_charge1').html(data.day_charge1);
                $('#total_unit').html(data.total_unit);
                $('#total_charge1').html(data.total_charge1);
                $('#charge').html(data.charge);
                $('#year1').html(data.year1);
                $('#month1').html(data.month1);
				// $('#re_total').val(data.recon_total);
			
			},
		});
	}

    function sendTransInfo(){
        var trans_id=$("#transformer").val();
		var fromDate=$("#fromDate").val();
        var toDate=$("#toDate").val();
		var dataTosend='trans_id='+trans_id+'&fromDate='+fromDate+'&toDate='+toDate;
		$.ajax({
			url: 'php/getTransformerData.php',
			type: 'POST',
			data:dataTosend,
			async: true,
			success: function (data) {
				//var data = JSON.parse(data);
				//alert(data);
				$('#report2').html(data);
                // $('#con_unit_total1').html(data.con_unit_total1);
         
				// $('#re_total').val(data.recon_total);
			
			},
		});
	}

//show transformer difference table
    $(document).ready(function(){
    $("#transBtn").click(function(){
        $("#report2").slideDown(1500);
    });
    });

    
</script>

</head>

<body style="padding-top: 70px;" background="images/admin_wallpaper.jpg">
<div role="tabpanel">
  <div role="tabpanel">
    <div role="tabpanel">
      <ul class="nav nav-tabs" role="tablist">
        <li class="active"><a href="#panelOne" data-toggle="tab" role="tab"><b>Monthly Consumption Report</b></a></li>
		<li><a href="#panelTwo" data-toggle="tab" role="tab"><b>Bar Charts</b></a></li>
		<li><a href="#panelThree" data-toggle="tab" role="tab"><b>Differentiation</b></a></li>
      </ul>
      <div id="tabContent1" class="tab-content">
        <div class="tab-pane fade in active" id="panelOne">
          <div class="modal-dialog1">
			<div class="loginmodal-container-report">
            <!--search bar-->
            <form id="form1" method="POST" action="">
            <table align="center" width="600" style="padding: 200px;">
                <tr colspan="3">
                    <h2 style="padding-bottom: 20px;margin-left: 42px;margin-bottom: 24px;">Get Monthly Electricity Consumption Report</h2>
                </tr>
                <tr>
                    <th>
                    <select id="year" style="width: 122px;padding-top: 5px;padding-bottom: 5px; margin-bottom:25px; margin-left:30px;">
                        <option value="">-Select Year-</option>
                        <option value="2015">2015</option>
                        <option value="2016">2016</option>
                        <option value="2017">2017</option>
                        <option value="2018">2018</option>
                        <option value="2019">2019</option>
                        <option value="2020">2020</option>
                    </select>
                    <th>
                    <th>
                    <select id="month" style="width: 122px;padding-top: 5px;padding-bottom: 5px; margin-bottom:25px;">
                        <option value="">-Select Month-</option>
                        <option value="1">January</option>
                        <option value="2">February</option>
                        <option value="3">March</option>
                        <option value="4">April</option>
                        <option value="5">May</option>
                        <option value="6">June</option>
                        <option value="7">July</option>
                        <option value="8">August</option>
                        <option value="9">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">December</option>
                    </select>
                    </th>
                    <th>
                    <button type="button" id="loadReport" style="margin-bottom:25px;" onclick="send_details()">Load Report</button>
                    </th>
                </tr>
            </table>
            

            <!--Monthly Income report-->
            <div id="report1" style="display:none;">
				<table align="center" width="600" frame="box" style="padding: 200px;">
            	<tr bgcolor="#800000">
            		<th bgcolor="#800000" colspan="2" style="height: 80px;">
            			<p align="center" style="margin-top:10px;"><img src="images/monthly_consumption.png"></p>
            		</th>
            	</tr>
            	<tr>
                <td bgcolor="#F7FCB1"><p><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Month :&nbsp;<span id="month1"></span>
                    <span>/&nbsp;</span><span id="year1"></span></b>&nbsp;</p>
                    </td>
					<td bgcolor="#F7FCB1" style="width:175px"><p align="left" style=""><br><br><b>Area Office:</b> Monaragala</p>
					</td>
            	</tr>
				<tr bgcolor="#F7FCB1">
					<td colspan="2">
						<table border="2" align="center" width="400">
							
						</table>
						<br>
                        <br>
						
					<table width="100%" class="table table-hover">
                    <thead>
                        <tr>
                            <th></th>
                            <th></th>
                            <th class="text-right">No. Units</th>
                            <th class="text-right">Charge</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="col-md-9"><b>Electricity Consumption - Unit based</b></td>
                            <td class="col-md-1" style="text-align: center"></td>
                            <td class="col-md-1 text-right"><span id="con_unit_total1"></span></td>
                            <td class="col-md-1 text-right"><span id="con_unit_charge1"></span></td>
                        </tr>
                        <tr>
                            <td class="col-md-9"><b>Electricity Consumption - Time based</b></td>
                            <td class="col-md-1" style="text-align: center"></td>
                            <td class="col-md-1 text-right"><span id="con_time_total"></span></td>
                            <td class="col-md-1 text-right"><span id="con_time_charge1"></span></span></td>
                        </tr>
                        <tr>
                            <td class="col-md-9">&nbsp;&nbsp;# Electricity Consumption - Peak time</td>
                            <td class="col-md-1" style="text-align: center"></td>
                            <td class="col-md-1 text-right"><span id="peak_total"></span></td>
                            <td class="col-md-1 text-right"><span id="peak_charge1"></span></td>
                        </tr>
                        <tr>
                            <td class="col-md-9">&nbsp;&nbsp;# Electricity Consumption - Off Peak time</td>
                            <td class="col-md-1" style="text-align: center"></td>
                            <td class="col-md-1 text-right"><span id="off_peak_total"></span></td>
                            <td class="col-md-1 text-right"><span id="off_peak_charge1"></span></td>
                        </tr>
                        <tr>
                            <td class="col-md-9">&nbsp;&nbsp;# Electricity Consumption - Day time</td>
                            <td class="col-md-1" style="text-align: center"></td>
                            <td class="col-md-1 text-right"><span id="day_total"></span></td>
                            <td class="col-md-1 text-right"><span id="day_charge1"></span></td>
                        </tr>
                        <tr>
                            <td class="col-md-9"><b>Total</b></td>
                            <td class="col-md-1" style="text-align: center"></td>
                            <td class="col-md-1 text-right"><b><span id="total_unit"></span></b></td>
                            <td class="col-md-1 text-right"><b><span id="total_charge1"></span></b></td>
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
                        </tr>
                        <tr>
                            <td>   </td>
                            <td>   </td>
                            <td class="text-right"><h4><strong>Total: </strong></h4></td>
                            <td class="text-center text-danger"><h4><strong>$31.53&nbsp;&nbsp;&nbsp;&nbsp;<span="charge"></span></strong></h4></td>
                        </tr>-->
                    </tbody>
                </table>
				
					</td>
				</tr>
				<tr>
            		<td bgcolor="#F7FCB1"><p><br><br></p></td>
					<td bgcolor="#F7FCB1"><p></p></td>
            	</tr>
                </table>
                </form>
            </div>
			</div>
			</div>
        </div>
        
        <div class="tab-pane fade" id="panelTwo">
          <div role="tabpanel">
            <ul class="nav nav-tabs" role="tablist">
              <li class="active"><a href="#panelTwo-1" data-toggle="tab" role="tab">Month Electricity Consumption</a></li>
              <!--<li><a href="#panelTwo-2" data-toggle="tab" role="tab">Update Tariff</a></li>
			  <li><a href="#panelTwo-3" data-toggle="tab" role="tab">Delete Tariff</a></li>-->
            </ul>
            <div id="tabContent2" class="tab-content">
            <div class="tab-pane fade in active" id="panelTwo-1">
				<div style="margin-top: 8px;">
					<button type="button" id="btn1" class="btn-success" onclick="load_table();" style="margin-left: 34px;padding-top: 6px;padding-bottom: 6px; margin-bottom: 35px;">Daily Consumption In This Month</button>
					<button class="button" id="btn2" class="btn-success" style="margin-left: 20px;padding-top: 6px;padding-bottom: 6px;" onclick="location.href='http://localhost:8080/project/php/chart_timebase.php';">Monthly Consumption - Time Based</button><br>
				</div>
					
		
					<div id="chartContainer"></div>
					<script type="text/javascript">
		 
					function load_table(){$(function () {
						var chart = new CanvasJS.Chart("chartContainer", {
							theme: "theme2",
							animationEnabled: true,
							title: {
								text: "Daily Electricity Consumption In This Month"
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
				
              <div class="tab-pane fade" id="panelTwo-2">
                   <div class="modal-dialog">
					<div class="loginmodal-container-report">
						
					</div>
					</div>
              </div>
		</div>
        </div>
		</div>
		
		<div class="tab-pane fade" id="panelThree">
          <div class="modal-dialog">
			<div class="loginmodal-container-report">
            <!--search bar-->
			<div>
            <form id="form1" method="POST" action="">
            <table style="width:100%;>
                <tr colspan="3">
                    <h2 style="padding-bottom: 20px;margin-left: 177px;margin-bottom: 20px;">Comparison</h2>
                </tr>
                <tr>
                    <th><p align="center">Transformer ID</p></th>
                    <th><p align="center">From</p></th>
                    <th><p align="center">To</p></th>
                </tr>
                <tr>
                    <td><?php echo $trans_id_drop; ?></td>
                    <td><input type="date" name="fromDate" id="fromDate" style="height: 29px;"></td>
                    <td><input type="date" name="toDate" id="toDate" style="height: 29px;"></td> 
                </tr>
                <tr>
                <td colspan='3' align="center">
                    <button type="button" id="transBtn" name="transBtn" style="margin-top: 17px;margin-bottom: 15px;" onclick="sendTransInfo()">Load Table</button>
                </td>
                </tr>
                
            </table>
            </form>
			</div>
            <br><br>
            <!--Monthly Income report-->
            <div id="report2" style="display:none;">
				
            </div>
			</div>
			</form>
            </div>
        </div>
        
<nav class="navbar navbar-default navbar-fixed-top">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#topFixedNavbar1"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
        <a class="navbar-brand page-scroll" href="#page-top"><img src="images/electricalEngineerTitle.png" alt="Data Entry Clerk"></a></div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="topFixedNavbar1">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="home page.html">Home<span class="sr-only">(current)</span></a></li>
            <li><a href="http://www.ceb.lk/about-us/">About Us</a></li>
            <li><a href="http://www.ceb.lk/co-contact/">Contact Us</a></li>
            <li><a href="php/staffLogout.php">Log out</a></li>
          </ul>
        </div>
        <!-- /.navbar-collapse -->
      </div>
      <!-- /.container-fluid -->
    </nav>
    
    <br><br>
    <footer style="align-content:center; text-align:center;">&copy; <i>Copyright Electricity Bill Management System All Rights Reserved</i></footer>
    <script src="js/jquery-1.11.2.min.js" type="text/javascript"></script>
    <script src="js/bootstrap.js" type="text/javascript"></script>
  </div>
</div>
</div>
</div>
</body>
</html>

