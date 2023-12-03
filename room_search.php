<?php include("connect.php");
$from=$_GET['from'];
$to=$_GET['to'];

?>
<select class="form-control select3" name="room" id="room" required>
    <?php 	$result2 = $db->prepare("SELECT * FROM room ");
	$result2->bindParam(':userid', $date);
    $result2->execute();
    for($i=0; $row = $result2->fetch(); $i++){
        $room_no=$row['room_no'];
        $bid=0; $good=0; $count=0;
        $result = $db->prepare("SELECT * FROM booking JOIN booking_list ON booking_list.booking_id = booking.id WHERE booking_list.room_no='$room_no' AND booking.action='0' ");
        $result->bindParam(':userid', $date);
        $result->execute();
        for($i=0; $row1 = $result->fetch(); $i++){
            $in_date=$row1['in_date'];
            $out_date=$row1['out_date'];
            $count+=1;
            $bid1=0;
            $bid2=0;
        
        $date1=date_create($from);
        $date2=date_create($out_date);
        $f_out=date_diff($date1,$date2);
        $ff=$f_out->format("%R%a");

        $date1=date_create($in_date);
        $date2=date_create($to);
        $to_in=date_diff($date1,$date2);
        $toto=$to_in->format("%R%a");
        
        if($toto > 0){$bid1=1;}
        if($ff > 0 ){ $bid2=1; }

        $bb=$bid1+$bid2;
        if($bb==2){$bid=1;}
        }


        if($bid==0){
	?>
    <option value="<?php echo $row['id']; ?>">
    <?php echo $row['room_no'].' (Bed- '.$row['bed'].')'; ?>
    </option>


    <?php } } ?>
    
</select>
