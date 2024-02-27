<?php
require "../source/connection.php";

$vc = $_POST["vc"];
$np = $_POST["np"];
$ncp = $_POST["ncp"];
$e = $_POST["m"];

if(empty($vc)){
    echo "Please enter verification code";
}else if(strlen($np) <= 5 || strlen($np) > 20){
    echo "Password length should be between 5 to 20";
}else if(empty($ncp)){
    echo "Please re-type your password";
}else if($np != $ncp){
    echo "You password does not match to your re-typed password";
}else{

    $rs = Database::search("SELECT * FROM `user` WHERE `email`='".$e."' AND `varification_code`='".$vc."'");
    $n = $rs->num_rows;

    $hashedPass = password_hash($np,PASSWORD_DEFAULT);

    if($n == 1){
        Database::iud("UPDATE `user` SET `password`='".$hashedPass."' WHERE `email`='".$e."' ");
        echo "Success";
    }else{
        echo "Invalid varification code";
    }
}


?>
