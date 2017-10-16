<?php
session_start();
unset($_SESSION['consumer_id']);
//session_destroy();
header("location: http://localhost:8080/Project/home page.html");
?>
