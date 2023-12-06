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
if($r =='mechanic'){
header("location: job.php");
}
if($r =='pay'){
header("location: tech_month_pay.php");
}

if($r =='manager'){
header("location: app/");
}
	
if($r =='tech'){
header("location: tech.php");
}
if($r =='admin'){
include_once("sidebar.php");
}



?>





    <!-- /.sidebar -->

    </aside>



    <!-- Content Wrapper. Contains page content -->

    <div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

            <h1>
                Home
                <small>Preview</small>
            </h1>
        </section>
        <!-- Main content -->
        <section class="content">
            <?php

		include('connect.php');
 date_default_timezone_set("Asia/Colombo");
 $cash=$_SESSION['SESS_FIRST_NAME'];
                  $date =  date("Y-m-d");					

			

				$result = $db->prepare("SELECT sum(profit) FROM sales WHERE    date='$date' ");

				

					$result->bindParam(':userid', $date);

                $result->execute();

                for($i=0; $row = $result->fetch(); $i++){

				  

				  $profit=$row['sum(profit)'];

				}

				







$result = $db->prepare("SELECT sum(amount) FROM sales WHERE    date='$date'  ");
					$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
				  $sales_total=$row['sum(amount)'];
				}	
				
				
				$result = $db->prepare("SELECT sum(amount) FROM sales WHERE    date='$date' AND customer_name='NO' ");
					$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
				  $dr_amount=$row['sum(amount)'];
				}	




		$month1=date("Y-m-01");
		$month2=date("Y-m-31");
		
		
		
		date_default_timezone_set("Asia/Colombo");
		$date=date("Y-m-d");
		$result = $db->prepare("SELECT count(transaction_id) FROM sales WHERE  date='$date' ORDER by transaction_id DESC ");
				$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
				$job_count=$row['count(transaction_id)'];	
				}
		
				$date=date("Y-m-d");
			?>


            <div class="row">
                <div class="col-md-4">

                    <div class="info-box bg-red">
                        <span class="info-box-icon"><i class="fa fa-file-text"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Invoice</span>
                            <span class="info-box-number">Rs.<?php echo $sales_total; ?></span>

                            <span class="progress-description">
                                Today Sales Total
                            </span>
                        </div>

                    </div>
                </div>

                <div class="col-md-4">

                    <div class="info-box bg-green">
                        <span class="info-box-icon"><i class="glyphicon glyphicon-stats"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">NO.01 </span>
                            <span class="info-box-number">coming soon</span>
                            <div class="progress">
                                <div class="progress-bar" style="width: 50%"></div>
                            </div>
                            <span class="progress-description">
                                sub
                            </span>
                        </div>

                    </div>
                </div>

                <div class="col-md-4">

                    <div class="info-box bg-yellow">
                        <span class="info-box-icon"><i class="glyphicon glyphicon-lock"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">NO.02 </span>
                            <span class="info-box-number">coming soon</span>
                            <div class="progress">
                                <div class="progress-bar" style="width: 50%"></div>
                            </div>
                            <span class="progress-description">
                                sub
                            </span>
                        </div>

                    </div>
                </div>
            </div>






            <div class="row">
                <?php 
		$result = $db->prepare("SELECT * FROM room WHERE floor='1' ORDER by id ASC ");
				$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
				$type=$row['action'];
				$invoice=$row['invoice_no'];
				
				if($row['action']==1){$type='<i class="fa fa-calendar-check-o"></i> '.$row['in_date']; $color="purple";}
				if($row['action']==0){$type="Available"; $color="blue";}
				
$result1 = $db->prepare("SELECT sum(amount) FROM sales_list WHERE invoice_no='$invoice' ");
				$result1->bindParam(':userid', $date);
                $result1->execute();
                for($i=0; $row1 = $result1->fetch(); $i++){ $bill=$row1['sum(amount)']; }
				
