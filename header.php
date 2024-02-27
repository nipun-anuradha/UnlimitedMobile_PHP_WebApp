<!-- HEADER -->
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
                        <a href="index.php" class="logo">
                            <img src="./img/logo.png" alt="">
                        </a>
                    </div>
                </div>
                <!-- /LOGO -->

                <!-- SEARCH BAR -->
                <div class="col-md-6">
                    <div class="header-search">
                        <form>
                            <select class="input-select" id="c">
                                <option value="0">All Categories</option>
                                <?php
                                $category_rs = Database::search("SELECT * FROM `category` ");
                                $category_num = $category_rs->num_rows;
                                for ($c = 0; $c < $category_num; $c++) {
                                    $c_date = $category_rs->fetch_assoc();
                                ?>
                                    <option value="<?php echo $c_date["id"] ?>"><?php echo $c_date["name"] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                            <input class="input" id="stxt" placeholder="Search here">
                            <button type="button" class="search-btn" onclick="headerSearch();">Search</button>
                        </form>
                    </div>
                </div>
                <!-- /SEARCH BAR -->

                <!-- ACCOUNT -->
                <div class="col-md-12 col-lg-3 clearfix">
                    <div class="row">
                        <div class="header-ctn">
                            <!-- a -->
                            <div class="dropdown">
                                <a href="" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                    <i class="fa fa-user-o"></i>
                                    <?php
                                    // session_start();
                                    if (isset($_SESSION["u"])) {
                                    ?>
                                        <span><?php echo $_SESSION["u"]["fname"]; ?></span>
                                </a>
                                <div class="cart-dropdown account-dropdown">
                                    <a href="My-Account/profile.php">
                                        <div>My Account</div>
                                    </a><br>
                                    <a>
                                        <div style="cursor: pointer;" onclick="signOut();">Sign Out</div>
                                    </a>
                                </div>
                            <?php
                                    } else {
                            ?>
                                <a href="My-Account/index.php">My Account</a>
                            <?php
                                    }
                            ?>
                            </div>
                            <!-- /a -->

                            <!-- Wishlist -->
                            <!-- <div>
                                <a href="#">
                                    <i class="fa fa-heart-o"></i>
                                    <span>Your Wishlist</span>
                                    <?php
                                    // $wlist_rs = Database::search("SELECT COUNT(id) AS count FROM `watchlist` ");
                                    // $wlist = $wlist_rs->fetch_assoc();
                                    // if ($wlist["count"] != 0) {
                                    // ?>
                                    //     <div class="qty"><?php //echo $wlist["count"]; ?></div>
                                    <?php
                                    // }
                                    ?>
                                </a>
                            </div> -->
                            <!-- /Wishlist -->

                            <!-- Cart -->
                            <div class="dropdown">
                                <a href="" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                    <i class="fa fa-shopping-cart"></i>
                                    <span>Your Cart</span>
                                    <?php
                                    if(isset($_SESSION["u"])){
                                        $cart_rs = Database::search("SELECT * FROM `cart` WHERE user_email = '".$_SESSION["u"]["email"]."' ");
                                        $cart_num = $cart_rs->num_rows;

                                    $items = 0;
                                    if ($cart_num != 0 && isset($_SESSION["u"])) {
                                        //cal cart items
                                        $calItem_rs = Database::search("SELECT `cart`.qty AS cqty FROM `cart` INNER JOIN `product` ON `product`.id=`cart`.product_id WHERE `cart`.user_email='".$_SESSION["u"]["email"]."' ");
                                        while($cdata = $calItem_rs->fetch_assoc()){
                                            $items += $cdata["cqty"];
                                        }
                                        //cal cart items
                                    ?>
                                        <div class="qty" id="dditem"><?php echo $items; ?></div>
                                        <div class="cart-dropdown">
                                            <div class="cart-list">
                                                <?php
                                                $total = 0;
                                                $items = 0;
                                                for ($c = 0; $c < $cart_num; $c++) {
                                                    $cart_data = $cart_rs->fetch_assoc();

                                                    $p_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $cart_data["product_id"] . "'");
                                                    $p_data = $p_rs->fetch_assoc();
                                                    $total = $total + ($p_data["price"] * $cart_data["qty"]);

                                                    $img_rs = Database::search("SELECT * FROM `image` WHERE `product_id`='" . $p_data["id"] . "'");
                                                    $img_data = $img_rs->fetch_assoc();

                                                    $items += $cart_data["qty"];
                                                ?>
                                                    <div class="product-widget">
                                                        <div class="product-img">
                                                            <img src="<?php echo $img_data["code"]; ?>">
                                                        </div>
                                                        <div class="product-body">
                                                            <h3 class="product-name"><a style="cursor: pointer;" onclick="window.location = '<?php echo 'product.php?id=' . ($pd['id']) ?>'; "><?php echo $p_data["title"]; ?></a></h3>
                                                            <h4 class="product-price"><span class="qty" id="ddqty<?php echo $cart_data["product_id"]; ?>"><?php echo $cart_data["qty"]; ?>x</span>Rs.<?php echo $p_data["price"]; ?>.00</h4>
                                                        </div>
                                                        <button class="delete" onclick="deleteFromCart(<?php echo $cart_data['id']; ?>);"><i class="fa fa-close"></i></button>
                                                    </div>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                            <div class="cart-summary">
                                                <small><span id="sitem"><?php echo $items; ?></span> Item(s) selected</small>
                                                <h5 id="ddtotal">SUBTOTAL: Rs.<?php echo $total; ?>.00</h5>
                                            </div>
                                            <div class="cart-btns">
                                                <a href="cart.php" >View Cart</a>
                                                <a style="cursor: pointer;" onclick="checkout();">Checkout <i class="fa fa-arrow-circle-right"></i></a>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                }
                                    ?>

                                </a>
                            </div>
                            <!-- /Cart -->

                            <!-- Menu Toogle -->
                            <div class="menu-toggle">
                                <a href="#">
                                    <i class="fa fa-bars"></i>
                                    <span>Menu</span>
                                </a>
                            </div>
                            <!-- /Menu Toogle -->
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

