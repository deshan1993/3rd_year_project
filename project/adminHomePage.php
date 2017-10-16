<?php
	session_start();
	if(!isset($_SESSION["emp_post"])){
		header("Location: http://localhost:8080/Project/php/staffLogin.php");
		
	}
?>
<!--Get the tariff unit table details for display-->
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

	$sql = "SELECT * FROM tariff_unit_table";
	$display_units = mysqli_query($con, $sql);
	
	
?>
<!--Get the tariff time table details for display-->
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

	$sql = "SELECT * FROM tariff_time_table";
	$display_times = mysqli_query($con, $sql);
	
	
?>
<!--display employee Id drop down list for update-->
<?php
    require_once 'connection.php';
	
	//show premises list
    $sql="SELECT emp_id FROM employee_table";
    $result=$conn->query($sql);

    if(mysqli_num_rows($result)){
        $emp_id_drop= '<select id ="emp_id_up" name="emp_id_up" style="width:175px; height:30px">';
		$emp_id_drop.='<option value=" ">-Select-</option>';
    while($rs = $result->fetch_assoc()){
      $emp_id_drop.='<option value="'.$rs['emp_id'].'">'.$rs['emp_id'].'</option>';
        }
    }
    $emp_id_drop.='</select>';
?>

<!--display employee Id drop down list for delete-->
<?php
    require_once 'connection.php';
	
	//show premises list
    $sql="SELECT emp_id FROM employee_table";
    $result=$conn->query($sql);

    if(mysqli_num_rows($result)){
        $emp_id_drop1= '<select id ="emp_id_delete" name="employee_id_delete" style="width:175px; height:30px">';
		$emp_id_drop1.='<option value=" ">-Select-</option>';
    while($rs = $result->fetch_assoc()){
      $emp_id_drop1.='<option value="'.$rs['emp_id'].'">'.$rs['emp_id'].'</option>';
        }
    }
    $emp_id_drop.='</select>';
?>

<!--display tariff time plan list for update-->
<?php
    require_once 'connection.php';
	
	//show premises list
    $sql_time="SELECT time_plan_id FROM time_plan";
    $result_time=$conn->query($sql_time);

    if(mysqli_num_rows($result_time)){
        $time_plan_drop= '<select id ="time_plan_list" name="time_plan_list" style="width:175px; height:30px">';
		$time_plan_drop.='<option value=" ">-Select-</option>';
    while($rs = $result_time->fetch_assoc()){
      $time_plan_drop.='<option value="'.$rs['time_plan_id'].'">'.$rs['time_plan_id'].'</option>';
        }
    }
    $time_plan_drop.='</select>';
?>

<!--Display tariff id drop down list-->
<?php
    require_once 'connection.php';
	
    $sql="SELECT tariff_id,tariff_name FROM tariff_table";
    $result=$conn->query($sql);

    if(mysqli_num_rows($result)){
        $tariff_drop= '<select id ="tariff_id_drop" name="tariff_id_drop" style="width:50px; height:25px">';
		$tariff_drop.='<option value=" "> </option>';
    while($rs = $result->fetch_assoc()){
      $tariff_drop.='<option value="'.$rs['tariff_id'].'">'.$rs['tariff_id'].'</option>';
        }
    }
    $tariff_drop.='</select>';
?>
<!--Display tariff id drop down list for insert time rate table-->
<?php
    require_once 'connection.php';
	
	//show premises list
    $sql="SELECT tariff_id,tariff_name FROM tariff_table";
    $result=$conn->query($sql);

    if(mysqli_num_rows($result)){
        $tariff_drop_time= '<select id ="tariff_time_id_drop" name="tariff_time_id_drop" style="width:50px; height:25px">';
		$tariff_drop_time.='<option value=" "> </option>';
    while($rs = $result->fetch_assoc()){
      $tariff_drop_time.='<option value="'.$rs['tariff_id'].'">'.$rs['tariff_id'].'</option>';
        }
		$tariff_drop_time.='</select>';
    }
    
?>
<!--Display tariff time id drop down list in delete tab-->
<?php
    require_once 'connection.php';
	

    $sql="SELECT DISTINCT tariff_time_id FROM tariff_time_table";
    $result=$conn->query($sql);

    if(mysqli_num_rows($result)){
        $tariff_time_drop= '<select id ="tariff_time_id_drop" name="tariff_time_id_drop" style="width:160px; height:25px">';
		$tariff_time_drop.='<option value="0">-Select One-</option>';
    while($rs = $result->fetch_assoc()){
      $tariff_time_drop.='<option value="'.$rs['tariff_time_id'].'">'.$rs['tariff_time_id'].'</option>';
        }
		$tariff_time_drop.='</select>';
    }
    
?>
<!--Display tariff unit id drop down list for update table-->
<?php
    require_once 'connection.php';
	
	
    $sql="SELECT DISTINCT tariff_unit_id FROM tariff_unit_table";
    $result=$conn->query($sql);

    if(mysqli_num_rows($result)){
        $tariff_unit_drop1= '<select id ="tariff_unit_id_drop1" name="tariff_unit_id_drop1" style="width:100px; height:25px" readOnly="">';
		$tariff_unit_drop1.='<option value=" ">-Select-</option>';
    while($rs = $result->fetch_assoc()){
      $tariff_unit_drop1.='<option value="'.$rs['tariff_unit_id'].'">'.$rs['tariff_unit_id'].'</option>';
        }
		$tariff_unit_drop1.='</select>';
    }
    
?>
<!--Display tariff min value drop down list for update table-->
<?php
    require_once 'connection.php';
	
	
    $sql="SELECT DISTINCT start_unit FROM tariff_unit_table";
    $result=$conn->query($sql);

    if(mysqli_num_rows($result)){
        $tariff_min_drop1= '<select id ="tariff_unit_min_drop1" name="tariff_unit_min_drop1" style="width:100px; height:25px">';
		$tariff_min_drop1.='<option value=" ">-Select-</option>';
    while($rs = $result->fetch_assoc()){
      $tariff_min_drop1.='<option value="'.$rs['start_unit'].'">'.$rs['start_unit'].'</option>';
        }
		$tariff_min_drop1.='</select>';
    }
    
?>
<!--Display tariff max value drop down list for update table-->
<?php
    require_once 'connection.php';
	
	
    $sql="SELECT DISTINCT end_unit FROM tariff_unit_table";
    $result=$conn->query($sql);

    if(mysqli_num_rows($result)){
        $tariff_max_drop1= '<select id ="tariff_unit_max_drop1" name="tariff_unit_max_drop1" style="width:100px; height:25px">';
		$tariff_max_drop1.='<option value=" ">-Select-</option>';
    while($rs = $result->fetch_assoc()){
      $tariff_max_drop1.='<option value="'.$rs['end_unit'].'">'.$rs['end_unit'].'</option>';
        }
		$tariff_max_drop1.='</select>';
    }
    
?>
<!--Display tariff time id drop down list for update table-->
<?php
    require_once 'connection.php';
	
	
    $sql="SELECT DISTINCT tariff_time_id FROM tariff_time_table";
    $result=$conn->query($sql);

    if(mysqli_num_rows($result)){
        $tariff_time_drop1= '<select id ="tariff_time_id_drop1" name="tariff_time_id_drop1" style="width:100px; height:25px">';
		$tariff_time_drop1.='<option value=" ">-Select-</option>';
    while($rs = $result->fetch_assoc()){
      $tariff_time_drop1.='<option value="'.$rs['tariff_time_id'].'">'.$rs['tariff_time_id'].'</option>';
        }
		$tariff_time_drop1.='</select>';
    }
    