?>
                <div class="col-lg-3 col-xs-6">

                    <!-- small box -->

                    <div class="small-box bg-<?php echo $color; ?>">
                        <div class="inner">
                            <h4><?php echo $type; ?></h4>
                            <h4><i class="fa fa-user"></i> <?php echo $row['cus_name']; ?></h4>



                            <div class="row">
                                <div class="col-lg-6">
                                    <h4><i class="fa fa-male"></i> Person- <?php echo $row['qty']; ?></h4>
                                </div>
                                <div class="col-lg-6">
                                    <h4><i class="fa fa-file-text"></i> Rs.<?php echo $bill; ?></h4>
                                </div>
                            </div>



                        </div>

                        <div class="icon">

                            
                            <?php echo $row['room_no']; ?>
                        </div>
                        <?php if($row['action']==1){ ?>
                        <a href="sales.php?id=<?php echo $row['invoice_no']; ?>" class="small-box-footer">
                            <h4>INVOICE <i class="fa fa-arrow-circle-right"></i></h4>
                        </a>
                        <?php } if($row['action']==0){ ?>
                            <a href="sales.php?id=<?php echo date('ymdHis'); ?>" class="small-box-footer">
                            <h4>New Invoice <i class="fa fa-arrow-circle-right"></i></h4>
                        </a>
                        <?php } ?>
                    </div>

                </div>

                <?php } ?>
            </div>





<div class="col-12">
  <div style="background-color: #424242;color:aliceblue;font-size:28px;text-align:center;border-radius: 10px;">

 1end Floor
</div>
</div>
<br>





            <div class="row">
                <?php 
		$result = $db->prepare("SELECT * FROM room WHERE floor='2' ORDER by id ASC ");
				$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
				$type=$row['action'];
				$invoice=$row['invoice_no'];
				
				if($row['action']==1){$type='<i class="fa fa-calendar-check-o"></i> '.$row['in_date']; $color="purple";}
				if($row['action']==0){$type="Available"; $color="blue";}
				
$result1 = $db->prepare("SELECT sum(amount) FROM sales_list WHERE invoice_no='$invoice' ");
				$result1->bindParam(':userid', $date);
                $result1->execute();
                for($i=0; $row1 = $result1->fetch(); $i++){ $bill=$row1['sum(amount)']; }
				
?>
                <div class="col-lg-3 col-xs-6">

                    <!-- small box -->

                    <div class="small-box bg-<?php echo $color; ?>">
                        <div class="inner">
                            <h4><?php echo $type; ?></h4>
                            <h4><i class="fa fa-user"></i> <?php echo $row['cus_name']; ?></h4>



                            <div class="row">
                                <div class="col-lg-6">
                                    <h4><i class="fa fa-male"></i> Person- <?php echo $row['qty']; ?></h4>
                                </div>
                                <div class="col-lg-6">
                                    <h4><i class="fa fa-file-text"></i> Rs.<?php echo $bill; ?></h4>
                                </div>
                            </div>



                        </div>

                        <div class="icon">

                            
                            <?php echo $row['room_no']; ?>
                        </div>
                        <?php if($row['action']==1){ ?>
                        <a href="sales.php?id=<?php echo $row['invoice_no']; ?>" class="small-box-footer">
                            <h4>INVOICE <i class="fa fa-arrow-circle-right"></i></h4>
                        </a>
                        <?php } if($row['action']==0){ ?>
                            <a href="sales.php?id=<?php echo date('ymdHis'); ?>" class="small-box-footer">
                            <h4>New Invoice <i class="fa fa-arrow-circle-right"></i></h4>
                        </a>
                        <?php } ?>
                    </div>

                </div>

                <?php } ?>
            </div>



            <div class="col-12">
  <div style="background-color: #424242;color:aliceblue;font-size:28px;text-align:center;border-radius: 10px;">

 2end Floor
</div>
</div>
<br>


<div class="row">
                <?php 
		$result = $db->prepare("SELECT * FROM room WHERE floor='3' ORDER by id ASC ");
				$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
				$type=$row['action'];
				$invoice=$row['invoice_no'];
				
				if($row['action']==1){$type='<i class="fa fa-calendar-check-o"></i> '.$row['in_date']; $color="purple";}
				if($row['action']==0){$type="Available"; $color="blue";}
				
$result1 = $db->prepare("SELECT sum(amount) FROM sales_list WHERE invoice_no='$invoice' ");
				$result1->bindParam(':userid', $date);
                $result1->execute();
                for($i=0; $row1 = $result1->fetch(); $i++){ $bill=$row1['sum(amount)']; }
				
