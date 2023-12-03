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

header("location:./../../../index.php");
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
       Reminder Report
        <small>Preview</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Forms</a></li>
        <li class="active">Advanced Elements</li>
      </ol>
    </section>
  
   <section class="content">
   
     <div class="box">
            <div class="box-header">
              <h3 class="box-title">Sales Report</h3>
            </div>
            <!-- /.box-header -->
			
            <div class="box-body">
               <table id="example1" class="table table-bordered table-striped">
			  
                <thead>
                <tr>
					<th>Customer ID</th>
                  <th>Vehicle No</th>
				  <th>Customer Name</th>
					<th>Type</th>
					<th>Phone no</th>
					<th>Bill Date</th>
					<th>Date</th>
                  <th>#</th>
                </tr>
				
                </thead>
				
                <tbody>
				<?php
   
			 $tot=0;


$date1 = date("Y-m-d");
        $result = $db->prepare("SELECT * FROM customer  ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
		$customer_id=$row['customer_id'];
		$vehicle_no=$row['vehicle_no'];
		$customer=$row['customer_name'];
		$phone=$row['contact'];

		$result1 = $db->prepare("SELECT * FROM sales WHERE vehicle_no='$vehicle_no' and action='active' ORDER by transaction_id DESC limit 0,1 ");
		$result1->bindParam(':userid', $res);
		$result1->execute();
		for($i=0; $row1 = $result1->fetch(); $i++){
		$date1=$row1['date'];
	    $call_id=$row1['call_id'];
			$type=$row1['type'];
			$sa_id=$row1['transaction_id'];
		}
 $date = date("Y-m-d");
				  $sday= strtotime( $date1);
                  $nday= strtotime($date);
                  $tdf= abs($nday-$sday);
                  $nbday1= $tdf/86400;
                  $rs= intval($nbday1);
			
			if($rs>60){
			
			if($rs<90){
			
				
			?>
                <tr>
				  <td><?php echo $customer_id;?></td>
				  <td><?php echo $vehicle_no;?></td>
				  <td><?php echo $customer;?></td>
					<td><?php echo $type;?></td>
                  <td><?php echo $phone;?></td>
				  <td><?php echo $date1;?></td>
				  <td><?php echo $rs;?>Day</td>
				<td><?php 
				if($call_id=="1"){}else{ ?>
<a href="save_call_id.php?id=<?php echo $sa_id;?>"><button class="btn btn-info" >
  Call
 </button></a><?php }	?>
					</td>
				  
				  
				   <?php 
			}
				}
		}
					
					
				?>
                </tr>           
                </tbody>
  
              </table>
		</div>
				
	<a href="re_rp_print.php"><button class="btn btn-info" style="width: 123px; height:35px; margin-top:-8px;margin-left:8px;" >
 <i class="icon icon-search icon-large"></i> print
 </button></a>
            <!-- /.box-body -->
          </div>
	    
          <!-- /.box -->
        </div>
        <!-- /.col -->

    <!-- Main content -->
    
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
<!-- DataTables -->
<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="../../plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../../plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<script src="../../plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
	
	
	$('#datepicker').datepicker({  autoclose: true, datepicker: true,  format: 'yyyy-mm-dd '});
    $('#datepicker').datepicker({ autoclose: true });
	
	
	
	$('#datepickerd').datepicker({  autoclose: true, datepicker: true,  format: 'yyyy-mm-dd '});
    $('#datepickerd').datepicker({ autoclose: true  });
	
</script>
</body>
</html>