?>
<!--Display tariff unit id drop down list for delete table-->
<?php
    require_once 'connection.php';
	
	
    $sql="SELECT DISTINCT tariff_unit_id FROM tariff_unit_table";
    $result=$conn->query($sql);

    if(mysqli_num_rows($result)){
        $tariff_unit_drop2= '<select id ="tariff_unit_id_drop2" name="tariff_unit_id_drop2" style="width:100px; height:25px">';
		$tariff_unit_drop2.='<option value=" ">-Select-</option>';
    while($rs = $result->fetch_assoc()){
      $tariff_unit_drop2.='<option value="'.$rs['tariff_unit_id'].'">'.$rs['tariff_unit_id'].'</option>';
        }
		$tariff_unit_drop2.='</select>';
    }
    
?>
<!--Display tariff unit min drop down list for delete table-->
<?php
    require_once 'connection.php';
	
	//show premises list
    $sql="SELECT DISTINCT start_unit FROM tariff_unit_table";
    $result=$conn->query($sql);

    if(mysqli_num_rows($result)){
        $tariff_min_drop2= '<select id ="tariff_unit_min_drop2" name="tariff_unit_min_drop2" style="width:100px; height:25px">';
		$tariff_min_drop2.='<option value=" ">-Select-</option>';
    while($rs = $result->fetch_assoc()){
      $tariff_min_drop2.='<option value="'.$rs['start_unit'].'">'.$rs['start_unit'].'</option>';
        }
		$tariff_min_drop2.='</select>';
    }
    
?>
<!--Display tariff unit max id drop down list for delete table-->
<?php
    require_once 'connection.php';
	
	//show premises list
    $sql="SELECT DISTINCT end_unit FROM tariff_unit_table";
    $result=$conn->query($sql);

    if(mysqli_num_rows($result)){
        $tariff_max_drop2= '<select id ="tariff_unit_max_drop2" name="tariff_unit_max_drop2" style="width:100px; height:25px">';
		$tariff_max_drop2.='<option value=" ">-Select-</option>';
    while($rs = $result->fetch_assoc()){
      $tariff_max_drop2.='<option value="'.$rs['end_unit'].'">'.$rs['end_unit'].'</option>';
        }
		$tariff_max_drop2.='</select>';
    }
    
?>
<!--Display tariff time id drop down list for delete table-->
<?php
    require_once 'connection.php';
	
	//show premises list
    $sql="SELECT DISTINCT tariff_time_id FROM tariff_time_table";
    $result=$conn->query($sql);

    if(mysqli_num_rows($result)){
        $tariff_time_drop2= '<select id ="tariff_time_id_drop2" name="tariff_time_id_drop2" style="width:100px; height:25px">';
		$tariff_time_drop2.='<option value=" ">-Select-</option>';
    while($rs = $result->fetch_assoc()){
      $tariff_time_drop2.='<option value="'.$rs['tariff_time_id'].'">'.$rs['tariff_time_id'].'</option>';
        }
		$tariff_time_drop2.='</select>';
	}
	

?>

<?php

	$sql1 = mysqli_query($con, "SELECT LAST_INSERT_ID(tariff_id) FROM tariff_table");

	if ($result = $sql1) {
		
			/* fetch associative array */
			while ($row = mysqli_fetch_row($result)) {
				$newT = $row[0];
			}
		
			/* free result set */
			mysqli_free_result($result);
		}
		echo $row[0];
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" href="images/ceb.png">
<title>Electricity Bill Management System/Admin Home page</title>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="css/bootstrap1.css" rel="stylesheet" type="text/css">
<link href="css/consumerPageStyle.css" rel="stylesheet" type="text/css">
<!--<link href="css/handleStaffAccount.css" rel="stylesheet" type="text/css">-->
<script src="js/jquery-3.2.1.min.js"></script>

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
//insert employee data to database
	function pass_validates(){
	var emp_id = document.getElementById('emp_id').value;
	var emp_name = document.getElementById('emp_name').value;
	var emp_post = document.getElementById('emp_post').value;
	var emp_contact = document.getElementById('emp_contact').value;
	var pass1 = document.getElementById('emp_password').value;
	var pass2 = document.getElementById('emp_password1').value;
	
		if ( pass1 != pass2){
			document.getElementById('error_msg').innerHTML="Not Match!";
		}
		else{
			
			send_data(emp_id,emp_name,emp_post,emp_contact,pass2);
		}
	}
	
	function send_data(a,b,c,d,e){
		
		var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
						var result= this.responseText;
						alert (result);
						
						document.getElementById('emp_id').value=" ";
						document.getElementById('emp_name').value=" ";
						document.getElementById('emp_post').value=" ";
						document.getElementById('emp_contact').value=" ";
						document.getElementById('emp_password').value=" ";
						document.getElementById('emp_password1').value=" ";
						
                    }
                };
                xmlhttp.open("GET","php/insertEmployeeData.php?emp_id="+a+"&emp_name="+b+"&emp_post="+c+"&emp_mobile="+d+"&emp_password="+e,false);
                xmlhttp.send();
    }
</script>
<script type="text/javascript">
//get employee data to update window
	function get_employee_data(str){
		
		var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
						var result= this.responseText;
						  var dev=result.split("+");
						  document.getElementById("emp_name_up").value=dev[0];
						  document.getElementById("emp_post_up").value=dev[1];
						  document.getElementById("emp_contact_up").value=dev[2];
						  document.getElementById("emp_password_up").value=dev[3];
						 	
                    }
                };
                xmlhttp.open("GET","php/getEmployeeDetail.php?emp_id="+str,false);
                xmlhttp.send();
    }
</script>

<script type="text/javascript">
//update employee_id to delete the row in database
	function update_data(){
	var emp_id = document.getElementById('emp_id_up').value;
	var emp_name = document.getElementById('emp_name_up').value;
	var emp_post = document.getElementById('emp_post_up').value;
	var emp_contact = document.getElementById('emp_contact_up').value;
	var emp_password = document.getElementById('emp_password_up').value;
	
		if ( emp_password == ''){
			document.getElementById('error_msg1').innerHTML="No password!";
		}
		else{
			
			send_data1(emp_id,emp_name,emp_post,emp_contact,emp_password);
		}
	}
	
	function send_data1(a,b,c,d,e){
		
		var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
						var result= this.responseText;
						alert (result);
						
						document.getElementById('emp_id_up').value=" ";
						document.getElementById('emp_name_up').value=" ";
						document.getElementById('emp_post_up').value=" ";
						document.getElementById('emp_contact_up').value=" ";
						document.getElementById('emp_password_up').value=" ";
						
                    }
                };
                xmlhttp.open("GET","php/updateEmployeeData.php?emp_id="+a+"&emp_name="+b+"&emp_post="+c+"&emp_mobile="+d+"&emp_password="+e,false);
                xmlhttp.send();
    }
</script>
<script type="text/javascript">
//delete employee details from the database
	function send_emp_id(str){
		
		var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
						var result= this.responseText;
						alert (result);
						
						document.getElementById('employeeId').value=" ";
						
                    }
                };
                xmlhttp.open("GET","php/deleteEmployeeData.php?emp_id="+str,false);
                xmlhttp.send();
    }
</script>

<script>
	jQuery(function(){
        var counter = 1;
        jQuery('#add_row1').click(function(event){
            event.preventDefault();

				var newRow = jQuery('<tr bgcolor="#E5FCAB" id="trUnit"><td><p>&nbsp;<input type="number" id="min_value" name="min_value[' +
				counter +']" style="width:50px;" required /></p></td><td><p><input type="number" id="max_value" name="max_value[' +
				counter +']" style="width:50px;" required /></p></td><td><p><input type="number" id="unit_charge" name="unit_charge[' +
				counter +']" style="width:70px;" required /></p></td><td><p><input type="number" id="fixed_charge" name="fixed_charge[' +
				counter +']" style="width:80px;" required /></p></td><td><p><input type="number" id="demand_charge" name="demand_charge[' +
				counter +']" style="width:100px;" required /></p></td><td><p align="center"><button type="button" id="remove_row1" name="remove_row1' +
				counter +'" style="margin-bottom:4px"><span class="glyphicon glyphicon-minus"></p></td></tr>');
				jQuery('#table_unit_insert').append(newRow);
				counter++;              
        });
        });

		$(document).ready(function(){
            $("#table_unit_insert").on('click', '#remove_row1', function () {
            $(this).closest('#trUnit').remove();
        });
		});
	
	//show tariff unit drop down list
		$(document).ready(function () {
        $("#unitShow").click(function(){
            $("#tariff_drop_show").show();
        });
       });

	//show tariff time drop down list
	$(document).ready(function () {
        $("#timeShow").click(function(){
            $("#tariff_drop_show1").show();
        });
       });
