<?php header("content-type: text/html; charset=UTF-8");  ?>

<!DOCTYPE html>

<html>

<head>

<?php require_once ('auth.php');?>

<title>

POS

</title><meta charset="UTF-8">

 <link href="css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/DT_bootstrap.css">
  <link rel="stylesheet" href="css/font-awesome.min.css">
    <style type="text/css">
      .sidebar-nav {
        padding: 9px 0;
      }

    </style>

    <link href="css/bootstrap-responsive.css" rel="stylesheet">

<link href="../style.css" media="screen" rel="stylesheet" type="text/css" />
<link href="src/facebox.css" media="screen" rel="stylesheet" type="text/css" />
<script src="lib/jquery.js" type="text/javascript"></script>
<script src="src/facebox.js" type="text/javascript"></script>
<script language="javascript">

function Clickheretoprint()

{ 

  var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,"; 

      disp_setting+="scrollbars=yes,width=800, height=400, left=100, top=25"; 

  var content_vlue = document.getElementById("content").innerHTML; 

  var docprint=window.open("","",disp_setting); 
   docprint.document.open(); 
   docprint.document.write('</head><body onLoad="self.print()" style="width: 800px; font-size: 13px; font-family: arial;">');          
   docprint.document.write(content_vlue); 
   docprint.document.close(); 
   docprint.focus(); 

}

</script>

<?php

$invoice=$_GET['id'];
include('connect.php');
$result = $db->prepare("SELECT * FROM sales WHERE invoice_number= :userid");
$result->bindParam(':userid', $invoice);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$trid=$row['transaction_id'];
$invoice=$row['invoice_number'];
$cash=$row['pay_amount'];
$date=$row['date'];
$customer_id=$row['customer_id'];
$sales_man=$row['sales_man'];
$vehicle=$row['vehicle_no'];
$cus=$row['customer_name'];
}

$result = $db->prepare("SELECT sum(balance) FROM sales WHERE customer_id='$customer_id' and balance < '0' and pay_type='credit'");
$result->bindParam(':userid', $invoice);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$credit=$row['sum(balance)'];
}
$result = $db->prepare("SELECT * FROM sales_man WHERE id='$sales_man' ");
$result->bindParam(':userid', $invoice);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$sales_man=$row['name'];
}
?>








 <script language="javascript" type="text/javascript">

/* Visit http://www.yaldex.com/ for full source code

and get more free JavaScript, CSS and DHTML scripts! */



</SCRIPT>

<body onLoad="self.print()" style="width: 800px; font-size: 15px; font-family: arial;" >





<?php



$sec = "1";

?><meta http-equiv="refresh" content="<?php echo $sec?>;URL='email_invoice/invoice.php?id=<?php echo $invoice; ?>'">	

	

  

		

	

	

<div class="content" id="content">



	

	

	

	

	<strong style="color: red; font-size: 30px">  ABC ENTERPRISES</strong>
	<H3>
	 NO.359/A,Main Street. 
		  <br>
	<b>Tel: 031-2233301,2222123 </b></b><BR><b>Email: ABC@gmail.com 	
		
    

    	

<table border="0">

  <tr>

    

    <td>Cashier-<?php echo $_SESSION['SESS_FIRST_NAME'];?></td>

	

    <td>Time-<?php date_default_timezone_set("Asia/Colombo"); 

	   echo date("h:i:sa")  ?></td>
</tr>
	<tr>

    

    <td><div style="font:bold;">Invoice no.<?php echo $trid; ?></td>
	<td>    Date-<?php echo $date ?></td>
	
</tr>
	<tr>
	<td>    Sales by -<?php echo $sales_man ?></td>
	<td>    Vehicle no -<?php echo $vehicle ?></td>
	</tr>
	<tr>
	<td>    Customer -<?php echo $cus ?></td>
	<td> </td>
	</tr>
	</table>
	</hr>

	<div>

	</div>



	
