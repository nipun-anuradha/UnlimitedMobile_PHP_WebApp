<?php
require "../source/connection.php";

$oid = $_GET["oid"];
$state = $_GET["state"];

if(empty($oid)){
    echo "Somthing went wrong1";
}else if($state == 'R'){
    Database::iud("UPDATE `invoice` SET `status`='refund' WHERE `id`='".$oid."' ");
}else if($state == 'Ca'){
    Database::iud("UPDATE `invoice` SET `status`='cancle' WHERE `id`='".$oid."' ");
}else if($state == 'Co'){
    Database::iud("UPDATE `invoice` SET `status`='completed' WHERE `id`='".$oid."' ");
}

echo "success";
?>