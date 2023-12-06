<!DOCTYPE html>
<html>
<?php 
include("head.php");
include("connect.php");
?>

<body class="hold-transition skin-red sidebar-mini sidebar-collapse">
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
        $(".n").click(function() {
            var element = $(this);
            var idt = element.attr("id");
            var inf = 'n' + idt;
        });
        var modal1 = document.getElementsByClassName("modal");
        $(".n").click(function() {

            var element = $(this);
            var idt = element.attr("id");
            var inf = 'n' + idt;
            var modal = document.getElementById(inf);
            modal.style.display = "block";
            document.getElementById('cash_amount').focus();

            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                    document.getElementById('pro').focus();
                }
            }

            var span = document.getElementsByClassName("close")[0];
            span.onclick = function() {
                modal.style.display = "none";
                document.getElementById('pro').focus();
            }

        });

    });



    $(function() {

        $(document).ready(function() {


            $("body").keydown(function(key) {
                if (key.which == 115) { // F4 key
                    document.getElementById('n1').style.display = "block";
                    document.getElementById('cash_amount').focus();

                }

                if (key.which == 116) { // F5 key
                    document.getElementById('n2').style.display = "block";
                    document.getElementById('card_amount').focus();

                }
                if (key.which == 117) { // F6 key
                    document.getElementById('n3').style.display = "block";
                    document.getElementById('credit_amount').focus();

                }
                if (key.which == 27) { // esc key
                    document.getElementById('n1').style.display = "none";
                    document.getElementById('n2').style.display = "none";
                    document.getElementById('n3').style.display = "none";

                    document.getElementById('qty_error').style.display = "none";
                    document.getElementById('successful').style.display = "none";
                    document.getElementById('pro').focus();


                }

            });




        });
    });



    $(function() {
        $('input[name=com]').click(function() {
            //Save the link in a variable called element
            $(this).hide();
            //Find the id of the link that was clicked
        });

    });
    </script>
    <script>
    function test() {
        var qty = document.getElementById("qty").value;
        var pro = document.getElementById("pro").value;
        if (qty == "") {
            document.getElementById('qty_error').style.display = "block";
            document.getElementById('successful').style.display = "none";
        } else {
            var xmlHttp = new XMLHttpRequest();
            xmlHttp.open("GET", "sales_add.php?id=" + pro + "&qty=" + qty + "&invo=" + <?php echo $_GET['id']; ?>,
                false); // false for synchronous request
            xmlHttp.send(null);
            document.getElementById("c_view").innerHTML = xmlHttp.responseText;
            document.getElementById("qty").value = "1";

            document.getElementById('qty_error').style.display = "none";
            document.getElementById('successful').style.display = "block";
            return xmlHttp.responseText;
        }

    }




    function cat_change(id) {
    
            var xmlHttp = new XMLHttpRequest();
            xmlHttp.open("GET", "sales_list_get.php?cat_id="+id+"&invo="+<?php echo $_GET['id'] ?>, false); // false for synchronous request
            xmlHttp.send(null);
            document.getElementById("sales_item_list").innerHTML = xmlHttp.responseText;

            for (let i = 1; i < 7; i++) {
            if(i == id) {
                document.getElementById("cat_"+i).style.backgroundColor = "red";
            }else{
                document.getElementById("cat_"+i).style.backgroundColor = "black";
            }
        }

        return xmlHttp.responseText;


    }



    function add_cart(id,cat_id) {
        
        var qty = document.getElementById("qty_" + id).value;

            var xmlHttp = new XMLHttpRequest();
            xmlHttp.open("GET", "sales_add.php?id=" + id + "&qty=" + qty + "&invo=" + <?php echo $_GET['id']; ?>,
                false); // false for synchronous request
            xmlHttp.send(null);
            document.getElementById("c_view").innerHTML = xmlHttp.responseText;
            

            console.log(cat_id);

            cat_change(cat_id);
            
            return xmlHttp.responseText;
    }



    function alert_hidd() {
        document.getElementById('qty_error').style.display = "none";
        document.getElementById('successful').style.display = "none";
    }
    </script>




    <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Sales Form
                <small>Preview</small>
            </h1>

        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">

                <div class="col-md-5 col-xs-12">
                    <!-- Form Element sizes -->
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title">Control Panel</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <label>Item</label>
                                    </div>
                                    <select class="form-control select2" id="pro" name="id" style="width: 100%;"
                                        tabindex="1" onclick="alert_hidd()" autofocus>
                                        <?php  

                                          $result = $db->prepare("SELECT * FROM products WHERE type = 'service' OR type = 'dish'");
		                                 $result->bindParam(':userid', $res);
		                                 $result->execute();
		                                 for($i=0; $row = $result->fetch(); $i++){ ?>
                                        <option value="<?php echo $row['id'];?>"><?php echo $row['product_name']; ?> -
                                            <?php echo $row['product_code']; ?> - Rs<?php echo $row['sell_price']; ?>
                                        </option>
                                        <?php	} ?>
                                    </select>
                                </div>
                            </div>


                            <div>
                                <?php $result = $db->prepare("SELECT * FROM  category");
		                                 $result->bindParam(':userid', $res);
		                                 $result->execute();
		                                 for($i=0; $row = $result->fetch(); $i++){ ?>
                                <button id="cat_<?php echo $row['id']  ?>"
                                    onclick="cat_change('<?php echo $row['id']  ?>')" class="btn"
                                    style="background-color: #000000; color: #fff; margin: 6px; padding: 7px; border-radius: 15px;">
                                    <?php echo $row['name']  ?></button>
                                <?php } ?>
                            </div>


                            <div class="col-md-12">

                                <div class="alert alert-danger alert-dismissible" id="qty_error" style="display:none;">
                                    <button type="button" class="close" data-dismiss="alert"
                                        aria-hidden="true">&times;</button>
                                    <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                                    Enter the quantity and try again.
                                </div>

                                <div class="alert alert-success alert-dismissible" id="successful"
                                    style="display:none;">
                                    <button type="button" class="close" data-dismiss="alert"
                                        aria-hidden="true">&times;</button>
                                    <h4><i class="icon fa fa-check"></i> Alert!</h4>
                                    Data entry is successful
                                </div>

                            </div>

                            <div id="sales_item_list"></div>


                        </div>
                        <div id="err">

                        </div>



                        <!-- /.box-body -->
                    </div>

                </div>


                <div class="col-lg-7 col-xs-12">
                    <!-- SELECT2 EXAMPLE -->
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">Details</h3>

                            <?php 	  $id=$_REQUEST['id'];	?>
                            <!-- /.box-header -->
                            <div class="form-group">

                                <div id="c_view">

                                    <?php  include("sales_tabel.php"); ?>
                                </div>
                            </div>

                            <!-- /.box -->
                        </div>
                        <!-- /.col (right) -->
                    </div>



                    <div class="box box-danger">
                        <div class="box-header with-border">
                            <h3 class="box-title">Payment</h3>
                        </div>
                        <div class="box-body">

                            <div class="row">
                                <div class="col-lg-4 col-xs-12"><button type="button" id="1"
                                        class="btn btn-block btn-success  btn-lg n"><i class="fa fa-money"></i> CASH<p
                                            style="font-size: 14px;">[F4]</p></button></div>
                                <div class="col-lg-4 col-xs-12"><button type="button" id="2"
                                        class="btn btn-block btn-warning btn-lg n" style="color:#000000;"><i
                                            class="fa fa-credit-card"></i> CARD <p style="font-size: 14px;">[F5]</p>
                                    </button></div>
                                <div class="col-lg-4 col-xs-12"><button type="button" id="3"
                                        class="btn btn-block btn-danger btn-lg n"><i class="fa fa-repeat"></i> CREDIT <p
                                            style="font-size: 14px;">[F6]</p></button></div>
                            </div>


                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>


            </div> <!-- /.row -->

            <?php 
