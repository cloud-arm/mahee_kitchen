<?php
session_start();
include('connect.php');
date_default_timezone_set("Asia/Colombo");
  
  
 


$sql = 'UPDATE  products SET sell_price =? WHERE id =? ';
$ql = $db->prepare($sql);
$ql->execute(array($_POST['price'], $_POST['id']));



header("location: product_view.php");

?>