<?php
session_start();
include('connect.php');

$id = $_GET['id'];
$invo = "-40".$_GET['v'];

$sql = "UPDATE sales_list 
        SET invoice_no=?
		WHERE id=?";
$q = $db->prepare($sql);
$q->execute(array($invo,$id));

header("location: index.php");
?>