<!DOCTYPE html>
<html>
<head>
	<?php
		  include("connect.php");
	

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
?><meta http-equiv="refresh" content="<?php echo $sec;?>;URL='month_end.php'">	
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">

            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">

			  

                <thead>

                <tr>
				<th>Model</th>
					<th>Repair Value</th>
					<th>Repair </th>
                  <th>Full Service</th>
				  <th>NED Free Service</th>
                  <th>1st Free Service</th>
					<th>2nd Free Service</th>
                </tr>
                </thead>

				

                <tbody>

				<?php
	$repair11=0;
				$full11=0;
				$ned_free11=0;
				$free111=0;
				$free211=0;
			    $st2=0;
			 $nd2=0;

   $date1=$_GET['d1'];
					$date2=$_GET['d2'];

   $result = $db->prepare("SELECT * FROM mechanic ");

				$result->bindParam(':userid', $date);

                $result->execute();

                for($i=0; $row = $result->fetch(); $i++){	
					$id=$row['id'];
					$name=$row['name'];
				$repair=0;
				$full=0;
				$ned_free=0;
				$free1=0;
				$free2=0;
$result1 = $db->prepare("SELECT * FROM sales where action='active' and mechanic='$id' and date BETWEEN '$date1' and '$date2' ORDER by transaction_id ASC   ");
				$result1->bindParam(':userid', $id);
                $result1->execute();
                for($i=0; $row1 = $result1->fetch(); $i++){
$invo=$row1['invoice_number'];

		$result2 = $db->prepare("SELECT sum(price) FROM sales_list where invoice_no='$invo' and product_id='404'  ");
				$result2->bindParam(':userid', $id);
                $result2->execute();
                for($i=0; $row2 = $result2->fetch(); $i++){
					$repair1=$row2['sum(price)'];
				}
				$result2 = $db->prepare("SELECT count(id) FROM sales_list where invoice_no='$invo' and product_id='404'  ");
				$result2->bindParam(':userid', $id);
                $result2->execute();
                for($i=0; $row2 = $result2->fetch(); $i++){
					$repair2=$row2['count(id)'];
				}
				$result2 = $db->prepare("SELECT count(id) FROM sales_list where invoice_no='$invo' and product_id='402'  ");
				$result2->bindParam(':userid', $id);
                $result2->execute();
                for($i=0; $row2 = $result2->fetch(); $i++){
					$full1=$row2['count(id)'];
				}
				$result2 = $db->prepare("SELECT count(id) FROM sales_list where invoice_no='$invo' and product_id='407'  ");
				$result2->bindParam(':userid', $id);
                $result2->execute();
                for($i=0; $row2 = $result2->fetch(); $i++){
					$ned_free1=$row2['count(id)'];
				}
				$result2 = $db->prepare("SELECT count(id) FROM sales_list where invoice_no='$invo' and product_id='431'  ");
				$result2->bindParam(':userid', $id);
                $result2->execute();
                for($i=0; $row2 = $result2->fetch(); $i++){
					$st=$row2['count(id)'];
				}
				$result2 = $db->prepare("SELECT count(id) FROM sales_list where invoice_no='$invo' and product_id='432'  ");
				$result2->bindParam(':userid', $id);
                $result2->execute();
                for($i=0; $row2 = $result2->fetch(); $i++){
					$nd=$row2['count(id)'];
				}
				
					$repair_cou+=$repair2;
				$repair+=$repair1;
				$full+=$full1;
				$ned_free+=$ned_free1;
				$free1+=$st;
				$free2+=$nd;
				}
			?>

                <tr class="record" >
				<td><?php echo $row['name'];?></td>

			      <td>Rs.<?php echo $repair; ?></td>
					<td><?php echo $repair_cou; ?></td>
                  <td><?php echo $full; ?></td>
				  <td><?php echo $ned_free; ?></td>
   				  <td><?php echo $free1; ?></td>
				  <td><?php echo $free2; ?></td>

				       

                  

				  

				 

				  

				   <?php 
				$repair11+=$repair;
				$full11+=$full;
				$ned_free11+=$ned_free;
				$free111+=$free1;
				$free211+=$free2;
				}

				

				?>

                </tr>

               

                

                </tbody>

                <tfoot>

                <tr style="background-color:cornsilk">
					<td>Total</td>
				<td>Rs.<?php echo $repair11; ?></td>
                  <td><?php echo $full11; ?></td>
				  <td><?php echo $ned_free11; ?></td>
   				  <td><?php echo $free111; ?></td>
				  <td><?php echo $free211; ?></td>	
				</tr>
