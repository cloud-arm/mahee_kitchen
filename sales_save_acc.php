<?php
session_start();
include('connect.php');
date_default_timezone_set("Asia/Colombo"); 

$a1 = $_POST['name'];
$f = $_POST['qty'];
$acc_type = $_POST['type'];
$price = $_POST['price'];
$c = $_POST['invoice'];
$e=0;



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
if($a1=="shop"){
$b = $_POST['product'];
	$cost=0;
	$g=0;
	$type="out_shop";
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
$sql = "INSERT INTO sales_list (product_id,name,invoice_no,price,dic,qty,code,profit,type,acc_type) VALUES (:a,:b,:c,:d,:e,:f,:g,:pro,:type,:acc_type)";
$ql = $db->prepare($sql);
$ql->execute(array(':a'=>$a1,':b'=>$b,':c'=>$c,':d'=>$d,':e'=>$e,':f'=>$f,':g'=>$g,':pro'=>$profit,':type'=>$type,':acc_type'=>$acc_type));
header("location: job_accident.php?id=$c");


?>