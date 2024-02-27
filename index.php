<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    
    <link rel="icon" type="image/png"  href="img/titleLogo.png" />
    <title>Unlimited Mobile</title>

    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">


    <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />
    <link type="text/css" rel="stylesheet" href="css/slick.css" />
    <link type="text/css" rel="stylesheet" href="css/slick-theme.css" />
    <link type="text/css" rel="stylesheet" href="css/nouislider.min.css" />
    <link rel="stylesheet" href="css/font-awesome.min.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <link type="text/css" rel="stylesheet" href="css/style.css" />

</head>

<body onload="startTimer();">

    <?php session_start();
    require "source/connection.php";
    require "header.php";
    ?>

    <!-- NAVIGATION -->
    <nav id="navigation">
        <div>
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#myCarousel" data-slide-to="1"></li>
                    <li data-target="#myCarousel" data-slide-to="2"></li>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    <div class="item active">
                        <img src="img/hotdeal.png" alt="Los Angeles" style="width:100%;">
                    </div>

                    <div class="item">
                        <img src="img/hotdeal.png" alt="Chicago" style="width:100%;">
                    </div>

                    <div class="item">
                        <img src="img/hotdeal.png" alt="New york" style="width:100%;">
                    </div>
                </div>

                <!-- Left and right controls -->
                <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#myCarousel" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>

        <!-- container -->
        <div class="container">
            <!-- responsive-nav -->
            <div id="responsive-nav">
                <!-- NAV -->
                <ul class="main-nav nav navbar-nav">
                    <li class="active"><a href="#">Home</a></li>
                    <li><a href="#"><b>| Advance Search |</b></a></li>
                    <li><a href="#hot-deal">Hot Deals</a></li>
                    <li><a href="#">Smart Watches</a></li>
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

    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- shop -->
                <div class="col-md-4 col-xs-6">
                    <div class="shop">
                        <div class="shop-img">
                            <img src="./img/shop01.png" alt="">
                        </div>
                        <div class="shop-body">
                            <h3>Laptop<br>Collection</h3>
                            <a  class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
                <!-- /shop -->

                <!-- shop -->
                <div class="col-md-4 col-xs-6">
                    <div class="shop">
                        <div class="shop-img">
                            <img src="./img/shop03.png" alt="">
                        </div>
                        <div class="shop-body">
                            <h3>Accessories<br>Collection</h3>
                            <a  class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
                <!-- /shop -->

                <!-- shop -->
                <div class="col-md-4 col-xs-6">
                    <div class="shop">
                        <div class="shop-img">
                            <img src="./img/shop02.png" alt="">
                        </div>
                        <div class="shop-body">
                            <h3>Cameras<br>Collection</h3>
                            <a  class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
                <!-- /shop -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->

    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">

                <!-- section title -->
                <div class="col-md-12">
                    <div class="section-title">
                        <h3 class="title">Newly Added</h3>
                        <div class="section-nav">
                            <ul class="section-tab-nav tab-nav">
                                <li class="active"><a data-toggle="tab" href="#tab1">Laptops</a></li>
                                <li><a data-toggle="tab" href="#tab1">Smartphones</a></li>
                                <li><a data-toggle="tab" href="#tab1">Cameras</a></li>
                                <li><a data-toggle="tab" href="#tab1">Accessories</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /section title -->

                <!-- Products tab & slick -->
                <div class="col-md-12">
                    <div class="row" id="searchResult">

                        <!-- product1 -->
                        <!-- <div class="col-sm-4 col-lg-3 csize">
                            <div class="product">
                                <div class="product-img">
                                    <img src="./img/product01.png" alt="">
                                    <div class="product-label">
                                        <span class="sale">-30%</span>
                                        <span class="new">NEW</span>
                                    </div>
                                </div>
                                <div class="product-body">
                                    <p class="product-category">Category</p>
                                    <h3 class="product-name"><a href="#">product name goes here</a></h3>
                                    <h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
                                    <div class="product-rating">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <div class="product-btns">
                                        <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
                                        <button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
                                        <button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
                                    </div>
                                </div>
                                <div class="add-to-cart">
                                    <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
                                </div>
                            </div>
                        </div> -->
                        <!-- /product -->

                        <!-- product2 -->
                        <!-- <div class="col-sm-4 col-lg-3 csize">
                            <div class="product">
                                <div class="product-img">
                                    <img src="./img/product02.png" alt="">
                                    <div class="product-label">
                                        <span class="new">NEW</span>
                                    </div>
                                </div>
                                <div class="product-body">
                                    <p class="product-category">Category</p>
                                    <h3 class="product-name"><a href="#">product name goes here</a></h3>
                                    <h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
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
                                    <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
                                </div>
                            </div>
                        </div> -->
                        <!-- /product -->

                        <!-- product3 -->
                        <!-- <div class="col-sm-4 col-lg-3 csize">
                            <div class="product">
                                <div class="product-img">
                                    <img src="./img/product03.png" alt="">
                                    <div class="product-label">
                                        <span class="sale">-30%</span>
                                    </div>
                                </div>
                                <div class="product-body">
                                    <p class="product-category">Category</p>
                                    <h3 class="product-name"><a href="#">product name goes here</a></h3>
                                    <h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
                                    <div class="product-rating">
                                    </div>
                                    <div class="product-btns">
                                        <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
                                        <button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
                                        <button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
                                    </div>
                                </div>
                                <div class="add-to-cart">
                                    <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
                                </div>
                            </div>
                        </div> -->
                        <!-- /product -->

                        <!-- product -->
                        <?php
                        $products = Database::search("SELECT * FROM `product` WHERE `status_id`='1' ORDER BY `id` DESC LIMIT 8 OFFSET 0 ");
                        $pnum = $products->num_rows;

                        for ($z = 0; $z < $pnum; $z++) {

                            $pd = $products->fetch_assoc();
                        ?>
                            <div class="col-sm-4 col-lg-3 csize">
                                <div class="product">
                                    <div class="product-img">
                                        <?php

                                        $images = Database::search("SELECT * FROM `image` WHERE `product_id`='" . $pd["id"] . "' ");
                                        $image = $images->fetch_assoc();
                                        ?>
                                        <img src="<?php echo $image["code"]; ?>">
                                    </div>
                                    <div class="product-body">
                                        <?php
                                        $category = Database::search("SELECT * FROM `category` WHERE `id` = '" . $pd["category_id"] . "' ");
                                        $cname = $category->fetch_assoc();
                                        ?>
                                        <p class="product-category"><?php echo $cname["name"] ?></p>
                                        <h3 class="product-name"><a style="cursor: pointer;" onclick="window.location = '<?php echo 'product.php?id=' . ($pd['id']) ?>'; "><?php echo $pd["title"]; ?></a></h3>
                                        <h4 class="product-price">Rs.<?php echo $pd["price"]; ?>.00
                                            <?php
                                            if ($pd["oldPrice"] != "") {
                                            ?>
                                                <del class="product-old-price">Rs.<?php echo $pd["oldPrice"]; ?>.00</del>
                                            <?php
                                            }
                                            ?>
                                        </h4>
                                        <div class="product-rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <div class="product-btns">
                                            <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
                                            <button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
                                            <button class="quick-view" onclick="window.location = '<?php echo 'product.php?id=' . ($pd['id']) ?>'; "><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
                                        </div>
                                    </div>
                                    <div class="add-to-cart">
                                        <button class="add-to-cart-btn" onclick="addToCart(<?php echo $pd['id']; ?>);"><i class="fa fa-shopping-cart"></i> add to cart</button>
                                    </div>
                                    <!-- /product -->
                                </div>
                            </div>
                        <?php
                        }
                        ?>

                    </div>
                </div>
                <!-- Products tab & slick -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->

    <!-- HOT DEAL SECTION -->
    <div id="hot-deal" class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="hot-deal">
                        <ul class="hot-deal-countdown">
                            <li>
                                <div>
                                    <h3 id="d">00</h3>
                                    <span>Days</span>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <h3 id="h">00</h3>
                                    <span>Hours</span>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <h3 id="m">00</h3>
                                    <span>Mins</span>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <h3 id="s">00</h3>
                                    <span>Secs</span>
                                </div>
                            </li>
                        </ul>
                        <h2 class="text-uppercase">hot deal this week</h2>
                        <p>New Collection Up to 50% OFF</p>
                        <a class="primary-btn cta-btn" href="#">Shop now</a>
                    </div>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /HOT DEAL SECTION -->

    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">

                <!-- section title -->
                <div class="col-md-12">
                    <div class="section-title">
                        <h3 class="title">All Products</h3>
                        <div class="section-nav">
                            <ul class="section-tab-nav tab-nav">
                                <li class="active"><a data-toggle="tab" href="#tab2">Laptops</a></li>
                                <li><a data-toggle="tab" href="#tab2">Smartphones</a></li>
                                <li><a data-toggle="tab" href="#tab2">Cameras</a></li>
                                <li><a data-toggle="tab" href="#tab2">Accessories</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /section title -->

                <!-- Products tab & slick -->
                <div class="col-md-12">
                    <div class="row">
                        <div class="products-tabs">
                            <!-- tab -->
                            <div id="tab2" class="tab-pane fade in active">
                                <div class="products-slick" data-nav="#slick-nav-2">

                                    <!-- product -->
                                    <?php
                                    $products = Database::search("SELECT * FROM `product` WHERE `status_id`='1' ORDER BY `id` ASC LIMIT 8 OFFSET 0 ");
                                    $pnum = $products->num_rows;

                                    for ($z = 0; $z < $pnum; $z++) {

                                        $pd = $products->fetch_assoc();
                                    ?>
                                        <div class="product">
                                            <div class="product-img">
                                                <?php

                                                $images = Database::search("SELECT * FROM `image` WHERE `product_id`='" . $pd["id"] . "' ");
                                                $image = $images->fetch_assoc();
                                                ?>
                                                <img src="<?php echo $image["code"]; ?>">
                                            </div>
                                            <div class="product-body">
                                                <?php
                                                $category = Database::search("SELECT * FROM `category` WHERE `id` = '" . $pd["category_id"] . "' ");
                                                $cname = $category->fetch_assoc();
                                                ?>
                                                <p class="product-category"><?php echo $cname["name"] ?></p>
                                                <h3 class="product-name"><a style="cursor: pointer;" onclick="window.location = '<?php echo 'product.php?id=' . ($pd['id']) ?>'; "><?php echo $pd["title"]; ?></a></h3>
                                                <h4 class="product-price">Rs.<?php echo $pd["price"]; ?>.00
                                                    <?php
                                                    if ($pd["oldPrice"] != "") {
                                                    ?>
                                                        <del class="product-old-price">Rs.<?php echo $pd["oldPrice"]; ?>.00</del>
                                                    <?php
                                                    }
                                                    ?>
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
                                                    <button class="quick-view"  onclick="window.location = '<?php echo 'product.php?id=' . ($pd['id']) ?>'; "><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
                                                </div>
                                            </div>
                                            <div class="add-to-cart">
                                                <button class="add-to-cart-btn" onclick="addToCart(<?php echo $pd['id']; ?>);"><i class="fa fa-shopping-cart"></i> add to cart</button>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                    <!-- /product -->

                                </div>
                                <div id="slick-nav-2" class="products-slick-nav"></div>
                            </div>
                            <!-- /tab -->
                        </div>
                    </div>
                </div>
                <!-- /Products tab & slick -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->

    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-4 col-xs-6">
                    <div class="section-title">
                        <h4 class="title">Headphones & Audio</h4>
                        <div class="section-nav">
                            <div id="slick-nav-3" class="products-slick-nav"></div>
                        </div>
                    </div>

                    <div class="products-widget-slick" data-nav="#slick-nav-3">
                        <?php
                        $product_rs = Database::search("SELECT * FROM `product`  ");
                        $product_num = $product_rs->num_rows;

                        $number_of_pages = ceil($product_num / 3);

                        for ($x = 0; $x < $number_of_pages; $x++) {
                            $offset = 3 * $x;
                        ?>
                            <div>
                                <?php
                                $products = Database::search("SELECT * FROM `product` WHERE `status_id`='1' LIMIT 3 OFFSET " . $offset . " ");
                                $pnum = $products->num_rows;

                                for ($z = 0; $z < $pnum; $z++) {

                                    $pd = $products->fetch_assoc();
                                ?>
                                    <!-- product widget -->
                                    <div class="product-widget">
                                        <div class="product-img">
                                            <?php

                                            $images = Database::search("SELECT * FROM `image` WHERE `product_id`='" . $pd["id"] . "' ");
                                            $image = $images->fetch_assoc();
                                            ?>
                                            <img src="<?php echo $image["code"]; ?>">
                                        </div>
                                        <div class="product-body">
                                            <?php
                                            $category = Database::search("SELECT * FROM `category` WHERE `id` = '" . $pd["category_id"] . "' ");
                                            $cname = $category->fetch_assoc();
                                            ?>
                                            <p class="product-category"><?php echo $cname["name"] ?></p>
                                            <h3 class="product-name"><a style="cursor: pointer;" onclick="window.location = '<?php echo 'product.php?id=' . ($pd['id']) ?>'; "><?php echo $pd["title"] ?></a></h3>
                                            <h4 class="product-price">Rs.<?php echo $pd["price"] ?>.00</h4>
                                        </div>
                                    </div>
                                    <!-- /product widget -->
                                <?php
                                }
                                ?>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>

                <div class="col-md-4 col-xs-6">
                    <div class="section-title">
                        <h4 class="title">Accessories</h4>
                        <div class="section-nav">
                            <div id="slick-nav-4" class="products-slick-nav"></div>
                        </div>
                    </div>

                    <div class="products-widget-slick" data-nav="#slick-nav-4">
                        <?php
                        $product_rs = Database::search("SELECT * FROM `product` WHERE `category_id` = '9' ");
                        $product_num = $product_rs->num_rows;

                        $number_of_pages = ceil($product_num / 3);

                        for ($x = 0; $x < $number_of_pages; $x++) {
                            $offset = 3 * $x;
                        ?>
                            <div>
                                <?php
                                $products = Database::search("SELECT * FROM `product` WHERE `status_id`='1' AND `category_id` = '9' LIMIT 3 OFFSET " . $offset . " ");
                                $pnum = $products->num_rows;

                                for ($z = 0; $z < $pnum; $z++) {

                                    $pd = $products->fetch_assoc();
                                ?>
                                    <!-- product widget -->
                                    <div class="product-widget">
                                        <div class="product-img">
                                            <?php

                                            $images = Database::search("SELECT * FROM `image` WHERE `product_id`='" . $pd["id"] . "' ");
                                            $image = $images->fetch_assoc();
                                            ?>
                                            <img src="<?php echo $image["code"]; ?>">
                                        </div>
                                        <div class="product-body">
                                            <?php
                                            $category = Database::search("SELECT * FROM `category` WHERE `id` = '" . $pd["category_id"] . "' ");
                                            $cname = $category->fetch_assoc();
                                            ?>
                                            <p class="product-category"><?php echo $cname["name"] ?></p>
                                            <h3 class="product-name"><a style="cursor: pointer;" onclick="window.location = '<?php echo 'product.php?id=' . ($pd['id']) ?>'; "><?php echo $pd["title"] ?></a></h3>
                                            <h4 class="product-price">Rs.<?php echo $pd["price"] ?>.00</h4>
                                        </div>
                                    </div>
                                    <!-- /product widget -->
                                <?php
                                }
                                ?>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>

                <div class="clearfix visible-sm visible-xs"></div>

                <div class="col-md-4 col-xs-6">
                    <div class="section-title">
                        <h4 class="title">Smartwatches</h4>
                        <div class="section-nav">
                            <div id="slick-nav-5" class="products-slick-nav"></div>
                        </div>
                    </div>

                    <div class="products-widget-slick" data-nav="#slick-nav-5">
                        <?php
                        $product_rs = Database::search("SELECT * FROM `product` WHERE `category_id` = '1' ");
                        $product_num = $product_rs->num_rows;

                        $number_of_pages = ceil($product_num / 3);

                        for ($x = 0; $x < $number_of_pages; $x++) {
                            $offset = 3 * $x;
                        ?>
                            <div>
                                <?php
                                $products = Database::search("SELECT * FROM `product` WHERE `status_id`='1' AND `category_id` = '1' LIMIT 3 OFFSET " . $offset . " ");
                                $pnum = $products->num_rows;

                                for ($z = 0; $z < $pnum; $z++) {

                                    $pd = $products->fetch_assoc();
                                ?>
                                    <!-- product widget -->
                                    <div class="product-widget">
                                        <div class="product-img">
                                            <?php

                                            $images = Database::search("SELECT * FROM `image` WHERE `product_id`='" . $pd["id"] . "' ");
                                            $image = $images->fetch_assoc();
                                            ?>
                                            <img src="<?php echo $image["code"]; ?>">
                                        </div>
                                        <div class="product-body">
                                            <?php
                                            $category = Database::search("SELECT * FROM `category` WHERE `id` = '" . $pd["category_id"] . "' ");
                                            $cname = $category->fetch_assoc();
                                            ?>
                                            <p class="product-category"><?php echo $cname["name"] ?></p>
                                            <h3 class="product-name"><a style="cursor: pointer;" onclick="window.location = '<?php echo 'product.php?id=' . ($pd['id']) ?>'; "><?php echo $pd["title"] ?></a></h3>
                                            <h4 class="product-price">Rs.<?php echo $pd["price"] ?>.00</h4>
                                        </div>
                                    </div>
                                    <!-- /product widget -->
                                <?php
                                }
                                ?>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>

            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->


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