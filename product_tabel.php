<link href="src/facebox.css" media="screen" rel="stylesheet" type="text/css" />
<script src="lib/jquery.js" type="text/javascript"></script>
<script src="src/facebox.js" type="text/javascript"></script>
<script type="text/javascript">
  jQuery(document).ready(function($) {
    $('a[rel*=facebox]').facebox({
      loadingImage : 'src/loading.gif',
      
    })
  })
</script>
<table id="example1" class="table table-bordered table-striped">
			  
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Photo</th>
				          <th>Name</th>
                  <th>Code</th>
                  <th>Sell Price</th>
                  <th>Type</th>
                  <th>QTY</th>
					        <th>#</th>
                </tr>
				
                </thead>
<tbody>
<?php 
include("connect.php");

$inda=$_GET['q'];

$result = $db->prepare("select * from products where (`product_code` LIKE '%".$inda."%') OR (`product_name` LIKE '%".$inda."%')  ORDER by id DESC limit 0,100 ");
$result->bindParam(':userid', $date);
                $result->execute();
 for($i=0; $row = $result->fetch(); $i++){
	$id=$row['id']; 
	 ?>
	   <tr class="record">
				  <td><?php echo $row['id'];?></td> 
          <td width="10%"><?php if($row['img']==''){?> 
            <form action="product_photo_up.php" method="post" enctype="multipart/form-data">
              <input type="file" name="fileToUpload" id="fileToUpload"  accept=".jpg, .jpeg, .png" >
              <input type="hidden" name="id" value="<?php echo $row['id']  ?>">
              <input type="submit" name="submit" value="Upload" class="btn btn-info">
            </form>
          <?php }else{ ?>
          <img src="app/product_img/<?php echo $row['img'] ?>" width="50%" alt="">
          <?php } ?></td>
				  <td><?php echo $row['product_name'];?></td>
                  <td><?php echo $row['product_code'];?></td>
                  <td><?php echo $row['sell_price'];?></td>
				<td><?php echo $row['type'];?></td>
        <td><?php echo $row['qty'];?></td>
                  
				  <td>
					<a href="#" id="<?php echo $row['id']; ?>" class="delbutton" title="Click to Delete" >
				  <button class="btn btn-danger"><i class="icon-trash">x</i></button></a>
					</td>
				   
                </tr>
	<?php	}	?>
</tbody>
 <tfoot>
                
				
				
				
				
				
				
                </tfoot>
              </table>               
          
