<?php
// $data = array('abc'=>250, 'xyz'=>356);
// $data = json_encode($data);
// echo $data;


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

// document.getElementById('premises_list').value,document.getElementById('tariff_list').value,document.getElementById('amount').value)
$a_date = date("Y-m-d");
$d=cal_days_in_month(CAL_JEWISH_ADD_ALAFIM,09,2017);
echo $d=date('t');;

$last_date=DAY("Y-m-t", strtotime($a_date));
//echo $last_date;
?>