</script>
<script>
	//add rows to tariff time entering table
	jQuery(function(){
        var counter = 1;
        jQuery('#add_row2').click(function(event){
            event.preventDefault();

				var newRow = jQuery('<tr id="trTime"bgcolor="#E5FCAB"><td><p>&nbsp;<input type="number" name="peak_value[' +
				counter + ']" id="peak_value" style="width:50px;"></p></td><td><p><input type="number" name="off_peak_value[' +
				counter +']" id="off_peak_value" style="width:50px;"></p></td><td><p><input type="number" name="day_value[' +
				counter +']" id="day_value" style="width:50px;"></p></td><td><p><input type="number" name="fixed_charge2[' +
				counter +']" id="fixed_charge2" style="width:80px;"></p></td><td><p><input type="number" name="demand_charge2[' +
				counter +']" id="demand_charge2" style="width:80px;"></p></td><td><p><button type="button" id="remove_row2" name="remove_row1' +
				counter +']" style="margin-bottom:4px"><span class="glyphicon glyphicon-minus"></button></p></td></tr>');
				jQuery('#table_time_insert').append(newRow);
				counter++;              
        });
        });

		//remove tariff time table rows
		$(document).ready(function(){
            $("#table_time_insert").on('click', '#remove_row2', function () {
            $(this).closest('#trTime').remove();
        });
		});

</script>

<script type="text/javascript">
    $(document).ready(function(){
    $("#loadReport").click(function(){
        $("#report1").slideDown(1500);
    });

	// $("#passdata").click(function(e){
	// 	e.preventDefault()
	// 	//addUnits
	// 	alert(1);
	// )};

    });


	//update electricity bills to database
    function update(){
		var pwd=$('#pwd').val();
		var dataTosend='pwd='+pwd;
		$.ajax({
			url: 'php/calculateBillNew.php',
			type: 'POST',
			data:dataTosend,
			async: true,
			success: function (data) {
				//var data = JSON.parse(data);
				alert(data);
			},
		});
	}
	

//send unit tariff new data
	function send_unit_data(){
		var myform = document.getElementById("form2");
		var fd = new FormData(myform );
		$.ajax({
			url: "php/insertTariffUnitData.php",
			data: fd,
			cache: false,
			processData: false,
			contentType: false,
			type: 'POST',
			success: function (data) {
				alert(data);
				// do something with the result
			}
		});		
		// var data = $('#form2').serialize();
		// $.post('php/insertTariffUnitData.php', data);
	}

//send time tariff new data
	function send_time_data(){
		var myform = document.getElementById("form3");
		var fd = new FormData(myform );
		$.ajax({
			url: "php/insertTariffTimeData.php",
			data: fd,
			cache: false,
			processData: false,
			contentType: false,
			type: 'POST',
			success: function (data) {
				alert(data);
				// do something with the result
			}
		});		
		// var data = $('#form2').serialize();
		// $.post('php/insertTariffUnitData.php', data);
	}

//get time plan data
function get_time_plan(){
		var id=$("#time_plan_list").val();
		var dataTosend='id='+id;
		$.ajax({
			url: 'php/getTimePlanData.php',
			type: 'POST',
			data:dataTosend,
			async: true,
			success: function (data) {
				var data = JSON.parse(data);
				alert(data);
				$('#peak_plan').val(data.peak);
				$('#off_peak_plan').val(data.off_peak);
                $('#day_plan').val(data.day);
                $('#fixed_charge_plan').val(data.implement);
				
			},
		});
	}

//update time plan data
function update_time_plan(){
		var id=$("#time_plan_list").val();
		var peak=$("#peak_plan").val();
		var off_peak=$("#off_peak_plan").val();
		var day=$("#day_plan").val();
		var implement=$("#fixed_charge_plan").val();
		var dataTosend='id='+id+'&peak='+peak+'&off_peak='+off_peak+'&day='+day+'&implement'+implement;
		$.ajax({
			url: 'php/getTimePlanData.php',
			type: 'POST',
			data:dataTosend,
			async: true,
			success: function (data) {
				//var data = JSON.parse(data);
				alert(data);
				$("#time_plan_list").val("");
				$('#peak_plan').val("");
				$('#off_peak_plan').val("");
                $('#day_plan').val("");
                $('#fixed_charge_plan').val("");
				
			},
		});
	}
</script>

</head>

