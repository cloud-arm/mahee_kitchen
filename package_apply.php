<?php
session_start();
include('connect.php');
date_default_timezone_set("Asia/Colombo"); 

$id = $_GET['id'];
$invo = $_GET['invoice'];
$room=$_GET['room'];

$result = $db->prepare("SELECT * FROM room WHERE room_no = '$room' ");
$result->bindParam(':userid', $res);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$bed = $row['bed'];

}



$result1 = $db->prepare("SELECT * FROM package WHERE id = '$id' ");
$result1->bindParam(':userid', $res);
$result1->execute();
for($i=0; $row1 = $result1->fetch(); $i++){
$product_id=$row1['id'];
$qty=1;
$price=$row1['amount']*$bed;
$name=$row1['name'];
$dis=$row1['dis'];


$amount=$price*$qty;
$dis=$dis*$qty;

$date=date("Y-m-d");


// query
$sql = "INSERT INTO sales_list (product_id,name,invoice_no,price,dic,qty,code,profit,type,date,amount,cost,room_no) VALUES (:a,:b,:c,:d,:e,:f,:g,:pro,:type,:date,:amount,:cost,:room)";
$ql = $db->prepare($sql);
$ql->execute(array(':a'=>$product_id,':b'=>$name,':c'=>$invo,':d'=>$price,':e'=>$dis,':f'=>$qty,':g'=>'',':pro'=>'',':type'=>'package',':date'=>$date,':amount'=>$amount,':cost'=>'',':room'=>$room));

}



$sql = "UPDATE room 
        SET package_id=?
		WHERE room_no=?";
$q = $db->prepare($sql);
$q->execute(array($product_id,$room));


if(isset($_GET['end'])){
	header("location: app/sales.php?id=$invo");
}else{
	header("location: sales.php?id=$invo");
}



?>