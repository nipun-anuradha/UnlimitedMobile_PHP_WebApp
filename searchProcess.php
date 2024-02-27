<?php
require "source/connection.php";

$categoryID = $_POST["c"];
$txt = $_POST["t"];

$query = "SELECT * FROM `product` ";

if(preg_match('/[!@#$%^&*()_+{}\[\]:;<>,.?~\\/-\'"]/', $txt)){
    echo "Input should not contain special characters";
}else if (!empty($txt) && $categoryID == 0) {
    $query .= "WHERE `title` LIKE '%" . $txt . "%' ";
} else if (empty($txt) && $categoryID != 0) {
    $query .= "WHERE `category_id` ='" . $categoryID . "' ";
} else if (!empty($txt) && $categoryID != 0) {
    $query .= "WHERE `title` LIKE '%" . $txt . "%' AND `category_id` ='" . $categoryID . "' ";
}

// echo "empty";

$products = Database::search($query);
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
                <h3 class="product-name"><a href="#"><?php echo $pd["title"]; ?></a></h3>
                <h4 class="product-price">Rs.<?php echo $pd["price"]; ?>.00
                    <!--<del class="product-old-price">$990.00</del>-->
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