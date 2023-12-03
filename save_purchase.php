<?php
session_start();
include('connect.php');
date_default_timezone_set("Asia/Colombo"); 
$date = date("Y-m-d");
$a1 = $_POST['id'];
$c = $_POST['invo_no'];
$e = $_POST['remarks'];
$result = $db->prepare("SELECT sum(price) FROM sales_list WHERE invoice_no = '$a1' ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
        $d = $row['sum(price)'];	
		}

$result = $db->prepare("SELECT * FROM sales_list WHERE invoice_no = '$a1' ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
        $id = $row['product_id'];
		$qty = $row['qty'];
			
$sql = "UPDATE product 
        SET qty=qty+?
		WHERE product_id=?";
$q = $db->prepare($sql);
$q->execute(array($qty,$id));
			
			
			$sql = "UPDATE product 
        SET qty_tot=qty_tot+?
		WHERE product_id=?";
$q = $db->prepare($sql);
$q->execute(array($qty,$id));
			
			
		}
// query
$sql = "INSERT INTO purchases (invoice_no,date,suplier_invoice,amount,remarks) VALUES (:a,:b,:c,:d,:e)";
$ql = $db->prepare($sql);
$ql->execute(array(':a'=>$a1,':b'=>$date,':c'=>$c,':d'=>$d,':e'=>$e));
header("location: sales1.php");


?>