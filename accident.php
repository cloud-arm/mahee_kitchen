<!DOCTYPE html>
<html>
<?php 
include("head.php");
include("connect.php");
?>
<body class="hold-transition skin-blue sidebar-mini">
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

<link rel="stylesheet" href="datepicker.css"
        type="text/css" media="all" />
    <script src="datepicker.js" type="text/javascript"></script>
    <script src="datepicker.ui.min.js"
        type="text/javascript"></script>
 <script type="text/javascript">
	 $(function() {
$("#comment").click(function(){
//Save the link in a variable called element
//Find the id of the link that was clicked
	document.getElementById('comment_view').style.display='block';
	document.getElementById('approve_view').style.display='none';
	document.getElementById('dr_view').style.display='none';
	document.getElementById('suppliant_view').style.display='none';
});
		 
		 $("#approve").click(function(){
//Save the link in a variable called element
//Find the id of the link that was clicked
	document.getElementById('comment_view').style.display='none';
	document.getElementById('approve_view').style.display='block';
	document.getElementById('dr_view').style.display='none';
	document.getElementById('suppliant_view').style.display='none';
});
		 $("#dr").click(function(){
//Save the link in a variable called element
//Find the id of the link that was clicked
	document.getElementById('comment_view').style.display='none';
	document.getElementById('approve_view').style.display='none';
	document.getElementById('dr_view').style.display='block';
	document.getElementById('suppliant_view').style.display='none';
});
    	 $("#suppliant").click(function(){
//Save the link in a variable called element
//Find the id of the link that was clicked
	document.getElementById('comment_view').style.display='none';
	document.getElementById('approve_view').style.display='none';
	document.getElementById('dr_view').style.display='none';
	document.getElementById('suppliant_view').style.display='block';
});
		 

	 });
	 
	 
    </script>
	
	
    <!-- /.sidebar -->
  </aside>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    
    <section class="content">

		 <!-- Main content -->
    <section class="content">
		
		      <div class="row" style="margin-top: 10px;">
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title"><i class="fa fa-file-text-o"> </i>  Accident Assessment</h3>
            </div><a href="bill_acc.php?id=<?php echo $_GET['id']; ?>" >
					  <button class="btn btn-warning"><i class="glyphicon glyphicon-print"></i></button></a>
			  
			  <small class="pull-right">
				  <a href="job_accident.php?id=<?php echo $_GET['id']; ?>" >
					  <button class="btn btn-success"><i class="glyphicon glyphicon glyphicon-plus-sign"> </i> ADD Product</button> </a> </small> 
            <div id="ccr" class="box-body"  >
<div  class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
				
				<th>Product</th>
                  <th>Qty</th>
      
                  <th>Cost </th>
					<th>Approve Amount </th>
					<th>Difference </th>
					<th>Approve Type </th>
					<th>Action </th>
					
                </tr>
                </thead>
                <tbody>
				<?php
			date_default_timezone_set("Asia/Colombo");
		$hh=date("Y/m/d");
		$a1=$_GET['id'];
					$se=$_GET['se'];
					$tot_amount=0;
				$result = $db->prepare("SELECT * FROM sales_list WHERE   invoice_no='$a1'");
					$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
			?>
                <tr>
				
                  <td><?php echo $row['name'];?></td>
				  <td><?php echo $row['qty'];?></td>
                
                  <td>Rs.<?php echo $row['price'];?></td>
					<td><?php echo $row['app_amount'];?></td>
					<td><?php  echo $row['price'] - $row['app_amount'];?></td>
					<td><?php $app_type = $row['app_type'];
						if($app_type==1){
						?>
						<button type="button" class="btn btn-box-tool bg-green" > Replace </button>
					<?php }if($app_type==2){ ?>
					<button type="button" class="btn btn-box-tool bg-orange" > Repair </button>
						<?php }if($app_type==3){ ?>
						<button type="button" class="btn btn-box-tool bg-blue" > DR </button>
						 <?php } ?>
					</td>
					<td></td>
					<?php $tot_amount+= $row['price'];?>
                  <?php } ?>
                 </tr>
					<tr>
					<td></td><td>Total: </td>
						
						<td>Rs.<?php echo $tot_amount;?></td>
						<td></td> <td></td> <td></td> <td></td>
					</tr>
                </tbody>
                <tfoot>
                </tfoot>
              </table>

	<div class="col-xs-6">
       
       
        </div>
	
            </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
		
		<div class="row">
		<div class="col-md-2">
		<a class="btn btn-block btn-social btn-dropbox" id="comment">
                <i class="fa fa-comments"></i> Comment
              </a>
			</div><div class="col-md-4" id="approve">
			<a class="btn btn-block btn-social btn-success">
                <i class="fa fa-black-tie"></i> Insurance Agent Decision (Approve/DR)
              </a>
