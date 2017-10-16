<?php
	require_once 'connection.php';

	$tariff_id = $_GET["tariff_id"];
	
    $sql = "SELECT peak,off_peak,day,fixed_charge,demand_charge FROM tariff_time_table WHERE tariff_time_id='$tariff_id'";
    $result = $conn->query($sql);
    if($result->num_rows>0)
        {
            while($row = $result->fetch_assoc())
                    {	
						 echo $row["peak"]."+".$row["off_peak"]."+".$row["day"]."+".$row["fixed_charge"]."+".$row["demand_charge"];
                    }
        }
        else{
            echo"You entered invalid values";
        }
        $conn->close();
		
		
?>