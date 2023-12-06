<?php 
include("../connect.php");
date_default_timezone_set("Asia/Colombo");

$floor_id = $_GET['id'];

$sql = "SELECT * FROM room";

if($floor_id != '0' && $floor_id != ''){
    $sql = "SELECT * FROM room WHERE floor='$floor_id'";
}

$result = $db->prepare($sql);
$result->bindParam(':userid', $date);
$result->execute();

for($i=0; $row = $result->fetch(); $i++){?>

<div class="col-4 col-md-3 col-lg-2">
    <?php if($row['action'] == 1){?>    
        <a href="order.php?id=<?php echo $row['id'] ?>&invo=<?php echo $row['invoice_no'] ?>" class="nav-link">
    <?php }else{?>
        <a href="order.php?id=<?php echo $row['id'] ?>&invo=<?php echo date("ymdhis");?>" class="nav-link">
    <?php }?>
        <div class="room" <?php if($row['action'] == 1){ ?> style="background-color: rgb(var(--bg-theme));" <?php }?>>
            <span>
                
            </span>
            <span class="num"<?php if($row['action'] == 1){ ?> style="color: rgb(var(--bg-black));" <?php }?>><?php echo $row['room_no'] ?></span>
            <?php if($row['action'] == 1){             
                $invo = $row['invoice_no'];
                $result1 = $db->prepare("SELECT sum(amount) FROM sales_list WHERE invoice_no='$invo'");
                $result1->bindParam(':userid', $date);
                $result1->execute();
                for($i=0; $row1 = $result1->fetch(); $i++){$total = $row1['sum(amount)'];}?>
                <span class="tot">Rs. <?php echo $total ?></span>
            <?php }?>   
        </div>
    </a>
</div>

<?php }?>