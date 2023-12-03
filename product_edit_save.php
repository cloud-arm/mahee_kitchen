<?php
session_start();
include('connect.php');
$a = $_POST['sell'];
$b = $_POST['cost'];
$name = $_POST['name'];
$id =$_POST['id'];



$sql = "UPDATE products 
        SET sell_price=?
		WHERE id=?";
$q = $db->prepare($sql);
$q->execute(array($a,$id));

$sql = "UPDATE products 
        SET cost_price=?
		WHERE id=?";
$q = $db->prepare($sql);
$q->execute(array($b,$id));


$sql = "UPDATE products 
        SET product_name=?
		WHERE id=?";
$q = $db->prepare($sql);
$q->execute(array($name,$id));


header("location: product_view.php");


?>