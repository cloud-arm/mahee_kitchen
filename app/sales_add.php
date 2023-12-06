
<?php
//session_start();
include("../connect.php");


$id=$_REQUEST['id'];
$invo=$_REQUEST['invo'];
$c=$_REQUEST['qty'];

$room_id=$_REQUEST['room_id'];

$result = $db->prepare('SELECT * FROM room WHERE  id=:id ');
$result->bindParam(':id', $room_id);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){ $action=$row['action']; }

if($action == 0){ 
	$sql = 'UPDATE  room SET action =?,invoice_no=? WHERE id =? ';
	$ql = $db->prepare($sql);
	$ql->execute(array('1',$invo,$room_id));
 }


$tota=0;
$tota_qty=0;



$date =date("Y-m-d");
$discount = 0;

$cod=-1;
$result = $db->prepare("SELECT * FROM products WHERE id= :userid");
$result->bindParam(':userid', $id);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
	$cod=$row['id'];
	$pro_id=$row['id'];
$asasa=$row['sell_price'];
$code=$row['product_code'];
$gen=$row['product_name'];
$name=$row['product_name'];
$p=0;
$discount2=0;
}

$fffffff=$asasa-($discount+$discount2);
$d=$fffffff*$c;
$profit=($p-$discount)*$c;
$discount1 = ($discount2+$discount)*$c;
$lok="ulok";
	
$cashier= 0;
// query
$sql = "INSERT INTO sales_list (invoice_no,product_id,qty,amount,name,price,profit,code,dic,date,cashier) VALUES (:a,:b,:c,:d,:e,:f,:h,:i,:l,:k,:cashier)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$invo,':b'=>$pro_id,':c'=>$c,':d'=>$d,':e'=>$name,':f'=>$asasa,':h'=>$profit,':i'=>$code,':l'=>$discount1,':k'=>$date,':cashier'=>$cashier));

$id=$invo;
// include("sales_tabel.php");
header("location: item_get.php?&invo=$invo");
?>




