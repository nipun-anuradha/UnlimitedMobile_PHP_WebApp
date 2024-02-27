<?php 
require "../source/connection.php"; 
session_start();
if(isset($_SESSION["a"])){
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/png"  href="assets/images/titleLogo.png" />
    <title>Dashboard</title>

    <!-- ========== All CSS files linkup ========= -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/lineicons.css" />
    <link rel="stylesheet" href="assets/css/materialdesignicons.min.css" />
    <link rel="stylesheet" href="assets/css/fullcalendar.css" />
    <link rel="stylesheet" href="assets/css/fullcalendar.css" />
    <link rel="stylesheet" href="assets/css/main.css" />

    <script>
        setTimeout(function() {
            location.reload();
        }, 1800000); // 1800000 milliseconds = 30 minutes
    </script>
</head>

<body>
    <?php require "header.php"; ?>

        <!-- ========== section start ========== -->
        <section class="section">
            <div class="container-fluid">
                <!-- ========== title-wrapper start ========== -->
                <div class="title-wrapper pt-30">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <div class="title mb-30">
                                <h2>Admin Dashboard</h2>
                            </div>
                        </div>
                        <!-- end col -->
                        <div class="col-md-6">
                            <div class="breadcrumb-wrapper mb-30">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item">
                                            <a href="#0">Dashboard</a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">
                                            Home
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->
                </div>
                <!-- ========== title-wrapper end ========== -->
                <div class="row">
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                        <div class="icon-card mb-30">
                            <div class="icon purple">
                                <i class="lni lni-cart-full"></i>
                            </div>
                            <div class="content">
                                <?php
                                $invoice_rs = Database::search("SELECT * FROM `invoice` WHERE `status`='Pendding' ");
                                $invoice_num = $invoice_rs->num_rows;
                                ?>
                                <h6 class="mb-10">New Orders</h6>
                                <h3 class="text-bold mb-10"><?php echo $invoice_num; ?></h3>
                            </div>
                        </div>
                        <!-- End Icon Cart -->
                    </div>
                    <!-- End Col -->
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                        <div class="icon-card mb-30">
                            <div class="icon success">
                                <i class="lni lni-dollar"></i>
                            </div>
                            <div class="content">
                                <?php
                                $d = new DateTime();
                                $tz = new DateTimeZone("Asia/Colombo");
                                $d->setTimezone($tz);
                                $year = $d->format("Y");

                                $income_rs = Database::search("SELECT sum(`total`) AS `in` FROM `invoice` WHERE `date` LIKE '".$year."%' ");
                                $outcome_rs = Database::search("SELECT sum(`total`) AS `out` FROM `invoice` WHERE `status` IN ('refund','cancle') AND `date` LIKE '".$year."%' ");
                                $income = $income_rs->fetch_assoc()["in"] - $outcome_rs->fetch_assoc()["out"];
                                ?>
                                <h6 class="mb-10">Total Income (<?php echo $year; ?>)</h6>
                                <h3 class="text-bold mb-10">Rs.<?php echo $income ?></h3>
                            </div>
                        </div>
                        <!-- End Icon Cart -->
                    </div>
                    <!-- End Col -->
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                        <div class="icon-card mb-30">
                            <div class="icon primary">
                                <i class="lni lni-envelope"></i>
                            </div>
                            <div class="content">
                                <h6 class="mb-10">Messages</h6>
                                <h3 class="text-bold mb-10">0</h3>
                            </div>
                        </div>
                        <!-- End Icon Cart -->
                    </div>
                    <!-- End Col -->
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                        <div class="icon-card mb-30">
                            <div class="icon orange">
                                <i class="lni lni-user"></i>
                            </div>
                            <div class="content">
                                <?php
                                $user_rs = Database::search("SELECT COUNT(`email`) AS `users` FROM `user` WHERE `status_id`='1' ");
                                $user = $user_rs->fetch_assoc();
                                ?>
                                <h6 class="mb-10">Users</h6>
                                <h3 class="text-bold mb-10"><?php echo $user["users"]; ?></h3>
                            </div>
                        </div>
                        <!-- End Icon Cart -->
                    </div>
                    <!-- End Col -->
                </div>
                <!-- End Row -->

                
                <div class="row">
                    <div class="col-lg-7">
                        <div class="card-style mb-30">
                            <div class="title d-flex flex-wrap justify-content-between">
                                <div class="left">
                                    <h6 class="text-medium mb-10">Monthly Income Chart</h6>
                                    <!-- <h3 class="text-bold">$245,479</h3> -->
                                </div>
                            </div>

                            <div class="chart">
                                <canvas id="Chart1" style="width: 100%; height: 400px"></canvas>
                            </div>

                        </div>
                    </div>
                    
                    <div class="col-lg-5">
                        <div class="card-style mb-30">
                            <div class="title d-flex flex-wrap align-items-center justify-content-between ">
                                <div class="left">
                                    <h6 class="text-medium mb-30">Categoty-Items</h6>
                                </div>
                            </div>
                            
                            <div class="chart">
                                <canvas id="Chart2" style="width: 100%; height: 400px"></canvas>
                            </div>
                           
                        </div>
                    </div>
                    
                </div>
                <!-- End Row -->


                <div class="row">

                    <div class="col-lg-12">
                        <div class="card-style mb-30">
                            <div class="
                    title
                    d-flex
                    flex-wrap
                    justify-content-between
                    align-items-center
                  ">
                                <div class="left">
                                    <h6 class="text-medium mb-30">Pendding Orders</h6>
                                </div>

                            </div>
                            <!-- End Title -->
                            <div class="table-responsive">
                                <table class="table top-selling-table">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>
                                                <h6 class="text-sm text-medium">#</h6>
                                            </th>
                                            <th class="min-width">
                                                <h6 class="text-sm text-medium">Name</h6>
                                            </th>
                                            <th class="min-width">
                                                <h6 class="text-sm text-medium">Price</h6>
                                            </th>
                                            <th class="min-width">
                                                <h6 class="text-sm text-medium">Products</h6>
                                            </th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $order_rs = Database::search("SELECT `invoice`.id AS id, fname, lname, total FROM `invoice` INNER JOIN `user` ON `invoice`.user_email=`user`.email WHERE `invoice`.status='Pendding' ");
                                        $order_num = $order_rs->num_rows;

                                        for ($i = 0; $i < $order_num; $i++) {
                                            $order = $order_rs->fetch_assoc();
                                        ?>
                                            <tr>
                                                <td>
                                                    <div class="check-input-primary">
                                                        <input class="form-check-input" type="checkbox" id="checkbox-1" />
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="product">
                                                        <div class="image">
                                                            <img src="../img/usericon.jpg" />
                                                        </div>
                                                        <p class="text-sm"><?php echo $order["id"]; ?></p>
                                                    </div>
                                                </td>
                                                <td>
                                                    <p class="text-sm"><?php echo $order["fname"]." ".$order["lname"]; ?></p>
                                                </td>
                                                <td>
                                                    <p class="text-sm">Rs.<?php echo $order["total"]; ?></p>
                                                </td>
                                                <td>
                                                    <?php 
                                                    $item_rs = Database::search("SELECT COUNT(invoice_id) AS items FROM `invoice_item` WHERE `invoice_id`='".$order["id"]."' ");
                                                    $item = $item_rs->fetch_assoc();
                                                    ?>
                                                    <p class="text-sm"><?php echo $item["items"]; ?></p>
                                                </td>
                                                <td>
                                                    <div class="action justify-content-end">
                                                        <button class="more-btn ml-10 dropdown-toggle" id="moreAction1" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="lni lni-more-alt"></i>
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="moreAction1">
                                                            <li class="dropdown-item">
                                                                <a href="orders.php#<?php echo $order["id"]; ?>" class="text-gray">View</a>
                                                            </li>
                                                            <!-- <li class="dropdown-item">
                                                                <a href="#0" class="text-gray">Edit</a>
                                                            </li> -->
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>

                                    </tbody>
                                </table>
                                <!-- End Table -->
                            </div>
                        </div>
                    </div>
                    <!-- End Col -->
                </div>
                <!-- End Row -->

                
            <!-- end container -->
        </section>
        <!-- ========== section end ========== -->

        <?php require "footer.php"; ?>

        
    </main>
    <!-- ======== main-wrapper end =========== -->

    <!-- ========= All Javascript files linkup ======== -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/Chart.min.js"></script>
    <script src="assets/js/dynamic-pie-chart.js"></script>
    <script src="assets/js/moment.min.js"></script>
    <script src="assets/js/fullcalendar.js"></script>
    <script src="assets/js/jvectormap.min.js"></script>
    <script src="assets/js/world-merc.js"></script>
    <script src="assets/js/polyfill.js"></script>
    <script src="assets/js/main.js"></script>

    <script>
        // ====== calendar activation
        document.addEventListener("DOMContentLoaded", function() {
            var calendarMiniEl = document.getElementById("calendar-mini");
            var calendarMini = new FullCalendar.Calendar(calendarMiniEl, {
                initialView: "dayGridMonth",
                headerToolbar: {
                    end: "today prev,next",
                },
            });
            calendarMini.render();
        });

        // =========== chart one start
        <?php 
        $val = array("0", "100", "0", "0", "400", "0", "300", "0", "0", "0", "0", "0");
        for ($m = 1; $m <= 12; $m++) {
            if ($m >= 10) {
                $dateMonth = $year . "-" . $m;
            } else {
                $dateMonth = $year . "-0" . $m;
            }
            $income_rs = Database::search("SELECT SUM(total) AS total from `invoice` WHERE `date` LIKE '" . $dateMonth . "%' AND `status` IN('completed','pendding') ");
            $income_data = $income_rs->fetch_assoc();

            if ($income_data["total"] == "") {
                $val[$m - 1] = 0;
            } else {
                $val[$m - 1] = $income_data["total"];
            }

        }
        
        ?>

        const ctx1 = document.getElementById("Chart1").getContext("2d");
        const chart1 = new Chart(ctx1, {
            // The type of chart we want to create
            type: "line", // also try bar or other graph types

            // The data for our dataset
            data: {
                labels: [
                    "Jan",
                    "Fab",
                    "Mar",
                    "Apr",
                    "May",
                    "Jun",
                    "Jul",
                    "Aug",
                    "Sep",
                    "Oct",
                    "Nov",
                    "Dec",
                ],
                // Information about the dataset

                datasets: [{
                    label: "",
                    backgroundColor: "transparent",
                    borderColor: "#dc3545",
                    data: [
                        <?php foreach ($val as $value) {
                            echo $value . ",";
                        }
                        ?>
                    ],
                    pointBackgroundColor: "transparent",
                    pointHoverBackgroundColor: "#dc3545",
                    pointBorderColor: "transparent",
                    pointHoverBorderColor: "#fff",
                    pointHoverBorderWidth: 5,
                    pointBorderWidth: 5,
                    pointRadius: 8,
                    pointHoverRadius: 8,
                }, ],
            },

            // Configuration options
            defaultFontFamily: "Inter",
            options: {
                tooltips: {
                    callbacks: {
                        labelColor: function(tooltipItem, chart) {
                            return {
                                backgroundColor: "#ffffff",
                            };
                        },
                    },
                    intersect: false,
                    backgroundColor: "#f9f9f9",
                    titleFontFamily: "Inter",
                    titleFontColor: "#8F92A1",
                    titleFontColor: "#8F92A1",
                    titleFontSize: 12,
                    bodyFontFamily: "Inter",
                    bodyFontColor: "#171717",
                    bodyFontStyle: "bold",
                    bodyFontSize: 16,
                    multiKeyBackground: "transparent",
                    displayColors: false,
                    xPadding: 30,
                    yPadding: 10,
                    bodyAlign: "center",
                    titleAlign: "center",
                },

                title: {
                    display: false,
                },
                legend: {
                    display: false,
                },

                scales: {
                    yAxes: [{
                        gridLines: {
                            display: false,
                            drawTicks: false,
                            drawBorder: false,
                        },
                        ticks: {
                            padding: 35,
                            max: <?php echo max($val); ?>,
                            min: <?php echo min($val); ?>,
                        },
                    }, ],
                    xAxes: [{
                        gridLines: {
                            drawBorder: false,
                            color: "rgba(143, 146, 161, .1)",
                            zeroLineColor: "rgba(143, 146, 161, .1)",
                        },
                        ticks: {
                            padding: 20,
                        },
                    }, ],
                },
            },
        });

        // =========== chart one end

        // =========== chart two start

        <?php
        $categoryList = [];
        $itemCount = [];
        $c_rs = Database::search("SELECT * FROM `category` ");
        
        while ($cdata = $c_rs->fetch_assoc()) {
            $categoryList[] = $cdata["name"];
            
            $items_rs = Database::search("SELECT sum(`invoice_item`.qty) AS items FROM `invoice_item` INNER JOIN product ON `invoice_item`.product_id=`product`.id 
            INNER JOIN `category` ON `category`.id=`product`.category_id WHERE `category`.`name`='".$cdata["name"]."'  ");

            $idata = $items_rs->fetch_assoc()["items"];
            if($idata == null){
                $itemCount[] = 0;
            }else{
                $itemCount[] = $idata;
            }

            }

        ?>

        const ctx2 = document.getElementById("Chart2").getContext("2d");
        const chart2 = new Chart(ctx2, {
            // The type of chart we want to create
            type: "bar", // also try bar or other graph types
            // The data for our dataset
            data: {
                labels: [
                    <?php
                    foreach ($categoryList as $value) {
                            echo "'".$value."',";
                        }
                    ?>
                ],
                // Information about the dataset
                datasets: [{
                    label: "",
                    backgroundColor: "#dc3545",
                    barThickness: 6,
                    maxBarThickness: 8,
                    data: [
                        <?php foreach ($itemCount as $value) {
                            echo $value . ",";
                        }
                        ?>
                    ],
                }, ],
            },
            // Configuration options
            options: {
                borderColor: "#F3F6F8",
                borderWidth: 15,
                backgroundColor: "#F3F6F8",
                tooltips: {
                    callbacks: {
                        labelColor: function(tooltipItem, chart) {
                            return {
                                backgroundColor: "#dc3545",
                            };
                        },
                    },
                    backgroundColor: "#F3F6F8",
                    titleFontColor: "#8F92A1",
                    titleFontSize: 12,
                    bodyFontColor: "#171717",
                    bodyFontStyle: "bold",
                    bodyFontSize: 16,
                    multiKeyBackground: "transparent",
                    displayColors: false,
                    xPadding: 30,
                    yPadding: 10,
                    bodyAlign: "center",
                    titleAlign: "center",
                },

                title: {
                    display: false,
                },
                legend: {
                    display: false,
                },

                scales: {
                    yAxes: [{
                        gridLines: {
                            display: false,
                            drawTicks: false,
                            drawBorder: false,
                        },
                        ticks: {
                            padding: 35,
                            max: <?php echo max($itemCount); ?>,
                            min: <?php echo min($itemCount); ?>,
                        },
                    }, ],
                    xAxes: [{
                        gridLines: {
                            display: false,
                            drawBorder: false,
                            color: "rgba(143, 146, 161, .1)",
                            zeroLineColor: "rgba(143, 146, 161, .1)",
                        },
                        ticks: {
                            padding: 20,
                        },
                    }, ],
                },
            },
        });
        // =========== chart two end
    </script>

    <script src="assets/js/script.js"></script>
</body>

</html>
<?php
}else{
    header("Location: index.php");
}
?>