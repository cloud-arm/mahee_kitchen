<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CLOUD ARM</title>

    <?php 
    include("head.php");
    include("../connect.php");
    date_default_timezone_set("Asia/Colombo");

    $room_id = $_GET['id'];
    $invo_id = $_GET['invo'];

    $result = $db->prepare("SELECT * FROM room WHERE id='$room_id'");
    $result->bindParam(':userid', $date);
    $result->execute();
    for($i=0; $row = $result->fetch(); $i++){
        $room_name = $row['room_no'];
    }
    ?>
</head>
<body class="bg-light">

    <header>
        <nav class="navbar navbar-expand-lg bg-none">
            <div class="container-fluid">
                <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#nav" aria-controls="nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <a href="invoice.php?id=<?php echo $room_id?>&invo=<?php echo $invo_id?>"><span class="navbar-toggler border-0"><i id="icon" class="fa-solid fa-bell"></i></span></a>
                <div class="collapse navbar-collapse" id="nav">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="invoice.php?id=<?php echo $room_id?>&invo=<?php echo $invo_id?>">Invoice</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <div class="container-fluid down-up" id="down-up" style="transform: translateY(101%);">
        <div id="container" onclick="containerDown()"></div>
        <div class="up-content">
            <span class="closer"></span>
            <div class="content">
            <div class="cont-box">
                    <div class="row">
                        <div class="col-6">
                            <span class="top" id="top"></span><br>
                            <span class="sub-top" id="sub-top"></span>
                        </div>
                        <div class="col-6 pr">
                            <span>LKR. <span id="pr"></span></span>
                        </div>
                    </div>
                </div>
                <div class="box">
                    <span class="btn down">
                        <i class="fa-solid fa-minus"></i>
                    </span>
                    <input type="text" value="01" name="qty" id="qty" disabled>
                    <span class="btn up">
                        <i class="fa-solid fa-plus"></i>
                    </span>
                </div>
                <input type="text" name="price" id="price" class="d-none" disabled>
                <input type="text" name="id" id="id" class="d-none" disabled>
                <input type="text" name="room_id" id="room_id" class="d-none" disabled>
                <button class="btn" onclick="sales_add_list()">Order Now</button>
            </div>
        </div>
    </div>

    <div class="container-fluid bg-none">
        <div class="container-fluid my-4">
            <h1 class="fs-2 fw-semibold m_had"><span>Table Number </span> <?php echo $room_name?></h1>
        </div>

        <div class="container-fluid mb-4 mt-5">
            <form action="" method="">
                <div class="row d-flex justify-content-center align-items-center">
                    <div class="col-10 col-md-6">
                    <div class="search">
                        <i class="fa fa-search"></i>
                        <input type="text" class="form-control form-input" placeholder="Restaurants, Foods..">
                    </div>
                    </div>
                    <div class="col-2 col-md-2">
                    <div class="search-btn">
                        <button class="btn"><i class="fa-solid fa-sliders"></i></button>
                    </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="container-fluid mb-3">
        <div class="box">
            <div class="box-header">
                <h4 class="fs-4 m-0">Explore Category</h4>
                <i class="fa-solid fa-ellipsis d-md-none"></i>
            </div>
        </div>
    </div>

    <div class="container-lg box-body category" style="overflow-x: scroll;">
        <table>
            <tr>
                <td style="padding-right: 20px;"></td>
                <?php 
                    $result = $db->prepare("SELECT * FROM category");
                    $result->bindParam(':userid', $date);
                    $result->execute();

                    for($i=0; $row = $result->fetch(); $i++){?>
                <td>
                    <div class="cate-info cat_fill click_fun" value="<?php echo $row['id']?>">
                        <div class="img-box">
                            <img src="<?php echo $row['img'] ?>" alt="">
                        </div>
                        <span><?php echo $row['name'] ?></span>
                    </div>
                </td>
                <?php }?>
            </tr>
        </table>
    </div>

    <div class="container-fluid mb-3">
        <div class="box">
            <div class="box-body">
                <div class="row" id="cat-box"></div>
            </div>
        </div>
    </div>
   

    <!-- Bootstrap 5.3.2-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <!-- Jquery 3.7.1 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- Style -->
    <!-- <script src="js/style.js"></script> -->

    <script>

    function sales_add_list(){
        let id = document.getElementById('id').value;
        let qty = document.getElementById('qty').value;
        var xmlhttp;
        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        } else { 
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("cat-box").innerHTML = xmlhttp.responseText;
                console.log(xmlhttp.responseText);
            }
        }

        xmlhttp.open("GET", "sales_add.php?id="+id+"&invo=<?php echo $invo_id?>&qty="+qty+"&room_id=<?php echo $room_id?>" , true);
        xmlhttp.send();

        containerDown();


    }

    function open_model(id,p_name,p_code,price) {
        console.log(room_id);
        document.getElementById('qty').value = '01';
        document.getElementById('top').innerHTML = p_name;
        document.getElementById('sub-top').innerHTML = p_code;
        document.getElementById('pr').innerHTML = price;
        document.getElementById('price').value = price;
        document.getElementById('id').value = id;
        document.getElementById('down-up').style.transform = "translateY(0)";
    }

    function containerDown(){
        document.getElementById('down-up').style.transition = "transform 0.75s ease 0.2s";
        document.getElementById('down-up').style.transform = "translateY(101%)";
    }
    
    $(document).ready(function(){
        var xmlhttp;
        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        } else { 
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("cat-box").innerHTML = xmlhttp.responseText;
            }
        }

        xmlhttp.open("GET", "item_get.php?invo=<?php echo $invo_id ?>" , true);
        xmlhttp.send();

        $(".cat_fill").click(function() {
            var id = $(this).attr("value");
            
            var xmlhttp;
            if (window.XMLHttpRequest) {
                xmlhttp = new XMLHttpRequest();
            } else { 
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    document.getElementById("cat-box").innerHTML = xmlhttp.responseText;
                }
            }

            xmlhttp.open("GET", "item_get.php?id=" + id+"&invo=<?php echo $invo_id ?>" , true);
            xmlhttp.send();
        });

        $(".click_fun").click(function() {
            $(".click_fun").removeClass("active");
            $(this).addClass("active");
        });

        $('.closer').click(function(){
            $('#down-up').css("transform","translateY(101%)");
        });

        $('.content .btn.up').click(function (){
            let val = parseInt($('#qty').val());
            val +=1;
            if(val <10){
                $('#qty').val("0"+val);
            }else{
                $('#qty').val(val);
            }
        });

        $('.content .btn.down').click(function (){
            let val = parseInt($('#qty').val());
            if(val > 1){
                val-=1;
                if(val <10){
                    $('#qty').val("0"+val);
                }else{
                    $('#qty').val(val);
                }
            }
        });

        $('.content .btn').click(function (){
            let val = parseInt($('#qty').val());
            $('#pr').text(parseFloat($('#price').val())*val);
        });
    });
    </script>
</body>
</html>