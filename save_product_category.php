<?php

include('connect.php');
$id=$_POST['id'];
$gen=$_POST['cat'];
//$model_id=$_POST['model'];


	$sql = "UPDATE product 
        SET category=?
		WHERE product_id=?";
$q = $db->prepare($sql);
$q->execute(array($gen,$id));


	
header("location: product_category.php");

?>