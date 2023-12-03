<script type="text/javascript">
$(function() {


$(".delbutton").click(function(){

//Save the link in a variable called element
var element = $(this);

//Find the id of the link that was clicked
var del_id = element.attr("id");

//Built a url to send
var info = 'id=' + del_id;
 

return false;

});

});
</script>
<style>
.table {
    border-radius: 1px;
    width: 70%;
    margin: 5px auto;
  
	
}

</style>

<?php
$tota=0;
$tota_qty=0;



include("connect.php");
$id=$_REQUEST['id'];
$qty =$_REQUEST['qty'];
$c = 1;
$date =date("Y-m-d");
$discount = 0;

$cod=-1;
$result = $db->prepare("SELECT * FROM sales_list WHERE invoice_no= :userid ORDER by id DESC LIMIT    0, 1");
$result->bindParam(':userid', $id);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$cod=$row['id'];
}

echo "
	<div class='col-md-5'><div class='alert alert-success alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                <h4><i class='icon fa fa-info'></i> Alert!</h4>
                QTY Update to ".$qty."
              </div>
		</div>	  ";	

if($cod>0){

$sql = "UPDATE sales_list 
        SET qty=?
		WHERE id=?";

$q = $db->prepare($sql);
$q->execute(array($qty,$cod));

$sql = "UPDATE sales_list 
        SET amount=price*?
		WHERE id=?";

$q = $db->prepare($sql);
$q->execute(array($qty,$cod));
}
?>

 <?php
  include("sales_tabel.php");
?>

