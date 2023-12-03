<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('hed.php'); ?>


</head>

<body>
    <?php include('preload.php'); include("../connect.php"); ?>

    <div class="notify-alert-box">
        <img src="../img/AUTO_LOGO.png" alt="">
        <p>We'd like to send notify</p>
        <div class="buttons">
            <button id="notify-cancel-button">Cancel</button>
            <button id="notify-button">Allow</button>
        </div>
    </div>

    <br><br>
    <table>
        <tr>
            <th><img src="../img/AUTO_LOGO.png" width="80px" style="text-align: right;" alt=""></th>
            <th>
                <h3 style="color: #fff;">CLOUD ARM inc.</h3>
                <h5>Hi <?php echo $_SESSION['SESS_FIRST_NAME']; ?></h5>
            </th>
        </tr>
    </table>
    <br>


    <!-- small box -->
    <?php $user_l=$_SESSION['SESS_LAST_NAME']; if($user_l=="admin") {?>
    <div class="hederbar" style="overflow-x:auto;">
        <table>
            <tr>
                <td>
                    <div class="model-box v-4">
                        <table>
                            <tr>
                                <td><i style="font-size:60px; margin:15px; color:#D1D1D1" class="ion-android-cart"></i>
                                </td>
                                <td>
                                    <h4 style="color:#686868">Sales Total</h4>
                                    <p style="padding-bottom: 5px; font-size: 25px; color:#959595;">
                                        Rs.<?php $date=date("Y-m-d");
                                    $result = $db->prepare("SELECT sum(amount)  FROM sales  WHERE action='active' AND date = '$date' ORDER BY transaction_id DESC");
                                    $result->bindParam(':userid', $date);
                                    $result->execute();
                                    for($i=0; $row = $result->fetch(); $i++){echo number_format($row['sum(amount)'],2);} ?>
                                    </p>
                                </td>
                            </tr>
                        </table>
                    </div>
                </td>

                <td>
                    <div class="model-box v-4">
                        <table>
                            <tr>
                                <td><i style="font-size:60px; margin:15px; color:#D1D1D1;" class="ion-stats-bars"></i>
                                </td>
                                <td>
                                    <h4 style="color:#686868">Expenses Total</h4>
                                    <p style="padding-bottom: 5px; font-size: 25px; color:#959595;">
                                        Rs.<?php 
                                    $result = $db->prepare("SELECT sum(amount)  FROM expenses_records  WHERE date = '$date' ");
                                    $result->bindParam(':userid', $date);
                                    $result->execute();
                                    for($i=0; $row = $result->fetch(); $i++){echo number_format($row['sum(amount)'],2);} ?>
                                    </p>
                                </td>
                            </tr>
                        </table>
                    </div>
                </td>

                <td>
                    <div class="model-box v-4">
                        <table>
                            <tr>
                                <td><i style="font-size:60px; margin:15px; color:#D1D1D1; "
                                        class="ion-person-stalker"></i></td>
                                <td>
                                    <h4 style="color:#686868">Guests</h4>
                                    <p style="padding-bottom: 5px; font-size: 25px; color:#959595;"><?php 
                                    $result = $db->prepare("SELECT sum(qty)  FROM room  WHERE action = '1' ");
                                    $result->bindParam(':userid', $date);
                                    $result->execute();
                                    for($i=0; $row = $result->fetch(); $i++){echo $row['sum(qty)'];} ?></p>
                                </td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
        </table>
    </div>
    <?php } ?>
   






    <?php 				  
        $result = $db->prepare("SELECT * FROM room ORDER by id ASC ");
        $result->bindParam(':userid', $date);
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){ 
            $date=$row['in_date'];
            $action=$row['action'];


            $date1=date("Y-m-d");

				  $sday= strtotime( $date);
                  $nday= strtotime($date1);
                  $tdf= abs($nday-$sday);
                  $nbday1= $tdf/86400;
                  $time_on= intval($nbday1);
				  $time_type="Day";
				  $color="red";  
					
            ?>
    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
        <div style="border-radius: 15px; background-color: #181929; color:aliceblue; margin: 2%; ">

            <table style="width:100%;  margin: 10px;">
                <tr>
                    <td>
                        <h4 style="color:#8C8C8C; margin: 10px;">ROOM NO  <b style="font-size: 30px; color:#fff"><?php echo $row['room_no']; ?></b></h4>
                    </td>
                    <td></td>

                </tr>
                <tr>
                    <td style="color:#959595"><?php echo $row['cus_name']; ?></td>
                    <td style="color:#959595"><?php echo $row['in_date']; ?></td>
                </tr>

                <tr>
                    <td></td>
                    <td style="color:#686868"><?php echo $row['time']; ?></td>
                </tr>
                <tr>

                </tr>
            </table>

            <table style="width:100%">
                <?php if($action==1){ ?>
                <tr>
                    <td>
                        <div align="left" style="width:100%;">

                            <div class="bg-<?php echo $color;?>"
                                style="color:#dbdbdb; width:100px;  text-align: center; border-radius: 15px 15px 15px 15px ">
                                <?php echo $time_on." ".$time_type;?></div>
                           
                        </div>
                    </td>


                    <td>
                        <div align="right" style="width:100%;">
                            <a href="sales.php?id=<?php echo $row['invoice_no']; ?>&room_no=<?php echo $row['room_no']; ?>">
                                <div class="bg-red"
                                    style="color:#dbdbdb; width:100px;  text-align: center; border-radius: 15px 0px 15px 0px">
                                    View</div>
                            </a>

                        </div>
                    </td>
                </tr>
                <?php }else{ ?>

                <tr>
                    <td>
                        <div align="left" style="width:100%;">
                            <div class="bg-green"
                                style="color:#dbdbdb; width:100px;  text-align: center; border-radius: 15px 15px 15px 15px ">
                                Available</div>

                           
                        </div>
                    </td>


                    <td>
                        <div align="right" style="width:100%;">
                            <a href="check_in.php?id=<?php echo $row['id']; ?>">
                                <div class="bg-blue"
                                    style="color:#dbdbdb; width:100px;  text-align: center; border-radius: 15px 0px 15px 0px">
                                    Check in</div>
                            </a>

                        </div>
                    </td>
                </tr>
                <?php } ?>
            </table>

        </div>
    </div>
    <?php } ?>

    <br><br>
    <?php if($user_l=="admin") { ?>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="box box-solid " style="background-color: #0e0f1a;">
            <div class="box-header">


                <h3 class="box-title">Net Profit Graph</h3>

            </div>
            <div class="box-body border-radius-none">
                <div class="chart" id="line-chart" style="height: 200px;"></div>
            </div>
        </div>
    </div>
    <?php } ?>
    <br><br><br><br>
    <div style="margin-top:100px"><h3><?php echo date('Y-M-d') ?></h3><h3>....</h3></div>


    <nav class="nav">
        <div class="nav-item active" id="index.php">
            <i class="material-icons home-icon  menu-icon">
                home
            </i>
            <span class="nav-text">Home</span>
        </div>
        <div class="nav-item" id="booking.php">
            <i class="material-icons person-icon menu-icon">
                person
            </i>
            <span class="nav-text">Customer</span>
        </div>
        <div class="nav-item " id="report.php">
            <i class="ion-stats-bars menu-icon"></i>
            <span class="nav-text">Reports</span>
        </div>
        <div class="nav-item" id="#">
            <i class="material-icons search-icon menu-icon">
                search
            </i>
            <span class="nav-text">Search</span>
        </div>

    </nav>
