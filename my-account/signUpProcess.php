<?php
require "../source/connection.php";

$f = $_POST["f"];
$l = $_POST["l"];
$e = $_POST["e"];
$p = $_POST["p"];
$c = $_POST["c"];

if(empty($f)){
    echo "please enter your First Name";
}else if(strlen($f) > 20){
    echo "First Name must be less than 20 characters";
}else if(preg_match('/[!#$%^&*()_+{}\[\]:;<>,.?~\\/\-\'"]/', $f)){
    echo "Name should not contain special characters";
}else if(empty($l)){
    echo "please enter your Last Name";
}else if(strlen($l) > 25){
    echo "First Name must be less than 25 characters";
}else if(preg_match('/[!#$%^&*()_+{}\[\]:;<>,.?~\\/\-\'"]/', $l)){
    echo "Name should not contain special characters";
}else if(empty($e)){
    echo "please enter your Email Address";
}else if(strlen($e) >= 100){
    echo "Email must be less than 100 characters";
}else if(!filter_var($e,FILTER_VALIDATE_EMAIL)){
    echo "Invalid Email Address";
}else if(empty($p)){
    echo "please enter your Password";
}else if(strlen($p) < 8 || strlen($p) > 20){
    echo "Password sholud be between 08 and 20 characters";
}else if(empty($c)){
    echo "please enter confirm password";
}else if(!($p == $c)){
    echo "password not match";
}else{
    $r = Database::search("SELECT * FROM `user` WHERE `email`='".$e."' ");
    $n = $r->num_rows;

    if($n > 0){
        echo "Email Address already exists.";
    }else{
        $d = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $d->setTimezone($tz);
        $date = $d->format("Y-m-d H:i:s");

        $hashedPass = password_hash($p,PASSWORD_DEFAULT);

        Database::iud("INSERT INTO `user`(`fname`,`lname`,`email`,`password`,`joined_date`,`status_id`) 
        VALUES('".$f."','".$l."','".$e."','".$hashedPass."','".$date."','1') ");

        echo "success";
    }
}



?>