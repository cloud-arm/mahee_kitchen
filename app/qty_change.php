<?php 
  include("../connect.php");
$id=$_GET["id"];
$qty=$_GET["qty"];


$sql = 'UPDATE  sales_list SET qty =? , amount=price* ? WHERE  id=? ';
$ql = $db->prepare($sql);
$ql->execute(array($qty,$qty,$id));

echo $id."__".$qty;

?>