<?php

session_start();

include('connect.php');
$name = $_POST['cus_name'];
$b = $_POST['phone_no'];
$c = $_POST['address'];
$d =  $_POST['email'];

$room=  $_POST['room'];
$person=$_POST['person'];
$nic=$_POST['nic'];
$cus_id=$_POST['cus_id'];

// query

if($cus_id=='0'){

$sql = "INSERT INTO customer (customer_name,contact,address,email,nic) VALUES (:a,:b,:c,:d,:nic)";
$ql = $db->prepare($sql);
$ql->execute(array(':a'=>$name,':b'=>$b,':c'=>$c,':d'=>$d,':nic'=>$nic));

$result = $db->prepare("SELECT * FROM customer WHERE contact = '$b' ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
		$cus_id = $row['customer_id'];
		}
    }else{
        $result = $db->prepare("SELECT * FROM customer WHERE customer_id = '$cus_id' ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
		$name = $row['customer_name'];
		}
    }


$date=date('Y-m-d');
$time=date('H:i:s');
$invoice=date('ymdHis');




$sql = "UPDATE  room SET qty=?,invoice_no=?,in_date=?,time=?,cus_name=?,cus_id=?,action=? WHERE id=?";
$ql = $db->prepare($sql);
$ql->execute(array($person,$invoice,$date,$time,$name,$cus_id,"1",$room));


if(isset($_POST['end'])){header("location: app/index.php");}else{
header("location: index.php");}





?>