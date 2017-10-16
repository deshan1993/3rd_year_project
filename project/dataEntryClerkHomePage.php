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
        $select= '<select id ="mylist" name="premises" style="height:28px;font-size:16px;width: 30%;margin-bottom: 9px; width: 40%;">';
    while($rs = $result->fetch_assoc()){
      $select.='<option value="'.$rs['premises_id'].'">'.$rs['premises_name'].'</option>';
        }
    }
    $select.='</select>';
	
	//show tariff list
	$sql="SELECT tariff_id,tariff_name FROM tariff_table";
    $result=$conn->query($sql);

    if(mysqli_num_rows($result)){
        $select_tariff= '<select id ="mylist" name="tariff" style="height:28px;font-size:16px;width: 30%;margin-bottom: 9px; width: 40%;">';
    while($rs = $result->fetch_assoc()){
      $select_tariff.='<option value="'.$rs['tariff_id'].'">'.$rs['tariff_name'].'</option>';
        }
    }
    //show the drop down list
    $select_tariff.='</select>';
?>

<!--Get message details to show inside the tables-->
<?php

	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "electricity_data";

	// Create connection
	$con = mysqli_connect($servername, $username, $password, $dbname);
	// Check connection
	if (!$con) {
		die("Connection failed: " . mysqli_connect_error());
	}

	$sql = "SELECT * FROM message_table ORDER BY msg_date DESC"; //DESC used sort by decrease, ASC used for sort by increase
	$records = mysqli_query($con, $sql);
	
	
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" href="images/ceb.png">
<title>Electricity Bill Management System/Data Entry Clerk Home page</title>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="css/bootstrap1.css" rel="stylesheet" type="text/css">
<link href="css/handleAccount.css" rel="stylesheet" type="text/css">
<script src="./js/jquery-3.2.1.min.js"></script>

	<SCRIPT language=Javascript>
       <!--
       function isNumberKey(evt)
       {
          var charCode = (evt.which) ? evt.which : evt.keyCode;
          if (charCode != 46 && charCode > 31 
            && (charCode < 48 || charCode > 57))
             return false;

          return true;
       }
       //-->
    </SCRIPT>
	<script type="text/javascript">
		function clear_masg_table(){
	
		var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
						var result= this.responseText;
						alert(result);
						location.reload();
                    }
                };
                xmlhttp.open("GET","php/deleteConsumerMessage.php",true);
                xmlhttp.send();
    }
	</script>

	<script type="text/javascript">
		function send_con_id(){
		var con_id=$("#con_id").val();
		var year=$("#year").val();
		var month=$("#month").val();
		var dataTosend='con_id='+con_id+'&year='+year+'&month='+month;
		$.ajax({
			url: 'php/getBillInfo.php',
			type: 'POST',
			data:dataTosend,
			async: true,
			success: function (data) {
				//alert(data);
				var data = JSON.parse(data);
				//alert(data);
				$('#unit').val(data.unit);
				$('#mon_bill').val(data.mon_bill);
				$('#outstanding').val(data.outstanding);
				$('#totalBill').val(data.totalBill);
			
			},
		});
	}
	</script>

	<style>
		.text1{
			style="width:214px;
			height: 28px;
		}
	</style>
	
</head>

