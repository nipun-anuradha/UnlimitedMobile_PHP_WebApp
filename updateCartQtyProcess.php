<?php
require "source/connection.php";
session_start();

$pid = $_GET["pid"];
$qty = $_GET["qty"];

$p_rs = Database::search("SELECT * FROM `product` WHERE `id`='".$pid."' ");
$p = $p_rs->fetch_assoc();

if($qty > $p["qty"]){
    $c_rs = Database::search("SELECT * FROM `cart` WHERE  `user_email`='".$_SESSION["u"]["email"]."' AND `product_id`='".$pid."' ");
    echo $c_rs->fetch_assoc()["qty"];
}else{
    Database::iud("UPDATE `cart` SET `qty`='".$qty."' WHERE `user_email`='".$_SESSION["u"]["email"]."' AND `product_id`='".$pid."' ");
    
    $cart_rs = Database::search("SELECT `cart`.qty AS cqty, price FROM `cart` INNER JOIN `product` ON `product`.id=`cart`.product_id WHERE `cart`.user_email='".$_SESSION["u"]["email"]."' ");

    $total = 0;
    $items = 0;
    while($cdata = $cart_rs->fetch_assoc()){
        $total += $cdata["cqty"] * $cdata["price"];
        $items += $cdata["cqty"];
    }

    echo "SUBTOTAL : Rs.".$total.".00";
    echo ",".$items;
    echo ",".$qty."x";
}




?>