<?php
session_start();
include('connect.php');
$id = $_POST['id'];
$a1 = $_POST['price'];
$b = $_POST['dis'];
$c = $_POST['qty'];
$invo = "-22".$_POST['vehicle'];

$a=$a1*$c;

// query
$sql = "UPDATE  sales_list SET price=?,dic=?,qty=?,invoice_no=? WHERE id=?";
$ql = $db->prepare($sql);
$ql->execute(array($a,$b,$c,$invo,$id));

header("location: index.php");
?>



