<?php
	require_once 'connection.php';

	$con_Id = $_GET["con_Id"];
	
	
    $sql = "SELECT * FROM consumer_table WHERE con_id='".$con_Id."'";
    $result = $conn->query($sql);
    if($result->num_rows>0)
        {
            while($row = $result->fetch_assoc())
                    {	
						 echo $row["con_title"]."+".$row["con_name"]."+".$row["con_nic"]."+".$row["con_address"]."+".$row["con_contact"]."+".$row["con_email"]."+".$row["con_password"]."+".$row["premises_id"]."+".$row["tariff_id"];
                    }
        }
        else{
            echo"No Result";
        }
        $conn->close();
		
		
?>