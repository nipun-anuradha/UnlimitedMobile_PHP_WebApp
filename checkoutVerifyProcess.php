<?php
require "source/connection.php";
session_start();

$status = true;


$c_rs = Database::search("SELECT * FROM `cart` WHERE  `user_email`='".$_SESSION["u"]["email"]."' ");
while($c_data = $c_rs->fetch_assoc()){
    $p_rs = Database::search("SELECT * FROM `product` WHERE `id`='".$c_data["product_id"]."' ");
    $p = $p_rs->fetch_assoc();

    if($c_data["qty"] > $p["qty"]){
        $status = false;
        echo $p["title"] . " requested quentity not available";
    }
}

if($status){
    echo "Success";
}

?>