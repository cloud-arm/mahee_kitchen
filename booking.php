<!DOCTYPE html>
<html>
<!-- fullCalendar 2.2.5-->
<link rel="stylesheet" href="../../plugins/fullcalendar/fullcalendar.min.css">
<link rel="stylesheet" href="../../plugins/fullcalendar/fullcalendar.print.css" media="print">
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




    <link rel="stylesheet" href="datepicker.css" type="text/css" media="all" />
    <script src="datepicker.js" type="text/javascript"></script>
    <script src="datepicker.ui.min.js" type="text/javascript"></script>
    <script type="text/javascript">
    $(function() {
        $("#datepicker1").datepicker({
            dateFormat: 'yy/mm/dd'
        });
        $("#datepicker2").datepicker({
            dateFormat: 'yy/mm/dd'
        });

    });
    </script>




    <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Booking
                <small>Preview</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Forms</a></li>
                <li class="active">booking</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- SELECT2 EXAMPLE -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Add Booking</h3>


                    <!-- /.box-header -->
                    <div class="form-group" id="new-form">

                        <div class="box-body">
                            <!-- /.box -->
                            <div class="form-group">
                                <form method="post" action="booking_save.php">
                                    <div class="col-md-6">
                                        <div class="box-body">
                                            <div class="col-md-6">
                                                <label> Phone Number</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-phone"></i>
                                                    </div>
                                                    <input type="text" class="form-control" onchange="cus_fill()"
                                                        name="phone_no" id="phone">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>NIC</label>
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-user"></i>
                                                        </div>
                                                        <input type="text" name="nic" id="nic"
                                                            class="form-control pull-right">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label> Customer Name</label>
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-user"></i>
                                                        </div>
                                                        <input type="text" class="form-control" id="name"
                                                            name="cus_name" required>
                                                    </div>
                                                </div>
                                            </div>



                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-at"></i>
                                                        </div>
                                                        <input type="text" name="email" id="email"
                                                            class="form-control pull-right">
                                                    </div>
                                                </div>
                                            </div>



                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label> Address</label>
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-home"></i>
                                                        </div>
                                                        <input type="text" name="address" id="address"
                                                            class="form-control pull-right">
                                                    </div>
                                                </div>
                                            </div>



                                            <div class="row">

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>From</label>
                                                        <div class="input-group">
                                                            <div class="input-group-addon">
                                                                <i class="fa fa-home"></i>
                                                            </div>
                                                            <input type="text" name="from" id="datepicker"
                                                                value="<?php echo date('Y-m-d'); ?>"
                                                                class="form-control pull-right" autocomplete="off">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>to</label>
                                                        <div class="input-group">
                                                            <div class="input-group-addon">
                                                                <i class="fa fa-home"></i>
                                                            </div>
                                                            <input type="text" name="to" id="datepickerd" onchange="room_search()"
                                                                class="form-control pull-right" autocomplete="off">
                                                        </div>
                                                    </div>
                                                </div>



                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Pay Amount</label>
                                                        <div class="input-group">
                                                            <div class="input-group-addon">
                                                                <i class="fa fa-usd"></i>
                                                            </div>
                                                            <input type="text" name="pay" id="pay"
                                                                class="form-control pull-right">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Package</label>
                                                        <div class="input-group">
                                                            <div class="input-group-addon">
                                                                <i class="fa fa-bed"></i>
                                                            </div>
                                                            <select class="form-control select3" name="package"
                                                                required>
                                                                <?php 	$result2 = $db->prepare("SELECT * FROM package  ");
	                                                        $result2->bindParam(':userid', $date);
                                                            $result2->execute();
                                                            for($i=0; $row = $result2->fetch(); $i++){
	                                                        ?>
                                                                <option value="<?php echo $row['id']; ?>">
                                                                    <?php echo $row['name'].' - '.$row['amount']; ?>
                                                                </option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row" >
                                            <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Discount Amount</label>
                                                        <div class="input-group">
                                                            <div class="input-group-addon">
                                                                <i class="fa fa-usd"></i>
                                                            </div>
                                                            <input type="text" name="dis" id="dis"
                                                                class="form-control pull-right">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="cus_id" id="cus_id" value="0">
                                        <input class="btn btn-info" type="submit" value="Submit">
                                    </div>
                                </form>
                                <!-- /.box -->

                                <div class="col-md-6" style="background-color: #DDDDDD;">
                                    <h3>Room List</h3>
                                    <div class="col-md-6">
                                    <div id="room_list">
                                        <select class="form-control select3" name="room" id="room" required>
                                        
                                            <?php 	$result2 = $db->prepare("SELECT * FROM room  ");
	                                                        $result2->bindParam(':userid', $date);
                                                            $result2->execute();
                                                            for($i=0; $row = $result2->fetch(); $i++){
	                                                        ?>
                                            <option value="<?php echo $row['id']; ?>">
                                                <?php echo $row['room_no'].' (Bed- '.$row['bed'].')'; ?>
                                            </option>
                                            <?php } ?>
                                            
                                        </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3"><input class="form-control" type="text" name="qty" id="qty"
                                            width="50%">
                                    </div>
                                    <div class="col-md-3"><b class="btn btn-info" onclick="room_add()">ADD</b>
                                    </div>
                                    <div class="col-md-12">

                                        <div class="form-group" id="sub_list">
                                            <table width='100%' class='table'>
                                                <?php 
                                                $result = $db->prepare("SELECT * FROM booking_list WHERE booking_id ='0' ");
                                                $result->bindParam(':userid', $res);
                                                $result->execute();
                                                for($i=0; $row = $result->fetch(); $i++){
                                                ?>
                                                <tr>
                                                    <td><?php echo $row['room_no']; ?>
                                                    </td>
                                                    <td><?php echo $row['qty']; ?></td>
                                                    <td><b class="btn btn-danger dllpack" id="<?php echo $row['id']; ?>"
                                                            onclick="dll(<?php echo $row['id']; ?>)"><i
                                                                class="icon-trash">x</i></b>
                                                    </td>
                                                </tr>

                                                <?php } ?>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- /.col (left) -->



                        </div>
                    </div>

        </section>
        <?php if(isset($_GET['id'])){ ?>
        <section class="content">
            <div class="col-md-12">
                <div class="box box-primary">

                    <div class="box-body no-padding">
                        <?php $id=$_GET['id'];
                        $result = $db->prepare("SELECT * FROM booking JOIN booking_list ON booking.id=booking_list.booking_id WHERE booking_list.id='$id'  ");
                        $result->bindParam(':userid', $res);
                        $result->execute();
                        for($i=0; $row = $result->fetch(); $i++){ $type=$row['type']; $person=$row['qty']; $pack_id=$row['package_id']; 
                          ?>

                        <div class="col-lg-6 col-xs-6">
                            <!-- small box -->
                            <div
                                class="small-box bg-<?php if($type==2){echo "red"; $type_name="Promotion";}else{echo "green"; $type_name="Package";} ?>">
                                <div class="inner">
                                    <h3><?php  echo $row['cus_name']; ?></h3>
                                    <h4>Room NO - <?php echo $room_no=$row['room_no'] ?></h4>
                                    <p><?php echo $row['phone_no']; ?></p>
                                    <b style="font-size: 15px;"><?php echo $d1=$row['in_date']; echo ' - '.$d2=$row['out_date']; ?>
                                        <br>Pay: </b>Rs.<?php echo $amount=$row['pay_amount']; ?>
                                        <br> <b>Discount:</b>   Rs.<?php echo $discount=$row['discount']; ?>

                                </div>
                                <a href="booking_dll.php?id=<?php echo $row['id']; ?>"><b
                                        class="btn btn-danger ">Delete</b></a>

                                <div class="icon">
                                    <i class="fa fa-bed"></i>
                                </div>

                            </div>
                        </div>
                        <?php } ?>

                        <div class="form-group" id="edit-form">

                            <form method="post" action="booking_update.php">

                                <div class="box-body">
                                    <!-- /.box -->
                                    <div class="form-group">
                                        <div class="box-body">

                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Person</label>
                                                        <div class="input-group">
                                                            <div class="input-group-addon">
                                                                <i class="fa fa-users"></i>
                                                            </div>
                                                            <select class="form-control select3" name="person" required>
                                                                <option><?php echo $person; ?></option>
                                                                <option>1</option>
                                                                <option>2</option>
                                                                <option>3</option>
                                                                <option>4</option>
                                                                <option>5</option>
                                                                <option>6</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Room No</label>
                                                        <div class="input-group">
                                                            <div class="input-group-addon">
                                                                <i class="fa fa-bed"></i>
                                                            </div>
                                                            <select class="form-control select3" name="room" required>
                                                                <?php 	$result2 = $db->prepare("SELECT * FROM room  ");
	                                                        $result2->bindParam(':userid', $date);
                                                            $result2->execute();
                                                            for($i=0; $row = $result2->fetch(); $i++){
	                                                        ?>
                                                                <option value="<?php echo $row['room_no']; ?>"
                                                                    <?php if($row['room_no']==$room_no){echo 'selected'; } ?>>
                                                                    <?php echo $row['room_no'].' (Bed - '.$row['bed'].')'; ?>
                                                                </option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>From</label>
                                                        <div class="input-group">
                                                            <div class="input-group-addon">
                                                                <i class="fa fa-home"></i>
                                                            </div>
                                                            <input type="text" name="from" id="datepicker2"
                                                                value="<?php echo $d1; ?>"
                                                                class="form-control pull-right" autocomplete="off">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>to</label>
                                                        <div class="input-group">
                                                            <div class="input-group-addon">
                                                                <i class="fa fa-home"></i>
                                                            </div>
                                                            <input type="text" name="to" id="datepickerd2"
                                                                value="<?php echo $d2; ?>"
                                                                class="form-control pull-right" autocomplete="off">
                                                        </div>
                                                    </div>
                                                </div>



                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Pay Amount</label>
                                                        <div class="input-group">
                                                            <div class="input-group-addon">
                                                                <i class="fa fa-usd"></i>
                                                            </div>
                                                            <input type="text" name="pay" value="<?php echo $amount; ?>"
                                                                class="form-control ">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Discount</label>
                                                        <div class="input-group">
                                                            <div class="input-group-addon">
                                                                <i class="fa fa-usd"></i>
                                                            </div>
                                                            <input type="text" name="dis" value="<?php echo $discount; ?>"
                                                                class="form-control ">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Package</label>
                                                        <div class="input-group">
                                                            <div class="input-group-addon">
                                                                <i class="fa fa-usd"></i>
                                                            </div>
                                                            <select class="form-control select3" name="package"
                                                                required>
                                                                <?php 	$result2 = $db->prepare("SELECT * FROM package  ");
	                                                        $result2->bindParam(':userid', $date);
                                                            $result2->execute();
                                                            for($i=0; $row = $result2->fetch(); $i++){
	                                                        ?>
                                                                <option value="<?php echo $row['id']; ?>"
                                                                    <?php if($row['id']==$pack_id){echo 'selected'; } ?>>
                                                                    <?php echo $row['name'].' - '.$row['amount']; ?>
                                                                </option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>





                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <input type="hidden" name="id" value="<?php echo $id ?>">

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                        <input class="btn btn-info pull-right" type="submit" value="Update">
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </section>
        <?php } ?>

        <section class="content">
            <div class="col-md-12">
                <div>
                    <div class="box box-primary">
                        <div class="box-body no-padding">
                            <!-- THE CALENDAR -->
                            <div id="calendar"></div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /. box -->
                </div>

            </div>
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


    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
    <script src="../../plugins/fullcalendar/fullcalendar.min.js"></script>

    <script>
    function room_addy() {
        var mat = document.getElementById("room").value;
        var qty = document.getElementById("qty").value;
        var dd = fetch("room_list_add.php?room=" + mat + "&qty=" + qty).then(responseText => responseText);

        document.getElementById("sub_list").innerHTML = responseText;
    }


    function dll(did) {

        var xmlhttp;

        if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else { // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("sub_list").innerHTML = xmlhttp.responseText;
            }
        }

        xmlhttp.open("GET", "room_list_add.php?id=" + did, true);
        xmlhttp.send();
    }



    function room_search() {
        var from = document.getElementById("datepicker").value;
        var to = document.getElementById("datepickerd").value;

        if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else { // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("room_list").innerHTML = xmlhttp.responseText;
            }
        }

        xmlhttp.open("GET", "room_search.php?from=" + from + "&to=" + to, true);
        xmlhttp.send();

    }

    function room_add() {
        var mat = document.getElementById("room").value;
        var qty = document.getElementById("qty").value;
        var xmlhttp;

        if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else { // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("sub_list").innerHTML = xmlhttp.responseText;
            }
        }

        xmlhttp.open("GET", "room_list_add.php?room=" + mat + "&qty=" + qty, true);
        xmlhttp.send();

        document.getElementById("qty").value = "";
    }




    function cus_fill() {
        var phone = document.getElementById('phone').value;
        var data = 'ur';
        fetch("customer_data.php?phone=" + phone)
            .then((response) => response.json())
            .then((json) => fill(json));
    }


    function fill(json) {

        var d = new Date('2008', '05', '05', '10', '30');
        console.log(d);
        if (json.action == "true") {
            console.log("old customer");
            document.getElementById('name').value = json.name;
            document.getElementById('address').value = json.address;
            document.getElementById('email').value = json.email;
            document.getElementById('nic').value = json.nic;
            document.getElementById('cus_id').value = json.id;

            document.getElementById('name').disabled = true;
            document.getElementById('address').disabled = true;
            document.getElementById('email').disabled = true;
            document.getElementById('nic').disabled = true;

        } else {
            console.log("new customer");
            document.getElementById('name').value = '';
            document.getElementById('address').value = '';
            document.getElementById('email').value = '';
            document.getElementById('nic').value = "";
            document.getElementById('cus_id').value = "0";

            document.getElementById('name').disabled = false;
            document.getElementById('address').disabled = false;
            document.getElementById('email').disabled = false;
            document.getElementById('nic').disabled = false;
        }
    }



    function edit() {
        document.getElementById('new-form').style.display = 'none';
        document.getElementById('edit-form').style.display = 'block';
    }


    $(function() {
        /* initialize the external events
         -----------------------------------------------------------------*/
        function ini_events(ele) {
            ele.each(function() {

                // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
                // it doesn't need to have a start or end
                var eventObject = {
                    title: $.trim($(this).text()) // use the element's text as the event title
                };

                // store the Event Object in the DOM element so we can get to it later
                $(this).data('eventObject', eventObject);

                // make the event draggable using jQuery UI
                $(this).draggable({
                    zIndex: 1070,
                    revert: true, // will cause the event to go back to its
                    revertDuration: 0 //  original position after the drag
                });

            });
        }

        ini_events($('#external-events div.external-event'));

        /* initialize the calendar
         -----------------------------------------------------------------*/
        //Date for the calendar events (dummy data)
        var date = new Date();
        var d = date.getDate(),
            m = date.getMonth(),
            y = date.getFullYear();
        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            buttonText: {
                today: 'today',
                month: 'month',
                week: 'week',
                day: 'day'
            },
            //Random default events
            events: [ 
                <?php $result = $db->prepare("SELECT booking.* , booking_list.room_no, booking_list.id FROM booking JOIN booking_list ON booking.id=booking_list.booking_id WHERE booking.action='0' ");
					$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
		  $date=$row['in_date'];
          $date2=$row['out_date'];
		  $type=$row['type'];
          $id=$row['id'];
		  $action=0;
		  $receive='';
		  $split =  explode("-", $date);
		    $y= $split[0];
			$m= $split[1];
			$d= $split[2];

            $split2 =  explode("-", $date2);
		    $y2= $split2[0];
			$m2= $split2[1];
			$d2= $split2[2];
		  ?>


                {
                    title: '<?php echo $row['room_no']."-".$row['cus_name']; ?>',
                    start: '<?php echo $y ?>,<?php echo $m ?>,<?php echo $d ?>',
                    end: new Date('<?php echo $y2." ,".$m2," ,".$d2;?>'),
                    url: 'booking.php?id=<?php echo $id; ?>',
                    allDay: true,
                    backgroundColor: "<?php if($type=='5'){echo "#002091";} ?><?php if($type=='3'){echo "#f39c12";}  if($type=='4'){echo "#690dde";} if($type=='6'){echo "#d60000";} ?>",
                    borderColor: "<?php if($action=='3'){echo "#ff0000";} ?><?php if($action=='0'){echo "#000000";} ?><?php if($action=='2'){echo "#07f01e";} ?>"
                },

                <?php } ?>
            ],
            editable: false,
            droppable: false, // this allows things to be dropped onto the calendar !!!
            drop: function(date, allDay) { // this function is called when something is dropped 12a

                // retrieve the dropped element's stored Event Object
                var originalEventObject = $(this).data('eventObject');

                // we need to copy it, so that multiple events don't have a reference to the same object
                var copiedEventObject = $.extend({}, originalEventObject);

                // assign it the date that was reported
                copiedEventObject.start = date;
                copiedEventObject.allDay = allDay;
                copiedEventObject.backgroundColor = $(this).css("background-color");
                copiedEventObject.borderColor = $(this).css("border-color");

                // render the event on the calendar
                // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

                // is the "remove after drop" checkbox checked?
                if ($('#drop-remove').is(':checked')) {
                    // if so, remove the element from the "Draggable Events" list
                    $(this).remove();
                }

            }
        });

        <?php $y='2023';$m='05';$d='10'; ?>
        console.log(new Date('<?php echo $y ?>,<?php echo $m ?>,<?php echo $d ?>'));
        /* ADDING EVENTS */
        var currColor = "#3c8dbc"; //Red by default
        //Color chooser button
        var colorChooser = $("#color-chooser-btn");
        $("#color-chooser > li > a").click(function(e) {
            e.preventDefault();
            //Save color
            currColor = $(this).css("color");
            //Add color effect to button
            $('#add-new-event').css({
                "background-color": currColor,
                "border-color": currColor
            });
        });

    });


    $('#datepicker').datepicker({
        autoclose: true,
        datepicker: true,
        format: 'yyyy-mm-dd '
    });
    $('#datepicker').datepicker({
        autoclose: true
    });



    $('#datepickerd').datepicker({
        autoclose: true,
        datepicker: true,
        format: 'yyyy-mm-dd '
    });
    $('#datepickerd').datepicker({
        autoclose: true
    });
    </script>
</body>

</html>