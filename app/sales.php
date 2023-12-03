<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('hed.php'); ?>
    <!-- Select2 -->
    <link rel="stylesheet" href="css/select2.app.css">
</head>

<body>
    <?php include('preload.php'); include("../connect.php"); $id=$_GET['id']; $room_no=$_GET['room_no']; ?>
    <br><br>
    <a href="index.php"><i style="font-size:30px; color:#3A3939; margin:6%" class="ion-chevron-left"></i></a>
     <br>
    <H2 style="margin: 10px;">SALES</H2>
    
    <br><br>
    <?php 
    
    



    $result1 = $db->prepare("SELECT * FROM room WHERE  invoice_no='$id' ");
    $result1->bindParam(':userid', $date);
    $result1->execute();
    for($i=0; $row1 = $result1->fetch(); $i++){ $job_no=0; $customer_id=$row1['cus_id'];
    $invo=$row1['invoice_no'];
    $package_id = $row1['package_id']; 
    $cus=$row1['cus_name'];
    $indate=$row1['in_date'];
    $booking_id=$row1['booking_id'];
    ?>

<p style="margin: 10px;">ROOM NO: <?php echo $row1['room_no']; ?></p>
    <?php } 
    $date=date('Y-m-d');
    $sday= strtotime( $date);
    $nday= strtotime($indate);
    $tdf= abs($nday-$sday);
    $nbday1= $tdf/86400;
    $qty = intval($nbday1);

    $result = $db->prepare('SELECT * FROM booking WHERE  id=:userid ');
    $result->bindParam(':userid', $booking_id);
    $result->execute();
    for($i=0; $row = $result->fetch(); $i++){ $discount=$row['discount']; $advance=$row['pay_amount']; }

    $sql = 'UPDATE  sales_list SET qty=?,amount=price * ? WHERE  invoice_no=? AND type=?';
    $ql = $db->prepare($sql);
    $ql->execute(array($qty,$qty,$id,'package'));
    ?>
    <h3 style="margin: 10px;"><?php echo $cus; ?></h3>
   
    <p align="right" style="margin: 10px;">INVOICE NO: <?php echo $invo; ?></p>
    <p align="right" style="margin: 10px;"><?php echo $indate; ?></p>

    
    <br>

    <form action="sales_save.php" method="post">
        <select class="select2" id="product" name="name" style="width: 78%;">
            <?php  $total=0;
                  $result = $db->prepare("SELECT * FROM products  ");
                 $result->bindParam(':userid', $res);
                 $result->execute();
                 for($i=0; $row = $result->fetch(); $i++){ ?>
            <option product_price="<?php echo $row['sell_price'];?>" value="<?php echo $row['id'];?>">
                <?php echo $row['product_name']; ?></option>
            <?php	} ?>
        </select>
        <input type="number" name="qty" class="model-box" style="width:15%;" placeholder="QTY">
        <input type="hidden" name="end" value="app">
        <input type="hidden" name="room_no" value="<?php echo $room_no; ?>">
        <input type="hidden" name="invoice" value="<?php echo $id; ?>">
    </form>
    <b id="price_dis" style="margin: 10px;"></b>
   
    <br>
    <div class="model-box">
        <table style="width: 96%;  margin:2%; text-align:center;">
            <thead>
                <tr style="background-color: #00525E;">
                <td>Room</td>
                    <td>item</td>
                    <td>qty</td>
                    <td>Dis</td>
                    <td align="right">Price</td>
                    <td align="right">Total</td>
                </tr>
            </thead>
            <tbody>
                <?php $result = $db->prepare("SELECT * FROM sales_list WHERE  invoice_no='$id' ");
                       $result->bindParam(':userid', $date);
                       $result->execute();
                       for($i=0; $row = $result->fetch(); $i++){ ?>
                <tr style="border-color: #959595;">
                <td><?php echo $row['room_no']  ?></td>
                    <td width="40%"><?php echo $row['name']; ?></td>
                    <td><?php echo $row['qty']; ?></td>
                    <td style="color: #E8AEAE;"><?php echo number_format($row['dic'],1); ?></td>
                    <td align="right"><?php echo number_format($row['price'],1) ?></td>
                    <td align="right"><?php echo number_format($row['amount'],1); ?></td>
                    <td style="display: none;" class="dll"><a href="../sales_dll.php?id=<?php echo $row['id']; ?>&invo=<?php echo $invo; ?>&end=app&room_no=<?php echo $room_no; ?>">
                            <button class="btn btn-danger"><i class="fa fa trash">X</i></button></a></td>
                </tr>
                <tr>
                    <td>.</td>
                </tr>
                <?php $total+=$row['amount']; } ?>
            </tbody>

        </table>
    </div>
    <button onclick="dllshow()" class="model-box v-1 color-red">Delete</button>
    <div class="model-box">
        <h3 align="right" style="margin: 10px;">Total: Rs.<?php echo number_format($total,2); ?></h3>
        <h3 align="right" style="margin: 10px;"><?php echo $row1['pay_type'] ?></h3> <br>
        <h4 align="right" style="margin: 10px;">Advance: Rs.<?php echo number_format($advance,2); ?></h4>
        <h4 align="right" style="margin: 10px;">Balance: Rs.<?php echo number_format($total-$advance,2); ?></h4>
    </div>
   

    <br><br>
    <div class="model-box">
        <?php 
		
		$result1 = $db->prepare("SELECT * FROM customer WHERE customer_id='$customer_id' ");
		$result1->bindParam(':userid', $a1);
		$result1->execute();
		for($i=0; $row1 = $result1->fetch(); $i++){
		$email=$row1['email'];
		} ?>
        <form method="post" action="../save_bill.php">
            <div class="form-group">

                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-3">

                            <textarea class="model-box" placeholder="Note"
                                style="width: 90%; height: 50px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"
                                name="note" id="" cols="30" rows="2"></textarea>
                        </div>
                    </div>
                </div>
            </div>


            <?php if($email==""){}else{ ?>
            <div class="col-md-3">
                <input id="vehicle2" type="checkbox" name="email" value="1">
                <label style="margin: 10px;" for="vehicle2"> Send to <?php echo $email; ?></label>
            </div>

            <?php } ?>

            
            <div class="col-md-2 col-sm-4 col-lg-4" style="margin: 20px;">
                <div class="model-box">
                    <div class="row">
                        <label>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="p_type" id="optionsRadios1" value="Cash" checked>
                                    Cash
                                </label>
                            </div>
                        </label>

                        <label>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="p_type" id="optionsRadios1" value="Card">
                                    Card
                                </label>
                            </div>
                        </label>

                       

                    </div>
                    <!-- /btn-group -->
                    <input type="number" style="width:50%" class="model-box" name="dis" value="<?php echo $discount; ?>">

                    <label>Discount</label>
                    <input type="number" style="width:50%" class="model-box" name="amount" value="">

                    <label>Pay Amount</label>

                </div>
            </div>

            <input type="hidden" class="form-control" name="total" value="<?php echo $total; ?>">
            <input type="hidden" class="form-control" name="id" value="<?php echo $invo; ?>">
            <input type="hidden" name="end" value="app">
            <input class="btn btn-info " type="submit" value="Pay and Print" style="margin: 20px;">
        </form>
    </div>
    <br><br>


    <div class="hederbar" style="overflow-x:auto;">
        <table>
            <tr>


                <?php if($package_id==0){
        $date=date('Y-m-d');
        $result = $db->prepare("SELECT * FROM package ");
        $result->bindParam(':userid', $date);
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){ 
           if($row['type']==1){$color="#09BE45";}else{ $color="#BE0909"; }
            ?>
                <td>
                    <div class="model-box v-3">
                        <h3> <?php echo $row['name']; ?></h3>
                        Rs.<?php echo $row['amount']; ?> <br>
                        <a
                            href="../package_apply.php?id=<?php echo $row['id']; ?>&invoice=<?php echo $_GET['id']; ?>&room=<?php echo $room_no; ?>&end=app">
                            <div
                                style="width: 100%;  background-color: <?php echo $color; ?>; color:aliceblue;  border-radius: 0px 0px 15px 15px;">
                                Apply</div>
                        </a>
                    </div>
                </td>
                <?php } } ?>


            </tr>
        </table>
    </div>

    <br>
</body>
<!-- jQuery 2.2.3 -->
<script src="../../../plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Select2 -->
<script src="../../../plugins/select2/select2.full.min.js"></script>

<script>
$('#product').change(function() {
    var price = $(this).find('option:selected').attr('product_price');
    document.getElementById('price_dis').innerHTML = "Price: <i style='color:#FF4A4A;'>" + price + "</i>";
});

function dllshow() {


 var all_col=document.getElementsByClassName('dll');
  for(var i=0;i<all_col.length;i++)
  {
   all_col[i].style.display='block';
  }
   
}

$(function() {
    //Initialize Select2 Elements
    $(".select2").select2();
});
</script>

</html>