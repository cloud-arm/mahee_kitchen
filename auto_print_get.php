<?php
session_start();
include('connect.php');

$invo=0;
$result = $db->prepare('SELECT * FROM room WHERE  print=1 ');
$result->bindParam(':id', $res);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){ $invo=$row['invoice_no']; }
	
echo $invo;

?>