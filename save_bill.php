<?php
session_start();
date_default_timezone_set("Asia/Colombo");
include('connect.php');

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


		



$result = $db->prepare("SELECT * FROM room WHERE invoice_no = '$invoice' ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
        $cus_name = $row['cus_name'];
		$cus_id = $row['cus_id'];
		$in_date=$row['in_date'];
		$in_time=$row['time'];
		}
		
		
		
$result = $db->prepare("SELECT sum(amount) FROM sales_list WHERE invoice_no = '$invoice' ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
        $amount = $row['sum(amount)'];
		}
		
$result = $db->prepare("SELECT sum(profit) FROM sales_list WHERE invoice_no = '$invoice' ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
        $profit = $row['sum(profit)'];
		}

$discount=0;
$amount=$amount-$discount;

$date= date("Y-m-d");
$time=date('H:i:s');
$balance = $amount-$pay_total;

//$discount=$_POST['dis'];

// query
$sql = "INSERT INTO sales (invoice_number,amount,balance,profit,pay_type,pay_amount,date,customer_id,customer_name,action,discount) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
$ql = $db->prepare($sql);
$ql->execute(array($invoice,$amount,$balance,$profit,$pay_type,$pay_total,$date,$cus_id,$cus_name,'active',$discount));
      
      
$sql = "UPDATE room 
        SET qty='',cus_name='',cus_id='',invoice_no='',action='0',in_date='',time = '',booking_id=''
		WHERE invoice_no=?";
$q = $db->prepare($sql);
$q->execute(array($invoice));

header("location: bill.php?id=$invoice");

?>