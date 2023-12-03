<?php 
include('connect.php');

$name=$_POST['name'];
$type=$_POST['type'];
$amount=$_POST['amount'];




$sql = "INSERT INTO package (name,type,amount) VALUES (?,?,?)";
$ql = $db->prepare($sql);
$ql->execute(array($name,$type,$amount));

$result = $db->prepare("SELECT id FROM package ORDER BY id DESC LIMIT 1");
    $result->bindParam(':userid', $res);
    $result->execute();
    for($i=0; $row = $result->fetch(); $i++){ $id=$row['id']; }

$sql = "UPDATE package_list 
        SET package_id=?
		WHERE package_id=?";
$q = $db->prepare($sql);
$q->execute(array($id,'0'));


header("location: package.php");
?>