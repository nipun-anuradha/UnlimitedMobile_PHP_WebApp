<?php
require "../source/connection.php";

$oid = $_GET["oid"];

if(empty($oid)){
    echo "Somthing went wrong1";
}else{
    Database::iud("UPDATE `invoice` SET `status`='completed' WHERE `id`='".$oid."' ");
    echo "success";
}


?>