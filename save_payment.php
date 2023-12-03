<?php
session_start();
date_default_timezone_set("Asia/Colombo");
include('connect.php');
$f = $_POST['chq_no'];
$type = $_POST['p_type'];
$from = $_POST['from'];
$balance = $_POST['balance'];
$bank="non";
if($type=="chq"){
	$amount_pay=$_POST['chq_amount'];
	$amount=$_POST['chq_amount'];
	$date= $_POST['chq_date'];
	$bank = $_POST['bank'];
} 
if($type=="cash"){
	$amount_pay=$_POST['cash_amount'];
$amount=$_POST['cash_amount'];
	$date = date("Y-m-d");
}
if($type=="credit"){
	$amount_pay=$_POST['card_amount'];
$amount=$_POST['card_amount'];
	$date = date("Y-m-d");
}


$a = $_POST['invoice'];
$now = date("Y-m-d");
$b = $_POST['order_id'];



$sql = "UPDATE sales 
        SET balance=balance+?
		WHERE transaction_id=?";
$q = $db->prepare($sql);
$q->execute(array($amount_pay,$b));


$result = $db->prepare("SELECT * FROM sales  WHERE invoice_number='$a'   ");
				$result->bindParam(':userid', $a);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
	                $balance1=$row['balance'];
				}


if($balance1 <= 0){	
$ex="close";
$sql = "UPDATE sales 
        SET action=?
		WHERE transaction_id=?";
$q = $db->prepare($sql);
$q->execute(array($ex,$b));
}






$id=$_POST['cus_id'];

$g="non";

$sql = "INSERT INTO payment (invoice_no,pay_amount,amount,type,date,chq_no,bank,date_now) VALUES (:a,:b,:c,:d,:e,:f,:g,:h)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$a,':b'=>$amount_pay,':c'=>$amount,':d'=>$type,':e'=>$date,':h'=>$now,':f'=>$f,':g'=>$bank));

header("location: payment.php?id=$id");	



// query



?>