?>
                <div class="col-lg-3 col-xs-6">

                    <!-- small box -->

                    <div class="small-box bg-<?php echo $color; ?>">
                        <div class="inner">
                            <h4><?php echo $type; ?></h4>
                            <h4><i class="fa fa-user"></i> <?php echo $row['cus_name']; ?></h4>



                            <div class="row">
                                <div class="col-lg-6">
                                    <h4><i class="fa fa-male"></i> Person- <?php echo $row['qty']; ?></h4>
                                </div>
                                <div class="col-lg-6">
                                    <h4><i class="fa fa-file-text"></i> Rs.<?php echo $bill; ?></h4>
                                </div>
                            </div>



                        </div>

                        <div class="icon">

                           
                            <?php echo $row['room_no']; ?>
                        </div>
                        <?php if($row['action']==1){ ?>
                        <a href="sales.php?id=<?php echo $row['invoice_no']; ?>" class="small-box-footer">
                            <h4>INVOICE <i class="fa fa-arrow-circle-right"></i></h4>
                        </a>
                        <?php } if($row['action']==0){ ?>
                        <a href="sales.php?id=<?php echo date('ymdHis'); ?>" class="small-box-footer">
                            <h4>New Invoice <i class="fa fa-arrow-circle-right"></i></h4>
                        </a>
                        <?php } ?>
                    </div>

                </div>

                <?php } ?>
            </div>



        </section>


    </div>

    <!-- /.content-wrapper -->

    <?php

  include("dounbr.php");

?>

    <!-- /.control-sidebar -->

    <!-- Add the sidebar's background. This div must be placed

       immediately after the control sidebar -->

    <div class="control-sidebar-bg"></div>



    <!-- ./wrapper -->



    <!-- jQuery 2.2.3 -->

    <script src="../../plugins/jQuery/jquery-2.2.3.min.js"></script>

    <!-- Bootstrap 3.3.6 -->

    <script src="../../bootstrap/js/bootstrap.min.js"></script>

    <!-- ChartJS 1.0.1 -->

    <script src="../../plugins/chartjs/Chart.min.js"></script>

    <!-- FastClick -->

    <script src="../../plugins/fastclick/fastclick.js"></script>

    <!-- AdminLTE App -->

    <script src="../../dist/js/app.min.js"></script>

    <!-- AdminLTE for demo purposes -->

    <script src="../../dist/js/demo.js"></script>







    <?php

 include("chart.php");

