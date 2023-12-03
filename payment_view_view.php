<h3>
<?php
include("connect.php");
 $invo=$_REQUEST['id'];
   $result = $db->prepare("SELECT * FROM sales WHERE invoice_number='$invo'   ");
				$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
 echo $row['customer_name'];
					$order=$row['transaction_id'];
					$balance= $row['balance'];
					$cus_id= $row['customer_id'];
				}

?></h3>
        <!-- /.box-header -->


<a class="label pull-right bg-navy" style="font-size: 100%" >Invoice-<?php echo $order ?></a>
              <table id="example1" class="table table-bordered table-striped">
			  
                <thead>
                <tr>
                  <th>Product_code</th>
                  <th>Product_name</th>
                  <th>Price</th>
                  <th>QTY</th> 
                </tr>
                </thead>
                <tbody>
				<?php
					
   $result = $db->prepare("SELECT sum(price) FROM sales_list WHERE invoice_no='$invo'   ");
				$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
				$total= $row['sum(price)'];
				}
			
					
			
   
   $result = $db->prepare("SELECT * FROM sales_list WHERE invoice_no='$invo'   ");
				$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
			?>
                <tr  >
                  <td><?php echo $row['code'];?></td>
                  <td><?php echo $row['name'];?></td>
                  <td><?php echo $row['price'];?></td>
                  <td><?php echo $row['qty'];?></td>
					</tr  > 
					
				<?php }?>
				  
				  </tbody>
                <tfoot>
 
                </tfoot>
              </table>
<small class="label pull-right bg-green"><h5>Total Rs.<?php echo $total;?></h5></small>
		 
     <small class="label pull-left bg-red"><h5>Balance Rs.<?php echo $balance;?></h5></small>
		<br><br><br>
<form method="post" action="save_payment.php">
	<input type="hidden" name="invoice" value="<?php echo $invo; ?>"  >
			 <input type="hidden" name="order_id" value="<?php echo $order; ?>"  >
			 <input type="hidden" name="from" value="payment"  >
			 <input type="hidden" name="bill_total" value="<?php echo $total;?>"  >
			 <input type="hidden" name="balance" value="<?php echo $balance;?>"  >
             <input type="hidden" name="cus_id" value="<?php echo $cus_id;?>"  >
	<div class="col-md-10">
		<select name="p_type" class="form-control" id="p_type" onchange="view_payment_date(this.value);">
            <option value="0" style="color: red" >Payment Method</option> 
			<option value="cash">Cash</option>
            <option value="credit">Card</option>
            <option value="chq">Cheque</option>
                      </select>
		
   <div class="form-group" id='credit_pay' style="display:none;">
        <label for="exampleInputPassword1">Card Amount</label>
         <div class="input-group"> 
           <input type="text" name="card_amount" class="form-control pull-right" autocomplete="off" >
       </div>
     <br>
	<input class="btn btn-info" type="submit" value="Pay" >
		</div>
		
		
		 <div class="form-group" id='cash_pay' style="display:none;">
         <label for="exampleInputPassword1">Cash Amount</label>
         <div class="input-group"> 
           <input type="text" name="cash_amount" class="form-control pull-right" autocomplete="off" >
       </div>
     <br>
	<input class="btn btn-info" type="submit" value="Pay" >
		
		</div>
		
		
		 <div class="form-group" id='chq_pay' style="display:none;"> 
         <label for="exampleInputPassword1">Cheque No</label>
         <div class="input-group"> 
           <input type="text" name="chq_no" class="form-control pull-right" autocomplete="off" >
       </div>
		<label for="exampleInputPassword1">Bank</label>
         <div class="input-group"> 
           <input type="text" name="bank" class="form-control pull-right">
       </div>
			 <label for="exampleInputPassword1">Amount</label>
         <div class="input-group"> 
           <input type="text" name="chq_amount" class="form-control pull-right" autocomplete="off" >
       </div>
			  <label for="exampleInputPassword1">Date</label>
         <div class="input-group"> 
           <input type="text" name="chq_date" class="form-control pull-right" id="chq"autocomplete="off">
       </div>
      <br>
	<input class="btn btn-info" type="submit" value="Pay" >
		
		</div>
		
		<div id="form_continue"></div>
	            <!-- /btn-group -->
                
		 
              	
		</div>
	
			</form>

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
   $('#chq').datepicker({
      autoclose: true, format: 'yyyy/mm/dd'
    });
	   $('#datepicker').datepicker({
      autoclose: true, format: 'yyyy/mm/dd'
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

<script> 
 function view_payment_date(type){
	if(type=='credit'){
	document.getElementById('credit_pay').style.display='block';	
	document.getElementById('cash_pay').style.display='none';
	document.getElementById('chq_pay').style.display='none';
		} else if(type=='chq'){
		document.getElementById('chq_pay').style.display='block';	
		document.getElementById('credit_pay').style.display='none';	
		document.getElementById('cash_pay').style.display='none';
			}else if(type=='cash'){
		document.getElementById('chq_pay').style.display='none';	
		document.getElementById('credit_pay').style.display='none';	
		document.getElementById('cash_pay').style.display='block';
			}else {
		document.getElementById('chq_pay').style.display='none';	
		document.getElementById('credit_pay').style.display='none';	
		document.getElementById('cash_pay').style.display='none';
			} 
	 } 
  </script>

       
   

