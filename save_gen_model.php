<?php
session_start();
include('connect.php');
date_default_timezone_set("Asia/Colombo"); 

$id = $_POST['id'];
$model = $_POST['model'];


$result = $db->prepare("SELECT * FROM product WHERE product_id = '$id' ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
            $p_name = $row['gen_name'];			
		}

$result = $db->prepare("SELECT * FROM model WHERE id = '$model' ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
            $m_name = $row['name'];
		}


// query
$sql = "INSERT INTO product_model (product_id,product_name,model_id,model_name) VALUES (:a,:b,:c,:d)";
$ql = $db->prepare($sql);
$ql->execute(array(':a'=>$id,':b'=>$p_name,':c'=>$model,':d'=>$m_name));
header("location: product_model.php?id=$id");


?>