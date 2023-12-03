<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('hed.php'); ?>
    <link rel="stylesheet" href="css/select2.app.css">
    <link rel="stylesheet" href="css/datepik.css">
    <style>
        
    input {
        width: 80%;
    }

    .login-btn {
        border-radius: 30px;
        width: 40%;
        background: linear-gradient(27deg, rgba(190, 0, 0, 0.8), rgba(50, 0, 0, 0.6));
        /* color:#FF3636; */
        color: #ABABAB;
        margin-top: 50px;
        font-size: 17px;
        height: 40px;
    }
    </style>
</head>

<body>
    <?php include('preload.php'); include("../connect.php"); ?>
    <br><br>
    <a href="index.php"><i style="font-size:30px; color:#3A3939; margin:6%" class="ion-chevron-left"></i></a>
    <br><br>
    <h2 style="margin:15px">Booking</h2>
    <br>
   
<?php $result = $db->prepare("SELECT * FROM booking WHERE  action= '0' ");
$result->bindParam(':userid', $res);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){ $id=$row['id'];?>
<div class="model-box">
    <h3><?php echo $row['cus_name']  ?></h3>
    <p><?php echo $row['phone_no']  ?></p>

    <table style="width: 100%;">
        <?php 
        $result1 = $db->prepare('SELECT * FROM booking_list WHERE  booking_id = :id');
        $result1->bindParam(':id', $id);
        $result1->execute();
        for($i=0; $row1 = $result1->fetch(); $i++){ ?>
        <tr>
            <td>Room  <?php echo $row1['room_no'];  ?></td>
            <td><?php echo $row['in_date'] ?></td>
            <td><?php echo $row['out_date'] ?></td>
        </tr>
        <?php } ?>
    </table>
    <b>Pay Amount <?php echo $row['pay_amount']  ?></b>
    <br>
    <a href="booking_apply.php?id=<?php echo $id; ?>">
        <div class="model-box color-red"><b>APPLY</b></div>
    </a>
</div> <br>
<?php } ?>
  
</body>

<!-- jQuery 2.2.3 -->
<script src="../../../plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Select2 -->
<script src="../../../plugins/select2/select2.full.min.js"></script>
<script src="js/datepik.js"></script>

<script>
$(function() {
    //Initialize Select2 Elements
    $(".select2").select2();
});
</script>

</html>