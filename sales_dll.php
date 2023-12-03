<?php
session_start();
include('connect.php');
date_default_timezone_set("Asia/Colombo");
  
  
 
$id=$_GET['id'];
$invo=$_GET['invo'];
$room_no=$_GET['room_no'];


$result = $db->prepare("DELETE FROM sales_list WHERE  id= :memid");
	$result->bindParam(':memid', $id);
	$result->execute();




if(isset($_GET['end'])){
	header("location: app/sales.php?id=$invo&room_no=$room_no");
}else{
	header("location: sales.php?id=$invo&room_no=$room_no");
}
?>