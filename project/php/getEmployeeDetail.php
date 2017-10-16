<?php
	require_once 'connection.php';

	$emp_id = $_GET["emp_id"];
	
	
    $sql = "SELECT * FROM employee_table WHERE emp_id='$emp_id'";
    $result = $conn->query($sql);
    if($result->num_rows>0)
        {
            while($row = $result->fetch_assoc())
                    {	
						 echo $row["emp_name"]."+".$row["emp_post"]."+".$row["emp_telephone"]."+".$row["emp_password"];
                    }
        }
        else{
            echo"No Result";
        }
        $conn->close();
		
		
?>