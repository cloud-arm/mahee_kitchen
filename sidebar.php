<div class="wrapper">
    <header class="main-header">
        <!-- Logo -->
        <a href="index.php" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>C</b>arm</span>
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
                    <li class="dropdown messages-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-check-square-o"></i>
                            <span class="label label-success"><?php echo $count; ?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">You have <?php echo $count; ?> Payment</li>
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu">



                                    <li>
                                        <a href="pay_rp.php?d1=<?php echo $date;?>&d2=<?php echo $date;?>">
                                            <i class="fa fa-user text-green"></i> <?php // echo $row['name']; ?>

                                        </a>

                                    </li>
                                    <!-- end message -->

                                    <?php  ?>



                                </ul>
                            </li>
                            <li class="footer"><a href="#">See All Messages</a></li>
                        </ul>
                    </li>
                    <!-- Notifications: style can be found in dropdown.less -->


                    <?php
		  
		include('connect.php');
 date_default_timezone_set("Asia/Colombo");
                  $date =  date("Y/m/d");		
				$rowcount123 = 0;			
				$ttre = 0;
                //$tre=$ttre-$rowcount123;
				$rv=0;
				$rate=0;				
			?>

                    <li class="dropdown notifications-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-credit-card"></i>
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
                 $date =  date("Y/m/d");					
				$rate=0;	
			?>
                                    <li>
                                        <a href="delay payment.php?id=day">
                                            <i class="fa fa-user text-yellow"></i> <?php echo $row['cus_name']; ?>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="footer"><a href="delay payment.php?id=week">View all</a></li>
                        </ul>
                    </li>
                    <!-- Tasks: style can be found in dropdown.less -->
                    <li class="dropdown tasks-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-flag-o"></i>
                            <span class="label label-danger">9</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">You have 9 tasks</li>
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu">
                                    <li>
                                        <!-- Task item -->
                                        <a href="#">
                                            <h3>
                                                Design some buttons
                                                <small class="pull-right">20%</small>
                                            </h3>
                                            <div class="progress xs">
                                                <div class="progress-bar progress-bar-aqua" style="width: 20%"
                                                    role="progressbar" aria-valuenow="20" aria-valuemin="0"
                                                    aria-valuemax="100">
                                                    <span class="sr-only">20% Complete</span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <!-- end task item -->
                                    <li>
                                        <!-- Task item -->
                                        <a href="#">
                                            <h3>
                                                Create a nice theme
                                                <small class="pull-right">40%</small>
                                            </h3>
                                            <div class="progress xs">
                                                <div class="progress-bar progress-bar-green" style="width: 40%"
                                                    role="progressbar" aria-valuenow="20" aria-valuemin="0"
                                                    aria-valuemax="100">
                                                    <span class="sr-only">40% Complete</span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <!-- end task item -->
                                    <li>
                                        <!-- Task item -->
                                        <a href="#">
                                            <h3>
                                                Some task I need to do
                                                <small class="pull-right">60%</small>
                                            </h3>
                                            <div class="progress xs">
                                                <div class="progress-bar progress-bar-red" style="width: 60%"
                                                    role="progressbar" aria-valuenow="20" aria-valuemin="0"
                                                    aria-valuemax="100">
                                                    <span class="sr-only">60% Complete</span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <!-- end task item -->
                                    <li>
                                        <!-- Task item -->
                                        <a href="#">
                                            <h3>
                                                Make beautiful transitions
                                                <small class="pull-right">80%</small>
                                            </h3>
                                            <div class="progress xs">
                                                <div class="progress-bar progress-bar-yellow" style="width: 80%"
                                                    role="progressbar" aria-valuenow="20" aria-valuemin="0"
                                                    aria-valuemax="100">
                                                    <span class="sr-only">80% Complete</span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <!-- end task item -->
                                </ul>
                            </li>
                            <li class="footer">
                                <a href="#">View all tasks</a>
                            </li>
                        </ul>
                    </li>
                    <?php
			$uname=$_SESSION['SESS_MEMBER_ID'];
		$result1 = $db->prepare("SELECT * FROM user WHERE id='$uname' ");
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
                            <span class="hidden-xs"><?php echo $_SESSION['SESS_FIRST_NAME'];?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="<?php echo $upic1;?>" class="img-circle" alt="User Image">

                                <p> <?php echo $_SESSION['SESS_FIRST_NAME'];?> -
                                    <?php echo $_SESSION['SESS_LAST_NAME'];?>
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
                        <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i
                                class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
            </form>
            <!-- /.search form -->
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
                <li class="header">MAIN NAVIGATION</li>
                <li>
                    <a href="index.php">
                        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                        <span class="pull-right-container">

                        </span>
                    </a>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-group"></i> <span>Customer</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="cus.php"><i class="fa fa-circle-o text-yellow"></i> Add customer</a></li>
                        <li><a href="cus_view.php"><i class="fa fa-circle-o text-aqua"></i> View customer</a></li>
                    </ul>
                </li>
                <li>
                    <a href="sales.php?id=<?php echo date("ymdHis"); ?>">
                        <i class="fa fa-cart-plus"></i> <span>Sales</span>
                        <span class="pull-right-container">

                        </span>
                    </a>
                </li>

                <li>
                    <a href="expenses.php">
                        <i class="fa fa-usd"></i> <span>Expenses</span>
                        <span class="pull-right-container">

                        </span>
                    </a>
                </li>

                <li>
                    <a href="stock.php">
                        <i class="fa fa-cubes"></i> <span>Stock</span>
                        <span class="pull-right-container">

                        </span>
                    </a>
                </li>

                <li>
                    <a href="booking.php">
                        <i class="fa fa-bed"></i> <span>Booking</span>
                        <span class="pull-right-container">

                        </span>
                    </a>
                </li>

                <li>
                    <a href="product_view.php">
                        <i class="fa fa-cutlery"></i> <span>Dish and Service</span>
                        <span class="pull-right-container">

                        </span>
                    </a>
                </li>

                <li>
                    <a href="package.php">
                        <i class="fa fa-cubes"></i> <span>Pack</span>
                        <span class="pull-right-container">

                        </span>
                    </a>
                </li>

                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-user"></i> <span>HR</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="hr_employee.php"><i class="fa fa-user text-yellow"></i>Employee</a></li>
                        <li><a href="hr_attendance.php"><i class="fa  fa-500px text-yellow"></i>Attendance</a></li>
                        <li><a href="hr_salary_advance.php"><i class="fa fa-money text-yellow"></i>Advance</a></li>
                        <li><a href="hr_payroll.php"><i class="fa fa-list-alt text-red"></i>Payroll </a></li>
                    </ul>
                </li>

                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-line-chart"></i> <span>Report</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="sales_rp.php?d1=<?php echo date("Y-m-d");?>&d2=<?php echo date("Y-m-d");?>"><i
                                    class="fa fa-circle-o text-yellow"></i> Sales Report</a></li>
                        <li><a href="package_rp.php?d1=<?php echo date("Y-m-d");?>&d2=<?php echo date("Y-m-d");?>"><i
                                    class="fa fa-circle-o text-yellow"></i> Package Report</a></li>
                    </ul>
                </li>




            </ul>
            </li>
            </ul>
        </section>