$result = $db->prepare("select sum(amount) from sales_list where invoice_no='$id' ORDER by id DESC  ");
$result->bindParam(':userid', $date);
                $result->execute();
 for($i=0; $row = $result->fetch(); $i++){ $tota=$row['sum(amount)']; }
 
 ?>




            <div id="n1" class="modal "> <br><br><br><br><br><br>
                <div class="col-lg-3 col-xs-4"> </div>

                <div class="col-lg-6 col-xs-10">

                    <div class="alert alert-success alert-dismissible" styel="position: center;">
                        <h4><i class="icon fa fa-money"></i> CASH</h4>
                        <center>

                            <form method="post" action="save_bill.php">
                                <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                                <input type="hidden" name="p_type" value="cash">
                                <label for="exampleInputPassword1">Cash Amount</label>
                                <div class="input-group">
                                    <input type="number" id="cash_amount" name="amount" class="form-control "
                                        autocomplete="off">
                                    <input class="btn btn-info" name="com" type="submit" value="Pay and Print">
                            </form>
                        </center>
                    </div>

                </div>



                <div class="col-lg-12 col-xs-10">
                    <center>
                        <h2 style="color:#FFFFFF;"> Enter the [Esc] key To Exit </h2>
                    </center>
                </div>
            </div>



            <div id="n2" class="modal "> <br><br><br><br><br><br>
                <div class="col-lg-3 col-xs-4"> </div>
                <div class="col-lg-6 col-xs-10">

                    <div class="alert alert-warning alert-dismissible" styel="position: center;">
                        <h4><i class="icon fa fa-credit-card"></i> CARD</h4>
                        <center>

                            <form method="post" action="save_bill.php">
                                <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                                <input type="hidden" name="p_type" value="card">
                                <label for="exampleInputPassword1">Card Amount</label>
                                <div class="input-group">
                                    <input type="number" id="card_amount" name="amount" class="form-control "
                                        autocomplete="off">
                                    <input class="btn btn-info" name="com" type="submit" value="Pay and Print">
                            </form>
                        </center>
                    </div>

                </div>

                <div class="col-lg-12 col-xs-10">
                    <center>
                        <h2 style="color:#FFFFFF;"> Enter the [Esc] key To Exit </h2>
                    </center>
                </div>
            </div>


            <div id="n3" class="modal "> <br><br><br><br><br><br>
                <div class="col-lg-3 col-xs-4"> </div>
                <div class="col-lg-6 col-xs-10">

                    <div class="alert alert-danger alert-dismissible" styel="position: center;">
                        <h4><i class="icon fa fa-repeat"></i> CREDIT</h4>
                        <center>
                            <h2>BILL TOTAL <a class="btn btn-primary btn-lg">Rs.<?php echo $tota; ?></a></h2>
                            <form method="post" action="save_bill.php">
                                <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                                <input type="hidden" name="p_type" value="card">
                                <label for="exampleInputPassword1">Card Amount</label>
                                <div class="input-group">
                                    <input type="number" id="card_amount" name="amount" class="form-control "
                                        autocomplete="off">
                                    <input class="btn btn-info" name="com" type="submit" value="Pay and Print">
                            </form>
                        </center>
                    </div>

                </div>

                <div class="col-lg-12 col-xs-10">
                    <center>
                        <h2 style="color:#FFFFFF;"> Enter the [Esc] key To Exit </h2>
                    </center>
                </div>
            </div>








    </div>
    </div>
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
    $(function() {
        //Initialize Select2 Elements
        $(".select2").select2();
    });


    function view_payment_date(type) {
        if (type == 'credit') {
            document.getElementById('credit_pay').style.display = 'block';
            document.getElementById('cash_pay').style.display = 'none';
            document.getElementById('chq_pay').style.display = 'none';
        } else if (type == 'chq') {
            document.getElementById('chq_pay').style.display = 'block';
            document.getElementById('credit_pay').style.display = 'none';
            document.getElementById('cash_pay').style.display = 'none';
        } else if (type == 'cash') {
            document.getElementById('chq_pay').style.display = 'none';
            document.getElementById('credit_pay').style.display = 'none';
            document.getElementById('cash_pay').style.display = 'block';
        } else {
            document.getElementById('chq_pay').style.display = 'none';
            document.getElementById('credit_pay').style.display = 'none';
            document.getElementById('cash_pay').style.display = 'none';
        }
    }
    </script>

    <script type="text/javascript">
    function myFunction() {
        document.getElementById("pro").reset();
    }

    function fetch_report(pro) {
        var xmlhttp;
        if (pro == "") {
            document.getElementById("c_view").innerHTML = "";
            return;
        }
        if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else { // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("c_view").innerHTML = xmlhttp.responseText;
                document.getElementById("qty").value = "1";
            }
        }
        xmlhttp.open("GET", "sales_product_save.php?pro=" + pro + "&id=" + <?php echo $id; ?> + "", true);
        xmlhttp.send();
    }

    //............................/qty/.............................................//

    function myFunction1() {
        document.getElementById("qty").reset();
    }

    function fetch_report1(qty) {
        var xmlhttp;
        if (qty == "") {
            document.getElementById("c_view").innerHTML = "";
            return;
        }
        if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else { // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("c_view").innerHTML = xmlhttp.responseText;
            }
        }

        xmlhttp.open("GET", "sales_product_qty_save.php?id=" + <?php echo $id; ?> + "&qty=" + qty + "", true);
        xmlhttp.send();
        document.getElementById('pro').focus();
        save();
        alert('qty');


    }



    //............................/discount/.............................................//

    function myFunction_dis() {
        document.getElementById("dis").reset();
    }

    function fetch_report_dis(dis) {
        var xmlhttp;
        if (dis == "") {
            document.getElementById("c_view").innerHTML = "";
            return;
        }
        if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else { // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("c_view").innerHTML = xmlhttp.responseText;
            }
        }

        xmlhttp.open("GET", "sales_product_dis_save.php?id=" + <?php echo $id; ?> + "&dis=" + dis + "", true);
        xmlhttp.send();
        document.getElementById('pro').focus();
        save();
        alert('dis');


    }


    //----------------------------- cancel -------------------------------------//
    function myFunction_cancel() {
        document.getElementById("cancel").reset();
    }

    function fetch_report_cancel(cancel) {
        var xmlhttp;
        if (cancel == "") {
            document.getElementById("c_view").innerHTML = "";
            return;
        }
        if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else { // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("c_view").innerHTML = xmlhttp.responseText;
            }
        }

        xmlhttp.open("GET", "sales_product_cancel.php?id=" + <?php echo $id; ?> + "&cancel=" + cancel + "", true);
        xmlhttp.send();
        document.getElementById('pro').focus();
        save();
        alert('cancel');
    }
    </script>

</body>

</html>