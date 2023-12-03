<?php
session_start();
include("connect.php");


$id=$_REQUEST['id'];
$pro=$_REQUEST['pro'];


$tota=0;
$tota_qty=0;
$qty_check=0;

$c = 1;

$qty_check=strpos($pro,"*");

if($qty_check > 0){
    
     $split = explode("*", $pro);
            $c= $split[0];
			$pro= $split[1];
}


$date =date("Y-m-d");
$discount = 0;

$cod=-1;
$result = $db->prepare("SELECT * FROM products WHERE product_code= :userid");
$result->bindParam(':userid', $pro);
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

if($cod<0){
echo "
	<div class='col-md-5'><div class='alert alert-info alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                <h4><i class='icon fa fa-info'></i> Alert!</h4>
                No records found
              </div>
		</div>	  ";	
}
if($cod>0){


$fffffff=$asasa-($discount+$discount2);
$d=$fffffff*$c;
$profit=($p-$discount)*$c;
$discount1 = ($discount2+$discount)*$c;
$lok="ulok";
	
$cashier= $_SESSION['SESS_FIRST_NAME'];
// query
$sql = "INSERT INTO sales_list (invoice_no,product_id,qty,amount,name,price,profit,code,dic,date,cashier) VALUES (:a,:b,:c,:d,:e,:f,:h,:i,:l,:k,:cashier)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$id,':b'=>$pro,':c'=>$c,':d'=>$d,':e'=>$name,':f'=>$asasa,':h'=>$profit,':i'=>$code,':l'=>$discount1,':k'=>$date,':cashier'=>$cashier));

}

include("sales_tabel.php");
?>




