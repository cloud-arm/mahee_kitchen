<?php 
include("../connect.php");
date_default_timezone_set("Asia/Colombo");

$cat_id = $_GET['id'];
$invo=$_GET['invo'];

$sql = "SELECT * FROM products WHERE type='dish'";

if($cat_id != ''){
    $sql = "SELECT * FROM products WHERE type='dish' AND cat_id='$cat_id'";
}

$result = $db->prepare($sql);
$result->bindParam(':userid', $date);
$result->execute();

echo $room_id;

for($i=0; $row = $result->fetch(); $i++){
    $ch=0; $pro_id=$row['id'];
    $result2 = $db->prepare("SELECT * FROM sales_list WHERE  invoice_no=:id AND product_id='$pro_id' ");
    $result2->bindParam(':id', $invo);
    $result2->execute();
    for($i=0; $row1 = $result2->fetch(); $i++){ $ch=$row1['id'];}
    if($ch == 0){
    ?>
    <div class="col-6 col-sm-4 col-md-3 col-lg-2">
        <div class="info-box">
            <span class="head"><?php echo $row['product_name']?></span>
            <span class="sub-head"><?php echo $row['product_code']?></span>
            <div class="img-box">
                <img src="img/rice.png" alt="">
            </div>
            <div class="info-foot">
                <span class="price">LKR. <?php echo $row['sell_price']?></span>
                <span class="fav" onclick="open_model('<?php echo $row['id'] ?>','<?php echo $row['product_name']?>','<?php echo $row['product_code']?>','<?php echo $row['sell_price']?>')">
                    <i class="fa-solid fa-cart-plus"></i>
                </span>
            </div>
        </div>
    </div>

<?php }}?>