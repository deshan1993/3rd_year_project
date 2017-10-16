<?php
    
    $con_id = $_GET["con_id"];
    $con_tariff = $_GET["con_tariff"];

    alert("$con_id");

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "electricity_data";

    $conn = new mysqli($servername,$username,$password,$database);

    //check the connection
    if($conn->connect_error){
        die("Connection failed: ". $conn->connect_error);
    }
    //echo "Connected Successfully";



$conn->close();
?>