<?php

    $trans_id = $_POST['trans_id'];
    $fromDate = $_POST['fromDate'];
    $toDate = $_POST['toDate'];

    $con_total=0; //consumers consumption total
    $trans_total=0; //transformer unit amount
    $difference=0;

    $con = mysqli_connect("localhost","root","","electricity_data");

    $sql1 = "SELECT IFNULL(SUM(cons_amount),0) AS con_sum FROM consumption_table cns INNER JOIN consumer_table ct on cns.con_id=ct.con_id WHERE ct.premises_id in 
    (SELECT premises_id FROM premises_table prem INNER JOIN consumption_table cns WHERE transformer_id = '$trans_id' AND cons_date BETWEEN $fromDate AND $toDate)";

    $result1 = mysqli_query($con, $sql1);
    $row1 = mysqli_fetch_assoc($result1);
    $con_total = $row1['con_sum'];

    $sql2 = "SELECT IFNULL(SUM(usages),0) AS usages FROM transformer WHERE transformer_id='$trans_id' AND trans_date BETWEEN '$fromDate' AND '$toDate'";
    $result2 = mysqli_query($con, $sql2);
    $row2 = mysqli_fetch_assoc($result2);
    $trans_total = $row2['usages'];

    $difference = $trans_total - $con_total;

    echo "<table align='center' width='100%' border='2'>";
    echo "<tr bgcolor='#FFEEB8'>";
        echo "<th style='width: 182px;'><p align='center'>Transformer Unit Amount</p></th>";
        echo "<th style='width: 182px;'><p align='center'>Consumed Unit Amount</p></th>";
        echo "<th style='width: 182px;'><p align='center'>Difference</p></th></tr>";
        echo "<tr>";
        echo "<td bgcolor='#F7FCB1'><p align='center'>&nbsp;&nbsp;$trans_total</td>";
        echo "<td bgcolor='#E5FCAB'><p align='center'>$con_total&nbsp;&nbsp;</p></td>";
        echo "<td bgcolor='#E5FCAB'><p align='center'>$difference&nbsp;&nbsp;</p></td>";
        echo "</tr>";
    echo "</table>";

    $con->close();
    





?>

