<?php
session_start();
include('connect.php');
date_default_timezone_set("Asia/Colombo"); 

$id = $_GET['id'];

$b=1;


$sql = "UPDATE  sales
        SET call_id=?
		WHERE transaction_id=?";
$q = $db->prepare($sql);
$q->execute(array($b,$id));

// query

header("location: re_rp.php");


?>