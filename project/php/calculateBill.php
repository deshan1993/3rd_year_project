<?php
    //$con_id = $_GET['con_id'];
    $con_id = 'Con-0001';
    $year = date("Y");
    $month = date("m");

    $count = 0;
    $i=0;
    $gap=0;
    $total = 0;
    $total1=0;
    $total2=0;
    $remain=0;
    $total_bill=0;
    $tariff_id=0;
    $reconnect_charge=0;
    

    $con=mysqli_connect("localhost","root","","electricity_data");
    $query1 = mysqli_query($con, "SELECT * FROM consumer_table WHERE con_id='$con_id'");
    while($row1 = mysqli_fetch_array($query1, MYSQL_ASSOC)){
        $tariff_id = $row1['tariff_id'];
        
        }
        //echo $tariff_id;
    
    //for get sum of this monthly electricity consumption
    $query2 = "SELECT SUM(cons_amount) AS amount_sum FROM consumption_table WHERE con_id = '$con_id' AND YEAR(cons_date) <= '$year' AND MONTH(cons_date) <= '$month' ";
    $result2 = mysqli_query($con, $query2); 
    $row2 = mysqli_fetch_assoc($result2); 
    $sum = $row2['amount_sum']; //sum of monthly electricity consumption

    $tariffUnitArray = array(); //array for keep tariff unit table details
    $tariffTimeArray = array(); //array for keep tariff time table details
    
    //calculate electricity bill
    if($tariff_id != "GP-2" || $tariff_id !="GP-3" || $tariff_id != "H-2" || $tariff_id != "H-3" || $tariff_id != "I-2" || $tariff_id !="I-3" || $tariff_id != "D-2"){
    
        if($tariff_id=='D-1'){
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
            $query_D = mysqli_query($con, "SELECT * FROM tariff_unit_table WHERE tariff_unit_id ='$tariff_id' ");
            
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
    
    if($tariff_id == "GP-2" || $tariff_id =="GP-3" || $tariff_id == "H-2" || $tariff_id == "H-3" || $tariff_id == "I-2" || $tariff_id =="I-3" || $tariff_id == "D-2"){
    
        //assign tariff time table values to variables
        $query_time = mysqli_query($con, "SELECT * FROM tariff_time_table WHERE tariff_time_id ='$tariff' ");
        
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
        
        $today_date = date("Y-m-d");
        
        if($implement_plan<$today_date){
            
        }
    
    }
    
    //for get sum of electrcity bills
    $sql_bill = "SELECT SUM(bill_amount) AS bill_sum FROM consumer_payment WHERE con_id = '$con_id'";
    $result_bill = mysqli_query($con, $sql_bill); 
    $row_bill = mysqli_fetch_assoc($result_bill); 
    $bill_sum = $row_bill['bill_sum']; //sum of monthly electricity consumption


    //for get adjustments
    $sql_adj = "SELECT SUM(payment_value) AS payment_sum FROM consumer_payment WHERE con_id = '$con_id'";
    $result_adj = mysqli_query($con, $sql_adj); 
    $row_adj = mysqli_fetch_assoc($result_adj); 
    $bill_adj = $row_adj['payment_sum']; //sum of monthly electricity consumption

    $outstanding = $bill_sum - $bill_adj;//assign outstanding amount

    $total_bill=$total+$outstanding;
    echo $total_bill;

    $con->close();
    

?>