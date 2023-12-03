
<table id="example1" class="table table-bordered table-striped">
              
                <thead>
                <tr>
				          <th>Code</th>
				          <th>Product Name</th>
                  <th>QTY</th>
				          <th>Price</th>
                  <th>Total</th>
                  <th>#</th>
				  
                </tr>
                </thead>
<tbody>
<?php 

$tota_qty=0;
$tota=0;

$result = $db->prepare("select * from sales_list where invoice_no='$id' ORDER by id DESC  ");
$result->bindParam(':userid', $date);
                $result->execute();
 for($i=0; $row = $result->fetch(); $i++){
	echo "<tr class='record' >
<td align='center'>".$row['code']."</td>
<td align='center'>".$row['name']."</td>
<td align='center'>".$row['qty']."</td>
<td align='center'>".$row['price']."</td>
<td align='center'>".$row['amount']."</td>
<td><a href='sales_dll.php?id=".$row['id']."&invo=".$id."'  >
				  <button class='btn btn-danger'><i class='fa fa trash'>X</i></button></a> </td>
</tr>";
$tota+=$row['amount'];
	 $tota_qty+=$row['qty'];
	}


echo "



";
?>
</tbody>
                
              </table>
<h3>QTY- <?php echo $tota_qty; ?></h3>

<h3>Total Rs.<?php echo $tota; ?></h3>
