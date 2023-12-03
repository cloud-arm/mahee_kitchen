
<?php
session_start();
include("connect.php");


$id=$_REQUEST['id'];
$invo=$_REQUEST['invo'];
$c=$_REQUEST['qty'];


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
	
$cashier= $_SESSION['SESS_FIRST_NAME'];
// query
$sql = "INSERT INTO sales_list (invoice_no,product_id,qty,amount,name,price,profit,code,dic,date,cashier) VALUES (:a,:b,:c,:d,:e,:f,:h,:i,:l,:k,:cashier)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$invo,':b'=>$pro_id,':c'=>$c,':d'=>$d,':e'=>$name,':f'=>$asasa,':h'=>$profit,':i'=>$code,':l'=>$discount1,':k'=>$date,':cashier'=>$cashier));

$id=$invo;
include("sales_tabel.php");
//header("location: sales.php?id=$invo");
?>