?>




    <?php 
	           
	
	?>
    <!-- page script -->

    <script>
    $(function() {

      if (navigator.userAgent.match(/Android/i) ||
            navigator.userAgent.match(/iPhone/i) ||
            navigator.userAgent.match(/iPad/i) ||
            navigator.userAgent.match(/iPod/i) ||
            navigator.userAgent.match(/BlackBerry/i) ||
            navigator.userAgent.match(/Windows Phone/i)) {
            window.location.href = 'app/';
        }


        /* ChartJS

         * -------

         * Here we will create a few charts using ChartJS

         */



        //--------------

        //- AREA CHART -

        //--------------


        var pieChartCanvas = $("#pieChart").get(0).getContext("2d");
        var pieChart = new Chart(pieChartCanvas);

        var pieOptions = {
            //Boolean - Whether we should show a stroke on each segment
            segmentShowStroke: true,
            //String - The colour of each segment stroke
            segmentStrokeColor: "#fff",
            //Number - The width of each segment stroke
            segmentStrokeWidth: 2,
            //Number - The percentage of the chart that we cut out of the middle
            percentageInnerCutout: 50, // This is 0 for Pie charts
            //Number - Amount of animation steps
            animationSteps: 100,
            //String - Animation easing effect
            animationEasing: "easeOutBounce",
            //Boolean - Whether we animate the rotation of the Doughnut
            animateRotate: true,
            //Boolean - Whether we animate scaling the Doughnut from the centre
            animateScale: false,
            //Boolean - whether to make the chart responsive to window resizing
            responsive: true,
            // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
            maintainAspectRatio: true,
            //String - A legend template
            legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
        };
        //Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
        pieChart.Doughnut(PieData, pieOptions);
        // Get context with jQuery - using jQuery's .get() method.
        var areaChartCanvas = $("#lineChart").get(0).getContext("2d");
        // This will get the first returned node in the jQuery collection.
        var areaChart = new Chart(areaChartCanvas);
        var areaChartData = {
            labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September",
                "October", "November", "December"
            ],
            datasets: [{
                    label: <?php echo date("Y")-1 ?> + " SALES ",
                    fillColor: "rgba(210, 214, 222, 1)",
                    strokeColor: "rgba(210, 214, 222, 1)",
                    pointColor: "rgba(210, 214, 222, 1)",
                    pointStrokeColor: "#c1c7d1",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(220,220,220,1)",
                    data: [<?php  echo $m1t; ?>, <?php  echo $m2t; ?>, <?php  echo $m3t; ?>,
                        <?php  echo $m4t; ?>, <?php  echo $m5t; ?>, <?php  echo $m6t; ?>,
                        <?php  echo $m7t; ?>, <?php  echo $m8t; ?>, <?php  echo $m9t; ?>,
                        <?php  echo $m10t; ?>, <?php  echo $m11t; ?>, <?php  echo $m12t; ?>
                    ]
                },
                {
                    label: <?php echo date("Y") ?> + " SALES ",
                    fillColor: "rgba(60,141,188,0.9)",
                    strokeColor: "rgba(60,141,188,0.8)",
                    pointColor: "#3b8bba",
                    pointStrokeColor: "rgba(60,141,188,1)",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(60,141,188,1)",
                    data: [<?php  echo $m1; ?>, <?php  echo $m2; ?>, <?php  echo $m3; ?>,
                        <?php  echo $m4; ?>, <?php  echo $m5; ?>, <?php  echo $m6; ?>,
                        <?php  echo $m7; ?>, <?php  echo $m8; ?>, <?php  echo $m9; ?>,
                        <?php  echo $m10; ?>, <?php  echo $m11; ?>, <?php  echo $m12; ?>
                    ]
                }
            ]
        };
        var areaChartOptions = {
            //Boolean - If we should show the scale at all
            showScale: true,
            //Boolean - Whether grid lines are shown across the chart
            scaleShowGridLines: false,
            //String - Colour of the grid lines
            scaleGridLineColor: "rgba(0,0,0,.05)",
            //Number - Width of the grid lines
            scaleGridLineWidth: 1,
            //Boolean - Whether to show horizontal lines (except X axis)
            scaleShowHorizontalLines: true,
            //Boolean - Whether to show vertical lines (except Y axis)
            scaleShowVerticalLines: true,
            //Boolean - Whether the line is curved between points
            bezierCurve: true,
            //Number - Tension of the bezier curve between points
            bezierCurveTension: 0.3,
            //Boolean - Whether to show a dot for each point
            pointDot: false,
            //Number - Radius of each point dot in pixels
            pointDotRadius: 4,
            //Number - Pixel width of point dot stroke
            pointDotStrokeWidth: 1,
            //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
            pointHitDetectionRadius: 20,
            //Boolean - Whether to show a stroke for datasets
            datasetStroke: true,
            //Number - Pixel width of dataset stroke
            datasetStrokeWidth: 2,
            //Boolean - Whether to fill the dataset with a color
            datasetFill: true,

            //String - A legend template

            legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",

            //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container

            maintainAspectRatio: true,

            //Boolean - whether to make the chart responsive to window resizing

            responsive: true

        };



        //Create the line chart

        areaChart.Line(areaChartData, areaChartOptions);



        //-------------

        //- LINE CHART -

        //--------------

        var lineChartCanvas = $("#lineChart").get(0).getContext("2d");

        var lineChart = new Chart(lineChartCanvas);

        var lineChartOptions = areaChartOptions;

        lineChartOptions.datasetFill = false;

        lineChart.Line(areaChartData, lineChartOptions);



        //-------------

        //- PIE CHART -

        //-------------





        //-------------

        //- BAR CHART -

        //-------------

        var barChartCanvas = $("#barChart").get(0).getContext("2d");

        var barChart = new Chart(barChartCanvas);

        var barChartData = areaChartData;

        barChartData.datasets[1].fillColor = "#00a65a";

        barChartData.datasets[1].strokeColor = "#00a65a";

        barChartData.datasets[1].pointColor = "#00a65a";

        var barChartOptions = {

            //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value

            scaleBeginAtZero: true,

            //Boolean - Whether grid lines are shown across the chart

            scaleShowGridLines: true,

            //String - Colour of the grid lines

            scaleGridLineColor: "rgba(0,0,0,.05)",

            //Number - Width of the grid lines

            scaleGridLineWidth: 1,

            //Boolean - Whether to show horizontal lines (except X axis)

            scaleShowHorizontalLines: true,

            //Boolean - Whether to show vertical lines (except Y axis)

            scaleShowVerticalLines: true,

            //Boolean - If there is a stroke on each bar

            barShowStroke: true,

            //Number - Pixel width of the bar stroke

            barStrokeWidth: 2,

            //Number - Spacing between each of the X value sets

            barValueSpacing: 5,

            //Number - Spacing between data sets within X values

            barDatasetSpacing: 1,

            //String - A legend template

            legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",

            //Boolean - whether to make the chart responsive

            responsive: true,

            maintainAspectRatio: true

        };



        barChartOptions.datasetFill = false;

        barChart.Bar(barChartData, barChartOptions);

    });
    </script>

</body>

</html>