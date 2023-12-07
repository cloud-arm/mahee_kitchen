<?php 
include("../connect.php"); 

$id=$_GET['id'];
$result = $db->prepare("DELETE FROM sales_list WHERE  id='$id' ");
	$result->bindParam(':memid', $_GET['id']);
	$result->execute();

?>

