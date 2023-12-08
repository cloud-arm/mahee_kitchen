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
    ?>
</head>
<body class="bg-light">

    <header>
        <nav class="navbar navbar-expand-lg bg-none">
            <div class="container-fluid">
                <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#nav" aria-controls="nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <a href="order.php" class="d-none"><span class="navbar-toggler border-0"><i id="icon" class="fa-solid fa-bell"></i></span></a>
                <div class="collapse navbar-collapse" id="nav">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Orders
                            </a>
                            <ul class="dropdown-menu border-0">
                                <li><a class="dropdown-item" href="#">Table 01</a></li>
                                <li><a class="dropdown-item" href="#">Table 02</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="#">Table 01</a></li>
                                <li><a class="dropdown-item" href="#">Table 02</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="#">Table 01</a></li>
                                <li><a class="dropdown-item" href="#">Table 02</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <div class="container-fluid mb-3">
        <div class="box">
            <div class="box-header">
                <h4 class="fs-4 m-0">Explore Tables</h4>
                <i class="fa-solid fa-ellipsis d-md-none"></i>
            </div>
        </div>
    </div>

    <div class="container-lg box-body category" style="overflow-x: scroll;">
        <table>
            <tr>
                <td>
                    <div class="room-info room_fill click_fun active" value="0">
                        <div class="room-box first">
                            <span>All</span>
                        </div>
                        <span>Floor</span>
                    </div>
                </td>
                <td>
                    <div class="room-info room_fill click_fun" value="1">
                        <div class="room-box">
                            <span>1</span>
                        </div>
                        <span>Floor</span>
                    </div>
                </td>
                <td>
                    <div class="room-info room_fill click_fun" value="2">
                        <div class="room-box">
                            <span>2</span>
                        </div>
                        <span>Floor</span>
                    </div>
                </td>
                <td>
                    <div class="room-info room_fill click_fun" value="3">
                        <div class="room-box">
                            <span>3</span>
                        </div>
                        <span>Floor</span>
                    </div>
                </td>
            </tr>
        </table>
    </div>

    <div class="container room-container">
        <div class="row" id="room-box">
            
            <?php echo include('room_get.php'); ?>

        </div>
    </div>
   

    <!-- Bootstrap 5.3.2-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <!-- Jquery 3.7.1 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- Style -->
    <!-- <script src="js/style.js"></script> -->

    <script>
        $(document).ready(function(){
            $(".room_fill").click(function() {
                var id = $(this).attr("value");
                
                var xmlhttp;
                if (window.XMLHttpRequest) {
                    xmlhttp = new XMLHttpRequest();
                } else { 
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        document.getElementById("room-box").innerHTML = xmlhttp.responseText;
                    }
                }

                xmlhttp.open("GET", "room_get.php?id=" + id , true);
                xmlhttp.send();
            });

            $(".click_fun").click(function() {
                $(".click_fun").removeClass("active");
                $(this).addClass("active");
            });
        });



    </script>
</body>
</html>