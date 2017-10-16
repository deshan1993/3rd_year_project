<?php
	session_start();
	if(!isset($_SESSION["emp_post"])){
		header("Location: http://localhost:8080/Project/php/staffLogin.php");
		
	}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" href="images/ceb.png">
<title>Electricity Bill Management System/Accountant Home page</title>
<!-- <link href="cs/bootstrap.css" rel="stylesheet" type="text/css"> -->
<link href="css/bootstrap-3.3.4.css" rel="stylesheet" type="text/css">
<link href="css/bootstrap1.css" rel="stylesheet" type="text/css">
<link href="css/consumerPageStyle.css" rel="stylesheet" type="text/css">
<link href="css/handleStaffAccount.css" rel="stylesheet" type="text/css">
<script src="js/jquery-3.2.1.min.js"></script>

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
			url: 'php/getIncomeDetails.php',
			type: 'POST',
			data:dataTosend,
			async: true,
			success: function (data) {
				var data = JSON.parse(data);
				//alert(data);
				$('#bill_total').html(data.bill_total);
				$('#recon_total').html(data.recon_total);
                $('#peak_total').html(data.peak_total);
                $('#off_peak_total').html(data.off_peak_total);
                $('#day_total').html(data.day_total);
                $('#pay_total').html(data.pay_total);
                $('#neg_pay').html(data.neg_pay);
                $('#advance').html(data.advance);
                $('#adjustment').html(data.adjustment);
                $('#total_income').html(data.total_income);
                $('#total_income1').html(data.total_income1);

                $('#year1').html(data.year1);
                $('#month1').html(data.month1);
				// $('#re_total').val(data.recon_total);
			
			},
		});
	}
</script>
</head>

<body style="padding-top: 70px;" background="images/admin_wallpaper.jpg">
<div role="tabpanel">
  <div role="tabpanel">
    <div role="tabpanel">
      <ul class="nav nav-tabs" role="tablist">
        <li class="active"><a href="#panelOne" data-toggle="tab" role="tab"><b>Monthly Income Report</b></a></li>
        <li><a href="#panelTwo" data-toggle="tab" role="tab"><b>Monthly Income - Charts</b></a></li>
      </ul>
      <div id="tabContent1" class="tab-content">
	  
		<!--panelOne-->
        <div class="tab-pane fade in active" id="panelOne">
			<div class="modal-dialog1">
			<div class="loginmodal-container-report">
            <!--search bar-->
            <form id="form1" method="POST" action="">
            <table align="center" width="600" style="padding: 200px;">
                <tr colspan="3">
                    <h2 style="padding-bottom: 20px;margin-left: 123px;margin-bottom: 32px;">Get Monthly Income Report</h2>
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
            </form>

            <!--Monthly Income report-->
            <div id="report1" style="display:none;">
				<table align="center" width="600" frame="box" style="padding: 200px;">
            	<tr bgcolor="#800000">
            		<th bgcolor="#800000" colspan="2" style="height: 80px;">
            			<p align="center" style="margin-top:10px;"><img src="images/monthly_income_report.png"></p>
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
                            <th class="text-center">Due Amount</th>
                            <th class="text-center">Paid Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="col-md-9"><b><em>Electricity unit sale (Rs.)</em></b></td>
                            <td class="col-md-1" style="text-align: center"></td>
                            <td class="col-md-1 text-right"><span id="bill_total"></span></td>
                            <td class="col-md-1 text-right"><span id="pay_total"></span></td>
                        </tr>
                        <tr>
                            <td class="col-md-9"><b><em>Reconnecting payment revenue (Rs.)</em></b></td>
                            <td class="col-md-1" style="text-align: center"></td>
                            <td class="col-md-1 text-right"></td>
                            <td class="col-md-1 text-right"><span id="recon_total"></span></td>
                        </tr>
                        <tr>
                            <td class="col-md-9"><b><em>Adjustment/Rebates (Rs.)</em></b></td>
                            <td class="col-md-1" style="text-align: center"></td>
                            <td class="col-md-1 text-right"></td>
                            <td class="col-md-1 text-right"><span id='adjustment'></span></td>
                        </tr>
                        <tr>
                            <td class="col-md-9"><b><em>Peak - Electricity sale (Rs.)</em></b></td>
                            <td class="col-md-1" style="text-align: center"></td>
                            <td class="col-md-1 text-right"><span id="peak_total"></span></td>
                            <td class="col-md-1 text-right"></td>
                        </tr>
                        <tr>
                            <td class="col-md-9"><b><em>Off Peak - Electricity sale (Rs.)</em></b></td>
                            <td class="col-md-1" style="text-align: center"></td>
                            <td class="col-md-1 text-right"><span id="off_peak_total"></span></td>
                            <td class="col-md-1 text-right"></td>
                        </tr>
                        <tr>
                            <td class="col-md-9"><b><em>Day - Electricity sale (Rs.)</em></b></td>
                            <td class="col-md-1" style="text-align: center"></td>
                            <td class="col-md-1 text-right"><span id="day_total"></span></td>
                            <td class="col-md-1 text-right"></td>
                        </tr>
                        <tr>
                            <td class="col-md-9"><b><em>Neglected bill payment (Rs.)</em></b></td>
                            <td class="col-md-1" style="text-align: center"></td>
                            <td class="col-md-1 text-right"></td>
                            <td class="col-md-1 text-right"><span id="neg_pay"></span></td>
                        </tr>
                        <tr>
                            <td class="col-md-9"><b><em>Amount paid in advance (Rs.)</em></b></td>
                            <td class="col-md-1" style="text-align: center"></td>
                            <td class="col-md-1 text-right"></td>
                            <td class="col-md-1 text-right"><span id="advance"></span></td>
                        </tr>
						<tr>
                            <td class="col-md-9"><b><em>Total Income (Rs.)</em></b></h4></td>
                            <td class="col-md-1" style="text-align: center"></td>
                            <td class="col-md-1 text-right"></td>
                            <td class="col-md-1 text-right"><span id="total_income"></span></td>
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
                            <td class="text-right"><h4><strong>Total:</strong></h4></td>
                            <td class="text-right text-danger"><h4><strong><span>Rs.&nbsp;</span><span id="total_income1"></span></strong></h4></td>
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
            </form>
            </div>
			</div>
			</div>
				
        </div>
		
		<!--panelTwo-->
		<div class="tab-pane fade" id="panelTwo">
        <div class="modal-dialog">
		<div class="loginmodal-container-report">
        <div>
		<button class="button" id="btn2" class="" style="padding-top: 7px;padding-bottom: 7px;padding-left: 13px;padding-right: 13px;margin-left: 157px;" onclick="location.href='http://localhost:8080/project/php/time_income_chart.php';">Load Income - Time Based</button><br>
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
        <a class="navbar-brand page-scroll" href="#page-top"><img src="images/accountantTitle.png" alt="Data Entry Clerk"></a></div>
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
    <!-- <script src="js/bootstrap.js" type="text/javascript"></script> -->
    <script src="js/bootstrap-3.3.4.js" type="text/javascript"></script>
</div>
</div>
</div>
</body>
</html>