<body style="padding-top: 70px" background="images/admin_wallpaper.jpg">
<div role="tabpanel">
  <div role="tabpanel">
    <div role="tabpanel">
      <ul class="nav nav-tabs" role="tablist">
        <li class="active"><a href="#panelOne" data-toggle="tab" role="tab"><b>Handle Authorized Accounts</b></a></li>
		<li><a href="#panelTwo" data-toggle="tab" role="tab"><b>Tariff Rate Changes</b></a></li>
		<li><a href="#panelThree" data-toggle="tab" role="tab"><b>View Tariff Rates</b></a></li>
		<li><a href="#panelFour" data-toggle="tab" role="tab"><b>Update monthly Electricity Data</b></a></li>
      </ul>
      <div id="tabContent1" class="tab-content">
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
					<p align="center"><h3 style="color:#003366;font-size:18px font-family:'Gill Sans', 'Gill Sans MT', 'Myriad Pro', 'DejaVu Sans Condensed', Helvetica, Arial, sans-serif;margin-left: 120px;margin-bottom: 40px;">Enter employee details</h3></p><br>
                
				<form>
                <table width="400" border="0" align="center">
					<tbody>
						<tr>
							<td>&nbsp;<label>Employee ID :</label></td>
							<td>&nbsp;</td>
							<td>&nbsp;<input type="text" id="emp_id" name="emp_id" placeholder="Emp-xxxx" required></td>
							<td>&nbsp;<p style="font-style:bold; color: #fa3d4c;"><label id=""></label></p></td>
						</tr>
						<tr>
							<td>&nbsp;<label>Employee Name :</label></td>
							<td>&nbsp;</td>
							<td>&nbsp;<input type="text" id="emp_name" name="emp_name" placeholder="W.M Saman Kumara" required></td>
							<td>&nbsp;<p style="font-style:bold; color: #fa3d4c;"><label id=""></label></p></td>
						</tr>
						<tr>
							<td>&nbsp;<label>Employee Post :</label></td>
							<td>&nbsp;</td>
							<td>&nbsp;<input type="text" id="emp_post" name="emp_post" placeholder="Engineer" required></td>
							<td>&nbsp;<p style="font-style:bold; color: #fa3d4c;"><label id=""></label></p></td>
						</tr>
						<tr>
							<td>&nbsp;<label>Employee Mobile :</label></td>
							<td>&nbsp;</td>
							<td>&nbsp;<input type="text" id="emp_contact" name="emp_contact" onkeypress="return isNumberKey(event)" maxlength="10" placeholder="071xxxxxxx" required></td>
							<td>&nbsp;<p style="font-style:bold; color: #fa3d4c;"><label id=""></label></p></td>
						</tr>
						<tr>
							<td>&nbsp;<label>Password :</label></td>
							<td>&nbsp;</td>
							<td>&nbsp;<input type="password" id="emp_password" name="emp_password" placeholder="saman1993%$" required></td>
							<td>&nbsp;<p style="font-style:bold; color: #fa3d4c;"><label id=""></label></p></td>
						</tr>
						<tr>
							<td>&nbsp;<label>Conform Password :</label></td>
							<td>&nbsp;</td>
							<td>&nbsp;<input type="password" id="emp_password1" name="emp_password1" placeholder="saman1993%$" required></td>
							<td>&nbsp;<p style="font-style:bold; color: #fa3d4c;"><label id="error_msg"></label></p></td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;<input type="button" id="insert" name="insert" class="login loginmodal-submi" value="Insert" onclick="pass_validates();">
							<button type="reset">Rest</button></td>
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
						<p align="center"><h3 style="color:#003366; font-size:18px font-family:'Gill Sans', 'Gill Sans MT', 'Myriad Pro', 'DejaVu Sans Condensed', Helvetica, Arial, sans-serif;" align="center">Update employee details</h3></p><br>
					<form>
					<table width="410" border="0" align="center">
					<tbody>
						<tr>
							<td>&nbsp;<label>Employee ID :</label></td>
							<td>&nbsp;</td>
							<td>&nbsp;<p>&nbsp;<?php echo $emp_id_drop; ?></p></td>
							<td>&nbsp; &nbsp;<input type="button" name="search" class="login loginmodal-searc" value="Search" onclick="get_employee_data(getElementById('emp_id_up').value)"></td>
						</tr>
						<tr>
							<td>&nbsp;<label>Employee Name:</label></td>
							<td>&nbsp;</td>
							<td>&nbsp;<input type="text" id="emp_name_up" name="emp_name_up"></td>
							<td>&nbsp;<p style="font-style:bold; color: #fa3d4c;"><label id="" required></label></p></td>
						</tr>
						<tr>
							<td>&nbsp;<label>Mobile No:</label></td>
							<td>&nbsp;</td>
							<td>&nbsp;<input type="text" id="emp_contact_up" name="emp_contact_up" onkeypress="return isNumberKey(event)" maxlength="10"></td>
							<td>&nbsp;<p style="font-style:bold; color: #fa3d4c;"><label id="" required></label></p></td>
						</tr>
						<tr>
							<td>&nbsp;<label>Emp. Post:</label></td>
							<td>&nbsp;</td>
							<td>&nbsp;<input type="text" id="emp_post_up" name="emp_post_up"></td>
							<td>&nbsp;<p style="font-style:bold; color: #fa3d4c;"><label id="" required></label></p></td>
						</tr>
						<tr>
							<td>&nbsp;<label>Password:</label></td>
							<td>&nbsp;</td>
							<td>&nbsp;<input type="text" id="emp_password_up" name="emp_password_up"></td>
							<td>&nbsp;<p style="font-style:bold; color: #fa3d4c;"><label id="error_msg1"></label></p></td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;<input type="button" name="submit" class="" value="Submit" onclick="update_data()">
							<button type="reset">Reset</button></td>
							<td></td>
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
					<p align="center"><h3 style="color:#003366; font-size:18px font-family:'Gill Sans', 'Gill Sans MT', 'Myriad Pro', 'DejaVu Sans Condensed', Helvetica, Arial, sans-serif;" align="center">Delete employee account</h3></p><br>
					<form>
					<table width="400" border="0" align="center">
					<tbody>
						<tr>
							<td>&nbsp;<label>Employee ID :</label></td>
							<td>&nbsp;</td>
							<td>&nbsp;<?php echo $emp_id_drop1; ?></td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;<label id="emp_name_label"></label></td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;<input type="submit" name="delete" class="login loginmodal-subm" value="Delete" onclick="send_emp_id(document.getElementById('emp_id_delete').value);"></td>
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
		
<!--tab two start --------------------------------------------------------------------------------------------------------------------------------------------------------->
		
		<div class="tab-pane fade" id="panelTwo">
          <div role="tabpanel">
            <ul class="nav nav-tabs" role="tablist">
              <li class="active"><a href="#panelTwo-1" data-toggle="tab" role="tab">Create Tariff</a></li>
              <li><a href="#panelTwo-2" data-toggle="tab" role="tab">Update Tariff</a></li>
			  <li><a href="#panelTwo-3" data-toggle="tab" role="tab">Delete Tariff</a></li>
            </ul>
            <div id="tabContent2" class="tab-content">
              <div class="tab-pane fade in active" id="panelTwo-1">
                <div class="modal-dialog">
				<div class="loginmodal-container">
					<p align="center"><h3 style="color:#003366; font-size:18px font-family:'Gill Sans', 'Gill Sans MT', 'Myriad Pro', 'DejaVu Sans Condensed', Helvetica, Arial, sans-serif;" align="center">Enter tariff details</h3></p><br>
					
					<form>
						<label><input value="1" type="radio" name="formselector" onclick="displayForm(this)">&nbsp;&nbsp;Add Tariff Unite Rates</label>
						<br> 
						<label><input value="2" type="radio" name="formselector" onclick="displayForm(this)">&nbsp;&nbsp;Add Tariff Time Rates</label>   
					</form>
		<!--Enter tariff unit rates-->

        <br>
        <!--Enter tariff description-->
        	<form style="" id="form1">
            <table align="center" width="500" frame="box" style="padding: 15px;">
            	<tr bgcolor="#FFEEB8">
            		<th colspan="3">
            			<p align="center" style="margin-top: 10px;">Enter Tariff ID &amp; Tariff Description (Unit &amp; Time)</p>
            		</th>
            	</tr>
            	<tr bgcolor="#F7FCB1">
            		<td><p><label>&nbsp;&nbsp;Tariff ID: </label></p></td>
            		<td><p><input type="text" id="tariff_id1" name="tariff_id1" maxlength="3" width="3" required></p></td>
            		<td>&nbsp;<p style="font-style:bold; color: #fa3d4c;" align="left"><label id="error1"></label></p></td>
            	</tr>
            	<tr bgcolor="#F7FCB1">
            		<td><p><label>&nbsp;&nbsp;Tariff Info: </label></td>
            		<td><p><input type="text" id="tariff_info" name="tariff_info" required></p></td>
            		<td>&nbsp;<p style="font-style:bold; color: #fa3d4c;" align="left"><label id="error2"></label></p></td>
            	</tr>
            	<tr bgcolor="#F7FCB1">
            		<td></td>
            		<td><p>&nbsp;<button type="button" id="btn_insert" name="btn_insert" onclick="send_tariff_data(getElementById('tariff_id1').value,getElementById('tariff_info').value),moveTariff(getElementById('tariff_id1').value)">Insert</button>&nbsp;
            			<button type="reset">Reset</button></p>
            		</td>
            		<td>&nbsp;</td>
            	</tr>
            </table>
            </form>

            <br>
            <!--Enter new tariff information-->
            <form style="visibility:hidden" id="form2">
            <table align="center" width="500" frame="box" style="padding: 15px;"id="table_unit_insert">
            	<tr bgcolor="#FFEEB8">
            		<th colspan="6">
            			<p align="center" style="margin-top: 10px;">Enter New Tariff Information (Unit Rate)</p>
            		</th>
            	</tr>
				<tr bgcolor="#FFEEC4">
            		<th colspan="3">
					<p align="center"><input name="tariff_id_insert" id="tariff_id_insert" type="text" style="width: 50px;" align="center" readonly>
						&nbsp;&nbsp;
						<input type="radio" name="unitShow" id="unitShow">&nbsp;
						<lable id="tariff_drop_show" style="display:none;"><?php echo $tariff_drop; ?></lable></p>
            		</th>
					<th colspan="3">
            			<p align="center"><button type="button" id="add_row1"  style="margin-left: 215px"><span class="glyphicon glyphicon-plus"></button>
						<button id="passdata" onclick="send_unit_data()" type="button">send</button></p>
            		</th>
            	</tr><br>
				
            	<tr bgcolor="#E5FCAB">	
            		<td><p align="center">Min</p></td>
            		<td><p align="center">Max</p></td>
            		<td><p>Unit charge</p></td>
            		<td><p>Fixed Charge</p></td>
            		<td><p>Demand Charge</p></td>
					<td><p></p></td>
            	</tr>
            	<tr bgcolor="#E5FCAB">
            		<td><p>&nbsp;<input type="number" id="min_value" name="min_value[0]" style="width:50px;" required /></p></td>
            		<td><p><input type="number" id="max_value" name="max_value[0]" style="width:50px;" required /></p></td>
            		<td><p><input type="number" id="unit_charge" name="unit_charge[0]" style="width:70px;" required /></p></td>
            		<td><p><input type="number" id="fixed_charge" name="fixed_charge[0]" style="width:80px;" required /></p></td>
            		<td><p><input type="number" id="demand_charge" name="demand_charge[0]" style="width:100px;" required /></p></td>
					<td><p align="center"><button type="button" id="btn_insert_unit" style="margin-left: 45px;padding-top: 0px;padding-bottom: 0px;border-top-width: 0px;padding-left: 0px;border-left-width: 0px;padding-right: 0px;border-right-width: 0px;border-bottom-width: 0px;" disable;></button></p></td>
            	</tr>
            </table>
			<!--<button type="reset">Reset</button>-->
            </form>          
          
           
		<!--Enter new tariff time rates-->
   
			<br>
            <form style="visibility:hidden" id="form3" method="POST">
            <table id="table_time_insert" align="center" width="500" frame="box" style="padding: 15px;">
            	<tr bgcolor="#FFEEB8">
            		<th colspan="6">
            			<p align="center" style="margin-top: 10px;">Enter New Tariff Information (Time Rate)</p>
            		</th>
            	</tr>
				<tr bgcolor="#FFEEC4">
            		<th colspan="3">
					<p align="center"><input id="time_id_insert" name="time_id_insert" type="text" style="width: 50px;" align="center" readonly>
						&nbsp;&nbsp;
						<input type="radio" name="timeShow" id="timeShow">&nbsp;
						<lable id="tariff_drop_show1" style="display:none;"><?php echo $tariff_drop; ?></lable></p>
            		</th>
					<th colspan="3">
            			<p align="center"><button type="button" id="add_row2" style="margin-left: 215px"><span class="glyphicon glyphicon-plus"></button>
						<button id="passdata" onclick="send_time_data()" type="button">send</button></p>
            		</th>
				</tr>
            	<tr bgcolor="#E5FCAB">
            		<td><p>&nbsp;&nbsp;&nbsp;&nbsp;Peak</p></td>
            		<td><p>Off Peak</p></td>
            		<td><p>&nbsp;&nbsp;&nbsp;&nbsp;Day</p></td>
            		<td><p>Fixed Charge</p></td>
            		<td><p>Demand Charge</p></td>
					<td><p></p></td>
            	</tr>
            	<tr bgcolor="#E5FCAB">
            		<td><p>&nbsp;<input type="number" id="peak_value" name="peak_value[0]" style="width:50px;"></p></td>
            		<td><p><input type="number" id="off_peak_value" name="off_peak_value[0]" style="width:50px;"></p></td>
            		<td><p><input type="number" id="day_value" name="day_value[0]" style="width:50px;"></p></td>
            		<td><p><input type="number" id="fixed_charge2" name="fixed_charge2[0]" style="width:80px;"></p></td>
            		<td><p><input type="number" id="demand_charge2" name="demand_charge2[0]" style="width:80px;"></p></td>
					<td><p><button type="button" id="btn_insert_time" style="margin-left: 45px;padding-top: 0px;padding-bottom: 0px;border-top-width: 0px;padding-left: 0px;border-left-width: 0px;padding-right: 0px;border-right-width: 0px;border-bottom-width: 0px;" disabled></button></td>
            	</tr>
            </table>
			<!--<button type="reset">Rest</button></p></td>-->
            </form>
					
				</div>
				</div>
				</div>
