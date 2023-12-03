<?php

session_start();

include('connect.php');
$a = $_POST['vehicle_no'];
$b = $_POST['model'];
$c = $_POST['cus_name'];
$d = $_POST['phone_no'];
$d2 = $_POST['phone_no2'];
$e = $_POST['address'];
$f =  $_POST['email'];
$g =  $_POST['engine_no'];
$h =  $_POST['chassis_no'];
$i =  $_POST['bye_date'];
$j =  $_POST['color'];
$birthday =  $_POST['birthday'];
$gend =  $_POST['gend'];







// query

$sql = "INSERT INTO customer (vehicle_no,model,customer_name,contact,address,email,engine_no,chassis_no,bye_date,color,birthday,gend,contact2) VALUES (:a,:b,:c,:d,:e,:f,:g,:h,:i,:j,:birthday,:gend,:pho2)";
$ql = $db->prepare($sql);
$ql->execute(array(':a'=>$a,':b'=>$b,':c'=>$c,':d'=>$d,':e'=>$e,':f'=>$f,':g'=>$g,':h'=>$h,':i'=>$i,':j'=>$j,':birthday'=>$birthday,':gend'=>$gend,':pho2'=>$d2));



$result = $db->prepare("SELECT * FROM job WHERE vehicle_no = '$a' and type='active' ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
			$category=$row['category'];
			$id1 = $row['id'];
		}

if($category==""){header("location: job.php");}
else{ header("location: job_accident.php?id=$id1"); }

?>