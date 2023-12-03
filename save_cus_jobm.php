<?php

session_start();
include('connect.php');
date_default_timezone_set("Asia/Colombo");

$a = $_POST['vehicle_no'];
$b = $_POST['model'];
$c = $_POST['cus_name'];
$d = $_POST['phone_no'];
$d2 = $_POST['phone_no2'];
$e = 0;
$f =  $_POST['email'];
$g =  0;
$h =  0;
$i =  0;
$j =  0;
$birthday =  0;
$gend =  0;

$promo=$_POST['pro'];

$date=date("Y-m-d");
$time=date("H.i");

$day="30";
$ac='pending';

// query

$sql = "INSERT INTO customer (vehicle_no,model,customer_name,contact,address,email,engine_no,chassis_no,bye_date,color,birthday,gend,contact2) VALUES (:a,:b,:c,:d,:e,:f,:g,:h,:i,:j,:birthday,:gend,:pho2)";
$ql = $db->prepare($sql);
$ql->execute(array(':a'=>$a,':b'=>$b,':c'=>$c,':d'=>$d,':e'=>$e,':f'=>$f,':g'=>$g,':h'=>$h,':i'=>$i,':j'=>$j,':birthday'=>$birthday,':gend'=>$gend,':pho2'=>$d2));


$sql = "INSERT INTO promo (vehicle_no,cus_name,promo_id,day,date,time,action) VALUES (:a,:b,:c,:d,:e,:f,:g)";
$ql = $db->prepare($sql);
$ql->execute(array(':a'=>$a,':b'=>$c,':c'=>$promo,':d'=>$day,':e'=>$date,':f'=>$time,':g'=>$ac));

header("location: promo.php");
?>