<!--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
			<!--tariff details update tab-->
             <div class="tab-pane fade" id="panelTwo-2">
                <div class="modal-dialog1">
				<div class="loginmodal-container">
					<p align="center"><h3 style="color:#003366; font-size:18px font-family:'Gill Sans', 'Gill Sans MT', 'Myriad Pro', 'DejaVu Sans Condensed', Helvetica, Arial, sans-serif;" align="center">Update tariff details</h3></p><br>
					
					<form>
						<label><input value="1" type="radio" name="formselector" onclick="displayForm1(this)">&nbsp;&nbsp;Update Tariff Unite Rates</label>
						<br> 
						<label><input value="2" type="radio" name="formselector" onclick="displayForm1(this)">&nbsp;&nbsp;Update Tariff Time Rates</label>
						<br> 
						<label><input value="3" type="radio" name="formselector" onclick="displayForm1(this)">&nbsp;&nbsp;Update Tariff Time Plan</label>   
					</form>
		
            <!--update tariff unit information-->
            <form style="visibility:hidden" id="form1_unit">
            <table align="center" width="600" frame="box" style="padding: 15px;">
            	<tr bgcolor="#FFEEB8">
            		<th bgcolor="#FFEEB8" colspan="6">
            			<p align="center" style="margin-top: 10px;">Update New Tariff Information (Unit Rate)</p>
            		</th>
            	</tr>
            	<tr>
            		<td bgcolor="#F7FCB1"><p align="center">Tariff ID</p></td>
            		<td bgcolor="#F7FCB1"><p align="center">Min</p></td>
            		<td bgcolor="#F7FCB1"><p align="center">Max</p></td>
            		<td bgcolor="#E5FCAB"><p align="center">Unit charge</p></td>
            		<td bgcolor="#E5FCAB"><p align="center">Fixed Charge</p></td>
            		<td bgcolor="#E5FCAB"><p align="center">Demand Charge</p></td>
            	</tr>
            	<tr>
            		<td bgcolor="#F7FCB1"><p>&nbsp;&nbsp;<?php echo $tariff_unit_drop1; ?></p></td>
            		<td bgcolor="#F7FCB1"><p><?php echo $tariff_min_drop1; ?></p></td>
            		<td bgcolor="#F7FCB1"><p><?php echo $tariff_max_drop1; ?></p></td>
            		<td bgcolor="#E5FCAB"><p>&nbsp;<input type="number" id="unit_charge_up" name="unit_charge_up" style="width:90px;" required="true"></p></td>
            		<td bgcolor="#E5FCAB"><p><input type="number" id="fixed_charge_up" name="fixed_charge_up" style="width:90px;" required="true"></p></td>
            		<td bgcolor="#E5FCAB"><p><input type="number" id="demand_charge_up" name="demand_charge_up" style="width:90px;" required="true"></p></td>
            	</tr>
				<tr>
					<td  bgcolor="#F7FCB1" colspan="3"><p align="center"><button type="button" id="btn_search_unit" onclick="get_unit_data(getElementById('tariff_unit_id_drop1').value,getElementById('tariff_unit_min_drop1').value,getElementById('tariff_unit_max_drop1').value);lock();">Search</button></p></td>
					<td bgcolor="#E5FCAB" colspan="3"><p align="center"><button type="button" id="btn_update_unit" onclick="update_unit_values(getElementById('tariff_unit_id_drop1').value,getElementById('tariff_unit_min_drop1').value,getElementById('tariff_unit_max_drop1').value,getElementById('unit_charge_up').value,getElementById('fixed_charge_up').value,getElementById('demand_charge_up').value);">Update</button>&nbsp;
					<button type="reset" id="btn_reset_unit">Reset</button></p></td>
				</tr>
            </table>
            </form>
        

        <!--update tariff time-->
   
            <br>
            <form style="visibility:hidden" id="form1_time">
            <table align="center" width="600" frame="box" style="padding: 15px;">
            	<tr>
            		<th bgcolor="#FFEEB8" colspan="6">
            			<p align="center" style="margin-top: 10px;">Update New Tariff Information (Time Rate)</p>
            		</th>
            	</tr>
            	<tr>
            		<td bgcolor="#F7FCB1"><p align="center">Tariff ID</p></td>
            		<td bgcolor="#E5FCAB"><p align="center">Peak</p></td>
            		<td bgcolor="#E5FCAB"><p align="center">Off Peak</p></td>
            		<td bgcolor="#E5FCAB"><p align="center">Day</p></td>
            		<td bgcolor="#E5FCAB"><p align="center">Fixed Charge</p></td>
            		<td bgcolor="#E5FCAB"><p align="center">Demand Charge</p></td>
            	</tr>
            	<tr>
            		<td bgcolor="#F7FCB1"><p>&nbsp;&nbsp;<?php echo $tariff_time_drop1; ?></p></td>
            		<td bgcolor="#E5FCAB"><p>&nbsp;<input type="number" id="peak_up" name="peak_up" style="width:90px;" required></p></td>
            		<td bgcolor="#E5FCAB"><p><input type="number" id="off_peak_up" name="off_peak_up" style="width:90px;" required></p></td>
            		<td bgcolor="#E5FCAB"><p><input type="number" id="day_up" name="day_up" style="width:90px;" required></p></td>
            		<td bgcolor="#E5FCAB"><p><input type="number" id="fixed_charge_up2" name="fixed_charge_up2" style="width:90px;" required></p></td>
            		<td bgcolor="#E5FCAB"><p><input type="number" id="demand_charge_up2" name="demand_charge_up2" style="width:90px;" required></p></td>
            	</tr>
				<tr>
					<td  bgcolor="#F7FCB1"><p align="center"><button type="button" id="btn_search_time" onclick="get_time_data(getElementById('tariff_time_id_drop1').value);lock1();">Search</button></p></td>
					<td bgcolor="#E5FCAB" colspan="5"><p align="right"><button type="button" id="btn_update_time" onclick="update_time_values(getElementById('tariff_time_id_drop1').value,getElementById('peak_up').value,getElementById('off_peak_up').value,getElementById('day_up').value,getElementById('fixed_charge_up2').value,getElementById('demand_charge_up2').value);">Update</button>&nbsp;&nbsp;
					<button type="reset">Reset</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p></td>
				</tr>
            </table>
            </form>
			
			<!--update time plan details-->
   
            <br>
            <form style="visibility:hidden" id="form3_time">
            <table align="center" width="600" frame="box" style="padding: 15px;">
            	<tr>
            		<th bgcolor="#FFEEB8" colspan="6">
            			<p align="center" style="margin-top: 10px;">Update Time Plan Details</p>
            		</th>
            	</tr>
            	<tr>
            		<td bgcolor="#F7FCB1"><p align="center">Time Plan</p></td>
            		<td bgcolor="#E5FCAB"><p align="center">Peak (Time)</p></td>
            		<td bgcolor="#E5FCAB"><p align="center">Off Peak (Time)</p></td>
            		<td bgcolor="#E5FCAB"><p align="center">Day (Time)</p></td>
            		<td bgcolor="#E5FCAB"><p align="center">Implement Date</p></td>
            	</tr>
            	<tr>
            		<td bgcolor="#F7FCB1"><p>&nbsp;&nbsp;<?php echo $time_plan_drop; ?></p></td>
            		<td bgcolor="#E5FCAB"><p>&nbsp;<input type="number" id="peak_plan" name="peak_plan" style="width:90px;" required></p></td>
            		<td bgcolor="#E5FCAB"><p><input type="number" id="off_peak_plan" name="off_peak_plan" style="width:90px;" required></p></td>
            		<td bgcolor="#E5FCAB"><p><input type="number" id="day_plan" name="day_plan" style="width:90px;" required></p></td>
            		<td bgcolor="#E5FCAB"><p><input type="date" id="fixed_charge_plan" name="fixed_charge_plan" style="width:90px;height: 27px;" required></p></td>
            	</tr>
				<tr>
					<td  bgcolor="#F7FCB1"><p align="center"><button type="button" id="btn_search_time" onclick="get_time_plan()">Search</button></p></td>
					<td bgcolor="#E5FCAB" colspan="5"><p align="right"><button type="button" id="btn_update_time" onclick="update_time_plan()">Update</button>&nbsp;&nbsp;
					<button type="reset">Reset</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p></td>
				</tr>
            </table>
            </form>
		</div>
		</div>
		</div>
