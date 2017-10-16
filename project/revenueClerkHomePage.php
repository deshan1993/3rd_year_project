<?php
	session_start();
	if(!isset($_SESSION["emp_post"])){
		header("Location: http://localhost:8080/Project/php/staffLogin.php");
		
	}
?>

<?php
	require_once 'connection.php';
	
	//show premises list
    $sql="SELECT premises_id,premises_name FROM premises_table";
    $result=$conn->query($sql);

    if(mysqli_num_rows($result)){
        $select= '<select id ="premises_list" name="premises_list" style="height:25px; font-size:14px; width: 80%;">';
    while($rs = $result->fetch_assoc()){
      $select.='<option value="'.$rs['premises_id'].'">'.$rs['premises_name'].'</option>';
        }
    }
		$select.='</select>';
		
		//show tariff list
		$sql="SELECT tariff_id,tariff_name FROM tariff_table";
		$result=$conn->query($sql);

		if(mysqli_num_rows($result)){
				$select_tariff= '<select id ="tariff_list" name="tariff_list" style="height:25px; font-size:14px; width: 80%;">';
		while($rs = $result->fetch_assoc()){
			$select_tariff.='<option value="'.$rs['tariff_id'].'">'.$rs['tariff_id'].'</option>';
				}
		}
		//show the drop down list
		$select_tariff.='</select>';
?>

<?php
	$con = mysqli_connect("localhost","root","","electricity_data");

	
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" href="images/ceb.png">
<title>Electricity Bill Management System/Revenue Clerk Home page</title>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="css/bootstrap1.css" rel="stylesheet" type="text/css">
<link href="css/consumerPageStyle.css" rel="stylesheet" type="text/css">
<link href="css/handleStaffAccount.css" rel="stylesheet" type="text/css">
<script src="./js/jquery-3.2.1.min.js"></script>

</script>
<script> 
$(document).ready(function(){
    $("#btn_search").click(function(){
        $("#panel").slideDown("slow");
    });

		$("#btn_search").click(function(){
        $("#btn_slide_up").show();
    });

		$("#btn_slide_up").click(function(){
        $("#panel").slideUp();
    });
});

</script>

<script type="text/javascript">
//send info for get payment neglect consumer list
	function send_data(){
		var premises=$("#premises_list").val();
		var tariff=$("#tariff_list").val();
		var amount=$("#amount").val();
		var year=$("#year").val();
		var month=$("#month").val();
		//alert(premises);
		var dataTosend='premises='+premises+'&tariff='+tariff+'&amount='+amount+'&year='+year+'&month='+month;
		$.ajax({
			url: 'php/getConDisconnectList.php',
			type: 'POST',
			data:dataTosend,
			async: true,
			success: function (data) {
				$('#panel').html(data);
			},
		});
	}

//send data to get reconneting info
	function send_con_id(){
		var con_id=$("#re_con_id").val();
		var dataTosend='con_id='+con_id;
		$.ajax({
			url: 'php/getReconInfo.php',
			type: 'POST',
			data:dataTosend,
			async: true,
			success: function (data) {
				//alert(data);
				$('#re_mon_bill').val(data.total_bill);
				$('#re_due').val(data.recon_amount);
			
			},
		});
	}
</script>

<style type="text/css"> 
#panel, #flip {
    padding: 5px;
    text-align: center;
    background-color: #e5eecc;
    border: solid 1px #c3c3c3;
}

#panel {
    padding: 25px;
		display: none;
}

.tdHeight{
	height:40px;
}
</style>

</head>

