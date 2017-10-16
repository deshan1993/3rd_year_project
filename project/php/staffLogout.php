<?php
session_start();
unset($_SESSION['emp_post']);
//session_destroy();
header("location: http://localhost:8080/Project/home page.html");
?>
