<!DOCTYPE html>

<html>

<?php 

include("head.php");
include("connect.php");

?>

<body>

    <?php 

include_once("auth.php");
$r=$_SESSION['SESS_LAST_NAME'];
?>





    <!-- /.sidebar -->

    </aside>



    <!-- Content Wrapper. Contains page content -->

    <div>

        <!-- Content Header (Page header) -->

        <section class="content-header">

            <h1>
                Home
                <small>Preview</small>
            </h1>
        </section>
        <!-- Main content -->
        <section class="content">
            <?php

		include('connect.php');
		
				$date=date("Y-m-d");
			?>







            <div class="row">
                <?php 
		$result = $db->prepare("SELECT * FROM room  ORDER by id ASC ");
				$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
				$type=$row['action'];
				$invoice=$row['invoice_no'];
				
				if($row['action']==1){$type='in operation'.$row['in_date']; $color="yellow";}
				if($row['action']==0){$type="Available"; $color="blue";}
				
$result1 = $db->prepare("SELECT sum(amount) FROM sales_list WHERE invoice_no='$invoice' ");
				$result1->bindParam(':userid', $date);
                $result1->execute();
                for($i=0; $row1 = $result1->fetch(); $i++){ $bill=$row1['sum(amount)']; }
				
?>
               


                <div class="col-md-3">

                    <div class="info-box bg-<?php echo $color; ?>">
                        <span class="info-box-icon"><i class="fa fa-cutlery"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text"> <?php echo $type; ?> </span>
                            <span class="info-box-number"><?php echo $row['room_no']; ?></span>
                            <div class="progress">
                                <div class="progress-bar" style="width: 50%"></div>
                            </div>
                            <span class="progress-description">
                            Rs.<?php echo $bill; ?>
                            </span>
                        </div>

                    </div>
                </div>

                <?php } ?>
            </div>







        </section>


    </div>

    <!-- /.content-wrapper -->


    <!-- /.control-sidebar -->

    <!-- Add the sidebar's background. This div must be placed

       immediately after the control sidebar -->

    <div class="control-sidebar-bg"></div>



    <!-- ./wrapper -->



    <!-- jQuery 2.2.3 -->

    <script src="../../plugins/jQuery/jquery-2.2.3.min.js"></script>

    <!-- Bootstrap 3.3.6 -->

    <script src="../../bootstrap/js/bootstrap.min.js"></script>

    <!-- ChartJS 1.0.1 -->

    <script src="../../plugins/chartjs/Chart.min.js"></script>

    <!-- FastClick -->

    <script src="../../plugins/fastclick/fastclick.js"></script>

    <!-- AdminLTE App -->

    <script src="../../dist/js/app.min.js"></script>

    <!-- AdminLTE for demo purposes -->

    <script src="../../dist/js/demo.js"></script>


    <!-- page script -->

    <script>
        setInterval(myTimer, 5000);


        function myTimer(){

            var xmlhttp;
            if (window.XMLHttpRequest) {
                xmlhttp = new XMLHttpRequest();
            } else { 
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                  //  document.getElementById("cat-box").innerHTML = xmlhttp.responseText;

                  console.log(xmlhttp.responseText);

                  if(xmlhttp.responseText=="0") {}else{
                    window.location.href = "bill.php?id="+xmlhttp.responseText;
                  }
                }
            }

            xmlhttp.open("GET", "auto_print_get.php" , true);
            xmlhttp.send();


          //  window.location.href = "http://www.w3schools.com";
        }
    </script>


</body>

</html>