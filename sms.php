<!DOCTYPE html>
<html>
<head>
	<?php
		  include("connect.php");
	
	$invo = $_GET['id'];
	$co = substr($invo,0,2) ;
			?>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>COLOR Biznaz | Invoice</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body onload="window.print() " style=" font-size: 13px; font-family: arial;">
<?php
$sec = "1";
?><meta http-equiv="refresh" content="<?php echo $sec;?>;URL='sales1.php'">	
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
	  
	  
	  
	  
	  <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-6">
           <h3><img src="chaminda_m.jpg" width="120" alt="">Chaminda Motors.</h3>
	  <p>NO.56 Marikkar st,Darga town, <br>
	  Email: Chamindamotors8@gmail.com <br>
	  https://www.facebook.com/ChamindaMotors <br>	  
	<h4><b>Mobile No: 076-834 9735</b><br>	
		  Date:<?php date_default_timezone_set("Asia/Colombo"); 
    echo date("Y-m-d"); echo "  Time-";  echo date("h:ia")  ?>
			</h4></p>
	  
        </div>
        <!-- /.col -->
		  
		  
		  
		  
        <div class="col-xs-6">
          <small class="pull-right"><img src="honda.png" width="120" alt="">
        </div> <h3>
		  <?php if ($co=="qt"){
		 echo $_GET['vehicle_no'];
	} 
		  if ($co>0){
		 
			   $invo=$_GET['id'];	
				$result = $db->prepare("SELECT * FROM sales WHERE   invoice_number='$invo'");
				$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
				echo $row['vehicle_no'];
				}
			  }  if ($co=="ds"){
		 
			   $invo=$_GET['id'];	
				$result = $db->prepare("SELECT * FROM sales WHERE   invoice_number='$invo'");
				$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
				echo $row['vehicle_no'];
				}
			   } ?>
			..</h3></small>
        <!-- /.col -->
		  <div class="col-xs-4">
          <h3>
		  <?php if ($co=="qt"){
		echo "Quotations";
	} 
		  if ($co>0){
		 
			  echo "Final Bill";
				
			  }  if ($co=="ds"){
		 
			  echo "Final Bill";
			   } ?>
			  </h3>
      </div></div>
  
<div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
				<th>ID Code</th>
				<th>Product</th>
                  <th>Qty</th>
                  
                  <th>Amount </th>
                </tr>
                </thead>
                <tbody>
				<?php
			date_default_timezone_set("Asia/Colombo");
		$hh=date("Y/m/d");
		$invo=$_GET['id'];
					$tot_amount=0;
				$result = $db->prepare("SELECT * FROM sales_list WHERE   invoice_no='$invo'");
					$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
			?>
                <tr>
				<td><?php echo $row['code'];?></td>
                  <td><?php echo $row['name'];?></td>
				  <td><?php echo $row['qty'];?></td>
                  
                  <td>Rs.<?php echo $row['price'];?></td>
					<?php $tot_amount+= $row['price'];?>
                  <?php } ?>
                 </tr>
                </tbody>
                <tfoot>
                </tfoot>
              </table>
	<?php
				$result1 = $db->prepare("SELECT * FROM sales WHERE   invoice_number='$invo'  ");		
					$result1->bindParam(':userid', $date);
                $result1->execute();
                for($i=0; $row1 = $result1->fetch(); $i++){
				//$tot_amount=$row1['amount'];
					$balance=$row1['balance'];
				}
			?>  
	<div class="col-xs-6">
         
          <div class="table-responsive">
            <table class="table">
			<tr>
                <th>Amount</th>
                <td>Rs.<?php echo $tot_amount; ?>.00</td>
              </tr>
			  <tr>
                <th>Pay Amount</th>
                <td>Rs.<?php echo $tot_amount+$balance; ?>.00</td>
              </tr>
              <tr>
                <th>Balance:</th>
                <td>Rs.<?php echo $balance; ?>0</td>
              </tr>
            </table>
          </div>
        </div>
            </div>
        </div>
  </section>
</div>
</body>
</html>