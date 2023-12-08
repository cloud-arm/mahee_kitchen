<?php
session_start();
date_default_timezone_set("Asia/Colombo");
include('../connect.php');

$f=0;
$g="non";
$cus=3;
$v1="";

        $cus_name ="no";
		$cus_id = 0;

$invoice = $_POST['id'];
$pay_type = $_POST['p_type'];
$now=date("Y-m-d");
$pay_total=$_POST['amount'];



		
$sql = 'UPDATE  sales SET action=?, pay_amount=?, balance=amount-?, pay_type=?  WHERE  invoice_number=? ';
$ql = $db->prepare($sql);
$ql->execute(array('active',$pay_total,$pay_total,$pay_type,$invoice));


    
      
$sql = "UPDATE room 
        SET qty='',cus_name='',cus_id='',invoice_no='',action='0',in_date='',time = '',booking_id=''
		WHERE invoice_no=?";
$q = $db->prepare($sql);
$q->execute(array($invoice));

header("location: bill.php?id=$invoice");

?>