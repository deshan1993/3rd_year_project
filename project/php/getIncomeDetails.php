<?php
    $year = $_POST['year'];
    $month = $_POST['month'];

    // $year=2017;
    // $month=9;
    $loss=0;
    $bill_total=0;
    $pay_total=0;
    $libility=0;
    $peak_total=0;
    $off_peak_total=0;
    $day_total=0;
    $recon_total=0;
    $adjustment=0;
    $adjustment1 = number_format($adjustment, 2);
    $total_income=0;



    $con = mysqli_connect("localhost","root","","electricity_data");

    //get total electricity bill amount
		$query_tot = "SELECT SUM(bill_amount) AS bill_total FROM electricity_bill_table WHERE (year = '$year' AND month = '$month')";
		$result_tot = mysqli_query($con, $query_tot); 
		$row_tot = mysqli_fetch_assoc($result_tot); 
        $bill_total = number_format($row_tot['bill_total'], 2);
        
    //get total electrcity bill payments
        $pay_tot = "SELECT SUM(payment_value) AS pay_total FROM consumer_payment WHERE (year = '$year' AND month = '$month')";
        $result_tot = mysqli_query($con, $pay_tot); 
        $row_pay = mysqli_fetch_assoc($result_tot);
        $pay_total = $row_pay['pay_total'];
        $pay_total1 = number_format($pay_total, 2);

    //get income from peak time
    $query_peak = "SELECT SUM(peak_rs) AS peak_tot FROM consumption_time_table WHERE (year = '$year' AND month = '$month')";
    $result_peak = mysqli_query($con, $query_peak); 
    $row_peak = mysqli_fetch_assoc($result_peak); 
    $peak_total = number_format($row_peak['peak_tot'],2);

    //get income from  off peak time
    $query_off_peak = "SELECT SUM(off_peak_rs) AS off_peak_tot FROM consumption_time_table WHERE (year = '$year' AND month = '$month')";
    $result_off_peak = mysqli_query($con, $query_off_peak); 
    $row_off_peak = mysqli_fetch_assoc($result_off_peak); 
    $off_peak_total = number_format($row_off_peak['off_peak_tot'],2);

    //get income from  day time
    $query_day = "SELECT SUM(day_rs) AS day_tot FROM consumption_time_table WHERE year = '$year' AND month = '$month'";
    $result_day = mysqli_query($con, $query_day); 
    $row_day = mysqli_fetch_assoc($result_day); 
    $day_total = number_format($row_day['day_tot'],2);

    //income from reconnecting
    $query_recon = "SELECT SUM(recon_payment) AS recon_tot FROM reconnecting_payment WHERE YEAR(recon_date) = '$year' AND MONTH(recon_date) = '$month'";
    $result_recon = mysqli_query($con, $query_recon); 
    $row_recon = mysqli_fetch_assoc($result_recon); 
    $recon_total1 = $row_recon['recon_tot'];
    $recon_total = number_format($recon_total1, 2);

    //count of neglect bill payments
    $query_count1 = "SELECT COUNT(con_id) FROM electricity_bill_table WHERE (year = '$year' AND month = '$month' AND is_paid=0)";
    $result_count1 = mysqli_query($con, $query_count1); 
    $neglect_tot = mysqli_num_rows( $result_count1);

    //count of do payments
    $query_count2 = "SELECT COUNT(con_id) FROM electricity_bill_table WHERE (year = '$year' AND month = '$month' AND is_paid=1)";
    $result_count2 = mysqli_query($con, $query_count2); 
    $do_pay_tot = mysqli_num_rows( $result_count2);

    //neglect bill payment
    $query_neg_tot = "SELECT SUM(total_amount) AS neg_pay_tot FROM electricity_bill_table WHERE year = '$year' AND month = '$month' AND is_paid=0";
    $result_neg_tot = mysqli_query($con, $query_neg_tot); 
    $row_neg_pay_tot = mysqli_fetch_assoc($result_neg_tot);
    $neg_pay_total = $row_neg_pay_tot['neg_pay_tot'];
    $neg_pay_total1 = number_format($neg_pay_total, 2);

    $total_remain1=0;
    $total_remain=0;
    $total_remain=0;
    $remain_payment=0;
    $conArray = array();
    $i=0;
    $query = mysqli_query($con, "SELECT con_id FROM consumer_table");
    while($row = mysqli_fetch_array($query)){

        $conArray[$i] = $row['con_id'];

        $sql_remain = "SELECT remain FROM consumer_payment WHERE con_id='$conArray[$i]' AND year='$year' AND month='$month' ORDER BY payment_id DESC";
        $result_remain = mysqli_query($con, $sql_remain);
        if(mysqli_fetch_row($result_remain)>0){
            $row_remain = mysqli_fetch_assoc($result_remain);
            $remain_payment = $row_remain['remain'];
            
        }
        else{
            $remain_payment=0;
            
        }
        $total_remain1 += $remain_payment;
        $i++;
    }
    $total_remain = number_format($total_remain1, 2);
    //$remain_payment1 = number_format($remain_payment, 2);
    
    $total_income = $pay_total + $recon_total1 + $total_remain1;
    $total_incomes = number_format($total_income, 2);
    $total_income1 = $total_incomes;
    $total_income2 = $total_incomes;

    //total time tariff income
    $data = array('bill_total'=>$bill_total, 
    'recon_total'=>$recon_total,
    'peak_total'=>$peak_total,
    'off_peak_total'=>$off_peak_total,
    'day_total'=>$day_total,
    'pay_total'=>$pay_total1,
    'neg_pay'=>$neg_pay_total1,
    'advance'=>$total_remain,
    'adjustment'=>$adjustment1,
    'total_income'=>$total_income1,
    'total_income1'=>$total_income2,
    'year1'=>$year,
    'month1'=>$month);
    $data = json_encode($data);
    echo $data;

    
?>