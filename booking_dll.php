
<table width='100%' class='table' >
<?php  include('connect.php');

$id=$_GET['id'];

$result = $db->prepare("SELECT * FROM booking_list WHERE  id='$id' ");
$result->bindParam(':userid', $res);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){ $booking_id=$row['booking_id']; }

$result = $db->prepare("DELETE FROM booking WHERE  id= '$booking_id' ");
	$result->bindParam(':memid', $id);
	$result->execute();

	$result = $db->prepare("DELETE FROM booking_list WHERE  booking_id= '$booking_id' ");
	$result->bindParam(':memid', $id);
	$result->execute();

    header("location: booking.php");
?>
