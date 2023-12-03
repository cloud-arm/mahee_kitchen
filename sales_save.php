<?php
session_start();
include('connect.php');
date_default_timezone_set("Asia/Colombo"); 

$a1 = $_POST['name'];
$f = $_POST['qty'];
$e = $_POST['dis'];
$price = $_POST['price'];
$c = $_POST['invoice'];
$in_no = $_POST['in_no'];

$result = $db->prepare("SELECT * FROM product WHERE product_id = '$a1' ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
            $b = $row['name'];
			$d = $row['sell'];
			$g = $row['code'];
			$cost = $row['cost'];
			$type = $row['type'];
		}

if($price>0){
	$d=$price;
}

$d=$d-$e;

$profit=$d-$cost;
$profit=$profit*$f;

$d=$d*$f;
$e=$e*$f;
// query
$sql = "INSERT INTO sales_list (product_id,name,invoice_no,price,dic,qty,code,profit,type,other_bill_no) VALUES (:a,:b,:c,:d,:e,:f,:g,:pro,:type,:o_bill)";
$ql = $db->prepare($sql);
$ql->execute(array(':a'=>$a1,':b'=>$b,':c'=>$c,':d'=>$d,':e'=>$e,':f'=>$f,':g'=>$g,':pro'=>$profit,':type'=>$type,':o_bill'=>$in_no));
header("location: sales.php?id=$c");


?>