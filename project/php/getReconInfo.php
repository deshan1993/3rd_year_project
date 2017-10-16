<?php
    $con_id = $_POST['con_id'];
    //$con_id = 'Con-0001';
    $recon_total=0;
    
    $con = mysqli_connect("localhost","root","","electricity_data");

    $queryNew = "SELECT tariff_id FROM consumer_table WHERE con_id='$con_id'";
    $result_new = mysqli_query($con, $queryNew);
    $row_new = mysqli_fetch_assoc($result_new);
    $tariff_id = $row_new['tariff_id'];

    $year = date("Y");
    $month = date("m");
    
    $tariff = $tariff_id;
    $count = 0;
    $i=0;
    $gap=0;
    $total = 0;
    $total1=0;
    $total2=0;
    $remain=0;
    
    $remain_payment=0;
    $total_bill = 0;
    $pre_month_bill=0;
    //$bill_adj = 0;
    $bill_sum = 0;
    $payment_sum = 0;
    $recon_amount=0;
    
    //for get sum of this monthly electricity consumption
    $sql = "SELECT SUM(cons_amount) AS amount_sum FROM consumption_table WHERE con_id = '$con_id' AND YEAR(cons_date) = '$year' AND MONTH(cons_date) = '$month' ";
    $result = mysqli_query($con, $sql); 
    $row = mysqli_fetch_assoc($result); 
    $sum = $row['amount_sum']; //sum of monthly electricity consumption
    $sum_assign = $sum;
    
    //get remain payment amount
    $sql_remain = "SELECT remain FROM consumer_payment WHERE con_id='$con_id' ORDER BY payment_id DESC LIMIT 1 ";
    $result_remain = mysqli_query($con, $sql_remain);
    if(mysqli_fetch_row($result_remain)>0){
        $row_remain = mysqli_fetch_assoc($result_remain);
        $remain_payment = $row_remain['remain'];
    }
    else{
        $remain_payment=0;
    }
    
    //for get previous month issue bill amount
    $sql_sum = "SELECT SUM(total_amount) AS bill_sum FROM electricity_bill_table WHERE ( con_id='$con_id' AND year <= '$year' AND month < '$month')";
    $result_sum = mysqli_query($con, $sql_sum); 
    $row_sum = mysqli_fetch_assoc($result_sum); 
    $bill_sum = $row_sum['bill_sum']; //sum of previous outstanding bills total
    
    //sum of bill payments
    //for get sum of electrcity bills
    $sql_pay = "SELECT SUM(payment_value) AS payment_sum FROM consumer_payment WHERE con_id = '$con_id'";
    $result_pay_sum = mysqli_query($con, $sql_pay); 
    $row_pay = mysqli_fetch_assoc($result_pay_sum); 
    $payment_sum = $row_pay['payment_sum']; //sum of monthly electricity consumption
    
    $pre_month_bill = $bill_sum - $payment_sum;
    
    $outstanding = $remain_payment + $pre_month_bill;
    
    
    
    /***********************************************************************************************/
    
    //get tariff data to array
    $tariffUnitArray = array(); //array for keep tariff unit table details
    $tariffTimeArray = array(); //array for keep tariff time table details
    
    //calculate electricity bill
    if($tariff != "GP-2" || $tariff !="GP-3" || $tariff != "H-2" || $tariff != "H-3" || $tariff != "I-2" || $tariff !="I-3" || $tariff != "$tariff"){
    
        if($tariff=='D-1'){
            if($sum<=60){
                //calculate D-1 and sum less than 60 bill
                    $tariffUnitArrayD = array();
            
                    $query_D0 = mysqli_query($con, "SELECT * FROM tariff_unit_table WHERE tariff_unit_id ='D-0' ");
                    
                    while($row = mysqli_fetch_assoc($query_D0)){
                    
                        $tariffUnitArrayD[] = array('tariff_id'=>$row['tariff_unit_id'], 'min'=>$row['start_unit'], 'max'=>$row['end_unit'], 'unit_charge'=> $row['unit_charge'], 'fixed_charge'=> $row['fixed_charge'], 'demand_charge'=> $row['demand_charge']);
                        $count++;
                    }
                    
                    $tariffUnitArrayD[-1]['max']=0;
                    while($i<$count){
                        $gap = $tariffUnitArrayD[$i]['max'] - $tariffUnitArrayD[$i-1]['max'];
                        if($sum<=$gap && $sum>0){
                            $total1 += ($sum*$tariffUnitArrayD[$i]['unit_charge'])+($tariffUnitArrayD[$i]['fixed_charge']+$tariffUnitArrayD[$i]['demand_charge']);
                            $sum = 0;
                        }
                        if($sum>$gap && $sum>0){
                            //$remain = $sum-$gap;
                            $total2 += (($tariffUnitArrayD[$i]['max']-$tariffUnitArrayD[$i-1]['max'])*$tariffUnitArrayD[$i]['unit_charge'])+($tariffUnitArrayD[$i]['fixed_charge']+$tariffUnitArrayD[$i]['demand_charge']);
                            $remain = $sum - ($tariffUnitArrayD[$i]['max']-$tariffUnitArrayD[$i-1]['max']);
                            $sum=$remain;
                        }
                        $i++;
                    }
                    $total += $total1+$total2;
                
            }
            else{//grater than 60 and D-1
                $query_D = mysqli_query($con, "SELECT * FROM tariff_unit_table WHERE tariff_unit_id ='D-1' ");
                
                while($row = mysqli_fetch_assoc($query_D)){
                
                    $tariffUnitArray[] = array('tariff_id'=>$row['tariff_unit_id'], 'min'=>$row['start_unit'], 'max'=>$row['end_unit'], 'unit_charge'=> $row['unit_charge'], 'fixed_charge'=> $row['fixed_charge'], 'demand_charge'=> $row['demand_charge']);
                    $count++;
                }
                
                $tariffUnitArray[-1]['max']=0;
    
                while($i<$count){
    
                    $gap = $tariffUnitArray[$i]['max'] - $tariffUnitArray[$i-1]['max'];
    
                    if($sum<=$gap && $sum>0){
                        $total1 += ($sum*$tariffUnitArray[$i]['unit_charge'])+($tariffUnitArray[$i]['fixed_charge']+$tariffUnitArray[$i]['demand_charge']);
                        $sum = 0;
                    }
                    if($sum>$gap && $sum>0){
                
                        $total2 += (($tariffUnitArray[$i]['max']-$tariffUnitArray[$i-1]['max'])*$tariffUnitArray[$i]['unit_charge'])+($tariffUnitArray[$i]['fixed_charge']+$tariffUnitArray[$i]['demand_charge']);
                        $remain = $sum - ($tariffUnitArray[$i]['max']-$tariffUnitArray[$i-1]['max']);
                        $sum=$remain;
                    }
                    $i++;
                }
                $total += $total1+$total2;
            
            }
        
            }
    
        else{//other tariffs
            $query_D = mysqli_query($con, "SELECT * FROM tariff_unit_table WHERE tariff_unit_id ='$tariff' ");
            
            while($row = mysqli_fetch_assoc($query_D)){
            
                $tariffUnitArray[] = array('tariff_id'=>$row['tariff_unit_id'], 'min'=>$row['start_unit'], 'max'=>$row['end_unit'], 'unit_charge'=> $row['unit_charge'], 'fixed_charge'=> $row['fixed_charge'], 'demand_charge'=> $row['demand_charge']);
                $count++;
                
            }
            
            $tariffUnitArray[-1]['max']=0;
    
            while($i<$count){
    
                $gap = $tariffUnitArray[$i]['max'] - $tariffUnitArray[$i-1]['max'];
    
                if($sum<=$gap && $sum>0){
                    $total1 += ($sum*$tariffUnitArray[$i]['unit_charge'])+($tariffUnitArray[$i]['fixed_charge']+$tariffUnitArray[$i]['demand_charge']);
                    $sum = 0;
                }
                if($sum>$gap && $sum>0){
            
                    $total2 += (($tariffUnitArray[$i]['max']-$tariffUnitArray[$i-1]['max'])*$tariffUnitArray[$i]['unit_charge'])+($tariffUnitArray[$i]['fixed_charge']+$tariffUnitArray[$i]['demand_charge']);
                    $remain = $sum - ($tariffUnitArray[$i]['max']-$tariffUnitArray[$i-1]['max']);
                    $sum=$remain;
                }
                $i++;
            }
            $total += $total1+$total2;
        }
    }
    
    //calculate tariff time electricity bill
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
            $total = $total_peak+$total_off_peak+$total_day+($fixed_charge1 + $demand_charge1);
            //echo $totalBill = $total + $outstanding;
                
            }
            //end of calculate tariff time electricity bill
    
             $total_bill = $total + $outstanding;// calculate total bill
             $recon_amount = ($total_bill)*0.2;
             $recon_total = $total_bill + $recon_amount;

             $data = array('total_bill'=>$total_bill, 'recon_amount'=>$recon_amount, 'recon_total'=>$recon_total);
             $data = json_encode($data);
             echo $data;
             
            $con->close();


?>