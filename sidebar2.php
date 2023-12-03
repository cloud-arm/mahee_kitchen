<div class="wrapper">
 
		  
		  
  <header class="main-header">
    <!-- Logo -->
    <a href="tech.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><i class="fa fa-cloud"></i>arm</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><i class="fa fa-cloud"></i><b> arm</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

	  
	  
	   <?php
		include('connect.php');
 date_default_timezone_set("Asia/Colombo");

                  $date =  date("Y/m/d");					
			
				
				
				
				
				
				
				
				$count=0;
				
				
			?>
	  
	  
	  
	  
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
         
          <!-- Notifications: style can be found in dropdown.less -->
		  
		  
		  <?php
		  
		include('connect.php');
 date_default_timezone_set("Asia/Colombo");
			 $m_id=$_SESSION['mac_id'];
                  $date =  date("Y-m-d");
			 $result = $db->prepare("SELECT count(amount) FROM sales WHERE mechanic = '$m_id' and date='$date' ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
		$rv=$row['count(amount)'];	
			
		}
			
				$rowcount123 = 0;			
				//$ttre = 0;
                //$tre=$ttre-$rowcount123;
				//$rv=0;
				$rate=0;				
			?>
  
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-wrench"></i>
              <span class="label label-warning"><?php echo $rv; ?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have <?php echo $rv; ?> notifications</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">           
  <?php
		include('connect.php');
 date_default_timezone_set("Asia/Colombo");
                 //$date =  date("Y/m/d");					
				$rate=0;	
		$result = $db->prepare("SELECT * FROM sales WHERE mechanic = '$m_id' and date='$date' ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
		$job=$row['job_no'];
			?>
                  <li>
                    <a href="#">
                      <i class="fa fa-motorcycle text-black"></i> <?php echo $row['vehicle_no']; ?>
						<span class="badge bg-yellow">
						<?php 
		$result1 = $db->prepare("SELECT * FROM job WHERE id = '$job'  ");
		$result1->bindParam(':userid', $res);
		$result1->execute();
		for($i=0; $row1 = $result1->fetch(); $i++){
			echo $row1['tech_time_end'];
		}
							
							?>
						<i class="fa fa-clock-o"></i></span>
                    </a>
                  </li> 
					
					<?php } ?>
                </ul>
              </li>
              <li class="footer"><a href="tech.php">View all</a></li>
            </ul>
          </li>
          <!--  style can be found in dropdown.less -->   
			<?php
		$uname=$_SESSION['SESS_FIRST_NAME'];
		$result1 = $db->prepare("SELECT * FROM user WHERE username='$uname' ");
		$result1->bindParam(':userid', $res);
		$result1->execute();
		for($i=0; $row1 = $result1->fetch(); $i++){
		$upic1=$row1['upic'];
		}
			
			?>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo $upic1;?>" class="user-image" alt="User Image">
              <span ><?php echo $_SESSION['SESS_FIRST_NAME'];?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo $upic1;?>" class="img-circle" alt="User Image">

                <p> <?php echo $_SESSION['SESS_FIRST_NAME'];?> - <?php echo $_SESSION['SESS_LAST_NAME'];?>
                  <small>Member since Nov. <?php echo date("Y"); ?></small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                  </div>
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href=" ../../../index.php" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
		
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo $upic1;?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $_SESSION['SESS_FIRST_NAME'];?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
		<li>
          <a  href="tech.php">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
			
            </span>
          </a>
        </li> 
		 
		<li>
          <a  href="job_m.php">
            <i class="fa fa-file-text-o"></i> <span>JOB</span>
            <span class="pull-right-container">
			
            </span>
          </a>
        </li>  
		
		  
		  <li>
          <a  href="leave.php">
            <i class="fa fa-file-text-o"></i> <span>Leave</span>
            <span class="pull-right-container">
			
            </span>
          </a>
        </li>
		  
		  	  <li>
          <a  href="advance.php">
            <i class="fa fa-usd"></i> <span>Advance</span>
            <span class="pull-right-container">
			
            </span>
          </a>
        </li>
		  
		  
		  
		  <li class="treeview">
          <a href="#">
            <i class="fa fa-line-chart"></i> <span>Report</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
           </span>
        </a>
          <ul class="treeview-menu">
            <li><a href="tech_month.php?d1=<?php echo date("Y-m-01");?>&d2=<?php echo date("Y-m-31");?>"><i class="fa fa-circle-o text-yellow"></i> Month End Report</a></li>
          </ul>
        </li>
		  

          </ul>
        </li> 
      </ul>
    </section>