</H3>
	<div style="width: 100%; margin-top:-10px;">

	<table border="0" cellpadding="4" cellspacing="0" style="text-align:left;" width="40%">

		<thead>

			<tr>

				

				<th width="100" style="font-size: 20px;" ><hr>Decs & qty<hr>**************************</th>

				<th width="10" style="font-size: 20px;" ><hr>price<hr>*******</th>

				

				<th width="50" style="font-size: 20px;" ><hr>Total<hr>******</th/>

			</tr>

		<thead>

		<tbody>

				<?php
$qty=0;
					$id=$_GET['id'];

					$result = $db->prepare("SELECT * FROM sales_list WHERE invoice_no= :userid");

					$result->bindParam(':userid', $id);

				    $result->execute();

					for($i=0; $row = $result->fetch(); $i++){

				?>				

	

			    <tr class="record" >

				<td class="record" ><b><h4><?php echo $row['code']; ?>_<?php echo $row['name']; ?> x <?php echo $row['qty']; ?></h4></b></td>

				<td>

				<?php

				$bb=$row['code'];

				$cc=$row['qty'];
				$qty+=$row['qty'];

				$ppp=$row['price'];

				echo $ppp;

				?>

				</td>
				</td>
				<td>

				<?php

				$dfdf=$row['amount'];

				echo $dfdf;

				?>

				</td>

				</tr>

				<?php
					}
				?>

				<tr>

					<td colspan="2" style=" text-align:right;"><strong style="font-size: 20px;">Total</strong></td>

                    

					<td colspan="2"><strong style="font:bold 20px 'Aleo';">

					<?php

					$sdsd=$id;

					$resultas = $db->prepare("SELECT sum(amount) FROM sales_list WHERE invoice_no= :a");
					$resultas->bindParam(':a', $sdsd);
					$resultas->execute();
					for($i=0; $rowas = $resultas->fetch(); $i++){
					$fgfg=$rowas['sum(amount)'];
					
						echo  number_format($fgfg,2);
					}

					?>

					</strong></td>

				</tr>

				

				

				<tr>

					<td colspan="2"style=" text-align:right;"><strong style="font-size: 20px; color: #222222;">Pay amount</strong></td>

					<td colspan="2"><strong style="font:bold 18px 'Aleo';">

					<?php echo number_format($cash,2);	?>
					</strong></td>

				</tr>

				

				<tr>
	<td colspan="2" style=" text-align:right;"><strong style="font-size: 20px; color: #222222;">
					<?php
					echo 'Balance:';
					?>&nbsp;

					</strong></td>

					<td colspan="2"><strong style="font:bold 18px 'Aleo';">

					<?php
			
					$amount1=$cash-$fgfg;
					echo number_format($amount1,2);
					?>
					</strong></td>
				</tr>

				
		<tr>
	<td colspan="2" style=" text-align:right;"><strong style="font-size: 20px; color: #222222;">
					<?php
					echo 'Credit Balance:';
					?>&nbsp;

					</strong></td>

					<td colspan="2"><strong style="font:bold 18px 'Aleo';">

					<?php
			
					
					echo number_format($credit,2);
					?>
					</strong></td>
				</tr>
						

			<tr>

	<td colspan="2"style=" text-align:left;"><strong style="font-size: 20px; ">QTY Total

					

					<?php

					echo $qty;

					?>

					</strong></td>

				</tr>		

					

				

			</center>

		</tbody>

	</table>***************************************************************************

         <br>



	<strong style=" font-size: 30px;">...:ස්තූතියි නැවත ඵන්න:..</strong>
	  <br>
	<strong style=" font-size: bold 18px;">විකුනූ භාණ්ඩ සදහා දින5කින් පසු වගකියනු නොලැබෙ</strong>

	</div><strong style=" font-size: 16px;">#COLUD ARM software company(0779252594) </strong>

	<div style="width: 370px; float:10 ">

	<div class="content" id="content">

<div style="margin: 0 auto; padding: 20px; width: 900px; font-weight: normal;">

	<div style="width: 10%; height: 100px;" >  

	

	

	</div>

	</div>

	</div>



</div>

</div>




