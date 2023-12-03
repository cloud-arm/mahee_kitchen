<script type="text/javascript">
$(function() {


$(".delbutton").click(function(){

//Save the link in a variable called element
var element = $(this);

//Find the id of the link that was clicked
var del_id = element.attr("id");
//Built a url to send
var info = 'id=' + del_id;
 if(confirm("Sure you want to delete this Product? There is NO undo!"))
		  {
 $.ajax({
   type: "GET",
   url: "purchase_dll.php?yard=<?php// echo $_GET['yard']; ?>",
   data: info,
   success: function(){
   }
 });
         $(this).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast")
		.animate({ opacity: "hide" }, "slow");
 }
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
include("connect.php");
$id=$_REQUEST['id'];
$dis=$_REQUEST['dis'];
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


if($cod<0){
echo "
	<div class='col-md-5'><div class='alert alert-info alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                <h4><i class='icon fa fa-info'></i> Alert!</h4>
                No records found
              </div>
		</div>	  ";	
}

if($cod<0){
echo "
	<div class='col-md-5'><div class='alert alert-info alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                <h4><i class='icon fa fa-info'></i> Alert!</h4>
                No records found
              </div>
		</div>	  ";	
}
if($cod>0){

$sql = "UPDATE sales_list 
        SET dic=?
		WHERE id=?";

$q = $db->prepare($sql);
$q->execute(array($dis,$cod));

$sql = "UPDATE sales_list 
        SET price=price-?
		WHERE id=?";
$q = $db->prepare($sql);
$q->execute(array($dis,$cod));
	
	
$sql = "UPDATE sales_list 
        SET amount=price*qty
		WHERE id=?";

$q = $db->prepare($sql);
$q->execute(array($cod));
	
}
?>
<?php
  include("sales_tabel.php");
?>