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

$invoice = $_GET['id'];
$pay_type = 'temp';
$now=date("Y-m-d");
$pay_total=0;



		



$result = $db->prepare("SELECT * FROM room WHERE invoice_no = '$invoice' ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
        $cus_name = $row['cus_name'];
		$cus_id = $row['cus_id'];
		$in_date=$row['in_date'];
		$in_time=$row['time'];
		$room_no=$row['room_no'];
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
$sales_id=0;
$result = $db->prepare('SELECT * FROM sales WHERE  invoice_number = :id');
$result->bindParam(':id', $invoice);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){ $sales_id=$row['transaction_id']; }


if($sales_id==0){
// query
$sql = "INSERT INTO sales (invoice_number,amount,balance,profit,pay_type,pay_amount,date,customer_id,customer_name,action,discount,room_no) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
$ql = $db->prepare($sql);
$ql->execute(array($invoice,$amount,$balance,$profit,$pay_type,$pay_total,$date,$cus_id,$cus_name,'pending',$discount,$room_no));
 
}
      
$sql = "UPDATE room 
        SET print='1'
		WHERE invoice_no=?";
$q = $db->prepare($sql);
$q->execute(array($invoice));

header("location: bill.php?id=$invoice");

?>