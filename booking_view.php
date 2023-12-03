<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Note</title>
</head>
<body>
    <br><br>
    <center>
    <a href="email_invoice/booking.php?id=<?php echo $_GET['id']; ?>">
        <button style="border-radius: 10px; background-color: darkolivegreen; color: antiquewhite; font-size: 20px;">Send Email</button>
    </a>
	<br><br>
	<a href="booking.php">
        <button style="border-radius: 10px; background-color:black; color: antiquewhite; font-size: 20px;">Back to Booking</button>
    </a>


</center>
<br><br>
    <?php 
include('connect.php');
$connect = $db;
$invoice_no=$_GET['id'];

$result1 = $connect->prepare("SELECT * FROM booking WHERE  id='$invoice_no'  ");
		$result1->bindParam(':userid', $res);
		$result1->execute();
		for($i=0; $row1 = $result1->fetch(); $i++){
		$date=date("Y-m-d");
		$time=date("H.i");
		$cus_id=$row1['cus_id'];
		

		
		$result = $connect->prepare("SELECT * FROM customer WHERE  customer_id='$cus_id'  ");
		$result->bindParam(":userid", $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){ 
			$send_mail=$row['email']; 
			$name=$row['customer_name']; 
			$phone=$row['contact']; 
		}
		
		


		$sales_list=""; $tot=0;
		$result = $connect->prepare("SELECT * FROM booking_list WHERE  booking_id='$invoice_no'  ");
		$result->bindParam(":userid", $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
		    
		    
			
			$sales_list.='
			         <tr>
						<td align="center" style="border-bottom: 1px solid #ccc;">'.$row["room_no"].'</td>
						<td align="center" style="border-bottom: 1px solid #ccc;">'.$row["qty"].'</td>
						<td align="center" style="border-bottom: 1px solid #ccc;">'.$row1["in_date"].' To '.$row1["out_date"].'</td>
						<td align="center" style="border-bottom: 1px solid #ccc;">'.$row["day"].'</td>
						<td align="center" style="border-bottom: 1px solid #ccc;">'.$row["price"].'</td>
						<td align="center" style="border-bottom: 1px solid #ccc;">'.$row["amount"].'</td>
					 </tr>
			';
		$tot+=$row["amount"];
		}
$message = '';

	
$output = '.
<html>
<head>
<link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
<style>
body {
  font-family: Poppins;
}
</style>
</head>
<body>
<table style="font-size: 12px;"  cellpadding="0" cellspacing="0" border="0" width="100%">
		<tr>
			<td>
				<table  cellpadding="0" cellspacing="0" border="0" width="100%">
					<tr>
						<td valign="top" width="50%">
						<img src="pic/logo_1.jpeg" alt="Logo" style="max-width:150px;">
						<br>
							 <b style="font-family: '."'Poppins'".'; font-size:17px">OASIS HILL RESORT.</b>
         <p>1E,<br>
		 Unique view rd,  <br>
		 Nuwara Eliya,  <br>
		 Sri Lanka <br><br>
         Call: 077 320 4000<br>
		 Oasishillresort4@gmail.com <br>
         
         
						</td>
						<td align="right" valign="top" width="50%">
							<b style="font-family: '."'Poppins'".'; font-size:30px">BOOKING</b><br>
							<b>#ORD_'.$invoice_no.'</b>
							<p>Date: '.date('Y-M-d').' Time:'.date('H:m').'</p> 
							<b>Bill To:</b> '.$name.'<br>
							Email: '.$send_mail.'<br>
							Phone no: '.$phone.'<br>
						</td>
					</tr>
					
				</table>
			</td>
		</tr>
		<tr>
			<td>
				
			</td>
		</tr>
		<tr>
			<td>
				
			</td>
		</tr>
	</table>
	</body>
	<table cellpadding="0" cellspacing="0" border="0" width="100%">
				<thead>
				<tr>
						<th align="center"  style="border-bottom: 1px solid #ccc;">Room No</th>
						<th align="center"  style="border-bottom: 1px solid #ccc;">Person</th>
						<th align="center"  style="border-bottom: 1px solid #ccc;">Date</th>
						<th align="center"  style="border-bottom: 1px solid #ccc;">Day</th>
						<th align="center"  style="border-bottom: 1px solid #ccc;">Price</th>
						<th align="center"  style="border-bottom: 1px solid #ccc;">Amount</th>
					</tr>
				</thead>
					
				<tbody>
				'.$sales_list.'
				</tbody>
				</table>

				<center>
				<h3>Total Rs.'.number_format($tot,2).'</h3>
				<h3>Pay Amount Rs.'.number_format($row1["pay_amount"],2).'</h3>
				<h3>Balance Rs.'.number_format($tot-$row1["pay_amount"],2).'</h3>
			</center>
</html>
	';
}


?>
<center>
<div style="width:1000px">
    <?php echo $output; ?>
</div>
</center>

</body>
</html>