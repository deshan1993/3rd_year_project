<?php

	if(isset($_POST["login"])){
		if(!empty($_POST['userID']) && !empty($_POST['password'])){
			$userId = $_POST['userID'];
			$password = $_POST['password'];
			$conn = new mysqli('localhost','root','') or die (mysqli_error()); //DB connection_aborted
			$db = mysqli_select_db($conn,'electricity_data') or die("DB Error"); //select DB from database
			//select database
			$query = mysqli_query($conn, "SELECT * FROM consumer_table WHERE con_id='".$userId."' AND con_password='".$password."'");
			$numrows = mysqli_num_rows($query);
			if($numrows !=0){
				while($row = mysqli_fetch_assoc($query)){
					$dbcon_id = $row['con_id'];
					$dbcon_password = $row['con_password'];
				}
				if($userId == $dbcon_id && $password == $dbcon_password){
					session_start();
					$_SESSION['consumer_id']=$userId;
					header("Location: http://localhost:8080/Project/consumerHomePage.php");
				}
			}
			else{
				echo "Invalid Consumer ID or Password!";
			}
		}
		else{
			echo "Required All fields!";
		}
	}

	/*$userID = $_POST['userID'];
	$password = $_POST['password'];
	
	//connect to database
	mysql_connect("localhost", "root", "");
	mysql_select_db("electricity_data");
	
	//query the database for user
	$result = mysql_query("SELECT * FROM consumer_table WHERE con_id = '$userID' and con_password = '$password'")
	or die("Failed to query database ".mysql_error());
	
	$row = mysql_fetch_array($result);
	
	if($row['con_id'] == $userID && $row['con_password'] == $password)
	{
		echo "Login success!!! welcome";
		header('Location: http://localhost:8080/Project/consumerHomePage.php');
		
	}
	else
	{
		echo "Failed to login";
	}*/
	

?>