<body style="padding-top: 70px;" background="images/admin_wallpaper.jpg">
<div role="tabpanel">
  <div role="tabpanel">
    <div role="tabpanel">
      <ul class="nav nav-tabs" role="tablist">
        <li class="active"><a href="#panelOne" data-toggle="tab" role="tab">Power Disconnecting Details</a></li>
        <li><a href="#panelTwo" data-toggle="tab" role="tab">Reconnecting Payments</a></li>
        <li><a href="#panelThree" data-toggle="tab" role="tab">**</a></li>
      </ul>
      <div id="tabContent1" class="tab-content">
        <div class="tab-pane fade in active" id="panelOne">
          <div class="modal-dialog">
			<div class="loginmodal-container-report">
			<!--<h3 style="color:#003366; font-size:18px font-family:'Gill Sans', 'Gill Sans MT', 'Myriad Pro', 'DejaVu Sans Condensed', Helvetica, Arial, sans-serif;" align="center">Disconnect Power Suppy</h3><br>-->
			<div id="flip">
				<h3 style="font-style:italic;"><u>Findout the power disconnect consumer list</u></h3><br>
				<div>
				<form id="form1" method="POST" action="">
					<table width="400" align="center">
							<tr>
								<th class="tdHeight">Premises Area:</th>
								<td class="tdHeight"><?php echo $select; ?></td>
							</tr>
							<tr>
								<th class="tdHeight">Bill greater than:</th>
								<td class="tdHeight">
									<select id="amount" style="height:25px; font-size:14px; width: 80%;">
										<option value="1000">Rs. 1000/=</option>
										<option value="2500">Rs. 2500/=</option>
										<option value="5000">Rs. 5000/=</option>
										<option value="7500">Rs. 7500/=</option>
										<option value="10000">Rs. 10000/=</option>
									</select>
								</td>
							</tr>
							<tr>
								<th class="tdHeight">Tariff Id:</th>
								<td class="tdHeight"><?php echo $select_tariff; ?></td>
							</tr>
							<tr>
								<th class="tdHeight">Year:</th>
								<td class="tdHeight">
									<select id="year" style="height:25px; font-size:14px; width: 80%;">
										<option value="2015">2015</option>
										<option value="2016">2016</option>
										<option value="2017">2017</option>
										<option value="2018">2018</option>
										<option value="2019">2019</option>
									</select>
								</td>
							</tr>
							<tr>
								<th class="tdHeight">Month:</th>
								<td class="tdHeight">
									<select id="month" style="height:25px; font-size:14px; width: 80%;">
										<option value="1">January</option>
										<option value="2">February</option>
										<option value="3">March</option>
										<option value="4">April</option>
										<option value="5">May</option>
										<option value="6">June</option>
										<option value="7">July</option>
										<option value="8">August</option>
										<option value="9">September</option>
										<option value="10">Octomber</option>
										<option value="11">November</option>
										<option value="12">December</option>
									</select>
								</td>
							</tr>
							<tr>
								<th class="tdHeight"></th>
								<td class="tdHeight"><button type="button" id="btn_search" onclick="send_data()">Search</button>
								<button type="button" id="btn_slide_up" style="display: none;">Slide-up</button>
								</td>
							</tr>
					</table>
				</form>
				</div>
				
			</div>
			<div id="panel">
            <p></p>
			</div>
			</div>
            </div>
        </div>
        <!--Enter reconnecting payment info-->
        <div class="tab-pane fade" id="panelTwo">
        <div class="modal-dialog">
				<div class="loginmodal-container-report">
				<div id="flip">
				<h3 style="font-style:italic;"><u>Enter Reconnecting Payment</u></h3><br>
				<div>
				<form id="form2" method="POST" action="">
					<table width="400" align="center">
							<tr>
								<th class="tdHeight">Consumer Id:</th>
								<td class="tdHeight"><input type="text" id="re_con_id" style="width: 153px;height: 28px;">
								<button type="button" id="re_search_btn" onclick="send_con_id()">Search</button></td>
							</tr>
							<tr>
								<th class="tdHeight">Monthly Bill Amount (Rs.):</th>
								<td class="tdHeight"><input type="text" id="re_mon_bill" align="right" style="width: 214px;height: 28px;" readonly></td>
							</tr>
							<tr>
								<th class="tdHeight">Reconnection Due (Rs.):</th>
								<td class="tdHeight"><input type="text" id="re_due" align="right" style="width: 214px;height: 28px;" readonly></td>
							</tr>
							<tr>
								<th class="tdHeight">Total Amount (Rs.):</th>
								<td class="tdHeight"><input type="text" id="re_total" align="right" style="width: 214px;height: 28px;" readonly></td>
							</tr>
							<tr>
								<th class="tdHeight">Reconnection Payment (Rs.):</th>
								<td class="tdHeight"><input type="text" id="re_pay" style="width: 214px;height: 28px;"></td>
							</tr>
							<tr>
							<th class="tdHeight"></th>
							<td class="tdHeight"><button type="button" id="btn_enter" onclick="enter_recon()">Enter</button>
							</td>
							</tr>
					</table>
				</form>
				</div>
				</div>
				</div>
        </div>
        </div>

        
        <div class="tab-pane fade" id="panelThree">
        <div class="modal-dialog">
		<div class="loginmodal-container">
		
		</div>
        </div>
        </div>
        
<nav class="navbar navbar-default navbar-fixed-top">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#topFixedNavbar1"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
        <a class="navbar-brand page-scroll" href="#page-top"><img src="images/revenueClerkTitle.png" alt="Data Entry Clerk"></a></div>
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
<script>
//send data to get reconneting info
	function send_con_id(){
		var con_id=$("#re_con_id").val();
		var dataTosend='con_id='+con_id;
		$.ajax({
			url: 'php/getReconInfo.php',
			type: 'POST',
			data:dataTosend,
			async: true,
			success: function (data) {
				var data = JSON.parse(data);
				//alert(data);
				$('#re_mon_bill').val(data.total_bill);
				$('#re_due').val(data.recon_amount);
				$('#re_total').val(data.recon_total);
			
			},
		});
	}

	function enter_recon(){
		var con_id=$("#re_con_id").val();
		var re_pay=$("#re_pay").val();
		var re_due=$("#re_due").val();
		var re_mon_bill=$("#re_mon_bill").val();
		var dataTosend='con_id='+con_id+'&re_pay='+re_pay+'&re_mon_bill='+re_mon_bill+'&re_due='+re_due;
		$.ajax({
			url: 'php/inertReconPayment.php',
			type: 'POST',
			data:dataTosend,
			async: true,
			success: function (data) {
				alert(data);
				$('#re_mon_bill').val(" ");
				$('#re_due').val(" ");
				$('#re_total').val(" ");
				$('#re_pay').val(" ");
				$('#re_con_id').val(" ");
			
			},
		});
	}
</script>
</body>
</html>

