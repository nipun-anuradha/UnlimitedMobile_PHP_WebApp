<?php
require "source/connection.php";
session_start();
if (isset($_SESSION["u"])) {
?>


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" href="img/titleLogo.png" />

        <title>Unlimited Mobile | Checkout</title>

        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">


        <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />
        <link type="text/css" rel="stylesheet" href="css/slick.css" />
        <link type="text/css" rel="stylesheet" href="css/slick-theme.css" />
        <link type="text/css" rel="stylesheet" href="css/nouislider.min.css" />
        <link rel="stylesheet" href="css/font-awesome.min.css">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

        <link type="text/css" rel="stylesheet" href="css/style.css" />


    </head>

    <body>
        <?php
        require "header.php";
        ?>

        <!-- BREADCRUMB -->
        <div id="breadcrumb" class="section">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="breadcrumb-header">Checkout</h3>
                        <ul class="breadcrumb-tree">
                            <li><a href="#">Home</a></li>
                            <li class="active">Checkout</li>
                        </ul>
                    </div>
                </div>
                <!-- /row -->
            </div>
            <!-- /container -->
        </div>
        <!-- /BREADCRUMB -->

        <!-- SECTION -->
        <div class="section">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row">

                    <div class="col-md-7">
                        <!-- Billing Details -->
                        <div class="billing-details">
                            <div class="section-title">
                                <h3 class="title">Billing address</h3>
                            </div>
                            <div class="form-group">
                                <input class="input" type="text" id="fname" placeholder="First Name">
                            </div>
                            <div class="form-group">
                                <input class="input" type="text" id="lname" placeholder="Last Name">
                            </div>
                            <!-- <div class="form-group">
                                <input class="input" type="email" id="mail" placeholder="Email">
                            </div> -->
                            <div class="form-group col-xs-6 col-md-6">
                                <select class="input-select col-xs-12 col-md-12" id="provi">
                                    <option value="0">Province</option>
                                    <?php
                                    $province_rs = Database::search("SELECT * FROM `province` ");
                                    $province_num = $province_rs->num_rows;

                                    for ($x = 0; $x < $province_num; $x++) {
                                        $province_data = $province_rs->fetch_assoc();
                                    ?>
                                        <option value="<?php echo $province_data["id"] ?>"><?php echo $province_data["name"] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-xs-6 col-md-6">
                                <select class="input-select col-xs-12 col-md-12" id="dis">
                                    <option value="0">Distric</option>
                                    <?php
                                    $distric_rs = Database::search("SELECT * FROM `distric` ");
                                    $distric_num = $distric_rs->num_rows;

                                    for ($x = 0; $x < $distric_num; $x++) {
                                        $distric_data = $distric_rs->fetch_assoc();
                                    ?>
                                        <option value="<?php echo $distric_data["id"] ?>"><?php echo $distric_data["name"] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <input class="input" type="text" id="line1" placeholder="Address Line 1">
                            </div>
                            <div class="form-group">
                                <input class="input" type="text" id="line2" placeholder="Address Line 2">
                            </div>
                            <div class="form-group">
                                <input class="input" type="text" id="city" placeholder="City">
                            </div>
                            <div class="form-group">
                                <input class="input" type="text" id="zcode" placeholder="ZIP Code">
                            </div>
                            <div class="form-group">
                                <input class="input" type="tel" id="tel" placeholder="Telephone">
                            </div>
                            <!-- <div class="form-group">
                            <div class="input-checkbox">
                                <input type="checkbox" id="create-account">
                                <label for="create-account">
                                    <span></span>
                                    Create Account?
                                </label>
                                <div class="caption">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.</p>
                                    <input class="input" type="password" name="password" placeholder="Enter Your Password">
                                </div>
                            </div>
                        </div> -->
                        </div>
                        <!-- /Billing Details -->

                        <!-- Shiping Details -->
                        <div class="shiping-details">
                            <div class="section-title">
                                <h3 class="title">Shiping address</h3>
                            </div>
                            <div class="input-checkbox">
                                <input type="checkbox" id="shiping-address" disabled>
                                <label for="shiping-address">
                                    <span></span>
                                    Ship to a diffrent address?
                                </label>
                                <div class="caption">
                                    <div class="form-group">
                                        <input class="input" type="text" id="fname_s" placeholder="First Name">
                                    </div>
                                    <div class="form-group">
                                        <input class="input" type="text" id="lname_s" placeholder="Last Name">
                                    </div>
                                    <div class="form-group col-xs-6 col-md-6">
                                        <select class="input-select col-xs-12 col-md-12" id="provi_s">
                                            <option value="0">Province</option>
                                            <?php
                                            $province_rs = Database::search("SELECT * FROM `province` ");
                                            $province_num = $province_rs->num_rows;

                                            for ($x = 0; $x < $province_num; $x++) {
                                                $province_data = $province_rs->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $province_data["id"] ?>"><?php echo $province_data["name"] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-xs-6 col-md-6">
                                        <select class="input-select col-xs-12 col-md-12" id="dis_s">
                                            <option value="0">Distric</option>
                                            <?php
                                            $distric_rs = Database::search("SELECT * FROM `distric` ");
                                            $distric_num = $distric_rs->num_rows;

                                            for ($x = 0; $x < $distric_num; $x++) {
                                                $distric_data = $distric_rs->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $distric_data["id"] ?>"><?php echo $distric_data["name"] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <input class="input" type="text" id="line1_s" placeholder="Address Line 1">
                                    </div>
                                    <div class="form-group">
                                        <input class="input" type="text" id="line2_s" placeholder="Address Line 2">
                                    </div>
                                    <div class="form-group">
                                        <input class="input" type="text" id="city_s" placeholder="City">
                                    </div>
                                    <div class="form-group">
                                        <input class="input" type="text" id="zcode_s" placeholder="ZIP Code">
                                    </div>
                                    <div class="form-group">
                                        <input class="input" type="tel" id="tel_s" placeholder="Telephone">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Shiping Details -->

                        <!-- Order notes -->
                        <div class="order-notes">
                            <textarea class="input" placeholder="Order Notes" id="note"></textarea>
                        </div>
                        <!-- /Order notes -->
                    </div>

                    <!-- Order Details -->
                    <div class="col-md-5 order-details">
                        <div class="section-title text-center">
                            <h3 class="title">Your Order</h3>
                        </div>
                        <div class="order-summary">
                            <div class="order-col">
                                <div><strong>PRODUCT</strong></div>
                                <div><strong>TOTAL</strong></div>
                            </div>
                            <div class="order-products">
                                <?php
                                $total = 0;
                                if (isset($_SESSION["u"])) {
                                    $uemail = $_SESSION["u"]["email"];
                                    $cart_rs = Database::search("SELECT * FROM `cart` WHERE `user_email`='" . $uemail . "'");
                                    $cart_num = $cart_rs->num_rows;

                                    if ($cart_num != 0) {
                                        $total = 0;

                                        for ($x = 0; $x < $cart_num; $x++) {
                                            $cart_data = $cart_rs->fetch_assoc();

                                            $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $cart_data["product_id"] . "'");
                                            $product_data = $product_rs->fetch_assoc();

                                            $total = $total + ($product_data["price"] * $cart_data["qty"]);
                                ?>
                                            <div class="order-col">
                                                <div><?php echo $cart_data["qty"]; ?>x <?php echo $product_data["title"]; ?></div>
                                                <div>Rs.<?php echo $product_data["price"] * $cart_data["qty"]; ?>.00</div>
                                            </div>
                                <?php
                                        }
                                    }
                                }
                                ?>

                            </div>
                            <div class="order-col">
                                <div>Shiping</div>
                                <div><strong>FREE</strong></div>
                            </div>
                            <div class="order-col">
                                <div><strong>TOTAL</strong></div>
                                <div><strong class="order-total">Rs.<?php echo $total; ?>.00</strong></div>
                            </div>
                        </div>
                        <div class="payment-method">
                            <div class="input-radio">
                                <input type="radio" name="payment" id="payment-1" disabled>
                                <label for="payment-1">
                                    <span></span>
                                    Direct Bank Transfer
                                </label>
                                <div class="caption">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                </div>
                            </div>
                            <div class="input-radio">
                                <input type="radio" name="payment" id="payment-2" checked>
                                <label for="payment-2">
                                    <span></span>
                                    Card Payment
                                </label>
                                <div class="caption">
                                    <p>Get paid online. Pay Securely with any Credit/Debit Visa or MasterCard</p>
                                </div>
                            </div>
                            <!-- <div class="input-radio">
                            <input type="radio" name="payment" id="payment-3">
                            <label for="payment-3">
                                <span></span>
                                Paypal System
                            </label>
                            <div class="caption">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                            </div>
                        </div> -->
                        </div>
                        <div class="input-checkbox">
                            <input type="checkbox" id="terms">
                            <label for="terms">
                                <span></span>
                                I've read and accept the <a href="#">terms & conditions</a>
                            </label>
                        </div>
                        <div class="alert alert-danger hidden" id="msgBox">
                            <strong>Alert!</strong> <span id="msg"></span>
                        </div>
                        <a class="primary-btn order-submit" style="cursor: pointer;" onclick="placeOrder();">Place order</a>
                    </div>
                    <!-- /Order Details -->
                </div>
                <!-- /row -->
            </div>
            <!-- /container -->
        </div>
        <!-- /SECTION -->


        <?php require "footer.php"; ?>

        <div class="loading-overlay" id="loadingOverlay">
        <div class="loading-spinner"></div>

        <!-- jQuery Plugins -->
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/slick.min.js"></script>
        <script src="js/nouislider.min.js"></script>
        <script src="js/jquery.zoom.min.js"></script>
        <script src="js/main.js"></script>

        <script src="script.js"></script>
        <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>


    </script>
    </div>

    </body>

    </html>

<?php
} else {
    header("Location: my-account/index.php");
}
?>



