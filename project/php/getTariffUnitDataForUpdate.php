<?php
	require_once 'connection.php';

	$tariff_id = $_GET["tariff_id"];
	$min = $_GET['min'];
	$max = $_GET['max'];
	//echo $min;
	
	
    $sql = "SELECT unit_charge,fixed_charge,demand_charge FROM tariff_unit_table WHERE (tariff_unit_id='$tariff_id' AND start_unit='$min' AND end_unit='$max')";
    $result = $conn->query($sql);
    if($result->num_rows>0)
        {
            while($row = $result->fetch_assoc())
                    {	
						 echo $row["unit_charge"]."+".$row["fixed_charge"]."+".$row["demand_charge"];
                    }
        }
        else{
            echo"You entered invalid values";
        }
        $conn->close();
		
		
?>