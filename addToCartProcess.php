<?php

session_start();

require "source/connection.php";

if (isset($_SESSION["u"])) {
    if (isset($_GET["id"])) {

        $pid = $_GET["id"];
        $pqty = $_GET["q"];
        $uemail = $_SESSION["u"]["email"];

        $cartPorduct_rs = Database::search("SELECT * FROM `cart` WHERE `user_email`='" . $uemail . "' AND `product_id`='" . $pid . "'");
        $cart_product_num = $cartPorduct_rs->num_rows;

        $product_qty_rs = Database::search("SELECT `qty` FROM `product` WHERE `id`='" . $pid . "'");
        $product_qty_data = $product_qty_rs->fetch_assoc();

        $product_qty = $product_qty_data["qty"];

        if ($cart_product_num == 1) {
            $cartProductData = $cartPorduct_rs->fetch_assoc();
            $currentQty = $cartProductData["qty"];
            $newQty = (int) $currentQty + $pqty;

            if ($product_qty >= $newQty) {
                Database::iud("UPDATE `cart` SET `qty`='" . $newQty . "' WHERE `user_email`='" . $uemail . "' AND `product_id`='" . $pid . "' ");
                echo "Product quantity Updated";
            } else {
                echo "Invalid Product Quantity";
            }
        } else {
            if ($product_qty >= $pqty) {
                Database::iud("INSERT INTO `cart` (`product_id`,`user_email`,`qty`) VALUES ('" . $pid . "','" . $uemail . "','".$pqty."')");
                echo "New Product added to the cart";
            }else{
                echo "Invalid Product Quantity";
            }
        }
    } else {
        echo "Sorry For the Inconvenient";
    }
} else {
    echo "Please Log In or Sign Up";
}