<body style="padding-top: 70px;" background="images/admin_wallpaper.jpg">
    <div role="tabpanel">
      <ul class="nav nav-tabs" role="tablist">
        <li class="active"><a href="#panelOne" data-toggle="tab" role="tab"><b>Handle Consumer Account</b></a></li>
        <li><a href="#panelTwo" data-toggle="tab" role="tab"><b>Bill Payment Info</b></a></li>
        <li><a href="#panelThree" data-toggle="tab" role="tab"><b>Faulty Meter Info</b></a></li>
        <li><a href="#panelFour" data-toggle="tab" role="tab"><b>Consumer Messages</b></a></li>
      </ul>
      <div id="tabContent1" class="tab-content">
      
      <!--Panel one-->
        <div class="tab-pane fade in active" id="panelOne">
          <div role="tabpanel">
            <ul class="nav nav-tabs" role="tablist">
              <li class="active"><a href="#panelOne-1" data-toggle="tab" role="tab">Create Account</a></li>
              <li><a href="#panelOne-2" data-toggle="tab" role="tab">Update Account</a></li>
              <li><a href="#panelOne-3" data-toggle="tab" role="tab">Delete Account</a></li>
            </ul>
            <div id="tabContent2" class="tab-content">
              <div class="tab-pane fade in active" id="panelOne-1">
                <div class="modal-dialog">
				<div class="loginmodal-container">
					<p align="center"><h2 style="color:#003366; font-size:18px font-family:'Gill Sans', 'Gill Sans MT', 'Myriad Pro', 'DejaVu Sans Condensed', Helvetica, Arial, sans-serif;">Enter consumer details</h2></p><br>
                <form id="insert_form" method="POST" action="php/insertConsumerData.php">
                <table width="100%" border="0">
					<tbody>
						<tr>
							<td>&nbsp;<label>Consumer ID :</label></td>
							<td>&nbsp;&nbsp;&nbsp;</td>
							<td>&nbsp;<input type="text" name="con_Id"  style="width: 214px;height: 28px;" placeholder="Con-XXXX" required></td>
							</tr>
						<tr>
							<td>&nbsp;<label>Consumer Title :</label></td>
							<td>&nbsp;</td>
							<td>&nbsp;	<select name="con_Title" style="height:28px;font-size:16px;width: 30%;margin-bottom: 9px; width: 30%;">
											<option value="Mr">Mr.</option>
											<option value="Rev">Rev.</option>
											<option value="Mrs">Mrs.</option>
											<option value="Ms">Ms.</option>
											<option value="Prof">Prof.</option>
											<option value="Dr">Dr.</option>
											<option value="Eng">Eng.</option>
										</select></td>
							</tr>
						<tr>
							<td>&nbsp;<label>Consumer Name :</label></td>
							<td>&nbsp;</td>
							<td>&nbsp;<input type="text" name="con_Name" style="width: 214px;height: 28px;" placeholder="Sunimal Wijesinghe" required></td>
						</tr> 
						<tr>
							<td>&nbsp;<label>Consumer NIC :</label></td>
							<td>&nbsp;</td>
							<td>&nbsp;<input type="text" name="con_Nic" style="width: 214px;height: 28px;" placeholder="930272133V" required></td>
						</tr>
						<tr>
							<td>&nbsp;<label>Consumer Address :</label></td>
							<td>&nbsp;</td>
							<td>&nbsp;<input type="text" name="con_Address" style="width: 214px;height: 28px;" placeholder="No 73, Sirigala, Monaragala" required></td>
						</tr>
						<tr>
							<td>&nbsp;<label>Consumer Mobile Number :</label></td>
							<td>&nbsp;</td>
							<td>&nbsp;<input type="text" name="con_Mobile" style="width: 214px;height: 28px;" onkeypress="return isNumberKey(event)" maxlength="10" placeholder="07xxxxxxxx"></td>
						</tr>
						<tr>
							<td>&nbsp;<label>Consumer Email :</label></td>
							<td>&nbsp;</td>
							<td>&nbsp;<input type="text" name="con_Email" style="width: 214px;height: 28px;" placeholder="sunimal@gmail.com"></td>
						</tr>
						<tr>
							<td>&nbsp;<label>Premises ID :</label></td>
							<td>&nbsp;</td>
							<td>&nbsp;<?php echo $select; ?></td>
						</tr>
						<tr>
							<td>&nbsp;<label>Tariff :</label></td>
							<td>&nbsp;</td>
							<td>&nbsp;<?php echo $select_tariff; ?></td>
						</tr>
						<tr>
							<td>&nbsp;<label>Password :</label></td>
							<td>&nbsp;</td>
							<td>&nbsp;<input type="password" name="con_Password1" style="width: 214px;height: 28px;" id="con_Password1" placeholder="abc#$%12345"></td>
						</tr>
						<tr>
							<td>&nbsp;<label>Conform Password :</label></td>
							<td>&nbsp;</td>
							<td>&nbsp;<input type="password" name="con_Password" style="width: 214px;height: 28px;" id="con_Password" placeholder="abc#$%12345"></td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;<input type="submit" name="save" class="login loginmodal-submit" style="width: 128px;height: 28px;padding-bottom: 12px;margin-bottom: 15px;" value="Create Account"></td>
						</tr>
					</tbody>
				</table>
				</form>
				</div>
				</div>
				</div>
				
              <div class="tab-pane fade" id="panelOne-2">
                   <div class="modal-dialog">
					<div class="loginmodal-container">
						<p align="center"><h2 style="color:#003366; font-size:18px font-family:'Gill Sans', 'Gill Sans MT', 'Myriad Pro', 'DejaVu Sans Condensed', Helvetica, Arial, sans-serif;">Update consumer details</h2></p><br>
					<form id="update_consumer_detail" method="POST" action="php/updateConsumerData.php">
					<table width="500" border="0">
					<tbody>
						<tr>
							<td>&nbsp;<label>Consumer ID :</label></td>
							<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
							<td>&nbsp;<input type="text" id="con_id_up" style="width: 214px;height: 28px;" name="con_id_up" required placeholder="Con-XXXX"></td>
							<td>&nbsp;<input type="button" name="search" class="login loginmodal-search" style="width: 65px;height: 29px;margin-right: 7px;" value="Search" onclick="getConsumerDetail(getElementById('con_id_up').value);"></td>
						</tr>
						<tr> 
							<td>&nbsp;<label>Consumer Title :</label></td>
							<td>&nbsp;</td>
							<td>&nbsp;<input type="text" id="con_title_up" style="width: 214px;height: 28px;" name="con_title_up"></td>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td>&nbsp;<label>Consumer Name :</label></td>
							<td>&nbsp;</td>
							<td>&nbsp;<input type="text" id="con_name_up" style="width: 214px;height: 28px;" name="con_name_up"></td>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td>&nbsp;<label>Consumer NIC :</label></td>
							<td>&nbsp;</td>
							<td>&nbsp;<input type="text" id="con_nic_up" style="width: 214px;height: 28px;" name="con_nic_up"></td>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td>&nbsp;<label>Consumer Address :</label></td>
							<td>&nbsp;</td>
							<td>&nbsp;<input type="text" id="con_address_up" style="width: 240px;height: 28px;" name="con_address_up"></td>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td>&nbsp;<label>Consumer Telephone :</label></td>
							<td>&nbsp;</td>
							<td>&nbsp;<input type="text" id="con_contact_up" style="width: 214px;height: 28px;" name="con_contact_up" onkeypress="return isNumberKey(event)" maxlength="10"></td>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td>&nbsp;<label>Consumer Email :</label></td>
							<td>&nbsp;</td>
							<td>&nbsp;<input type="email" id="con_email_up" style="width: 214px;height: 28px;margin-bottom: 12px;" name="con_email_up"></td>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td>&nbsp;<label>Consumer password :</label></td>
							<td>&nbsp;</td>
							<td>&nbsp;<input type="text" id="con_password_up" style="width: 214px;height: 28px;" name="con_password_up"></td>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td>&nbsp;<label>Premises ID :</label></td>
							<td>&nbsp;</td>
							<td>&nbsp;<input type="text" id="con_premisesId_up" style="width: 214px;height: 28px;" name="con_premises_up"></td>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td>&nbsp;<label>Tariff ID :</label></td>
							<td>&nbsp;</td>
							<td>&nbsp;<input type="text" id="con_tariffId_up" style="width: 214px;height: 28px;" name="con_tariff_up"></td>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;<input type="submit" name="save" class="login loginmodal-submit" style="width: 128px;height: 28px;padding-bottom: 12px;margin-bottom: 15px;left: 39px;" value="Save"></td>
						</tr>
					</tbody>
					</table>
					</form>
					</div>
					</div>
              </div>
			  
			  <div class="tab-pane fade" id="panelOne-3">
				<div class="modal-dialog">
				<div class="loginmodal-container">
					<h2 style="color:#003366; font-size:18px font-family:'Gill Sans', 'Gill Sans MT', 'Myriad Pro', 'DejaVu Sans Condensed', Helvetica, Arial, sans-serif;">Delete consumer account</h2><br>
					<form name="form4" Method="POST" Action="php/deleteConsumerData.php">
					<table width="400" border="0">
					<tbody>
						<tr>
							<td>&nbsp;<label>Consumer ID :</label></td>
							<td>&nbsp;</td>
							<td>&nbsp;<input type="text" name="con_Id" style="width: 214px;height: 28px;" placeholder="Con-XXXX" required></td>
							</tr>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;<input type="submit" name="delete" style="width: 79px;left: 43px;" class="login loginmodal-submit" value="Delete"></td>
							<td></td>
						</tr>
					</tbody>
					</table>
					</form>
				</div>
				</div>
			</div>
			
        </div>
        </div>
		</div>
		
		<div class="tab-pane fade" id="panelTwo">
          <div role="tabpanel">
            <ul class="nav nav-tabs" role="tablist">
              <li class="active"><a href="#panelTwo-1" data-toggle="tab" role="tab">Enter Bill Payment Info</a></li>
              <!--<li><a href="#panelTwo-2" data-toggle="tab" role="tab">Electricity Bill Info</a></li>-->
            </ul>
            <div id="tabContent3" class="tab-content">
              <div class="tab-pane fade in active" id="panelTwo-1">
                <div class="modal-dialog">
				<div class="loginmodal-container">
					
					<div id="flip">
					<h2 style="align:center;">Enter Reconnecting Payment</h2></p><br>
					<div>
					<form id="form2" method="POST" action="">
						<table width="400" align="center">
								<tr>
									<th class="tdHeight">Consumer Id:</th>
									<td class="tdHeight"><input type="text" id="con_id" style="width: 153px;height: 28px;">
									<button type="button" id="re_search_btn" onclick="send_con_id()">Search</button></td>
								</tr>
								<tr>
									<th class="tdHeight">Year:</th>
									<td class="tdHeight">
									<select id="year" style="height:25px;font-size:14px;width: 80%;margin-top: 0px;margin-bottom: 11px;">
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
									<select id="month" style="height:25px;font-size:14px;width: 80%;margin-top: 0px;margin-bottom: 13px;">
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
									<th class="tdHeight">Consumed units:</th>
									<td class="tdHeight"><input type="text" id="unit" align="right" style="width: 214px;height: 28px;" readonly></td>
								</tr>
								<tr>
									<th class="tdHeight">Monthly Bill:</th>
									<td class="tdHeight"><input type="text" id="mon_bill" style="width: 214px;height: 28px;" readonly></td>
								</tr>
								<tr>
									<th class="tdHeight">Outstanding:</th>
									<td class="tdHeight"><input type="text" id="outstanding" style="width: 214px;height: 28px;" readonly></td>
								</tr>
								<tr>
									<th class="tdHeight">Total Bill:</th>
									<td class="tdHeight"><input type="text" id="totalBill" style="width: 214px;height: 28px;" readonly></td>
								</tr>
						</table>
					</form>
					</div>
					</div>
				</div>
				</div>
				</div>
        </div>
        </div>
		</div>
		
		<div class="tab-pane fade" id="panelThree">
          <div class="modal-dialog">
					<div class="loginmodal-container">
					<h2>Faulty meters details</h2>
					<p style="font-size=16px;">Some of faulty meter details are included following table. Consumption details are not propoerly sent to system below electricity meters.</p><hr>
						<table width="100%" border="2">
							<tr bgcolor="#FFEEB8" style="height: 35px;">
								<th align="center">&nbsp;&nbsp;Consumer Id</th>
								<th align="center">&nbsp;&nbsp;Consumer Name</th>
								<th align="center">&nbsp;&nbsp;Consumer Address</th>
							</tr>
							<?php
								$con_list = array();
								$i=0;
								$year1 = date("Y");
								$month1 = date("m");

								$con = $con = mysqli_connect("localhost","root","","electricity_data");
								$query = "SELECT con_id FROM consumer_table";
								$result = mysqli_query($con, $query);
								while($row=mysqli_fetch_assoc($result)){
									$con_list[$i] = $row['con_id'];

									$query1 = "SELECT con_id FROM consumption_table WHERE con_id='$con_list[$i]' AND YEAR(cons_date)='$year1' AND MONTH(cons_date)='$month1'";
									$result1 = mysqli_query($con,$query1);
									if($row1=mysqli_fetch_assoc($result1)){
										
									}
									else{
										$con_data = array();
										$query2 = "SELECT * FROM consumer_table WHERE con_id='$con_list[$i]'";
										$result2 = mysqli_query($con, $query2);
										$row2=mysqli_fetch_assoc($result2);
										$con_data[$i]['con_id1']=$row2['con_id'];
										$con_data[$i]['con_name1']=$row2['con_name'];
										$con_data[$i]['con_address1']=$row2['con_address'];

										echo "<tr bgcolor='#E5FCAB' style='height: 35px;'>";
										echo "<td>&nbsp;&nbsp;".$con_data[$i]['con_id1']."</td>";
										echo "<td>&nbsp;&nbsp;".$con_data[$i]['con_name1']."</td>";
										echo "<td>&nbsp;&nbsp;".$con_data[$i]['con_address1']."</td>";
										echo "</tr>";
									}
									$i++;
								}
							?>
						</table>
                      
                    </div>
					</div>
		</div>
		
		<div class="tab-pane fade" id="panelFour">
          <div class="modal-dialog">
					<div class="loginmodal-container">
					<h2>Consumers' messages</h2><hr>
						<table width="100%" border="2">
							<tr bgcolor="#FFEEB8" style="height: 35px;">
								<th>&nbsp;&nbsp;Date</th>
								<th>&nbsp;&nbsp;Time</th>
								<th>&nbsp;&nbsp;Consumer ID</th>
								<th>&nbsp;&nbsp;Message</th>
							</tr>
							<?php
								if (mysqli_num_rows($records) > 0) {
									// output data of each row
									while($value = mysqli_fetch_assoc($records)) {
										echo "<tr bgcolor='#E5FCAB' style='height: 35px;'>";
										echo "<td>&nbsp;&nbsp;".$value['msg_date']."</td>";
										echo "<td>&nbsp;&nbsp;".$value['msg_time']."</td>";
										echo "<td>&nbsp;&nbsp;".$value['con_id']."</td>";
										echo "<td>&nbsp;&nbsp;".$value['msg_info']."</td>";
										echo "</tr>";
									}
								}
								mysqli_close($con);
							?>
						</table>
					  <button type="submit" id="clear_msg" class="btn btn-default" style="margin-top: 35px;margin-left: 314px;" align="center" onclick="clear_masg_table();">Clear Messages</button>
					  <button type="button" id="refresh_msg"class="btn btn-default" style="margin-top: 35px;" align="center" onclick="location.reload();">Refresh</button>
					</div>
					</div>
		</div>
        
