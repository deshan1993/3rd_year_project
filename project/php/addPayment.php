<?php

$payment = $_POST['payment'];
$year = $_POST['year'];
$month = $_POST['month'];
$total_bill = $_POST['total_bill'];
$con_id = $_POST['con_id'];
$dateTime = date("Y-m-d H:m:s");
$remain = $total_bill - $payment;
//echo $dateTime;

$con = mysqli_connect("localhost","root","","electricity_data");
$insert_payment = "INSERT INTO consumer_payment (con_id,year,month,payment_date,bill_amount,payment_value,remain) VALUES ('$con_id','$year','$month','$dateTime','$total_bill','$payment','$remain')";
//$data_insert_query1 = "INSERT INTO consumption_time_table (con_id,year,month,peak_con,off_peak_con,day_con,peak_rs,off_peak_rs,day_rs) VALUES ('$con_id','$year','$month','$sum1','$sum2','$sum3','$total_peak','$total_off_peak','$total_day')";
if (mysqli_query($con,$insert_payment) === FALSE){
    echo "Error: " . $data_insert_query . "<br>" . $con->error;
    }
    else{
        echo "Successfully paid your monthly bill";
        $is_paid = "UPDATE electricity_bill_table SET is_paid=1 WHERE con_id='$con_id' AND year='$year' AND month='$month'";
        if(mysqli_query($con,$is_paid) === FALSE){
            echo "Error: ".$is_paid."<br>".$con->error;
        }
            
    }  
?>