<?php
session_start();
include('connect.php');

$id=$_POST['id'];
$from=$_POST['from'];
$to=$_POST['to'];
$pay=$_POST['pay'];
$room=$_POST['room'];
$person=$_POST['person'];
$package=$_POST['package'];
$dis=$_POST['dis'];

$result = $db->prepare("SELECT * FROM booking_list WHERE  id='$id'");
$result->bindParam(':userid', $res);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){ $bid=$row['booking_id']; $bed=$row['room_qty']; }

$result = $db->prepare('SELECT * FROM package WHERE  id=:userid ');
$result->bindParam(':userid', $package);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){ $price=$row['amount']*$bed; }
	
	
$sql = "UPDATE booking
        SET  in_date=? , out_date=? , pay_amount=?,package_id=?,discount=?
		WHERE id=?";
$q = $db->prepare($sql);
$q->execute(array($from,$to,$pay,$package,$dis,$bid));

$sql = 'UPDATE  booking_list SET room_no=?,qty=?,price=? WHERE id =? ';
$ql = $db->prepare($sql);
$ql->execute(array($room,$qty,$price,$id));
	
	
header("location: booking.php");

?>