<!---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
		<!--tariff details delete tab-->
             <div class="tab-pane fade" id="panelTwo-3">
                <div class="modal-dialog">
				<div class="loginmodal-container">
					<p align="center"><h3 style="color:#003366; font-size:18px font-family:'Gill Sans', 'Gill Sans MT', 'Myriad Pro', 'DejaVu Sans Condensed', Helvetica, Arial, sans-serif;" align="center">Delete tariff details</h3></p><br>
					
					<form>
						<label><input value="1" type="radio" name="formselector" onclick="displayForm2(this)">&nbsp;&nbsp;Delete Tariff Unite Rates Details</label>
						<br> 
						<label><input value="2" type="radio" name="formselector" onclick="displayForm2(this)">&nbsp;&nbsp;Delete Tariff Time Rates Details</label>   
					</form>
			<br>
            <!--delete tariff unit information-->
            <form style="visibility:hidden" id="form2_unit">
            <table align="center" width="500" frame="box">
            	<tr bgcolor="#FFEEB8">
            		<th colspan="3">
            			<p align="center" style="margin-top: 10px;">Delete Tariff Information (Unit Rate)</p>
            		</th>
            	</tr>
            	<tr bgcolor='#E5FCAB'>
            		<td><p align="center">Tariff ID</p></td>
            		<td><p align="center">Min</p></td>
            		<td><p align="center">Max</p></td>
            	</tr>
            	<tr bgcolor='#E5FCAB'>
            		<td><p align="center"><?php echo $tariff_unit_drop2; ?></p></td>
            		<td><p align="center"><?php echo $tariff_min_drop2; ?></p></td>
            		<td><p align="center"><?php echo $tariff_max_drop2; ?></p></td>
            	</tr>
				<tr bgcolor='#E5FCAB'>
					<td></td>
					<td><p></p></td>
					<td><p align="center"><button type="button" id="btn_delete_unit" onclick="delete_unit_values(getElementById('tariff_unit_id_drop2').value,getElementById('tariff_unit_min_drop2').value,getElementById('tariff_unit_max_drop2').value);">Delete</button>
					&nbsp;&nbsp;&nbsp;<button type="reset" id="reset_form2">Reset</button>
					</p></td>
				</tr>
            </table>
            </form>
        
        <!--Delete tariff time information-->
   
            <br>
            <form style="visibility:hidden" id="form2_time">
            <table align="center" width="500" frame="box" style="padding: 15px;">
            	<tr bgcolor="#FFEEB8">
            		<th colspan="2">
            			<p align="center" style="margin-top: 10px;">Delete Tariff Information (Time Rate)</p>
            		</th>
            	</tr>
            	<tr bgcolor='#E5FCAB'>
            		<td><p align="center">Select Tariff ID :</p></td>
            		<td><p align="left"><?php echo $tariff_time_drop2; ?></p></td>
            	</tr>
            	<tr bgcolor='#E5FCAB'>
            		<td><p></p></td>
            		<td><p align="left"><button type="button" id="delete_tariff_time" onclick="delete_time_values(getElementById('tariff_time_id_drop2').value)">Delete</button></p></td>
            	</tr>
            </table>
            </form>
		
		</div>
		</div>
		</div>
		
		</div>
        </div>
		</div>
		