<?php 
				$result2 = $db->prepare("SELECT sum(price) FROM sales_list where product_id='404'  ");
				$result2->bindParam(':userid', $id);
                $result2->execute();
                for($i=0; $row2 = $result2->fetch(); $i++){
					$repair12=$row2['sum(price)'];
				}
				$result2 = $db->prepare("SELECT count(id) FROM sales_list where product_id='402'  ");
				$result2->bindParam(':userid', $id);
                $result2->execute();
                for($i=0; $row2 = $result2->fetch(); $i++){
					$full12=$row2['count(id)'];
				}
				$result2 = $db->prepare("SELECT count(id) FROM sales_list where product_id='407'  ");
				$result2->bindParam(':userid', $id);
                $result2->execute();
                for($i=0; $row2 = $result2->fetch(); $i++){
					$ned_free12=$row2['count(id)'];
				}
				$result2 = $db->prepare("SELECT count(id) FROM sales_list where product_id='431'  ");
				$result2->bindParam(':userid', $id);
                $result2->execute();
                for($i=0; $row2 = $result2->fetch(); $i++){
					$st2=$row2['count(id)'];
				}
				$result2 = $db->prepare("SELECT count(id) FROM sales_list where product_id='432'  ");
				$result2->bindParam(':userid', $id);
                $result2->execute();
                for($i=0; $row2 = $result2->fetch(); $i++){
					$nd2=$row2['count(id)'];
				}
					
					?>
					
					
					<tr style="background-color:cornsilk">
					<td>Total</td>
				<td>Rs.<?php echo $repair12; ?></td>
                  <td><?php echo $full12; ?></td>
				  <td><?php echo $ned_free12; ?></td>
   				  <td><?php echo $st2; ?></td>
				  <td><?php echo $nd2; ?></td>	
				</tr>
					
					
				<tr style="background-color:coral">
					<td>Deference</td>
				<td>Rs.<?php echo $repair12-$repair11; ?></td>
                  <td><?php echo $full12-$full11; ?></td>
				  <td><?php echo $ned_free12-$ned_free11; ?></td>
   				  <td><?php echo $st2-$free111; ?></td>
				  <td><?php echo $nd2-$free211; ?></td>
					
					
					
				</tr>
                </tfoot>

              </table>

 <table id="example1" class="table table-bordered table-striped">

			  

                <thead>

                <tr>
				<th>name</th>
					<th>Repair</th>
                 
                </tr>
                </thead>
				<tbody>
				   
					   
					<?php   $result = $db->prepare("SELECT * FROM mechanic ");

				$result->bindParam(':userid', $date);

                $result->execute();

                for($i=0; $row = $result->fetch(); $i++){	
					$id=$row['id'];
					$name=$row['name'];
					?>   
				<tr class="record" >	   
				<td><?php echo $name ?></td>
					   
	<td>
<?php $result2 = $db->prepare("SELECT count(id) FROM job where washer_id='$id' and type='Close' and date BETWEEN '$date1' and '$date2'  ");
				$result2->bindParam(':userid', $id);
                $result2->execute();
                for($i=0; $row2 = $result2->fetch(); $i++){
					$amila=$row2['count(id)'];
					
					echo $amila;
				}?>
			    </td>
			     
					   </tr>
					<?php } ?>
				</tbody>
				
				</table>
				
				

            </div>
  </section>
</div>
</body>
</html>