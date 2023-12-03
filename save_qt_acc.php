<?php
session_start();
include('connect.php');
date_default_timezone_set("Asia/Colombo");
$a1 = $_POST['id'];


$result = $db->prepare("SELECT * FROM job WHERE id = '$a1' and type='active' ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
			$vehicle_no=$row['vehicle_no'];
		}

$result = $db->prepare("SELECT * FROM customer WHERE vehicle_no = '$vehicle_no' ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
            $cus = $row['customer_name'];
			$model = $row['model'];
		}

//$vehicle_no = $_POST['vehicle_no'];
$comment = "";
//$c = $_POST['cus_name'];
$result = $db->prepare("SELECT sum(price) FROM sales_list WHERE invoice_no = '$a1' ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
            $a = $row['sum(price)'];
		}


$result = $db->prepare("SELECT sum(profit) FROM sales_list WHERE invoice_no = '$a1' ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
        $profit = $row['sum(profit)'];	
		}


$note = "The Customer and Accident Job Registered";
$type="comments";

$c = "active";
$date=date("Y-m-d");
$time=date("H.i");
$cashi = $_SESSION['SESS_FIRST_NAME'];
// query
$sql = "INSERT INTO sales (vehicle_no,invoice_number,date,cashier,amount,balance,action,model,customer_name,comment) VALUES (:a,:b,:c,:d,:e,:f,:g,:model,:cus,:com)";
$ql = $db->prepare($sql);
$ql->execute(array(':a'=>$vehicle_no,':b'=>$a1,':c'=>$date,':d'=>$cashi,':e'=>$a,':cus'=>$cus,':model'=>$model,':com'=>$comment,':f'=>"0",':g'=>"Quotations"));


$sql = "INSERT INTO job_record (job_no,note,type,user,date,time) VALUES (:a,:b,:c,:d,:e,:f)";
$ql = $db->prepare($sql);
$ql->execute(array(':a'=>$a1,':b'=>$note,':c'=>$type,':d'=>$cashi,':e'=>$date,':f'=>$time));

header("location: bill_acc.php?id=$a1&vehicle_no=$vehicle_no");


?>