<!-- Tab three -------------------------------------------------------------------------------------------------------------------->

		<div class="tab-pane fade" id="panelThree">
			<div role="tabpanel">
            <ul class="nav nav-tabs" role="tablist">
              <li class="active"><a href="#panelThree-1" data-toggle="tab" role="tab">Unit Tafiff Rates</a></li>
              <li><a href="#panelThree-2" data-toggle="tab" role="tab">Time Tariff Rates</a></li>
            </ul>
            <div id="tabContent2" class="tab-content">
              <div class="tab-pane fade in active" id="panelThree-1">
                <div class="modal-dialog">
				<div class="loginmodal-container">
					<p align="center"><h3 style="color:#003366; font-size:18px font-family:'Gill Sans', 'Gill Sans MT', 'Myriad Pro', 'DejaVu Sans Condensed', Helvetica, Arial, sans-serif;" align="center">Unit Tariff Rates Table</h3></p><br>
					
					<table align="center" width="500" border="2">
							<tr bgcolor="#FFEEB8">
								<th><p align="center">Tariff ID</p></th>
								<th><p align="center">Min value</p></th>
								<th><p align="center">Max value</p></th>
								<th><p align="center">Unit Charge</p></th>
								<th><p align="center">Fixed Charge</p></th>
								<th><p align="center">Demand Charge</p></th>
							</tr>
							<?php
								if (mysqli_num_rows($display_units) > 0) {
									// output data of each row
									while($value = mysqli_fetch_assoc($display_units)) {
										echo "<tr>";
										echo "<td bgcolor='#F7FCB1'><p align='left'>&nbsp;&nbsp;".$value['tariff_unit_id']."</td>";
										echo "<td bgcolor='#E5FCAB'><p align='right'>".$value['start_unit']."&nbsp;&nbsp;</p></td>";
										echo "<td bgcolor='#E5FCAB'><p align='right'>".$value['end_unit']."&nbsp;&nbsp;</p></td>";
										echo "<td bgcolor='#E5FCAB'><p align='right'>".$value['unit_charge']."&nbsp;&nbsp;</p></td>";
										echo "<td bgcolor='#E5FCAB'><p align='right'>".$value['fixed_charge']."&nbsp;&nbsp;</p></td>";
										echo "<td bgcolor='#E5FCAB'><p align='right'>".$value['demand_charge']."&nbsp;&nbsp;</p></td>";
										echo "</tr>";
									}
								}
								//mysqli_close($con);
							?>
						</table>
				</div>
				</div>
				</div>
				
              <div class="tab-pane fade" id="panelThree-2">
                   <div class="modal-dialog">
					<div class="loginmodal-container">
						<p align="center"><h3 style="color:#003366; font-size:18px font-family:'Gill Sans', 'Gill Sans MT', 'Myriad Pro', 'DejaVu Sans Condensed', Helvetica, Arial, sans-serif;" align="center">Time Tariff  Rates Table</h3></p><br>
					
					<table align="center" width="500" border="2">
							<tr bgcolor="#FFEEB8">
								<th><p align="center"> Tariff ID </p></th>
								<th><p align="center"> Peak </p></th>
								<th><p align="center"> Off-Peak </p></th>
								<th><p align="center"> Day <p></th>
								<th><p align="center">Fixed Charge</p></th>
								<th><p align="center">Demand Charge</p></th>
							</tr>
							<?php
								if (mysqli_num_rows($display_times) > 0) {
									// output data of each row
									while($value = mysqli_fetch_assoc($display_times)) {
										echo "<tr>";
										echo "<td bgcolor='#F7FCB1'><p align='left'>&nbsp;&nbsp;".$value['tariff_time_id']."</td>";
										echo "<td bgcolor='#E5FCAB'><p align='right'>".$value['peak']."&nbsp;&nbsp;</p></td>";
										echo "<td bgcolor='#E5FCAB'><p align='right'>".$value['off_peak']."&nbsp;&nbsp;</p></td>";
										echo "<td bgcolor='#E5FCAB'><p align='right'>".$value['day']."&nbsp;&nbsp;</p></td>";
										echo "<td bgcolor='#E5FCAB'><p align='right'>".$value['fixed_charge']."&nbsp;&nbsp;</p></td>";
										echo "<td bgcolor='#E5FCAB'><p align='right'>".$value['demand_charge']."&nbsp;&nbsp;</p></td>";
										echo "</tr>";
									}
								}
								//mysqli_close($con);
							?>
						</table>
						<br>
						<table align="center" width="500">
							<tr>
								<td>
									<p><i>&nbsp;&nbsp;&nbsp;Peak - (18:30h - 22:30h)</i></p>
								</td>
								<td>
									<p><i>&nbsp;&nbsp;&nbsp;Off-Peak - (22:30h - 05:30h)</i></p>
								</td>
								<td>
									<p><i>&nbsp;&nbsp;&nbsp;Peak - (05:30h - 18:30h)</i></p>
								</td>
							</tr>
						</table>
						
					</div>
					</div>
              </div>
			  
        </div>
        </div>
        </div>

		<div class="tab-pane fade" id="panelFour">
			<div role="tabpanel">
            <ul class="nav nav-tabs" role="tablist">
              <li class="active"><a href="#panelFour-1" data-toggle="tab" role="tab">Update</a></li>
            </ul>
            <div id="tabContent2" class="tab-content">
              <div class="tab-pane fade in active" id="panelFour-1">
			  <div class="modal-dialog">
					<div class="loginmodal-container">
					<form id="check_pwd" method="POST" action="">
						<p align="center"><h3 style="color:#003366; font-size:18px font-family:'Gill Sans', 'Gill Sans MT', 'Myriad Pro', 'DejaVu Sans Condensed', Helvetica, Arial, sans-serif;" align="center">Time Tariff Rates Table</h3></p><br>
						<input type="password" id="pwd" style="margin-left: 199px;width: 122px;"><br>
						<button type="button" id="update_elec" onclick="update();" style="margin-top: 24px;margin-bottom: 24px;margin-left: 181px;">Update electricity bill data</button>
					</form>
					</div>
					
				</div>

			</div>
			</div>
			</div>
			</div>
        
