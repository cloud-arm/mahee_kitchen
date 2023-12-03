<?php
session_start();
include('connect.php');
date_default_timezone_set("Asia/Colombo"); 

$id = $_POST['vehicle_no'];
$id2 = $_POST['vehicle_no2'];
$user_id = $_POST['user'];
$user_id1 = $_POST['user1'];

if($id2==""){}else{$id=$id2;}


 $result = $db->prepare("SELECT * FROM user WHERE id='$user_id' ORDER by id ASC ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
		$user=$row['name'];
		}
 $result = $db->prepare("SELECT * FROM user WHERE id='$user_id1' ORDER by id ASC ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
		$user1=$row['name'];
		}


$result = $db->prepare("SELECT * FROM job WHERE vehicle_no = '$id' ORDER by id DESC limit 0,1 ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
            $job = $row['id'];			
		}

$result = $db->prepare("SELECT * FROM check_list  ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
            $check_id = $row['id'];
			$check_name = $row['name'];
			
			$idr = $_POST[$check_id];
			
			if($idr=="1"){
// query
$sql = "INSERT INTO check_records (job_id,vehicle_no,check_id,check_name,user,user_id,user1,user_id1) VALUES (:a,:b,:c,:d,:e,:f,:e1,:f1)";
$ql = $db->prepare($sql);
$ql->execute(array(':a'=>$job,':b'=>$id,':c'=>$check_id,':d'=>$check_name,':e'=>$user,':f'=>$user_id,':e1'=>$user1,':f1'=>$user_id1));
		}}
header("location: job_check.php");





?>