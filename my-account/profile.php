<?php
require "../source/connection.php";
session_start();
if (isset($_SESSION["u"])) {
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png"  href="../img/titleLogo.png" />

        <title>My Profile</title>

        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">


        <link type="text/css" rel="stylesheet" href="../css/bootstrap.min.css" />
        <link type="text/css" rel="stylesheet" href="../css/slick.css" />
        <link type="text/css" rel="stylesheet" href="../css/slick-theme.css" />
        <link type="text/css" rel="stylesheet" href="../css/nouislider.min.css" />
        <link rel="stylesheet" href="../css/font-awesome.min.css">
        <link rel="stylesheet" href="../admin/assets/css/lineicons.css" />

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

        <link type="text/css" rel="stylesheet" href="../css/style.css" />
        <link type="text/css" rel="stylesheet" href="../css/profile-style.css" />

    </head>

    <body>
        <header>

            <!-- MAIN HEADER -->
            <div id="header">
                <!-- container -->
                <div class="container-fluid">
                    <!-- row -->
                    <div class="row">
                        <!-- LOGO -->
                        <div class="col-md-3">
                            <div class="header-logo">
                                <a href="../index.php" class="logo">
                                    <img src="../img/logo.png" alt="">
                                </a>
                            </div>
                        </div>
                        <!-- /LOGO -->


                        <!-- ACCOUNT -->
                        <div class="offset-lg-5 col-md-12 col-lg-4 d-flex justify-content-end clearfix">
                            <div class="row">
                                <div class="header-ctn">
                                    <!-- home -->
                                    <div>
                                        <a href="../index.php">
                                            <i class="fa fa-home"></i>
                                            <span>Home</span>
                                        </a>
                                    </div>
                                    <!-- /home -->

                                    <!-- a -->
                                    <div>
                                        <a href="#" onclick="signOut();">
                                            <i class="fa fa-user-o"></i>
                                            <span>My Account</span>
                                        </a>
                                    </div>
                                    <!-- /a -->

                                    <!-- Wishlist -->
                                    <div>
                                        <a href="#">
                                            <i class="fa fa-heart-o"></i>
                                            <span>Your Wishlist</span>
                                        </a>
                                    </div>
                                    <!-- /Wishlist -->

                                    <!-- cart -->
                                    <!-- Cart -->
                                    <div class="dropdown">
                                        <a href="../cart.php" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                            <i class="fa fa-shopping-cart"></i>
                                            <span>Your Cart</span>
                                            <?php
                                            $cart_rs = Database::search("SELECT * FROM `cart` ");
                                            $cart_num = $cart_rs->num_rows;

                                            $items = 0;
                                            if ($cart_num != 0 && isset($_SESSION["u"])) {
                                                //cal cart items
                                                $calItem_rs = Database::search("SELECT `cart`.qty AS cqty FROM `cart` INNER JOIN `product` ON `product`.id=`cart`.product_id WHERE `cart`.user_email='" . $_SESSION["u"]["email"] . "' ");
                                                while ($cdata = $calItem_rs->fetch_assoc()) {
                                                    $items += $cdata["cqty"];
                                                }
                                                //cal cart items
                                            ?>
                                                <div class="qty" id="dditem"><?php echo $items; ?></div>

                                            <?php
                                            }
                                            ?>

                                        </a>
                                    </div>
                                    <!-- /Cart -->
                                    <!-- /cart -->

                                </div>
                            </div>

                        </div>
                        <!-- /ACCOUNT -->
                    </div>
                    <!-- row -->
                </div>
                <!-- container -->
            </div>
            <!-- /MAIN HEADER -->
        </header>
        <!-- /HEADER -->


        <div class="container mb-4 main-container">
            <div class="row">
                <div class="col-lg-4 pb-5">
                    <!-- Account Sidebar-->
                    <?php
                    $user = $_SESSION["u"];
                    ?>
                    <div class="author-card pb-3">
                        <div class="author-card-cover" style="background-image: url(../img/profilebkg.png);"></div>
                        <div class="author-card-profile">
                            <div class="author-card-avatar"><img src="../img/SINGLElogo.png">
                            </div>
                            <div class="author-card-details">
                                <h5 class="author-card-name text-lg"><?php echo $user['fname'] . " " . $user['lname']; ?></h5><span class="author-card-position"><?php echo $user['email']; ?></span>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="wizard">
                        <nav class="list-group list-group-flush">
                            <a class="list-group-item " href="#">
                                <div class="d-flex justify-content-between ">
                                    <div>name</div>
                                    <div>name</div>
                                    <div>name</div>
                                    <div>name</div>
                                </div>
                            </a>
                        </nav>
                    </div> -->
                </div>
                <!-- Orders Table-->
                <div class="col-lg-8 pb-5">
                    <div class="d-flex justify-content-end pb-3">
                        <div class="form-inline">
                            <label class="text-muted mr-3" for="order-sort">Sort Orders</label>
                            <select class="form-control" id="order-sort">
                                <option>All</option>
                                <option>Delivered</option>
                                <option>In Progress</option>
                                <option>Refuned</option>
                                <option>Canceled</option>
                            </select>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Order #</th>
                                    <th>Date Purchased</th>
                                    <th>Status</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $order_rs = Database::search("SELECT * FROM `invoice` WHERE user_email = '" . $user['email'] . "' ");
                                while ($details = $order_rs->fetch_assoc()) {
                                ?>
                                    <tr id="<?php echo 'R'.$details['id']; ?>">
                                        <td><a class="navi-link" href="#order-details" data-toggle="modal"><?php echo $details['id']; ?></a></td>
                                        <td><?php $date = new DateTime($details['date']); echo $date->format('Y-m-d'); ?></td>
                                        <td><span class="badge m-0">
                                            <?php
                                            if($details['status']=='completed'){
                                                echo 'Delivered';
                                            }else if($details['status']=='Pendding'){
                                                echo 'In Progress';
                                            }else if($details['status']=='cancle'){
                                                echo 'Cancle';
                                            }else if($details['status']=='refund'){
                                                echo 'Refuned';
                                            }else if($details['status']=='NotPay'){
                                                ?>
                                                Pendding Payment <button class="btn btn-warning" onclick="panddingPayment(<?php echo $details['id']; ?>);">PayNow</button>
                                                <?php
                                            }
                                            ?>
                                        </span></td>
                                        <td><span><?php echo $details['total']; ?></span></td>
                                        <td><button class="btn" onclick="deleteOrder(<?php echo $details['id']; ?>);"><i class="lni lni-close text-danger" ></i></button></td>
                                    </tr>
                                <?php
                                }
                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="loading-overlay" id="loadingOverlay">
        <div class="loading-spinner"></div>




        <script src="../script.js"></script>
        <script src="script.js"></script>
        <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
    </body>

    </html>

<?php

}
?>