<?php
    $con = mysqli_connect("localhost","root","","electricity_data");
    $tariff_id='D-2';
    $con_id='Con-0002';

    $year = date("Y");
    $month = date("m");

    $sum1=0;//peak
    $sum2=0;//off_peak
    $sum3=0;//day
    $sum=0;
    $total=0;
    $total_peak=0;
    $total_off_peak=0;
    $total_day=0;

    if($tariff_id == "GP-2" || $tariff_id =="GP-3" || $tariff_id == "H-2" || $tariff_id == "H-3" || $tariff_id == "I-2" || $tariff_id =="I-3" || $tariff_id == "D-2"){
        
            //assign tariff time table values to variables
            $query_time = mysqli_query($con, "SELECT * FROM tariff_time_table WHERE tariff_time_id ='$tariff_id' ");
            
                while($row = mysqli_fetch_array($query_time, MYSQL_ASSOC)){
                    $tariff_id1 = $row['tariff_time_id'];
                    $peak = $row['peak'];
                    $off_peak = $row['off_peak'];
                    $day = $row['day'];
                    $fixed_charge1 = $row['fixed_charge'];
                    $demand_charge1 = $row['demand_charge'];
                }
        
            //assign time plan table values to variables
            $query_plan = mysqli_query($con, "SELECT * FROM time_plan WHERE time_plan_id ='plan_01' ");
            
                while($row_plan = mysqli_fetch_array($query_plan, MYSQL_ASSOC)){
                    $peak_plan = $row_plan['peak'];
                    $off_peak_plan = $row_plan['off_peak'];
                    $day_plan = $row_plan['day'];
                    $implement_plan = $row_plan['implement_date'];
                }

            //get peak time sum
            $query_peak = "SELECT SUM(cons_amount) AS cons_peak FROM consumption_table WHERE (con_id = '$con_id' AND YEAR(cons_date) = '$year' AND MONTH(cons_date) = '$month' AND '$day_plan'<cons_time AND cons_time<='$peak_plan')";
            $result_peak = mysqli_query($con, $query_peak); 
            $row_peak = mysqli_fetch_assoc($result_peak); 
            $sum1 = $row_peak['cons_peak']; //sum of consumption in peak time
            $total_peak = ($sum1*$peak); //get peak bill

            //get off_peak time sum
            $query_off_peak = "SELECT SUM(cons_amount) AS cons_off_peak FROM consumption_table WHERE (con_id = '$con_id' AND YEAR(cons_date) = '$year' AND MONTH(cons_date) = '$month' AND '$peak_plan'>cons_time AND cons_time<='$off_peak_plan')";
            $result_off_peak = mysqli_query($con, $query_off_peak); 
            $row_off_peak = mysqli_fetch_assoc($result_off_peak); 
            $sum2 = $row_off_peak['cons_off_peak']; //sum of consumption in off peak time
            $total_off_peak = ($sum2*$off_peak);

            //get day time sum
            $query_day = "SELECT SUM(cons_amount) AS cons_day FROM consumption_table WHERE (con_id = '$con_id' AND YEAR(cons_date) = '$year' AND MONTH(cons_date) = '$month' AND  cons_time>'$off_peak_plan' AND cons_time<='$day_plan')";
            $result_day = mysqli_query($con, $query_day); 
            $row_day = mysqli_fetch_assoc($result_day); 
            $sum3 = $row_day['cons_day']; //sum of consumption in day time
            $total_day = ($sum3*$day);
            
            $sum = $sum1+$sum2+$sum3; //total monthly consumption
            echo $total = $total_peak+$total_off_peak+$total_day+($fixed_charge1 + $demand_charge1);

            $data_insert_query1 = "INSERT INTO consumption_time_table (con_id,year,month,peak_con,off_peak_con,day_con,peak_rs,off_peak_rs,day_rs) VALUES ('$con_id','$year','$month','$sum1','$sum2','$sum3','$total_peak','$total_off_peak','$total_day')";
            if (mysqli_query($con,$data_insert_query1) === TRUE) {
                echo "New record created successfully";
                } else {
                echo "Error: " . $data_insert_query . "<br>" . $con->error;
                }
            


            //echo "sum1 = ".$sum1."<br>sum2 = ".$sum2."<br>sum3 = ".$sum3."<br>";
           // echo $sum;     
        }//end of calculate tariff time electricity bill
        
?>