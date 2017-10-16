<?php
    $premises = $_POST['premises'];
	$tariff = $_POST['tariff'];
    $amount = $_POST['amount'];
    $year = $_POST['year'];
    $month = $_POST['month'];
    
    $consumerData = array();
    $x=0;

    $con = mysqli_connect("localhost","root","","electricity_data");
    
    echo "<h3>Payment neglect consumer list</h3>";
    echo "<table align='center' width='500' border='2'>";
    echo "<tr bgcolor='#FFEEB8'>";
        echo "<th><p align='center'>Consumer_ID</p></th>";
        echo "<th><p align='center'>Total Bill Amount</p></th></tr>";

    $query = mysqli_query($con, "SELECT con_id FROM consumer_table WHERE premises_id='$premises' AND tariff_id='$tariff'");
    while($row = mysqli_fetch_assoc($query)){

        //$amount=0;
        $outstanding;

         //get con_id and tariff_id
         $consumerData[] = array('con_id'=>$row['con_id']);
         $con_id = $consumerData[$x]['con_id'];
        
         //who neglect bill payment
         $query_amount = "SELECT con_id,total_amount FROM electricity_bill_table WHERE con_id='$con_id' AND is_paid=0 AND total_amount>'$amount' AND year='$year' AND month='$month'";
         $result_amount = mysqli_query($con,$query_amount);
         $row_amount = mysqli_fetch_assoc($result_amount);
         $amount = $row_amount['total_amount'];
         $neglect_con = $row_amount['con_id'];

         echo "<tr>";
         echo "<td bgcolor='#F7FCB1'><p align='left'>&nbsp;&nbsp;$neglect_con</td>";
         echo "<td bgcolor='#E5FCAB'><p align='right'>$amount&nbsp;&nbsp;</p></td>";
         echo "</tr>";

         $x++;

    }  
    echo "</table>";
        
        

$con->close();
   
?>