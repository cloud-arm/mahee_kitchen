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
        Payment
        <small>Preview</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Forms</a></li>
        <li class="active">Advanced Elements</li>
      </ol>
    </section>
   
   
   
    
     <form action="payment.php" method="get">   
	<center>
	
			  
			  
			<strong>

  <select class="form-control select3" name="id" style="width: 255px;" required >
			   <?php 		 $result = $db->prepare("SELECT * FROM customer");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
			
	?>
		<option value="<?php echo $row['customer_id'];?>"><?php echo $row['customer_name']; ?></option>
	<?php
				}
			?>
		</select><br>	
				<button class="btn btn-info" style="width: 123px; height:35px; margin-top:-8px;margin-left:8px;" type="submit">
 <i class="icon icon-search icon-large"></i> Search
 </button>
</strong>  
			  
		<br>	  
			  
         
			 
			 </center>
			 </form>
  
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
					<th>Date</th>
                  <th>Invoice no</th>
				   <th>Vehicle no</th>
				  <th>Pay Type</th>
                  
				  <th>Customer Name</th>
					
					
                  
					<th>Labor Cost</th>
                  <th>Part Price</th>
				  <th>Amount</th>
				  <th>Balance</th>
                  <th>View</th>
                </tr>
				
                </thead>
				
                <tbody>
				<?php
   $id=$_GET['id'];
			 $tot=0;$labor=0;$totb=0;
   $result = $db->prepare("SELECT * FROM sales WHERE  customer_id= '$id' and balance<'0' ");
				$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
				
				$type=$row['type'];
				$id=$row['invoice_number'];
				
			?>
                <tr>
				  <td><?php echo $row['date'];?></td>
				  <td><?php echo $row['transaction_id'];?></td>
				  <td><?php echo $row['vehicle_no'];?></td>
				  <td><?php echo $row['pay_type'];?></td>
                  <td><?php echo $row['customer_name'];?></td>
					
					
                  
				  <td><?php echo $row['labor_cost'];?></td>
                  <td><?php echo $row['amount']-$row['labor_cost'];?></td>
                  <td><?php echo $row['amount'];?></td>
				  <td><?php echo $row['balance'];?></td>
				  <td><a rel="facebox" href="payment_view_view.php?id=<?php echo $row['invoice_number'];?>"   title="Click to pay" >
				  <button class="btn btn-primary"><i style="color: black" class="fa fa-usd"> </i> Set Payment</button></a></td>
				  
				  
				   <?php 
					$totb+=$row['balance'];
					$tot+=$row['amount'];
					$labor+=$row['amount']-$row['labor_cost'];
				}
				
				?>
                </tr>
               
                
                </tbody>
                <tfoot>
                
				
				<tr>
					<th></th>
                  
					<th></th><th></th>
					<th>Total </th>
					
					<th>F/S</th>
                  
                  <th><?php echo $tot-$labor; ?>.00</th>
				  <th><?php echo $labor; ?>.00</th>
				  <th><?php echo $tot; ?>.00</th>
                  <th><?php echo $totb; ?></th>
					<th></th>
                </tr>
				
				
                </tfoot>
              </table>
			</div>
				
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
