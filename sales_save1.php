<?php
session_start();
include('connect.php');
date_default_timezone_set("Asia/Colombo"); 
$a1 = $_POST['name'];
$comment = $_POST['comment'];
$today=date("Y-m-d");


$result = $db->prepare("SELECT * FROM customer WHERE customer_id = '$a1' ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
            $c = $row['customer_name'];
			 $model = $row['model'];
			$a = $row['vehicle_no'];
			$iina = "-22".$row['vehicle_no'];
		}

$result = $db->prepare("SELECT * FROM job WHERE vehicle_no = '$a' and type='active' ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
			$job_no=$row['id'];
		}


$result = $db->prepare("SELECT * FROM sales WHERE vehicle_no = '$a' and job_no='$job_no' and action='' ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
            $old_invo = $row['invoice_number'];
			
		}


if($old_invo>0){
	$sql = "UPDATE  sales_list
        SET invoice_no=?
		WHERE invoice_no=?";
$q = $db->prepare($sql);
$q->execute(array($old_invo,$iina));
	
	
	header("location: sales.php?id=$old_invo"); 
			   }else{



$result = $db->prepare("SELECT * FROM job WHERE vehicle_no = '$a' and type='active' ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
			$job_no=$row['id'];
			$d = $row['km'];
			$mechanic = $row['mechanic_id'];
			$job_type_id = $row['job_type'];
			$washer_id = $row['washer_id'];
		}

$result = $db->prepare("SELECT * FROM job_type WHERE id = '$job_type_id' ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
			$type=$row['name'];			
		}

if($washer_id==0){$washer="Non";
				 }else{
$result = $db->prepare("SELECT * FROM washer WHERE id = '$washer_id' ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
			$washer=$row['name'];			
		}
}


$b = date("ymdhis");
$sql = "UPDATE  sales_list
        SET invoice_no=?
		WHERE invoice_no=?";
$q = $db->prepare($sql);
$q->execute(array($b,$iina));

$e = date("Y-m-d");
$f = $_SESSION['SESS_FIRST_NAME'];



// query
$sql = "INSERT INTO sales (vehicle_no,invoice_number,customer_name,km,date,cashier,comment,type,customer_id,model,mechanic,washer,job_no,type_id) VALUES (:a,:b,:c,:d,:e,:f,:j,:type,:cus_id,:model,:mech,:washer,:job_no,:type_id)";

$ql = $db->prepare($sql);
$ql->execute(array(':a'=>$a,':b'=>$b,':c'=>$c,':d'=>$d,':e'=>$e,':f'=>$f,':j'=>$comment,':type'=>$type,':cus_id'=>$a1,':model'=>$model,':mech'=>$mechanic,':washer'=>$washer,':job_no'=>$job_no,':type_id'=>$job_type_id));

	
	if(!$mechanic){
	?>	
<html>
<head>
	
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>COLOR BIZNAZ | SMS</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>

<body class="hold-transition login-page">

   <center> 
	   
	   <img src="wrench.gif" alt="" style="width: auto">
  
	   
	   <form action="bill_tech_save.php">
		   <h2>  <div class="col-md-6">
              <div class="form-group">
                
				  <div class="input-group">
				   <div class="input-group-addon">
                    <label>Mechanic	Name</label>
					   
                  </div>
					  <input type="hidden" name="job_no" value="<?php echo $job_no; ?>">
					  <input type="hidden" name="vehi" value="<?php echo $a; ?>">
                <select class="form-control select2" name="mechanic" style="width: 100%;"  required>
					<option></option>
				  <?php 
                $result = $db->prepare("SELECT * FROM mechanic ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
	?>
					
		<option value="<?php echo $row['id'];?>"><?php echo $row['name']; ?>  </option>
	<?php
				}
			?>
                </select>
                  </div>
                  </div>
			   <input class="btn btn-info" type="submit" value="NEXT >" >
				</div></h2></form>
  </center>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>
</body>
</html>

	<?php	
	}else{
	header("location: sales.php?id=$b");
	}
	
	

}

?>