<nav class="navbar navbar-default navbar-fixed-top">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#topFixedNavbar1"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
        <a class="navbar-brand page-scroll" href="#page-top"><img src="images/dataEntryClerkTitle.png" alt="Data Entry Clerk"></a></div>
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
	<script type="text/javascript">
		function showDropDown(){
		
		var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        
                        document.getElementById("drop").innerHTML = this.responseText;
                    }
                };
                xmlhttp.open("GET", "showDropDownList.php", false);
                xmlhttp.send();
		
		function myFunction() {
			document.getElementById("insert_form").reset();
		}
	}
	
	//function for get consumer detils to update form
	function getConsumerDetail(str){
		
		var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
						
                        
						  var result= this.responseText;
						  var dev=result.split("+");
						  document.getElementById("con_title_up").value=dev[0];
						  document.getElementById("con_name_up").value=dev[1];
						  document.getElementById("con_nic_up").value=dev[2];
						  document.getElementById("con_address_up").value=dev[3];
						  document.getElementById("con_contact_up").value=dev[4];
						  document.getElementById("con_email_up").value=dev[5];
						  document.getElementById("con_password_up").value=dev[6];
						  document.getElementById("con_premisesId_up").value=dev[7];
						  document.getElementById("con_tariffId_up").value=dev[8];
                    }
                };
                xmlhttp.open("GET","php/getConDetail.php?con_Id="+str, false);
                xmlhttp.send();
	}
	</script>
  </div>
</div>
</body>
</html>

