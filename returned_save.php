<meta charset="utf-8">
<?php
session_start();
date_default_timezone_set("Asia/Colombo");
include('connect.php');
$error=0;
$er="";
$qty = $_POST['qty'];
$id = $_POST['id'];
$dis = $_POST['dis'];

$date=date("Y-m-d");


$result = $db->prepare("SELECT * FROM sales_list WHERE id = '$id' ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
            $invoice_no = $row['invoice_no'];
			$in_qty = $row['qty'];
			$sales_price = $row['price'];
			$pro_code = $row['code'];
			$in_dis = $row['dic'];
			$old_amount = $row['amount'];
		}
$result = $db->prepare("SELECT * FROM sales WHERE invoice_number = '$invoice_no' ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
            $cus_id = $row['customer_id'];	
			$sall_id = $row['transaction_id'];
		}
$result = $db->prepare("SELECT * FROM customer WHERE customer_id = '$cus_id' ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
            $datab = $row['datab'];		
		}
$result = $db->prepare("SELECT * FROM products WHERE product_code = '$pro_code' ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
            $cost_price = $row['cost_price'];
			$product_name = $row['product_name'];
			$code = $row['product_code'];
			$pro_id = $row['id'];
		}
$lll=$cost_price/100*2;
$lo_cost=$cost_price+$lll;
$price=$sales_price-$dis;

if($datab==""){}else{
include($datab);	
$result = $db->prepare("SELECT * FROM sales_list WHERE ned_sales_no = '$id' ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
            $ssi = $row['invoice_no'];
		}
include('connect.php');
if(!$ssi){$error=1;$er=" Returned කල නොහැක ";}
$csr=1;
}

//$max_dis=$sales_price-$price;

if($qty>$in_qty){$error=1;$er="විකුණූ ප්‍රමානය ට වඩා වැඩියෙන් Returned කල නොහැක ";}
//if($lo_cost<$price){$error=1;$er=$product_name." සදහා දියහැකි උපරිම Discountඑක Rs.".$max_dis." වේ.";}

//-- error Display --//
if($error==1){
echo "<br><br><br><br><br><br><h3 style='color: red'><center>";
echo $er;
	echo "<br><br><br><a href='sales_returned.php?id=".$sall_id."'><button style='font-size: 30px; background-color: green' >Back</button></a></center></h3>";
}else{

$price_one=$sales_price-$dis;
$so_price=$price_one*$qty;
	
//-- Edit sales list --//
if($qty==$in_qty){	
	$result = $db->prepare("DELETE FROM sales_list WHERE  id= :memid");
	$result->bindParam(':memid', $id);
	$result->execute();	
}else{

$sql = "UPDATE sales_list 
        SET qty=qty-?
		WHERE id=?";
$q = $db->prepare($sql);
$q->execute(array($qty,$id));

$sql = "UPDATE sales_list 
        SET amount=amount-?
		WHERE id=?";
$q = $db->prepare($sql);
$q->execute(array($so_price,$id));	

}
$sql = "UPDATE sales 
        SET amount=amount-?
		WHERE transaction_id=?";
$q = $db->prepare($sql);
$q->execute(array($so_price,$sall_id));
	

$sql = "UPDATE sales 
        SET balance=balance+?
		WHERE transaction_id=?";
$q = $db->prepare($sql);
$q->execute(array($so_price,$sall_id));
//-- END Edit sales list --//

//-- Edite customer sales list --//
if($csr==1){
include($datab);	
$result = $db->prepare("SELECT * FROM sales_list WHERE ned_sales_no = '$id' ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
            $cus_invoice_no = $row['invoice_no'];
			$cus_sall_l_id = $row['id'];
		}
	
$result = $db->prepare("SELECT * FROM sales WHERE invoice_number = '$cus_invoice_no' ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
            $cus_id = $row['customer_id'];	
			$cus_sall_id = $row['transaction_id'];
		}
	
if($qty==$in_qty){	
	$result = $db->prepare("DELETE FROM sales_list WHERE  ned_sales_no= :memid");
	$result->bindParam(':memid', $id);
	$result->execute();	
}else{

$sql = "UPDATE sales_list 
        SET qty=qty-?
		WHERE ned_sales_no=?";
$q = $db->prepare($sql);
$q->execute(array($qty,$id));

$sql = "UPDATE sales_list 
        SET price=price-?
		WHERE ned_sales_no=?";
$q = $db->prepare($sql);
$q->execute(array($so_price,$id));
} }
//-- END Edite customer sales list --//



include('connect.php');
$sql = "INSERT INTO returned (name,code,sales_id,sales_list_id,product_id,qty,old_qty,dis,old_dis,price,old_price,cus_sales_id,cus_sales_list_id,date,old_amount) VALUES (:a,:b,:c,:d,:e,:f,:g,:h,:j,:k,:l,:m,:n,:o,:p)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$product_name,':b'=>$code,':c'=>$sall_id,':d'=>$id,':e'=>$pro_id,':f'=>$qty,':g'=>$in_qty,':h'=>$dis,':j'=>$in_dis,':k'=>$price_one,':l'=>$sales_price,':m'=>$cus_sall_id,':n'=>$cus_sall_l_id,':o'=>$date,':p'=>$old_amount));


	

	
header("location: sales_returned.php?id=$sall_id");

}
?>