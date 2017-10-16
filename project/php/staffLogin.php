<?php
	
	if(isset($_POST["login"])){
		if(!empty($_POST['userPost']) && !empty($_POST['password'])){
			$userPost = $_POST['userPost'];
			$password = $_POST['password'];
			$conn = new mysqli('localhost','root','') or die (mysqli_error()); //DB connection_aborted
			$db = mysqli_select_db($conn,'electricity_data') or die("DB Error"); //select DB from database
			//select database
			$query = mysqli_query($conn, "SELECT * FROM employee_table WHERE emp_post='".$userPost."' AND emp_password='".$password."'");
			$numrows = mysqli_num_rows($query);
			if($numrows !=0){
				while($row = mysqli_fetch_assoc($query)){
					$dbemp_post = $row['emp_post'];
					$dbemp_password = $row['emp_password'];
				}
				if($userPost == $dbemp_post && $password == $dbemp_password){
					session_start();
					$_SESSION['emp_post']=$userPost;
					switch($_SESSION['emp_post'])
						{
							case 'Data Entry Clerk':
							header('Location: http://localhost:8080/Project/dataEntryClerkHomePage.php');
							break;
							
							case 'Electrical Engineer':
							header('Location: http://localhost:8080/Project/electricalEngineerHomePage.php');
							break;
							
							case 'Accountant':
							header('Location: http://localhost:8080/Project/accountantHomePage.php');
							break;
							
							case 'Revenue Clerk':
							header('Location: http://localhost:8080/Project/revenueClerkHomePage.php');
							break;
							
							case 'Admin':
							header('Location: http://localhost:8080/Project/adminHomePage.php');
							break;
						}
					
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
	/*
	$userPost = $_POST['userPost'];
	$password = $_POST['password'];
	
	//connect to database
	mysql_connect("localhost", "root", "");
	mysql_select_db("electricity_data");

	//query the database for user
	$result = mysql_query("SELECT * FROM employee_table WHERE emp_post = '$userPost'")
	or die(mysql_error());
	
	$row = mysql_fetch_array($result);
	
	if($row['emp_post'] == $userPost && $row['emp_password'] == $password)
	{
		//echo "Login success!!! welcome";
		switch($userPost)
		{
			case 'Data Entry Clerk':
			header('Location: http://localhost:8080/Project/dataEntryClerkHomePage.php');
			break;
			
			case 'Electrical Engineer':
			header('Location: http://localhost:8080/Project/electricalEngineerHomePage.html');
			break;
			
			case 'Accountant':
			header('Location: http://localhost:8080/Project/accountantHomePage.html');
			break;
			
			case 'Revenue Clerk':
			header('Location: http://localhost:8080/Project/revenueClerkHomePage.html');
			break;
			
			case 'Admin':
			header('Location: http://localhost:8080/Project/adminHomePage.html');
			break;
		}
		
		
	}
	else
	{
		echo "Failed to login";
		//echo "<script type='text/javascript'>alert('Failed to login!')</script>";
	}
	
*/
?>