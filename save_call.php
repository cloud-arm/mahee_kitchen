<?php
session_start();
include("connect.php");
date_default_timezone_set("Asia/Colombo");
$a = $_POST['vehicel'];
$b = $_POST['name'];
$c = $_POST['id'];
$d = $_POST['invo'];
$e = $_POST['no'];
$f = $_POST['note'];
$type = $_POST['type'];
$date=date("Y-m-d");

$call_id=1;
$sql = "UPDATE sales 
        SET call_id=?
		WHERE invoice_number=?";
$q = $db->prepare($sql);
$q->execute(array($call_id,$d));


// query
$sql = "INSERT INTO call_center (vehicle_no,name,customer_id,invoice_no,mark,note,call_type,date) VALUES (:a,:b,:c,:d,:e,:f,:type,:date)";
$ql = $db->prepare($sql);
$ql->execute(array(':a'=>$a,':b'=>$b,':c'=>$c,':d'=>$d,':e'=>$e,':f'=>$f,':type'=>$type,':date'=>$date));
header("location: call.php");


?>