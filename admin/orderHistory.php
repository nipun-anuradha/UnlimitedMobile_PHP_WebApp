<?php
require "../source/connection.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/png"  href="assets/images/titleLogo.png" />
    <title>Order History</title>

    <!-- ========== All CSS files linkup ========= -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/lineicons.css" />
    <link rel="stylesheet" href="assets/css/materialdesignicons.min.css" />
    <link rel="stylesheet" href="assets/css/fullcalendar.css" />
    <link rel="stylesheet" href="assets/css/main.css" />

    <style>
        .container {
            position: relative;
            overflow: hidden;
            width: 100%;
            padding-top: 56.25%;
            /* 16:9 Aspect Ratio (divide 9 by 16 = 0.5625) */
        }

        /* Then style the iframe to fit in the container div with full height and width */

        .responsive-iframe {
            position: absolute;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            width: 100%;
            height: 100%;
        }
    </style>
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
                            <div class="titlemb-30">
                                <h2>Order History</h2>
                            </div>
                        </div>
                        <!-- end col -->
                        <div class="col-md-6">
                            <div class="breadcrumb-wrapper mb-30">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item">
                                            <a href="dashboard.php">Dashboard</a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">
                                            Orders
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
            </div>
            <!-- end container -->
        </section>
        <!-- ========== section end ========== -->




        <!-- ========== table components start ========== -->
        <section class="table-components">
            <div class="container-fluid">

                <!-- ========== tables-wrapper start ========== -->
                <div class="tables-wrapper">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card-style mb-30">
                                <h6 class="mb-10">Filter Options:</h6>
                                <!-- <p class="text-sm mb-20">
                                    For basic styling—light padding and only horizontal dividers—use the class table.
                                </p> -->
                                <div class="row">
                                    <div class="col-10 col-lg-3">
                                        <input type="text" class="form-control form-control-sm" placeholder="Order ID" id="st">
                                    </div>
                                    <div class="col-2 col-lg-2">
                                        <button class="btn btn-dark" onclick="orderSearch('h');"><i class="lni lni-search"></i></button>
                                    </div>
                                </div>



                                <div class="table-wrapper table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <h6>ID</h6>
                                                </th>
                                                <th>
                                                    <h6>Product</h6>
                                                </th>
                                                <th>
                                                    <h6>Brand</h6>
                                                </th>
                                                <th>
                                                    <h6>Model</h6>
                                                </th>
                                                <th>
                                                    <h6>Qty</h6>
                                                </th>
                                                <th>
                                                    <h6>Billing Address</h6>
                                                </th>
                                                <!-- <th>
                                                    <h6>Shipping Address</h6>
                                                </th> -->
                                                <th>
                                                    <h6>Status</h6>
                                                </th>
                                                <th></th>
                                            </tr>
                                            <!-- end table row-->
                                        </thead>
                                        <tbody id="tbody">
                                            <?php
                                            $order_rs = Database::search("SELECT `date`, `invoice`.`status`, `invoice`.id AS oid, `product`.id AS pid, `product`.title, `brand`.name AS bname, `model`.name AS mname, `invoice_item`.qty, fname, lname,
                                            line1, line2, city, postal_code, `distric`.name AS dname, `province`.name AS pname, contact_no FROM `invoice` INNER JOIN `invoice_item` ON `invoice`.id = `invoice_item`.invoice_id
                                            INNER JOIN `product` ON `invoice_item`.product_id = `product`.id INNER JOIN `model_has_brand` ON 
                                            `product`.model_has_brand_id = `model_has_brand`.id INNER JOIN `model` ON `model_has_brand`.model_id=`model`.id
                                            INNER JOIN `brand` ON `model_has_brand`.brand_id=`brand`.id INNER  JOIN `user_has_address` ON 
                                            `invoice`.user_has_address_id=`user_has_address`.id INNER JOIN `distric` ON `distric`.id=`user_has_address`.distric_id 
                                            INNER JOIN `province` ON `province`.id=`distric`.province_id WHERE `invoice`.status IN ('refund','cancle','completed') ORDER BY `invoice`.id desc");


                                            $order_num = $order_rs->num_rows;
                                            $prevId = "";

                                            for ($p = 0; $p < $order_num; $p++) {
                                                $order = $order_rs->fetch_assoc();

                                                //-
                                                $item_rs = Database::search("SELECT COUNT(invoice_id) AS items FROM `invoice_item` WHERE `invoice_id`='" . $order["oid"] . "' ");
                                                $item = $item_rs->fetch_assoc()["items"];
                                                //-

                                                //group items in same order
                                                $currentId = $order["oid"];
                                                if ($prevId != $currentId) {
                                            ?>
                                                    <tr>
                                                        <td colspan="7">
                                                            <hr>
                                                        </td>
                                                    </tr>
                                                <?php
                                                }

                                                //group items in same order

                                                ?>
                                                <tr>
                                                    <?php 
                                                    if ($prevId != $currentId) {
                                                    ?>
                                                    <td <?php if ($item > 1) {echo "rowspan= '" . $item . "' ";} ?>>
                                                        <p><?php echo $order["oid"]; ?></p>
                                                    </td>
                                                    <?php
                                                    }
                                                    ?>

                                                    <td class="min-width">
                                                        <div class="lead">
                                                            <div class="lead-image">
                                                                <?php
                                                                $image_rs = Database::search("SELECT code FROM `image` WHERE product_id = '" . $order["pid"] . "' ");
                                                                $image = $image_rs->fetch_assoc();
                                                                ?>
                                                                <img src="../<?php echo $image["code"]; ?>" />
                                                            </div>
                                                            <div class="lead-text">
                                                                <p><?php echo $order["title"]; ?></p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="min-width">
                                                        <p><a href="#0"><?php echo $order["bname"]; ?></a></p>
                                                    </td>
                                                    <td class="min-width">
                                                        <p><?php echo $order["mname"]; ?></p>
                                                    </td>
                                                    <td>
                                                        <p><?php echo $order["qty"]; ?></p>
                                                    </td>
                                                    <?php
                                                    if ($prevId != $currentId) {

                                                    ?>
                                                        <td class="min-width" <?php if ($item > 1) { echo "rowspan= '" . $item . "' ";} ?>>
                                                            <p><?php echo "<i><b>(".$order["date"].")</b></i><br>". $order["fname"] . " " . $order["lname"] . "<br>" . $order["line1"] . ", " . $order["line2"] . "<br>" . $order["city"] . "<br>" .
                                                                    $order["pname"] . "<br>".$order["dname"] . "<br>".$order["postal_code"] . "<br>" . $order["contact_no"]; ?></p>
                                                        </td>
                                                        <td <?php if ($item > 1) {echo "rowspan= '" . $item . "' ";} ?>>
                                                        <?PHP
                                                            if ($order["status"] == 'refund') {
                                                            ?>
                                                                    <span class="status-btn warning-btn" >Refund</span>
                                                            <?php
                                                            } else if ($order["status"] == 'cancle') {
                                                            ?>
                                                                    <span class="status-btn close-btn">Canceled</span>
                                                            <?php
                                                            } else if ($order["status"] == 'completed') {
                                                            ?>
                                                                    <span class="status-btn success-btn">Completed</span>
                                                            <?php
                                                            }
                                                        ?>
                                                        </td>
                                                        <td class="min-width" <?php if ($item > 1) { echo "rowspan= '" . $item . "' ";} ?>>
                                                        <div class="action justify-content-end">
                                                            <button class="more-btn ml-10 dropdown-toggle" id="moreAction1" data-bs-toggle="dropdown" aria-expanded="false">
                                                                <i class="lni lni-more-alt"></i>
                                                            </button>
                                                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="moreAction1">
                                                                <li class="dropdown-item">
                                                                    <a href="#0" class="text-gray" onclick="changeOrderState(<?php echo $order['oid']; ?> , 'R');">Refund</a>
                                                                </li>
                                                                <li class="dropdown-item">
                                                                    <a href="#0" class="text-gray" onclick="changeOrderState(<?php echo $order['oid']; ?> , 'Ca');">Cancle</a>
                                                                </li>
                                                                <li class="dropdown-item">
                                                                    <a href="#0" class="text-gray" onclick="changeOrderState(<?php echo $order['oid']; ?> , 'Co');">Completed</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                    <?php
                                                    }
                                                    $prevId = $currentId;
                                                    ?>
                                                </tr>
                                            <?php
                                            }
                                            ?>

                                        </tbody>
                                    </table>
                                    <!-- end table -->
                                </div>
                            </div>
                            <!-- end card -->
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->




                </div>
                <!-- ========== tables-wrapper end ========== -->
            </div>
            <!-- end container -->
        </section>
        <!-- ========== table components end ========== -->

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

    <script src="assets/js/script.js"></script>
</body>

</html>