</body>
<!-- jQuery 2.2.3 -->
<script src="../../../plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../../../bootstrap/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="../../../plugins/morris/morris.min.js"></script>

<script src="pwa/app.js"></script>

<script src="js/notify.js"></script>
<script src="js/nav.js"></script>
<script>
$(function() {


    // LINE CHART
    var line = new Morris.Line({
        element: 'line-chart',
        resize: true,
        data: [
            //----------------------######################################## ---------------------------------------//
            {
                y: '<?php echo $y=date("Y")-2; ?> Q1',
                item1: <?php $date1=$y."-01-01"; $date2=$y."-03-31";
    $result1 = $db->prepare("SELECT  sum(profit) FROM sales WHERE action='active' AND date BETWEEN '$date1' AND '$date2'  ");
    $result1->bindParam(':userid', $date);
    $result1->execute();
    for($i=0; $row1 = $result1->fetch(); $i++){ $gf=$row1['sum(profit)'];}  
    
    $result1 = $db->prepare("SELECT  sum(amount) FROM expenses_records WHERE date BETWEEN '$date1' AND '$date2'   ");
    $result1->bindParam(':userid', $date);
    $result1->execute();
    for($i=0; $row1 = $result1->fetch(); $i++){ $ex=$row1['sum(amount)'];}
    
    echo $gf-$ex;
    ?>
            },
            {
                y: '<?php echo date("Y")-2; ?> Q2',
                item1: <?php $date1=$y."-04-01"; $date2=$y."-06-31";$ex=0;$gf=0;
    $result1 = $db->prepare("SELECT  sum(profit) FROM sales WHERE action='active' AND date BETWEEN '$date1' AND '$date2'  ");
    $result1->bindParam(':userid', $date);
    $result1->execute();
    for($i=0; $row1 = $result1->fetch(); $i++){ $gf=$row1['sum(profit)'];}  
    
    $result1 = $db->prepare("SELECT  sum(amount) FROM expenses_records WHERE date BETWEEN '$date1' AND '$date2'   ");
    $result1->bindParam(':userid', $date);
    $result1->execute();
    for($i=0; $row1 = $result1->fetch(); $i++){ $ex=$row1['sum(amount)'];}
    
    echo $gf-$ex;
    ?>
            },


            {
                y: '<?php echo date("Y")-2; ?> Q3',
                item1: <?php $date1=$y."-07-01"; $date2=$y."-09-31";$ex=0;$gf=0;
    $result1 = $db->prepare("SELECT  sum(profit) FROM sales WHERE action='active' AND date BETWEEN '$date1' AND '$date2'  ");
    $result1->bindParam(':userid', $date);
    $result1->execute();
    for($i=0; $row1 = $result1->fetch(); $i++){ $gf=$row1['sum(profit)'];}  
    
    $result1 = $db->prepare("SELECT  sum(amount) FROM expenses_records WHERE date BETWEEN '$date1' AND '$date2'   ");
    $result1->bindParam(':userid', $date);
    $result1->execute();
    for($i=0; $row1 = $result1->fetch(); $i++){ $ex=$row1['sum(amount)'];}
    
    echo $gf-$ex;
    ?>
            },


            {
                y: '<?php echo date("Y")-2; ?> Q4',
                item1: <?php $date1=$y."-10-01"; $date2=$y."-12-31";$ex=0;$gf=0;
    $result1 = $db->prepare("SELECT  sum(profit) FROM sales WHERE action='active' AND date BETWEEN '$date1' AND '$date2'  ");
    $result1->bindParam(':userid', $date);
    $result1->execute();
    for($i=0; $row1 = $result1->fetch(); $i++){ $gf=$row1['sum(profit)'];}  
    
    $result1 = $db->prepare("SELECT  sum(amount) FROM expenses_records WHERE date BETWEEN '$date1' AND '$date2'   ");
    $result1->bindParam(':userid', $date);
    $result1->execute();
    for($i=0; $row1 = $result1->fetch(); $i++){ $ex=$row1['sum(amount)'];}
    
    echo $gf-$ex;
    ?>
            },
            //----------------------######################################## ---------------------------------------//



            //----------------------######################################## ---------------------------------------//
            {
                y: '<?php echo $y=date("Y")-1; ?> Q1',
                item1: <?php $date1=$y."-01-01"; $date2=$y."-03-31";$gf=0;$ex=0;
    $result1 = $db->prepare("SELECT  sum(profit) FROM sales WHERE action='active' AND date BETWEEN '$date1' AND '$date2'  ");
    $result1->bindParam(':userid', $date);
    $result1->execute();
    for($i=0; $row1 = $result1->fetch(); $i++){ $gf=$row1['sum(profit)'];}  
    
    $result1 = $db->prepare("SELECT  sum(amount) FROM expenses_records WHERE date BETWEEN '$date1' AND '$date2'   ");
    $result1->bindParam(':userid', $date);
    $result1->execute();
    for($i=0; $row1 = $result1->fetch(); $i++){ $ex=$row1['sum(amount)'];}
    
    echo $gf-$ex;
    ?>
            },


            {
                y: '<?php echo date("Y")-1; ?> Q2',
                item1: <?php $date1=$y."-04-01"; $date2=$y."-06-31";$ex=0;$gf=0;
    $result1 = $db->prepare("SELECT  sum(profit) FROM sales WHERE action='active' AND date BETWEEN '$date1' AND '$date2'  ");
    $result1->bindParam(':userid', $date);
    $result1->execute();
    for($i=0; $row1 = $result1->fetch(); $i++){ $gf=$row1['sum(profit)'];}  
    
    $result1 = $db->prepare("SELECT  sum(amount) FROM expenses_records WHERE date BETWEEN '$date1' AND '$date2'   ");
    $result1->bindParam(':userid', $date);
    $result1->execute();
    for($i=0; $row1 = $result1->fetch(); $i++){ $ex=$row1['sum(amount)'];}
    
    echo $gf-$ex;
    ?>
            },


            {
                y: '<?php echo date("Y")-1; ?> Q3',
                item1: <?php $date1=$y."-07-01"; $date2=$y."-09-31";$ex=0;$gf=0;
    $result1 = $db->prepare("SELECT  sum(profit) FROM sales WHERE action='active' AND date BETWEEN '$date1' AND '$date2'  ");
    $result1->bindParam(':userid', $date);
    $result1->execute();
    for($i=0; $row1 = $result1->fetch(); $i++){ $gf=$row1['sum(profit)'];}  
    
    $result1 = $db->prepare("SELECT  sum(amount) FROM expenses_records WHERE date BETWEEN '$date1' AND '$date2'   ");
    $result1->bindParam(':userid', $date);
    $result1->execute();
    for($i=0; $row1 = $result1->fetch(); $i++){ $ex=$row1['sum(amount)'];}
    
    echo $gf-$ex;
    ?>
            },

            {
                y: '<?php echo date("Y")-1; ?> Q4',
                item1: <?php $date1=$y."-10-01"; $date2=$y."-12-31";$ex=0;$gf=0;
    $result1 = $db->prepare("SELECT  sum(profit) FROM sales WHERE action='active' AND date BETWEEN '$date1' AND '$date2'  ");
    $result1->bindParam(':userid', $date);
    $result1->execute();
    for($i=0; $row1 = $result1->fetch(); $i++){ $gf=$row1['sum(profit)'];}  
    
    $result1 = $db->prepare("SELECT  sum(amount) FROM expenses_records WHERE date BETWEEN '$date1' AND '$date2'   ");
    $result1->bindParam(':userid', $date);
    $result1->execute();
    for($i=0; $row1 = $result1->fetch(); $i++){ $ex=$row1['sum(amount)'];}
    
    echo $gf-$ex;
    ?>
            },
            //----------------------######################################## ---------------------------------------//


            //----------------------######################################## ---------------------------------------//
            {
                y: '<?php echo $y=date("Y"); ?> Q1',
                item1: <?php $date1=$y."-01-01"; $date2=$y."-03-31";$gf=0;$ex=0;
    $result1 = $db->prepare("SELECT  sum(profit) FROM sales WHERE action='active' AND date BETWEEN '$date1' AND '$date2'  ");
    $result1->bindParam(':userid', $date);
    $result1->execute();
    for($i=0; $row1 = $result1->fetch(); $i++){ $gf=$row1['sum(profit)'];}  
    
    $result1 = $db->prepare("SELECT  sum(amount) FROM expenses_records WHERE date BETWEEN '$date1' AND '$date2'   ");
    $result1->bindParam(':userid', $date);
    $result1->execute();
    for($i=0; $row1 = $result1->fetch(); $i++){ $ex=$row1['sum(amount)'];}
    
    echo $gf-$ex;
    ?>
            },


            {
                y: '<?php echo date("Y"); ?> Q2',
                item1: <?php $date1=$y."-04-01"; $date2=$y."-06-31";$ex=0;$gf=0;
    $result1 = $db->prepare("SELECT  sum(profit) FROM sales WHERE action='active' AND date BETWEEN '$date1' AND '$date2'  ");
    $result1->bindParam(':userid', $date);
    $result1->execute();
    for($i=0; $row1 = $result1->fetch(); $i++){ $gf=$row1['sum(profit)'];}  
    
    $result1 = $db->prepare("SELECT  sum(amount) FROM expenses_records WHERE date BETWEEN '$date1' AND '$date2'   ");
    $result1->bindParam(':userid', $date);
    $result1->execute();
    for($i=0; $row1 = $result1->fetch(); $i++){ $ex=$row1['sum(amount)'];}
    
    echo $gf-$ex;
    ?>
            },


            {
                y: '<?php echo date("Y"); ?> Q3',
                item1: <?php $date1=$y."-07-01"; $date2=$y."-09-31";$ex=0;$gf=0;
    $result1 = $db->prepare("SELECT  sum(profit) FROM sales WHERE action='active' AND date BETWEEN '$date1' AND '$date2'  ");
    $result1->bindParam(':userid', $date);
    $result1->execute();
    for($i=0; $row1 = $result1->fetch(); $i++){ $gf=$row1['sum(profit)'];}  
    
    $result1 = $db->prepare("SELECT  sum(amount) FROM expenses_records WHERE date BETWEEN '$date1' AND '$date2'   ");
    $result1->bindParam(':userid', $date);
    $result1->execute();
    for($i=0; $row1 = $result1->fetch(); $i++){ $ex=$row1['sum(amount)'];}
    
    echo $gf-$ex;
    ?>
            },

            {
                y: '<?php echo date("Y"); ?> Q4',
                item1: <?php $date1=$y."-10-01"; $date2=$y."-12-31";$ex=0;$gf=0;
    $result1 = $db->prepare("SELECT  sum(profit) FROM sales WHERE action='active' AND date BETWEEN '$date1' AND '$date2'  ");
    $result1->bindParam(':userid', $date);
    $result1->execute();
    for($i=0; $row1 = $result1->fetch(); $i++){ $gf=$row1['sum(profit)'];}  
    
    $result1 = $db->prepare("SELECT  sum(amount) FROM expenses_records WHERE date BETWEEN '$date1' AND '$date2'   ");
    $result1->bindParam(':userid', $date);
    $result1->execute();
    for($i=0; $row1 = $result1->fetch(); $i++){ $ex=$row1['sum(amount)'];}
    
    echo $gf-$ex;
    ?>
            }
            //----------------------######################################## ---------------------------------------//
        ],
        xkey: 'y',
        ykeys: ['item1'],
        labels: ['Value'],
        lineColors: ['#ffffff'],
        gridTextColor: ['#ffffff'],
        hideHover: 'auto'
    });

});
</script>

</html>