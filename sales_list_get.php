<?php  
include("connect.php");
$cat_id=$_GET['cat_id'];
$invo=$_GET['invo'];
$result = $db->prepare("SELECT * FROM products   WHERE  type = 'dish' AND cat_id = '$cat_id'");
$result->bindParam(':userid', $res);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){ 
   $ch=0; $pro_id=$row['id'];
    $result2 = $db->prepare("SELECT * FROM sales_list WHERE  invoice_no=:id AND product_id='$pro_id' ");
    $result2->bindParam(':id', $invo);
    $result2->execute();
    for($i=0; $row1 = $result2->fetch(); $i++){ $ch=$row1['id'];}
    if($ch == 0){
    ?>
<div class="col-md-12" id="<?php echo $row['id']  ?>">
   <div
       style="background:#363A71; border-radius: 15px; padding: 10px; color: #fff; margin: 3px;">
       <div class="row">
           <div class="col-md-6">
               <div style="font-size: 20px;"><?php echo $row['product_name'] ?></div>
               <div style="font-size: 12px;">Rs.<?php echo $row['sell_price'] ?></div>
           </div>

           <div class="col-md-1 pull-right"><a href="#" class="btn btn-info pull-right"
                   onclick="add_cart('<?php echo $row['id']  ?>','<?php echo $cat_id; ?>')">
                   <i class="fa fa-cart-plus"></i></a></div>
           <div class="col-md-3 pull-right"><input type="number" name="qty"
                   id="qty_<?php echo $row['id']  ?>" value="1"
                   class="form-control pull-right"
                   style="border-radius: 10px; background-color:#38394D; color:#fff"></div>

       </div>
   </div>

</div>
<?php } } ?>

<script>

</script>