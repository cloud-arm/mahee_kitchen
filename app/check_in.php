<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('hed.php'); ?>
    
    <link rel="stylesheet" href="css/select2.app.css">
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
    <?php include('preload.php');  include("../connect.php"); ?>
    <?php $id=$_GET["id"]; $date=date('Y-m-d');
    $result = $db->prepare("SELECT * FROM booking_list JOIN booking ON booking.id=booking_list.booking_id WHERE  booking.id='$id' AND booking.in_date='$date'  ");
    $result->bindParam(':userid', $res);
    $result->execute();
    for($i=0; $row = $result->fetch(); $i++){ ?>
    <div class="alert-box">
        <h3>You have a booking </h3>
        <b><?php echo $row['cus_name']  ?></b> <br>
        <i style="color:#ABABAB"><?php echo $row['in_date'].' __To__ '.$row['out_date']  ?></i>

        <div class="buttons">
            <a href="booking.php">
            <button >Go</button>
            </a>
        </div>
    </div>
    <?php } ?>
    <br><br>
    <a href="index.php"><i style="font-size:30px; color:#3A3939; margin:6%" class="ion-chevron-left"></i></a>
    <br><br>
    <h2 style="margin:15px">CHECK IN</h2>
    <br>

    <center>
        <img src="img/hotel.svg" width="80%">


<br><br><br>

        <form action="../save_cus.php" method="post">

        <div class="row">

        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-3">
            <input class="model-box color-purple" type="number" id='phone' name="phone_no" onchange="ex_cus()" placeholder="Phone No" autocomplete="off" >
        </div>

        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-3">
            <input class="model-box color-purple" type="text" id='name' name="cus_name" placeholder="Customer Name" autocomplete="off">
        </div>

        

        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-3">
            <input class="model-box color-purple" type="text" id='email' name="email" placeholder="E-mail" autocomplete="off">
        </div>

        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-3">
            <input class="model-box color-purple" type="text" id='address' name="address" placeholder="Address" autocomplete="off">
        </div>

        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-3">
            <input class="model-box color-purple" type="text" id='nic' name="nic" placeholder="NIC" autocomplete="off">
        </div>

       

        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-3">
                <select class="model-box " name="person" style="width: 80%;" >
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                </select>
            </div>

        </div>
        
            <input type="hidden" name="end" value="app">
            <input type="hidden" name="cus_id" id='cus_id' value="0">
            <input type="hidden" name="room" value="<?php echo $_GET['id'] ?>">
            <input type="submit" value="Save" class="login-btn">
            
        </form>
        </center>
        <br><br>
        <div class="hederbar" style="overflow-x:auto;">
        <table>
            <tr>


                <?php $id=$_GET["id"];
                $result = $db->prepare("SELECT * FROM room WHERE id = '$id' ");
                $result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){ $room_no=$row['room_no']; }

        $result = $db->prepare("SELECT * FROM booking WHERE room_no = '$room_no' ");
        $result->bindParam(':userid', $date);
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){ 
           if($row['type']==1){$color="#09BE45";}else{ $color="#BE0909"; }
            ?>
                <td>
                    <div class="model-box v-3">
                        <h3> <?php echo $row['cus_name']; ?></h3>
                        <?php echo $row['in_date']; ?> To <?php echo $row['out_date']; ?>  <br>
                        
                    </div>
                </td>
                <?php } ?>


            </tr>
        </table>
    </div>
   
    <br><br><br><br>
</body>
<!-- jQuery 2.2.3 -->
<script src="../../../plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Select2 -->
<script src="../../../plugins/select2/select2.full.min.js"></script>
<script type="text/javascript" src="js/cam/webcam.min.js"></script>
<script src="js/alert.js"></script>
<script>
function ex_cus(){
    var phone = document.getElementById('phone').value;
    var data='ur';
    fetch("customer_data.php?phone="+phone)
  .then((response) => response.json())
  .then((json) => fill(json));
}

function fill(json) {
    

    if(json.action == "true"){
console.log("old customer");
    document.getElementById('name').value = json.name;
    document.getElementById('address').value = json.address;
    document.getElementById('email').value = json.email;
    document.getElementById('nic').value = json.nic;
    document.getElementById('cus_id').value = json.id;

    document.getElementById('name').disabled = true;
    document.getElementById('address').disabled = true;
    document.getElementById('email').disabled = true;
    document.getElementById('nic').disabled = true;

}else{
    console.log("new customer");
    document.getElementById('name').value = '';
    document.getElementById('address').value = '' ;
    document.getElementById('email').value =  '';
    document.getElementById('birthday').value = "" ;
    document.getElementById('cus_id').value = "0" ;

    document.getElementById('name').disabled = false ;
    document.getElementById('address').disabled = false;
    document.getElementById('email').disabled = false;
    document.getElementById('nic').disabled = false;
}
}


$(function() {
    //Initialize Select2 Elements
    $(".select2").select2();
});
</script>

</html>