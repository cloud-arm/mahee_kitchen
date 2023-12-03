<div class="table-responsive">
	<label >Accident</label>
                <table class="table no-margin">
                  <thead>
                  <tr>
                    <th >Vehicle No.</th>
                    
                    <th>Time</th>
					  <th>Type</th>
					 
                   <th>Profile</th>
					  
                  </tr>
                  </thead>
                  <tbody>
					  <?php 
				date_default_timezone_set("Asia/Colombo");
					  include("connect.php");
			$result = $db->prepare("SELECT * FROM job WHERE type='active' and category='Accident' ORDER by id ASC ");
				$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
					$date=$row['date'];
					$ramp=$row['ramp'];
					$phone="";
					
		$resultm = $db->prepare("SELECT * FROM mechanic WHERE ramp = '$ramp' ");
		$resultm->bindParam(':userid', $res);
		$resultm->execute();
		for($i=0; $rowm = $resultm->fetch(); $i++){
		$rname = $rowm['name'];	
		}
					
					if($ramp==""){ $color_ramp="yellow"; $info="Waiting"; }
					if($ramp>0){ $color_ramp="blue"; $info=$rname; }
					if($ramp=="out"){ $color_ramp="green"; $info="Washing"; }
					
					
					
					
					$date1=date("Y-m-d");
					if($date==$date1){
					$time=$row['time'];
					
						
$time_now=date("H.i");					
$date1 = new DateTime($time_now);
$date2 = $date1->diff(new DateTime($time));

$h=$date2->h;
$m=$date2->i;
					
			if($h==0){ 
				$time_on=$m;	
			$time_type="minute";
			}else{
			$time_on=$h;
			$time_type="hours";	
			}
						
						
						
					}else{
				  $sday= strtotime( $date);
                  $nday= strtotime($date1);
                  $tdf= abs($nday-$sday);
                  $nbday1= $tdf/86400;
                  $time_on= intval($nbday1);
						$time_type="Day";
					}
					
					
					if($time_type=="minute"){ $color="green"; }
					if($time_type=="Day"){ $color="green";
					
					if($time_on>3){ $color="yellow"; }
					if($time_on>5){ $color="red"; } }
					if($time_type=="hours"){ $color="green";}   
										   
					$vehicle=$row['vehicle_no'];
					$idi=0;
					$result1 = $db->prepare("SELECT * FROM customer WHERE vehicle_no='$vehicle'");
				$result1->bindParam(':userid', $date);
                $result1->execute();
                for($i=0; $row1 = $result1->fetch(); $i++){
				$idi=$row1['customer_id'];	
					$phone=$row1['contact'];
				}
					
					  ?>
                  <tr>
                    <td><?php echo $row['vehicle_no'];?></td>
                    
                    <td><span class="badge bg-<?php echo $color;?>"><i class="fa fa-clock-o"></i> <?php echo $time_on." ".$time_type;?></span></td>
					  
					  <td><span class="badge bg-<?php echo $color_ramp;?>"><?php echo $info;?></span></td>
					  
					  
					  
					  <td>
						  <a href="profile.php?id=<?php echo $idi; ?>" >
					  <button class="btn btn-success"><i class="glyphicon glyphicon-user"></i></button></a>
						  </td>

                  </tr>
                  <?php } ?>
                  </tbody>
					
                </table>
              </div>
			
<br> <label> JOB Orders </label>
              <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  <tr>
					  <th >No.</th>
                    <th >Vehicle No.</th>
                    <th>Time</th>
					  <th>Type</th> 
                  </tr>
                  </thead>
                  <tbody>
					  <?php 
				date_default_timezone_set("Asia/Colombo");
					  include("connect.php");
					  
			$result = $db->prepare("SELECT * FROM job WHERE type='active' and ramp='wash' ORDER by id ASC ");
				$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
				$id2=$row['id'];
				$wash_time1=$row['wash_time'];
				
$time_now=date("H.i");
$date1 = new DateTime($time_now);
$date2 = $date1->diff(new DateTime($wash_time1));

$h=$date2->h;
$m=$date2->i;

if($m>30){
$sql = "UPDATE job 
        SET wash_time=?
		WHERE id=?";
$q = $db->prepare($sql);
$q->execute(array($time_now,$id2));

$drying="Drying";	
$sql = "UPDATE job 
        SET ramp=?
		WHERE id=?";
$q = $db->prepare($sql);
$q->execute(array($drying,$id2));
					}
				}


			$result = $db->prepare("SELECT * FROM job WHERE type='active' and category='' ORDER by id ASC ");
				$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
					$wash_id=$row['washer_id'];
					$mechanic_id=$row['mechanic_id'];
					
					$date=$row['date'];
					$ramp=$row['ramp'];
					$phone="";
					
		$resultm = $db->prepare("SELECT * FROM mechanic WHERE ramp = '$ramp' ");
		$resultm->bindParam(':userid', $res);
		$resultm->execute();
		for($i=0; $rowm = $resultm->fetch(); $i++){
		$rname = $rowm['name'];	
		}
		$job_no+=1;			
					if($ramp==""){ $color_ramp="yellow"; $info="Waiting"; }
					if($ramp>0){ $color_ramp="blue"; $info=$rname; }
					if($ramp=="out"){ $color_ramp="green"; $info="Washing"; }
					
					
					$date1=date("Y-m-d");
					if($date==$date1){
					$time=$row['time'];
						
$date1 = new DateTime($time_now);
$date2 = $date1->diff(new DateTime($time));

$h=$date2->h;
$m=$date2->i;
					
			if($h==0){ 
				$time_on=$m;	
			$time_type="minute";
			}else{
			$time_on=$h;
			$time_type="hours";	
			}
						
						
						
					}else{
				  $sday= strtotime( $date);
                  $nday= strtotime($date1);
                  $tdf= abs($nday-$sday);
                  $nbday1= $tdf/86400;
                  $time_on= intval($nbday1);
						$time_type="Day";
					}
					
					
					if($time_type=="minute"){ $color="green"; }
					if($time_type=="Day"){ $color="red";  }
					if($time_type=="hours"){ $color="blue";								   
					     if($time_on>4){ $color="yellow"; }	 }  
										   
					$vehicle=$row['vehicle_no'];
					$idi=0;
					$result1 = $db->prepare("SELECT * FROM customer WHERE vehicle_no='$vehicle'");
				$result1->bindParam(':userid', $date);
                $result1->execute();
                for($i=0; $row1 = $result1->fetch(); $i++){
				$idi=$row1['customer_id'];	
					$phone=$row1['contact'];
				}
					
					  ?>
                  <tr>
					  <td><h3><?php echo $job_no;?>.</h3></td>
                    <td><h3><?php echo $row['vehicle_no']."  ";?>
						 <?php  if($mechanic_id>0){?>
						<i class="fa fa-wrench " style="color: #C10004" ></i>
						<?php  }if($wash_id>0){?>
						<i class="fa fa-tint" style="color: mediumblue"></i>
						 <?php } ?>
						</h3>
					  </td>
                    
                    <td><span class="badge bg-<?php echo $color;?>"><i class="fa fa-clock-o"></i> <?php echo $time_on." ".$time_type;?></span></td>
					  
					  <td><span class="badge bg-<?php echo $color_ramp;?>"><?php echo $info;?></span></td>
					  
					  
					  
					  
					  
                  </tr>
                  <?php } ?>
                  </tbody>
					
                </table>
              </div>
              <!-- /.table-responsive -->
