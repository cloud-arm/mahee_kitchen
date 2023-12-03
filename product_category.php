<!DOCTYPE html>
<html>
<?php 
include("head.php");
include("connect.php");
?>
<meta name="viewport" content="width=device-width, initial-scale=1">
<body class="hold-transition skin-blue sidebar-mini sidebar-collapse">
<?php 
include_once("auth.php");
$r=$_SESSION['SESS_LAST_NAME'];

if($r =='Cashier'){
include_once("sidebar2.php");
}
if($r =='admin'){
include_once("sidebar.php");
}
?>



<link rel="stylesheet" href="src/popup.css"
        type="text/css" media="all" />
<link rel="stylesheet" href="datepicker.css"
        type="text/css" media="all" />
    <script src="datepicker.js" type="text/javascript"></script>
    <script src="datepicker.ui.min.js"
        type="text/javascript"></script>
 <script type="text/javascript">
     
		 $(function(){
        $("#datepicker1").datepicker({ dateFormat: 'yy/mm/dd' });
        $("#datepicker2").datepicker({ dateFormat: 'yy/mm/dd' });
       
    });

    </script>




    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Product Form
        <small>Preview</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Forms</a></li>
        <li class="active">Product Form</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Product Edit</h3>

          
        <!-- /.box-header -->
		<div class="form-group">
              
		<form method="post" action="save_product_category.php">		
        <div class="box-body">
    <!-- /.box -->
<div class="form-group">		
	<div class="box-body">
          <div class="row">
            <div class="col-md-8">
              <div class="form-group">
                
				  <div class="input-group">
				   <div class="input-group-addon">
                    <label>Product	Name</label>
					   
                  </div>
                <select class="form-control select2" name="id" style="width: 100%;" autofocus required>
				  <?php 
                $result1 = $db->prepare("SELECT * FROM product WHERE gen_name=''  ");
		$result1->bindParam(':userid', $res);
		$result1->execute();
		for($i=0; $row = $result1->fetch(); $i++){
			
	?>
		<option value="<?php echo $row['product_id'];?>"><?php echo $row['name']; ?> _ <?php echo $row['code']; ?> _ <?php echo $row['qty']; ?> </option>
	<?php
				}
			?>
                </select>
                  </div>
                  </div>
				</div>
			  
			  <div class="col-md-6">
			  <div class="form-group">
                <div class="input-group date"> 
					<div class="input-group-addon">
                    <label>Category</label>
                  </div>
                      <select class="form-control select2" name="cat" style="width: 100%;" autofocus required>
				  <?php 
                $result1 = $db->prepare("SELECT * FROM category  ");
		$result1->bindParam(':userid', $res);
		$result1->execute();
		for($i=0; $row = $result1->fetch(); $i++){
			
	?>
		<option value="<?php echo $row['id'];?>"><?php echo $row['name']; ?> </option>
	<?php
				}
			?>
                </select>				   
                </div>				
        </div>		
        </div>
		  
			  
			  
			  
			  
			  
              </div>        
              </div>
			  <input class="btn btn-info" type="submit" value="Next" >
			  
			  </form>
			
			
			
		
          <!-- /.box -->

        </div>
        <!-- /.col (left) -->
       
     
            <!-- /.box-body -->
            
            </div>
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col (right) -->
      </div>
		
		
			  <?php 
	     $result1 = $db->prepare("SELECT * FROM category  ORDER by id DESC ");
		$result1->bindParam(':userid', $res);
		$result1->execute();
		for($i=0; $row = $result1->fetch(); $i++){
			$c_id=$row['id'];
	  ?>
	  
	  <a class="n" id="<?php echo $row['id']; ?>" href="#">
	  <button style="background-color: white; color: black" ><?php echo $row['name']; ?> <br> <img src="<?php echo $row['img']; ?>" alt="" style="width: 100px"></button></a>

<!-- The Modal -->

<div id="n<?php echo $row['id']; ?>" class="modal">
	
  <!-- Modal content -->
  <div id="tag" class="modal-content">
    <div class="modal-header">
      <span class="close"> &times;</span>
      <h2>Product</h2>
    </div>
    <div class="modal-body">
         <div class="form-group">
				
				
			 <?php 
	     $result = $db->prepare("SELECT * FROM product WHERE category = '$c_id' ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row1 = $result->fetch(); $i++){
	  ?>
                  <div class="radio">
                    <label>
                      <input type="radio" name="name" value="<?php echo $row1['product_id']; ?>" >
                      <?php echo $row1['code']; ?> <p style="color: red" ><?php echo $row1['name']; ?></p>
                    </label>
                  </div>
                <?php } ?>  
          </div>
			 
                    <label>Qty</label>
                  
                   <input type="number" value="1" name="qty" >				   
               
    </div>
		 <div class="modal-footer">
     
    
			   
                  
			 
			 </div>
  </div>
	</div>
   <?php } ?>
		
		
		
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  
  <!-- /.content-wrapper -->
    <?php
  include("dounbr.php");
?>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="../../plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../../bootstrap/js/bootstrap.min.js"></script>
<!-- Select2 -->
<script src="../../plugins/select2/select2.full.min.js"></script>
<!-- InputMask -->
<script src="../../plugins/input-mask/jquery.inputmask.js"></script>
<script src="../../plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="../../plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- date-range-picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="../../plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="../../plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- bootstrap color picker -->
<script src="../../plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="../../plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- SlimScroll 1.3.0 -->
<script src="../../plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="../../plugins/iCheck/icheck.min.js"></script>
<!-- FastClick -->
<script src="../../plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<!-- Page script -->
<script>
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();

    //Datemask dd/mm/yyyy
    $("#datemask").inputmask("YYYY/MM/DD", {"placeholder": "YYYY/MM/DD"});
    //Datemask2 mm/dd/yyyy
    $("#datemask2").inputmask("YYYY/MM/DD", {"placeholder": "YYYY/MM/DD"});
    //Money Euro
    $("[data-mask]").inputmask();

    //Date range picker
    $('#reservation').daterangepicker();
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'YYYY/MM/DD h:mm A'});
    //Date range as a button
    $('#daterange-btn').daterangepicker(
        {
          ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          },
          startDate: moment().subtract(29, 'days'),
          endDate: moment()
        },
        function (start, end) {
          $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }
    );

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    });

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue'
    });
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass: 'iradio_minimal-red'
    });
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_flat-green'
    });

    //Colorpicker
    $(".my-colorpicker1").colorpicker();
    //color picker with addon
    $(".my-colorpicker2").colorpicker();

    //Timepicker
    $(".timepicker").timepicker({
      showInputs: false
    });
  });
</script>
	
<script type="text/javascript">
$(function() {
		$(".n").click(function(){
var element = $(this);
var idt = element.attr("id");
var inf = 'n' + idt;
});
	
	
	var modal1 = document.getElementsByClassName("modal");
	
	

	$(".n").click(function(){
		
var element = $(this);
var idt = element.attr("id");
var inf = 'n' + idt;	
var modal = document.getElementById(inf);		
modal.style.display = "block";	

	window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
	
var span = document.getElementsByClassName("close")[0];
span.onclick = function() {
  modal.style.display = "none";
}
	
	
	});





});
</script>
	
</body>
</html>
