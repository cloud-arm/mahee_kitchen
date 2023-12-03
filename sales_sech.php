
<?php 
include("connect.php");

$inda=$_GET['q'];

$result = $db->prepare("select * from products where (`product_code` LIKE '%".$inda."%') OR (`product_name` LIKE '%".$inda."%') ORDER by id DESC limit 0,10 ");
$result->bindParam(':userid', $date);
                $result->execute();
 for($i=0; $row = $result->fetch(); $i++){
	echo "

<a class='btn btn-block btn-social btn-bitbucket' href='sales_add.php?id=".$row['id']."&invo=".$_GET['invo']."'  > <i class='fa  fa-tags'></i> ".$row['product_name']."
				 </a> ";
	}


echo "



";
?>