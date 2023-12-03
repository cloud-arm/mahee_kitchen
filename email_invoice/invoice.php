
<!DOCTYPE html>
<html>
<head>
<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>

</head>
<body>	

<?php
include("../connect.php");
$connect = $db;
$invoice_no=$_GET['id'];
date_default_timezone_set("Asia/Colombo");

	$result1 = $connect->prepare("SELECT * FROM sales WHERE  invoice_number='$invoice_no'  ");
		$result1->bindParam(':userid', $res);
		$result1->execute();
		for($i=0; $row1 = $result1->fetch(); $i++){
		$date=date("Y-m-d");
		$time=date("H.i");
		$cus_id=$row1['customer_id'];
		

		
		$result = $connect->prepare("SELECT * FROM customer WHERE  customer_id='$cus_id'  ");
		$result->bindParam(":userid", $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){ 
			$send_mail=$row['email']; 
			$name=$row['customer_name']; 
			$phone=$row['contact']; 
		}
		
		


		$sales_list=""; $tot=0;
		$result = $connect->prepare("SELECT * FROM sales_list WHERE  invoice_no='$invoice_no'  ");
		$result->bindParam(":userid", $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
		    
		    
			
			$sales_list.='
			         <tr>
						<td align="center" style="border-bottom: 1px solid #ccc;">'.$row["code"].'</td>
						<td align="center" style="border-bottom: 1px solid #ccc;">'.$row["name"].'</td>
                        <td align="center" style="border-bottom: 1px solid #ccc;">'.$row["room_no"].'</td>
						<td align="center" style="border-bottom: 1px solid #ccc;">'.$row["qty"].'</td>
						<td align="right" style="border-bottom: 1px solid #ccc;">'.$row["price"].'</td>
						<td align="right" style="border-bottom: 1px solid #ccc;">'.$row["amount"].'</td>
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
						<img src="../pic/logo_1.jpeg" alt="Logo" style="max-width:150px;">
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
							<b style="font-family: '."'Poppins'".'; font-size:30px">INVOICE</b><br>
							<b>#INVOICE_NO: '.$invoice_no.'</b>
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
						<th align="center"  style="border-bottom: 1px solid #ccc;">Code</th>
						<th align="center"  style="border-bottom: 1px solid #ccc;">Name</th>
						<th align="center"  style="border-bottom: 1px solid #ccc;">Room</th>
						<th align="center"  style="border-bottom: 1px solid #ccc;">QTY</th>
						<th align="right"  style="border-bottom: 1px solid #ccc;">Price</th>
						<th align="right"  style="border-bottom: 1px solid #ccc;">Amount</th>
					</tr>
				</thead>
					
				<tbody>
				'.$sales_list.'
				</tbody>
				</table>

				

<table  align="right" cellpadding="0" cellspacing="0" border="0" width="40%">
    <tr>
        <td>Total</td>
        <td align="right">Rs. '.number_format($tot,2).'</td>
    </tr>
    <tr>
        <td>Discount</td>
        <td align="right">Rs. '.number_format($row1["discount"],2).'</td>
    </tr>

    <tr>
        <td>Pay Amount</td>
        <td align="right">Rs. '.number_format($row1["pay_amount"],2).'</td>
    </tr>

     <tr>
        <td>Balance</td>
        <td align="right">Rs. '.number_format($tot-$row1["pay_amount"],2).'</td>
    </tr>

</table>
<div style="left:-33px; bottom: 25px; position: fixed; " >
<img src="../pic/BILL.jpg" style="max-width:240px;"></div> 


<div style="bottom: 0; position: fixed; text-align:right" >

<img src="../pic/fb.jpg" style="max-width:60px; ">@oasishillresort</div>

 
</html>
	';

function fetch_customer_data($output)
{		
	return $output;
}

//$send_mail="erandasampath2000@gmail.com";
$cc="";
//$name="RHN TRADING";
				
	include('pdf.php');
	$file_name = 'pdf/booking'.date("Ymds"). '.pdf';
	$html_code = '<link rel="stylesheet" href="bootstrap.min.css">';
	$html_code = fetch_customer_data($output);
	$pdf = new Pdf();
	$pdf->load_html($html_code);
	$pdf->render();
	$file = $pdf->output();
	file_put_contents($file_name, $file);
	
	require 'class/class.phpmailer.php';
	$mail = new PHPMailer;
	$mail->IsSMTP();						//Sets Mailer to send message using SMTP
	$mail->Host = 'mail.colorbiz.org';		//Sets the SMTP hosts of your Email hosting, this for Godaddy
	$mail->Port = '25';						//Sets the default SMTP server port
	$mail->SMTPAuth = true;					//Sets SMTP authentication. Utilizes the Username and Password variables
	$mail->Username = 'oasis@colorbiz.org';	//Sets SMTP username
	$mail->Password = 'Rathunona1.';		//Sets SMTP password
	$mail->SMTPSecure = '';					//Sets connection prefix. Options are "", "ssl" or "tls"
	$mail->From = 'oasis@colorbiz.org';		//Sets the From email address for the message
	$mail->FromName = 'OASIS HILL RESORT';			//Sets the From name of the message
	$mail->AddAddress($send_mail, $name);		//Adds a "To" address
	$mail->AddCC('hiru077@gmail.com');
	$mail->AddCC('Oasishillresort4@gmail.com');
	$mail->AddCC('erandasampath2000@gmail.com');
	$mail->WordWrap = 50;							//Sets word wrapping on the body of the message to a given number of characters
	$mail->IsHTML(true);							//Sets message type to HTML				
	$mail->AddAttachment($file_name);     				//Adds an attachment from a path on the filesystem
	$mail->Subject = 'Oasis Booking ';			//Sets the Subject of the message
	$mail->Body = '
	Hi, Dear '.$name.'
 
	Thank you very much for choosing our hotel for your vacation.<br>
	We hope you were able to take your dream vacation.<br>
	Your bill is attached.<br>
	<br><br>
     We hope your comments will be added to our fb page and google my business page.
	 <br><br>
     https://www.facebook.com/oasishillresort?mibextid=ZbWKwL
	 <br><br>
     Oasis Hill Resort https://g.co/kgs/z9ohYe
      <br><br>
      
      Good day to you, <br>
      thank you, <br>
      manager,<br>
      Oasis Hill Resort.<br>
	  <br><br><br>


';				//An HTML or plain text message body
	if($mail->Send())								//Send an Email. Return true on success or false on error
	{
		$message = '<label class="text-success">Customer Details has been send successfully...</label>';
		
		
$sql = "INSERT INTO e_mail (customer_id,customer,email,cc,type,date,time,invoice_number) VALUES (?,?,?,?,?,?,?,?)";
$ql = $db->prepare($sql);
$ql->execute(array($cus_id,$name,$send_mail,$cc,'invoice',$date,$time,$invoice_no));
		

	}
	unlink($file_name);

	}	 

//if(!$customer_id){header("location: index.php");}
?>

		<br />
		<div class="container">
			<h3 align="center">Create Dynamic PDF Send As Attachment with Email in PHP</h3>
			<br />
			<form method="post">
				<input type="submit" name="action" class="btn btn-danger" value="PDF Send" /><?php echo $message; ?>
			</form>
			<br />
			<?php
			echo fetch_customer_data($output);
			?>			
		</div>
		<br />
		<br />
		  <?php
$sec = "1";
?><meta http-equiv="refresh" content="<?php echo $sec;?>;URL='../index.php'">
	</body>
</html>





