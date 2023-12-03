<?php

include('connect.php');
$id=$_POST['id'];
$gen=$_POST['gen'];
//$model_id=$_POST['model'];


	$sql = "UPDATE product 
        SET gen_name=?
		WHERE product_id=?";
$q = $db->prepare($sql);
$q->execute(array($gen,$id));


	
header("location: product_model.php?id=$id");

?>