<!DOCTYPE html>
<html>
<head>
	<?php
		  include("connect.php");
	

			?>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>CLOUD ARM | Invoice</title>
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
?><meta http-equiv="refresh" content="<?php echo $sec;?>;URL='re_rp.php'">	
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">

            <div class="box-body">

    <table id="example1" class="table table-bordered table-striped">
			  
             <thead>
                <tr>
					<th>Customer ID</th>
                  <th>Vehicle No</th>
				 
                  
				  <th>Customer Name</th>
					<th>Type</th>
					<th>Phone no</th>
                  
					<th>Bill Date</th>
                  <th>#</th>
                </tr>
				
                </thead>
				
                <tbody>
				<?php
   
			 $tot=0;


$date1 = date("Y-m-d");
        $result = $db->prepare("SELECT * FROM customer  ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
		$customer_id=$row['customer_id'];
		$vehicle_no=$row['vehicle_no'];
		$customer=$row['customer_name'];
		$phone=$row['contact'];

		$result1 = $db->prepare("SELECT * FROM sales WHERE vehicle_no='$vehicle_no' and action='active' ORDER by transaction_id DESC limit 0,1 ");
		$result1->bindParam(':userid', $res);
		$result1->execute();
		for($i=0; $row1 = $result1->fetch(); $i++){
		$date1=$row1['date'];
			$type=$row1['type'];
		}
 $date = date("Y-m-d");
				  $sday= strtotime( $date1);
                  $nday= strtotime($date);
                  $tdf= abs($nday-$sday);
                  $nbday1= $tdf/86400;
                  $rs= intval($nbday1);
			
			if($rs>60){
			
			if($rs<90){
			
				
			?>
                <tr>
				  <td><?php echo $customer_id;?></td>
				  <td><?php echo $vehicle_no;?></td>
				  <td><?php echo $customer;?></td>
					<td><?php echo $type;?></td>
                  <td><?php echo $phone;?></td>
				  <td><?php echo $date1;?></td>
				  <td><?php echo $rs;?>Day</td>
				
				  
				  
				   <?php 
			}
				}
		}
					
					
				?>
                </tr>
               
                
                </tbody>
  
					</table>
					
					
            </div>
					
					
				
				
				
				
				
				</div></div>
  </section>
</div>
</body>
</html>