<nav class="navbar navbar-default navbar-fixed-top">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#topFixedNavbar1"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
        <a class="navbar-brand page-scroll" href="#page-top"><img src="images/adminTitle.png" alt="Data Entry Clerk"></a></div>
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
		//visible and hidden forms in "enter tariff details tab"
        function displayForm(c){ 
            if(c.value == "1"){
				 document.getElementById("form2").style.visibility='visible';
				 
				 document.getElementById("form3").style.visibility='hidden';  
            } 
            else if(c.value =="2"){
				document.getElementById("form2").style.visibility='hidden';
				
				document.getElementById("form3").style.visibility='visible';
            } 
            else{ 
            } 
         }
		
		//pass the new tariff id & info to php file
		function send_tariff_data(a,b){
		if(a=='' && b==''){
			if(a==''){
				document.getElementById('error1').innerHTML = "<<<< No value";
			}
			if(a==''){
				document.getElementById('error2').innerHTML = "<<<< No value";
			}
		}
		else{
		var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
						var result= this.responseText;
						alert (result);
						document.getElementById('tariff_id1').value = " ";
						document.getElementById('tariff_info').value = " ";
						document.getElementById('tariff_id_insert').value = a;
						document.getElementById('time_id_insert').value = a;//get value to tariff rate entering table
						
                    }
                };
                xmlhttp.open("GET","php/insertTariffInfo.php?tariff_id="+a+"&tariff_desc="+b,false);
                xmlhttp.send();
		}
    }
	
	//enter new tariff unit values
	function insert_unit_values(a,b,c,d,e,f){
		var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
						
						var result= this.responseText;
						alert (result);
						document.getElementById('tariff_id_drop').value = " ";
						document.getElementById('min_value').value = " ";
						document.getElementById('max_value').value = " ";
						document.getElementById('unit_charge').value = " ";
						document.getElementById('fixed_charge').value = " ";
						document.getElementById('demand_charge').value = " ";
                    }
                };
                xmlhttp.open("GET","php/insertTariffUnitData.php?tariff_id_drop="+a+"&start_unit="+b+"&end_unit="+c+"&unit_charge="+d+"&fixed_charge="+e+"&demand_charge="+f,false);
                xmlhttp.send();
	}
	
	//enter new tariff time values
	function insert_time_values(a,b,c,d,e,f){
		
		var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
						
						var result= this.responseText;
						alert (result);
						
						document.getElementById('tariff_time_id_drop').value = " ";
						document.getElementById('peak_value').value = " ";
						document.getElementById('off_peak_value').value = " ";
						document.getElementById('day_value').value = " ";
						document.getElementById('fixed_charge2').value = " ";
						document.getElementById('demand_charge2').value = " ";
                    }
                };
                xmlhttp.open("GET","php/insertTariffTimeData.php?tariff_id_drop="+a+"&peak_value="+b+"&off_peak_value="+c+"&day_value="+d+"&fixed_charge2="+e+"&demand_charge2="+f,false);
                xmlhttp.send();
	}
	
	//display update tariff details table
	function displayForm1(c){ 
            if(c.value == "1"){
				 document.getElementById("form1_unit").style.visibility='visible';
				 document.getElementById("form3_time").style.visibility='hidden';
				 document.getElementById("form1_time").style.visibility='hidden';
            } 
            else if(c.value =="2"){
				document.getElementById("form1_unit").style.visibility='hidden';
				document.getElementById("form3_time").style.visibility='hidden';
				document.getElementById("form1_time").style.visibility='visible';
            } 
            else if(c.value == "3"){
				document.getElementById("form1_unit").style.visibility='hidden';
				document.getElementById("form3_time").style.visibility='visible';
				document.getElementById("form1_time").style.visibility='hidden';
            } 
         }
		 
	//display delete tariff details table
	function displayForm2(c){ 
            if(c.value == "1"){
				 document.getElementById("form2_unit").style.visibility='visible';
				 
				 document.getElementById("form2_time").style.visibility='hidden';  
            }
            else if(c.value =="2"){
				document.getElementById("form2_unit").style.visibility='hidden';
				
				document.getElementById("form2_time").style.visibility='visible';
            } 
            else{ 
            } 
         }
		 
	//get tariff unit detaills for update
	function get_unit_data(a,b,c){
		
		var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
						
						var result= this.responseText;
						var dev = result.split("+");
						document.getElementById("unit_charge_up").value = dev[0];
						document.getElementById("fixed_charge_up").value = dev[1];
						document.getElementById("demand_charge_up").value = dev[2];
						//alert(result);
                    }
                };
                xmlhttp.open("GET","php/getTariffUnitDataForUpdate.php?tariff_id="+a+"&min="+b+"&max="+c,true);
                xmlhttp.send();
	}
	
	//disable tariff unit id,min,max when update it
	function lock(){
	
		document.getElementById('tariff_unit_id_drop1').disabled="true";
		document.getElementById('tariff_unit_min_drop1').disabled="true";
		document.getElementById('tariff_unit_max_drop1').disabled="true";
	}
	
	//send tariff unit data for update
	function update_unit_values(a,b,c,d,e,f){
		var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
						
						var result= this.responseText;
						alert(result);
						
						document.getElementById('tariff_unit_id_drop1').value = " ";
						document.getElementById('tariff_unit_min_drop1').value = " ";
						document.getElementById('tariff_unit_max_drop1').value = " ";
						document.getElementById('unit_charge_up').value = " ";
						document.getElementById('fixed_charge_up').value = " ";
						document.getElementById('demand_charge_up').value = " ";
                    }
                };
                xmlhttp.open("GET","php/updateTariffUnitData.php?tariff_id="+a+"&min="+b+"&max="+c+"&unit_charge="+d+"&fixed_charge="+e+"&demand_charge="+f,false);
                xmlhttp.send();
	}
	
	//get tariff time detaills for update
	function get_time_data(a){
		
		var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
						
						var result= this.responseText;
						var dev = result.split("+");
						document.getElementById("peak_up").value = dev[0];
						document.getElementById("off_peak_up").value = dev[1];
						document.getElementById("day_up").value = dev[2];
						document.getElementById("fixed_charge_up2").value = dev[3];
						document.getElementById("demand_charge_up2").value = dev[4];
						//alert(result);
                    }
                };
                xmlhttp.open("GET","php/getTariffTimeDataForUpdate.php?tariff_id="+a,true);
                xmlhttp.send();
	}

	//get tariff time plan details for update
	function get_time_plan_data(a){
		
		var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
						
						var result= this.responseText;
						var dev = result.split("+");
						document.getElementById("peak_up").value = dev[0];
						document.getElementById("off_peak_up").value = dev[1];
						document.getElementById("day_up").value = dev[2];
						document.getElementById("fixed_charge_up2").value = dev[3];
						document.getElementById("demand_charge_up2").value = dev[4];
						//alert(result);
                    }
                };
                xmlhttp.open("GET","php/getTariffTimeDataForUpdate.php?tariff_id="+a,true);
                xmlhttp.send();
	}
	
	//disable tariff time id, when update it
	function lock1(){
		document.getElementById('tariff_time_id_drop1').disabled="true";
	}
	
	//send data for update tariff time table
	function update_time_values(a,b,c,d,e,f){
		
		var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
						
						var result= this.responseText;
						alert(result);
						
						document.getElementById('tariff_time_id_drop1').value = " ";
						document.getElementById('peak_up').value = " ";
						document.getElementById('off_peak_up').value = " ";
						document.getElementById('day_up').value = " ";
						document.getElementById('fixed_charge_up2').value = " ";
						document.getElementById('demand_charge_up2').value = " ";
                    }
                };
                xmlhttp.open("GET","php/updateTariffTimeData.php?tariff_id="+a+"&peak="+b+"&off_peak="+c+"&day="+d+"&fixed_charge="+e+"&demand_charge="+f,false);
                xmlhttp.send();
	}
	
	//delete tariff unit data
	function delete_unit_values(a,b,c){
	
		var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
						
						var result= this.responseText;
						alert(result);
						document.getElementById('tariff_unit_id_drop2').value=" ";
						document.getElementById('tariff_unit_min_drop2').value=" ";
						document.getElementById('tariff_unit_max_drop2').value=" ";
                    }
                };
                xmlhttp.open("GET","php/deleteTariffUnitData.php?tariff_id="+a+"&min="+b+"&max="+c,false);
                xmlhttp.send();
	}
	
	//delete tariff time data
	function delete_time_values(a){
		
		var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
						
						var result= this.responseText;
						alert(result);
						document.getElementById('tariff_time_id_drop2').value=" ";
                    }
                };
                xmlhttp.open("GET","php/deleteTariffTimeData.php?tariff_id="+a,false);
                xmlhttp.send();
	}
	
    </script>
	<script>
function myFunction() {
    var table = document.getElementById("myTable");
    var row = table.insertRow(0);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);
    var cell5 = row.insertCell(4);
    var cell6 = row.insertCell(5);
    cell1.innerHTML = "<p><input type='number' id='min_value' name='min_value' style='width:50px;' required /></p>";
    cell2.innerHTML = "<p><input type='number' id='max_value' name='max_value' style='width:50px;' required /></p>";
    cell3.innerHTML = "<p><input type='number' id='unit_charge' name='unit_charge' style='width:70px;' required /></p>";
    cell4.innerHTML = "<p><input type='number' id='fixed_charge' name='fixed_charge' style='width:80px;' required /></p>";
    cell5.innerHTML = "<p><input type='number' id='demand_charge' name='demand_charge' style='width:100px;' required /></p>";
    cell6.innerHTML = "<button type='button' id='btn_insert_unit' onclick='insert_unit_values(getElementById('tariff_id_drop').value,getElementById('min_value').value,getElementById('max_value').value,getElementById('unit_charge').value,getElementById('fixed_charge').value,getElementById('demand_charge').value);'>";
}
  </div>
</div>
</div>
</div>
</body>
</html>