</div>
			<div class="col-md-3" id="dr">
		<a class="btn btn-block btn-social btn-warning">
                <i class="fa fa-gears"></i> ADD Damage Report (DR)
              </a>
			</div>
			<div class="col-md-2" id="suppliant">
		<a class="btn btn-block btn-social btn-bitbucket">
                <i class="fa fa-plus-square"></i>  SUPPLIANT
              </a>
			</div>
			
		</div> <br>
	<div class="box box-primary" id="comment_view" style="display:none;">
            <div class="box-header with-border">
              <h3 class="box-title">Comment Section</h3>
        <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>    
		</div>		
            <!-- /.box-header -->
            <div class="box-body">
              <form action="update_acc_note.php" method="post"  > 
				  <input type="hidden" name="invo" value="<?php echo $a1; ?>">
                <!-- textarea -->
                <div class="form-group">
                  <label>note</label>
                  <textarea class="form-control" name="note" rows="4" placeholder="Enter ..."></textarea>
                </div>
				  <input class="btn btn-info " type="submit" value="Save" >
              </form>
            </div>
            <!-- /.box-body -->
          </div>
		
			<div class="box box-success" id="approve_view" <?php if($se==1){ ?> style="display:block;"
				 <?php }if($se==0){ ?> style="display:none;" <?php } ?> >
            <div class="box-header with-border">
              <h3 class="box-title">Insurance Agent Decision (Approve/DR)</h3>
        <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>    
		</div>		
            <!-- /.box-header -->
            <div class="box-body">
              <form action="update_acc.php" method="post"  > 
				  <input type="hidden" name="invo" value="<?php echo $a1; ?>">
                <!-- textarea --><div class="row">
				  <div class="form-group">
					  <div class="col-md-5">
                  <label>Product</label>
                  <select class="form-control" name="product">
					  	<?php
			date_default_timezone_set("Asia/Colombo");
		$hh=date("Y/m/d");
		$a1=$_GET['id'];
					$tot_amount=0;
				$result = $db->prepare("SELECT * FROM sales_list WHERE   invoice_no='$a1' and app_type=''");
					$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
			?>
                    <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?> - Rs.<?php echo $row['price']; ?></option>
                <?php } 
		$result = $db->prepare("SELECT * FROM sales_list WHERE   invoice_no='$a1' and app_type='3'");
					$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
					  ?>
	<option style="background-color: darkgrey" value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?> - Rs.<?php echo $row['price']; ?></option>				  
					  <?php } ?>
                  </select>
                </div>
				  <div class="col-md-3">
                  <label>Type</label>
                  <select class="form-control" name="type">
                    <option></option>
					  <option value="1">Replase</option>
					  <option value="2">Repair</option>
                    <option value="3"> Damage Report (DR) </option>
                    
                    
                  </select>
                </div>
					  <div class="col-md-2">
                  <label>Approve Amount</label>
                 <input class="form-control" type="text" name="amount">
                </div>
					  <div class="col-md-2">
						  <label>.</label>
					  <input class="btn btn-info form-control" type="submit" value="Save" >
				  </div>
				  </div></div> 
				  </form>
               
				  
				  
              
            </div>
            <!-- /.box-body -->
          </div>
		
		
      <!-- row <--> <br>
      <div class="row">
        <div class="col-md-12">
          <!-- The time line -->
			<ul class="timeline">
			<?php 
			$a1 = $_GET['id'];
			$result = $db->prepare("SELECT * FROM job_record WHERE job_no = '$a1'  ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
			$job_id=$row['id'];
			$type=$row['type'];
			if($type=="comments"){ $icon="comments"; $color="blue"; }
			if($type=="approve"){ $icon="black-tie"; $color="green"; }
		
			?>
			
          
            <!-- timeline time label -->
            <li class="time-label">
                  <span class="bg-red">
                    <?php echo $row['date']; ?>
                  </span>
            </li>
            <li>
              <i class="fa fa-<?php echo $icon ?> bg-<?php echo $color ?>"></i>
              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> <?php echo $row['time']; ?></span>

                <h3 class="timeline-header"><a href="#"><?php echo $row['user']; ?></a> <?php echo $row['type']; ?></h3>

                <div class="timeline-body">
                  <?php echo $row['note']; ?>
                </div>
                <div class="timeline-footer">
					<?php 
					$an = $row['note'];
			if (strpos($an, 'Customer') !== false) { ?>
<button class="btn btn-info btn-xs"><i   class="glyphicon glyphicon-user"></i></button>
<?php }if (strpos($an, 'customer') !== false) {?>
<button class="btn btn-info btn-xs"><i   class="glyphicon glyphicon-user"></i></button>
<?php } if (strpos($an, 'call') !== false) { ?>
<button class="btn btn-success btn-xs"><i   class="glyphicon glyphicon-earphone"></i></button>
<?php }	if (strpos($an, 'insurance') !== false) {	?>
<button class="btn btn-success btn-xs"><i   class="fa fa-black-tie"></i></button>

					<?php }if ($type=="approve") {	?>
   <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
				
				<th>Product</th>
                  <th>Qty</th>
                  <th>Cost </th>
					<th>Approve Amount </th>
					<th>Approve Type </th>
                </tr>
                </thead>
                <tbody>
				<?php
	date_default_timezone_set("Asia/Colombo");
		$hh=date("Y/m/d");
		$a1=$_GET['id'];
					$se=$_GET['se'];
					$tot_amount=0;
				$result1 = $db->prepare("SELECT * FROM sales_list WHERE   invoice_no='$a1' and note_no='$job_id'");
					$result1->bindParam(':userid', $date);
                $result1->execute();
                for($i=0; $row1 = $result1->fetch(); $i++){
			?>
                <tr>
				
                  <td><?php echo $row1['name'];?></td>
				  <td><?php echo $row1['qty'];?></td>
                  <td>Rs.<?php echo $row1['price'];?></td>
					<td><?php echo $row1['app_amount'];?></td>
					<td><?php $app_type = $row1['app_type'];
						if($app_type==1){
						?>
						<button type="button" class="btn btn-box-tool bg-green" > Replace </button>
					<?php }if($app_type==2){ ?>
					<button type="button" class="btn btn-box-tool bg-orange" > Repair </button>
						<?php }if($app_type==3){ ?>
						<button type="button" class="btn btn-box-tool bg-blue" > DR </button>
						 <?php } ?>
					</td>
                  <?php } ?>
                 </tr>
					
                </tbody>
                <tfoot>
                </tfoot>
              </table> 
					
					<?php }	?>
                 
                </div>
              </div>
            </li>           
          
			<?php } ?>
			</ul>
			
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->


      <!-- /.row -->

    </section>
    <!-- /.content -->
		
          
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

</body>

</html>

