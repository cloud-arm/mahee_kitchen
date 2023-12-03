
<table width='100%' class='table' >
<?php  include('connect.php');

if (isset($_GET['id'])) {

$id=$_GET['id'];

$sql = 'DELETE FROM booking_list WHERE  id=? ';
$ql = $db->prepare($sql);
$ql->execute(array($id));

}else{

$room_id=$_GET['room'];
$qty=$_GET['qty'];

$result = $db->prepare("SELECT * FROM room WHERE id='$room_id'");
$result->bindParam(':userid', $res);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){ $room_no=$row['room_no']; $room_qty=$row['bed']; }

$sql = "INSERT INTO booking_list (room_id,room_no,qty,room_qty) VALUES (?,?,?,?)";
$ql = $db->prepare($sql);
$ql->execute(array($room_id,$room_no,$qty,$room_qty));
}

$result = $db->prepare("SELECT * FROM booking_list WHERE booking_id ='0' ");
$result->bindParam(':userid', $res);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
?>


    <tr >
        <td>Room NO: <?php echo $row['room_no']; ?></td>
        <td><?php echo $row['qty']; ?></td>
        <td><b class="btn btn-danger dllpack" id="<?php echo $row['id']; ?>"
                                                            onclick="dll(<?php echo $row['id']; ?>)"><i
                                                                class="icon-trash">x</i></b></td>
    </tr>

<?php } ?>
</table>

