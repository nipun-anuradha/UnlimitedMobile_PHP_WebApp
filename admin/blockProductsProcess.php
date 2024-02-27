<?php
require "../source/connection.php";

$pid = $_GET["id"];

$p_rs = Database::search("SELECT * FROM `product` WHERE `id`='".$pid."' ");
$p_data = $p_rs->fetch_assoc();

if($p_data["status_id"] == "1"){
    Database::iud("UPDATE `product` SET `status_id`='2'  WHERE `id`='".$pid."' ");
    echo "block";
}else if($p_data["status_id"] == "2"){
    Database::iud("UPDATE `product` SET `status_id`='1'  WHERE `id`='".$pid."' ");
    echo "unblock";
}



?>