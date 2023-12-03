<?php 
include("../connect.php");

$id=$_GET['id'];

$invoice_no=date('YmdHis');
$date=date('Y-m-d');
$time=date('H:i:s');

$result = $db->prepare('SELECT * FROM booking WHERE  id= :id ');
$result->bindParam(':id', $id);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){ 
    $cus_id=$row['cus_id'];
    $cus_name=$row['cus_name'];
    $pack_id=$row['package_id'];
 }


$result = $db->prepare("SELECT * FROM booking_list WHERE booking_id= '$id' ");
$result->bindParam(':userid', $res);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$ins_id=$row['id'];
$room_no=$row['room_no'];
$person=$row['qty'];

$result1 = $db->prepare("SELECT * FROM package WHERE id = :userid ");
$result1->bindParam(':userid', $pack_id);
$result1->execute();
for($i=0; $row1 = $result1->fetch(); $i++){
    $price=$row1['amount'];
    $name=$row1['name'];
}


$result1 = $db->prepare("SELECT * FROM room WHERE room_no = :userid ");
$result1->bindParam(':userid', $room_no);
$result1->execute();
for($i=0; $row1 = $result1->fetch(); $i++){
    $bed=$row1['bed'];
}

$price=$price*$bed;



$sql = "INSERT INTO sales_list (invoice_no,product_id,code,name,price,qty,type,amount,date,room_no,cost) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
$q = $db->prepare($sql);
$q->execute(array($invoice_no,$pack_id,'',$name,$price,'1','package',$price,$date,$room_no,''));



//---------------########## Room status update ############--------------//
$sql = "UPDATE  room SET qty=?,invoice_no=?,in_date=?,time=?,cus_name=?,cus_id=?,action=?,package_id=?,booking_id=? WHERE room_no=?";
$ql = $db->prepare($sql);
$ql->execute(array($person,$invoice_no,$date,$time,$cus_name,$cus_id,"1",$pack_id,$id,$room_no));

$sql = 'UPDATE  booking SET action=? WHERE id=? ';
$ql = $db->prepare($sql);
$ql->execute(array('1',$id));
 
}

header("location: index.php");
?>