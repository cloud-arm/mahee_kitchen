<?php

session_start();

include('connect.php');
$name = $_POST['cus_name'];
$phone_no = $_POST['phone_no'];
$c = $_POST['address'];
$d =  $_POST['email'];


$nic=$_POST['nic'];
$cus_id=$_POST['cus_id'];
$pay=$_POST['pay'];

$from=$_POST['from'];
$to=$_POST['to'];

$discount=$_POST['dis'];
$package=$_POST['package'];

// query

if($cus_id=='0'){

$sql = "INSERT INTO customer (customer_name,contact,address,email,nic) VALUES (:a,:b,:c,:d,:nic)";
$ql = $db->prepare($sql);
$ql->execute(array(':a'=>$name,':b'=>$phone_no,':c'=>$c,':d'=>$d,':nic'=>$nic));

$result = $db->prepare("SELECT * FROM customer WHERE contact = '$phone_no' ");
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
		$phone_no=$row['contact'];
		}
    }

	$result = $db->prepare('SELECT * FROM package WHERE  id= :id ');
	$result->bindParam(':id', $package);
	$result->execute();
	for($i=0; $row = $result->fetch(); $i++){ $package_price=$row['amount']; }


    $sday= strtotime( $from);
    $nday= strtotime($to);
    $tdf= abs($nday-$sday);
    $nbday1= $tdf/86400;
    $day_qty = intval($nbday1);

$date=date('Y-m-d');
$time=date('H:i:s');
$invoice=date('ymdHis');


$sql = "INSERT INTO booking (cus_name,cus_id,in_date,out_date,date,pay_amount,phone_no,package_id,discount) VALUES (?,?,?,?,?,?,?,?,?)";
$ql = $db->prepare($sql);
$ql->execute(array($name,$cus_id,$from,$to,$date,$pay,$phone_no,$package,$discount));


$result = $db->prepare('SELECT * FROM booking ORDER BY id DESC LIMIT 1');
$result->bindParam(':userid', $res);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){ $booking_id = $row['id'];}

$sql = 'UPDATE booking_list SET booking_id=?,price=room_qty * ?,amount=room_qty * ?,day=? WHERE  booking_id=? ';
$ql = $db->prepare($sql);
$ql->execute(array($booking_id,$package_price,$package_price*$day_qty,$day_qty,'0'));

//if(isset($_POST['end'])){header("location: app/index.php");}else{
//header("location: booking.php");}
header("location: booking_view.php?id=$booking_id");
?>

