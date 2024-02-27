<?php
session_start();
require "source/connection.php";

if (isset($_GET["id"])) {

    $pid = $_GET["id"];

    $product_rs = Database::search("SELECT product.id,product.category_id,product.model_has_brand_id,
    product.title,product.price,product.oldPrice,product.qty,product.description,product.condition_id,product.status_id,product.color_id,
    model.name AS mname,brand.name AS bname FROM product 
    INNER JOIN model_has_brand ON model_has_brand.id=product.model_has_brand_id 
    INNER JOIN brand ON brand.id=model_has_brand.brand_id
    INNER JOIN model ON model.id=model_has_brand.model_id
    WHERE product.id='" . $pid . "'");

    $product_num = $product_rs->num_rows;

    if ($product_num == 1) {

        $product_data = $product_rs->fetch_assoc();


?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="shortcut icon" href="img/titleLogo.png" type="image/x-icon" />

            <title>Single Product View</title>

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
            <?php require "header.php"; ?>

            <!-- NAVIGATION -->
            <nav id="navigation">
                <!-- container -->
                <div class="container">
                    <!-- responsive-nav -->
                    <div id="responsive-nav">
                        <!-- NAV -->
                        <ul class="main-nav nav navbar-nav">
                            <li class="active"><a href="#">Home</a></li>
                            <li><a href="#">Hot Deals</a></li>
                            <li><a href="#">Categories</a></li>
                            <li><a href="#">Laptops</a></li>
                            <li><a href="#">Smartphones</a></li>
                            <li><a href="#">Cameras</a></li>
                            <li><a href="#">Accessories</a></li>
                        </ul>
                        <!-- /NAV -->
                    </div>
                    <!-- /responsive-nav -->
                </div>
                <!-- /container -->
            </nav>
            <!-- /NAVIGATION -->

            <!-- BREADCRUMB -->
            <div id="breadcrumb" class="section">
                <!-- container -->
                <div class="container">
                    <!-- row -->
                    <div class="row">
                        <div class="col-md-12">
                            <ul class="breadcrumb-tree">
                                <?php
                                $ct_rs = Database::search("SELECT * FROM `category` WHERE `id`='" . $product_data['category_id'] . "' ");
                                $ct = $ct_rs->fetch_assoc();
                                ?>
                                <li><a href="#">Home</a></li>
                                <li><a href="#">All Categories</a></li>
                                <li><a href="#"><?php echo $ct["name"]; ?></a></li>
                                <li class="active"><?php echo $product_data["title"]; ?></a></li>
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
                        <!-- Product main img -->
                        <div class="col-md-5 col-md-push-2">
                            <div id="product-main-img">
                                <?php
                                $img_rs = Database::search("SELECT * FROM `image` WHERE `product_id`='" . $product_data["id"] . "' ");
                                while ($img = $img_rs->fetch_assoc()) {
                                ?>
                                    <div class="product-preview">
                                        <img src="<?php echo $img["code"]; ?>">
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                        <!-- /Product main img -->

                        <!-- Product thumb imgs -->
                        <div class="col-md-2  col-md-pull-5">
                            <div id="product-imgs">
                                <?php
                                $img_rs = Database::search("SELECT * FROM `image` WHERE `product_id`='" . $product_data["id"] . "' ");
                                while ($img = $img_rs->fetch_assoc()) {
                                ?>
                                    <div class="product-preview">
                                        <img src="<?php echo $img["code"]; ?>">
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                        <!-- /Product thumb imgs -->

                        <!-- Product details -->
                        <div class="col-md-5">
                            <div class="product-details">
                                <h2 class="product-name"><?php echo $product_data["title"]; ?></h2>
                                <div>
                                    <div class="product-rating">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-o"></i>
                                    </div>
                                    <a class="review-link" style="cursor: pointer;" >10 Review(s)</a>
                                </div>
                                <div>
                                    <h3 class="product-price">Rs.<?php echo $product_data["price"]; ?>.00 <?php if ($product_data["oldPrice"] != "") { ?> <del class="product-old-price">Rs.<?php echo $product_data["oldPrice"]; ?>.00</del> <?php } ?></h3>
                                    <?php
                                    if (0 >= $product_data["qty"]) {
                                    ?>
                                        <span class="product-available">Out of Stock</span>
                                    <?php
                                    } else {
                                        ?>
                                        <span class="product-available">In Stock</span>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <!-- <p>< ?php echo $product_data["description"]; ?></p> -->

                                <div class="product-options">
                                    <label>
                                        CONDITION :
                                        <?php
                                        $c_rs = Database::search("SELECT * FROM `condition` WHERE `id`='" . $product_data['condition_id'] . "' ");
                                        $c = $c_rs->fetch_assoc();
                                        echo $c["name"];
                                        ?>
                                    </label>
                                    <?php
                                    if ($product_data["color_id"] != "") {
                                    ?>
                                        <label>
                                            Color :
                                            <!-- <select class="input-select">
                                            <option value="0">Red</option>
                                        </select> -->
                                        <?php
                                        $clr_rs = Database::search("SELECT * FROM `color` WHERE `id`='" . $product_data['color_id'] . "' ");
                                        $clr = $clr_rs->fetch_assoc();
                                        ?>
                                            <span><?php echo $clr["name"]; ?></span>
                                        </label>
                                    <?php
                                    }
                                    ?>

                                </div>

                                <div class="add-to-cart">
                                    <div class="qty-label">
                                        Qty
                                        <div class="input-number">
                                            <input type="number" value="1" id="q">
                                            <span class="qty-up">+</span>
                                            <span class="qty-down">-</span>
                                        </div>
                                    </div>
                                    <button class="add-to-cart-btn" onclick="addToCart(<?php echo $pid; ?>, 'many');"><i class="fa fa-shopping-cart"></i> add to cart</button>
                                </div>

                                <ul class="product-btns">
                                    <li ><a style="cursor: pointer;"><i class="fa fa-heart-o"></i> add to wishlist</a></li>
                                    <!-- <li><a href="#"><i class="fa fa-exchange"></i> add to compare</a></li> -->
                                </ul>

                                <ul class="product-links">
                                    <li>Category:</li>
                                    <li><a style="cursor: pointer;"><?php echo $ct["name"]; ?></a></li>
                                </ul>

                                <!-- <ul class="product-links">
                                    <li>Share:</li>
                                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                    <li><a href="#"><i class="fa fa-envelope"></i></a></li>
                                </ul> -->

                            </div>
                        </div>
                        <!-- /Product details -->

                        <!-- Product tab -->
                        <div class="col-md-12">
                            <div id="product-tab">
                                <!-- product tab nav -->
                                <ul class="tab-nav">
                                    <li class="active"><a data-toggle="tab" href="#tab1">Description</a></li>
                                </ul>
                                <!-- /product tab nav -->

                                <!-- product tab content -->
                                <div class="tab-content">
                                    <!-- tab1  -->
                                    <div id="tab1" class="tab-pane fade in active">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <p><?php echo $product_data["description"]; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /tab1  -->

                                    
                                </div>
                                <!-- /product tab content  -->
                            </div>
                        </div>
                        <!-- /product tab -->
                    </div>
                    <!-- /row -->
                </div>
                <!-- /container -->
            </div>
            <!-- /SECTION -->

            <!-- Section -->
            <div class="section">
                <!-- container -->
                <div class="container">
                    <!-- row -->
                    <div class="row">

                        <div class="col-md-12">
                            <div class="section-title text-center">
                                <h3 class="title">Related Products</h3>
                            </div>
                        </div>

                        <!-- product -->
                        <?php
                        $sp_rs = Database::search("SELECT * FROM `product` WHERE `category_id`='" . $product_data["category_id"] . "' ORDER BY `id` ASC LIMIT 4 OFFSET 0 ");
                        $sp_num = $sp_rs->num_rows;

                        for ($z = 0; $z < $sp_num; $z++) {

                            $sp = $sp_rs->fetch_assoc();
                        ?>
                            <div class="col-md-3 col-xs-6">
                                <div class="product">
                                    <div class="product-img">
                                        <?php
                                        $images = Database::search("SELECT * FROM `image` WHERE `product_id`='" . $sp["id"] . "' ");
                                        $image = $images->fetch_assoc();
                                        ?>
                                        <img src="<?php echo $image["code"]; ?>">
                                    </div>
                                    <div class="product-body">
                                        <?php
                                        $category = Database::search("SELECT * FROM `category` WHERE `id` = '" . $sp["category_id"] . "' ");
                                        $cname = $category->fetch_assoc();
                                        ?>
                                        <p class="product-category"><?php echo $cname["name"] ?></p>
                                        <h3 class="product-name"><a href="#"><?php echo $sp["title"]; ?></a></h3>
                                        <h4 class="product-price">Rs.<?php echo $sp["price"]; ?>.00
                                            <!--<del class="product-old-price">$990.00</del>-->
                                        </h4>
                                        <div class="product-rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-o"></i>
                                        </div>
                                        <div class="product-btns">
                                            <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
                                            <button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
                                            <button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
                                        </div>
                                    </div>
                                    <div class="add-to-cart">
                                        <button class="add-to-cart-btn" onclick="addToCart(<?php echo $sp['id']; ?>, 'one');"><i class="fa fa-shopping-cart"></i> add to cart</button>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                        <!-- /product -->

                    </div>
                    <!-- /row -->
                </div>
                <!-- /container -->
            </div>
            <!-- /Section -->



            <?php require "footer.php"; ?>

            <!-- jQuery Plugins -->
            <script src="js/jquery.min.js"></script>
            <script src="js/bootstrap.min.js"></script>
            <script src="js/slick.min.js"></script>
            <script src="js/nouislider.min.js"></script>
            <script src="js/jquery.zoom.min.js"></script>
            <script src="js/main.js"></script>

            <script src="script.js"></script>

        </body>

        </html>

<?php

    } else {
        echo "Sorry for the inconvenient.";
    }
} else {
    echo "Something went wrong.";
}

?>