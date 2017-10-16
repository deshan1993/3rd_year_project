<?php
    $year = $_POST['year'];
    $month = $_POST['month'];

    // $year=2017;
    // $month=9;
    $total_unit = 0;
    $total_charge=0;
    $peak_charge=0;
    $off_peak_charge=0;
    $day_charge=0;
    $peak_total=0;
    $off_peak_total=0;
    $day_total=0;

    $con_time_total = 0; //time based no of units
    $con_time_charge = 0; //time based charges
    $con_unit_charge=0;
    $con_unit_total=0;

    $total=0;
    $charge=0;

    $con = mysqli_connect("localhost","root","","electricity_data");

    //get total consume units
		$query_tot = "SELECT SUM(consumption) AS consumption FROM electricity_bill_table WHERE (year = '$year' AND month = '$month')";
		$result_tot = mysqli_query($con, $query_tot); 
		$row_tot = mysqli_fetch_assoc($result_tot); 
        $total_unit = $row_tot['consumption'];
        
    //get total electrcity unit charges with time based
        $pay_tot = "SELECT SUM(bill_amount) AS bill_amount FROM electricity_bill_table WHERE (year = '$year' AND month = '$month')";
        $result_tot = mysqli_query($con, $pay_tot); 
        $row_pay = mysqli_fetch_assoc($result_tot);
        $total_charge = $row_pay['bill_amount'];

    //get income from peak time
        $query_peak = "SELECT SUM(peak_rs) AS peak_tot FROM consumption_time_table WHERE (year = '$year' AND month = '$month')";
        $result_peak = mysqli_query($con, $query_peak); 
        $row_peak = mysqli_fetch_assoc($result_peak); 
        $peak_charge = $row_peak['peak_tot'];

    //get income from  off peak time
        $query_off_peak = "SELECT SUM(off_peak_rs) AS off_peak_tot FROM consumption_time_table WHERE (year = '$year' AND month = '$month')";
        $result_off_peak = mysqli_query($con, $query_off_peak); 
        $row_off_peak = mysqli_fetch_assoc($result_off_peak); 
        $off_peak_charge = $row_off_peak['off_peak_tot'];

    //get income from  day time
        $query_day = "SELECT SUM(day_rs) AS day_tot FROM consumption_time_table WHERE year = '$year' AND month = '$month'";
        $result_day = mysqli_query($con, $query_day); 
        $row_day = mysqli_fetch_assoc($result_day); 
        $day_charge = $row_day['day_tot'];

    //get peak consumption total
        $query_day1 = "SELECT SUM(peak_con) AS peak_con FROM consumption_time_table WHERE year = '$year' AND month = '$month'";
        $result_day1 = mysqli_query($con, $query_day1); 
        $row_day1 = mysqli_fetch_assoc($result_day1); 
        $peak_total = $row_day1['peak_con'];
    
    //get off peak consumption total
        $query_day2 = "SELECT SUM(off_peak_con) AS off_peak_con FROM consumption_time_table WHERE year = '$year' AND month = '$month'";
        $result_day2 = mysqli_query($con, $query_day2); 
        $row_day2 = mysqli_fetch_assoc($result_day2); 
        $off_peak_total = $row_day2['off_peak_con'];

    //get day consumption total
        $query_day3 = "SELECT SUM(day_con) AS day_con FROM consumption_time_table WHERE year = '$year' AND month = '$month'";
        $result_day3 = mysqli_query($con, $query_day3); 
        $row_day3 = mysqli_fetch_assoc($result_day3); 
        $day_total = $row_day3['day_con'];

        $con_time_charge = $peak_charge + $off_peak_charge + $day_charge;
        $con_time_total = $peak_total + $off_peak_total + $day_total;

        $con_unit_charge = $total_charge - $con_time_charge;
        $con_unit_total = $total_unit - $con_time_total;

        //convert to
        $con_unit_charge1 = number_format($con_unit_charge, 2);
        $con_time_charge1 = number_format($con_time_charge, 2);
        $peak_charge1 = number_format($peak_charge, 2);
        $off_peak_charge1 = number_format($off_peak_charge, 2);
        $day_charge1 = number_format($day_charge, 2);
        $total_charge1 = number_format($total_charge, 2);
        $charge = $total_charge1;
       

        //total time tariff income
        $data = array('con_unit_charge1'=>$con_unit_charge1, 
        'con_unit_total1'=>$con_unit_total,
        'con_time_total'=>$con_time_total,
        'con_time_charge1'=>$con_time_charge1,
        'peak_total'=>$peak_total,
        'peak_charge1'=>$peak_charge1,
        'off_peak_total'=>$off_peak_total,
        'off_peak_charge1'=>$off_peak_charge1,
        'day_total'=>$day_total,
        'day_charge1'=>$day_charge1,
        'total_unit'=>$total_unit,
        'total_charge1'=>$total_charge1,
        'charge'=>$charge,
        'year1'=>$year,
        'month1'=>$month);
        $data = json_encode($data);
        echo $data;

    
?>