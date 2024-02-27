<?php
require "../source/connection.php";

$email = $_POST["mail"];

$u_rs = Database::search("SELECT * FROM `user` WHERE `email`='".$email."' ");
$u_data = $u_rs->fetch_assoc();

if($u_data["status_id"] == "1"){
    Database::iud("UPDATE `user` SET `status_id`='2'  WHERE `email`='".$email."' ");
    echo "block";
}else if($u_data["status_id"] == "2"){
    Database::iud("UPDATE `user` SET `status_id`='1'  WHERE `email`='".$email."' ");
    echo "unblock";
}



?>