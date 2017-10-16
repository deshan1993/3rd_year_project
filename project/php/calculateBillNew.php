<?php

    $pwd = $_POST['pwd'];
    //echo $pwd;

    if($pwd == '0000'){
    $con = mysqli_connect("localhost","root","","electricity_data");

    $year = date("Y");
    $month = date("m");

    $consumerData = array();
    $x=0;
    //$data = "";
    
    //calculate D-1 and sum less than 60 bill
    $tariffUnitArrayD = array();
    

    

    $tariffUnitArray = array(); //array for keep tariff unit table details
    $tariffTimeArray = array(); //array for keep tariff time table details
    $tariffUnitArray[-1]['max']=0;
    
    
            $query = mysqli_query($con, "SELECT con_id,tariff_id FROM consumer_table");
            
            while($row = mysqli_fetch_assoc($query)){

                $count=0;
                $count1=0;
                $count2=0;
                $i=0;
                $gap=0;
                $total = 0;
                $total1=0;
                $total2=0;
                $remain=0;
                $total_bill=0;
                $tariff_id=0;
                $sum=0;
                $bill_sum=0;
                $bill_adj=0;
                $outstanding=0;
                $totalBill=0;

                $sum1=0;//peak
                $sum2=0;//off_peak
                $sum3=0;//day
                $total_peak=0;
                $total_off_peak=0;
                $total_day=0;
                $payment_sum=0;
                $pre_month_bill=0;
                $remain_payment=0;

                //get con_id and tariff_id
                $consumerData[] = array('con_id'=>$row['con_id'], 'tariff_id'=>$row['tariff_id']);
                $con_id = $consumerData[$x]['con_id'];
                $tariff_id = $consumerData[$x]['tariff_id'];

                //for get sum of this monthly electricity consumption
                $query2 = "SELECT SUM(cons_amount) AS amount_sum FROM consumption_table WHERE (con_id = '$con_id' AND YEAR(cons_date) = '$year' AND MONTH(cons_date) = '$month') ";
                $result2 = mysqli_query($con, $query2); 
                $row2 = mysqli_fetch_assoc($result2); 
                $sum = $row2['amount_sum']; //sum of monthly electricity consumption
                $sum_assign = $sum;

                //get remain payment amount
                $sql_remain = "SELECT remain FROM consumer_payment WHERE con_id='$con_id' AND year<'$year' AND month<'$month' ORDER BY payment_id DESC LIMIT 1 ";
                $result_remain = mysqli_query($con, $sql_remain);
                if($row_remain = mysqli_fetch_assoc($result_remain)){
                    
                    $remain_payment = $row_remain['remain'];
                }
                else{
                    $remain_payment=0;
                }


                //for get previous month issue bill amount
                $sql_sum = "SELECT SUM(total_amount) AS bill_sum FROM electricity_bill_table WHERE (year <= '$year' AND month < '$month' AND con_id='$con_id')";
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


                
                
                //calculate electricity bill for tariff unit vise
                if($tariff_id != "GP-2" || $tariff_id !="GP-3" || $tariff_id != "H-2" || $tariff_id != "H-3" || $tariff_id != "I-2" || $tariff_id !="I-3" || $tariff_id != "D-2"){
                    
                        if($tariff_id=='D-1'){
                            if($sum<=60 && $sum>=0){
                                
                            
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
                            if($sum>60){//grater than 60 and D-1
                                $query_D = mysqli_query($con, "SELECT * FROM tariff_unit_table WHERE tariff_unit_id ='D-1' ");
                                
                                while($row = mysqli_fetch_assoc($query_D)){
                                
                                    $tariffUnitArray[] = array('tariff_id'=>$row['tariff_unit_id'], 'min'=>$row['start_unit'], 'max'=>$row['end_unit'], 'unit_charge'=> $row['unit_charge'], 'fixed_charge'=> $row['fixed_charge'], 'demand_charge'=> $row['demand_charge']);
                                    $count1++;
                                }
                                
                                $tariffUnitArray[-1]['max']=0;
                    
                                while($i<$count1){
                    
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
                                $count2++;
                                
                            }
                            
                            
                    
                            while($i<$count2){
                    
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
                            // $total += $total1+$total2;
                            // echo $total2."<br>";
                        }
                    }//end of tariff unit calculation

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
                
                            $data_insert_query1 = "INSERT INTO consumption_time_table (con_id,year,month,peak_con,off_peak_con,day_con,peak_rs,off_peak_rs,day_rs) VALUES ('$con_id','$year','$month','$sum1','$sum2','$sum3','$total_peak','$total_off_peak','$total_day')";
                            if (mysqli_query($con,$data_insert_query1) === FALSE){
                                echo "Error: " . $data_insert_query . "<br>" . $con->error;
                                }   
                        }
                   //end of calculate tariff time electricity bill
                    
                
                    

                        $totalBill = $total + $outstanding;

                //echo $sum_assign."*********".$bill_sum."-".$bill_adj."=".$outstanding."//monthly bill".$total." totalpay".$totalBill."<br>";
                // //echo $sum."<br>";

                $data_insert_query = "INSERT INTO electricity_bill_table (con_id,year,month,consumption,bill_amount,outstanding,total_amount) VALUES ('$con_id','$year','$month','$sum_assign','$total','$outstanding','$totalBill')";
                if (mysqli_query($con,$data_insert_query) === FALSE){
                        $data =  "Error: '.$data_insert_query.'<br>' . $con->error";
                    }
                else{
                    $data = 'Successfully electricity bills are uploaded';
                }
                
                $x++;

            }
    
            $con->close();
        }
        else{
            $data = 'You entered invalid password';
        }
        
        echo $data;

?>