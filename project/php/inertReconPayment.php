<?php
    $con_id = $_POST['con_id'];
    $re_due = $_POST['re_due'];
    $re_pay = $_POST['re_pay'];
    $re_mon_bill = $_POST['re_mon_bill'];
    $remain1 = $re_pay - $re_due;
    $remain = $remain1 - $re_mon_bill;

    $year = date('Y');
    $month = date('m');
    $date1 = date("Y-m-d");
    $date2 = date("Y-m-d H:m:s");

    $con = mysqli_connect("localhost","root","","electricity_data");
    
    $query1 = "INSERT INTO reconnecting_payment (con_id,recon_date,recon_payment) VALUES ('$con_id','$date1','$re_due')";
    $query2 = "INSERT INTO consumer_payment (con_id,year,month,payment_date,bill_amount,payment_value,remain) VALUES 
    ('$con_id','$year','$month','$date2','$re_mon_bill','$remain1','$remain')";

    if(mysqli_query($con,$query1)){
        echo "successfully pay";
    }
    else{
        echo "Error: ". $conn->error;
    }

    if(mysqli_query($con,$query2)){
        echo "successfully pay";
    }
    else{
        echo "Error: ". $conn->error;
    }

    $con->close();
?>