<?php

require "../source/connection.php";

$email = $_POST["e"];
$password = $_POST["p"];
$rememberMe = $_POST["rm"];

if(empty($email)){
    echo "please enter Email Address";
}else if(strlen($email) > 100){
    echo "Email Address should be less than 100 characters.";
}else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
    echo "Invalid Email Address.";
}else if(preg_match('/[!#$%^&*()_+{}\[\]:;<>,.?~\\/\-\'"]/', $password)){
    echo "Password should not contain special characters";
}else if(empty($password)){
    echo "please enter your Password";
}else if(strlen($password) < 8 || strlen($password) > 20){
    echo "Invalid Password";
}else{

    $resultset = Database::search("SELECT * FROM `admin` WHERE `email`='".$email."' AND `password`='".$password."' ");
    $n = $resultset->num_rows;

    if($n == 1){
        echo "success";
        $d = $resultset->fetch_assoc();
        
        session_start();
        $_SESSION["a"] = $d;

        if($rememberMe == "true"){
            setcookie("aEmail",$email,time()+(60*60*24*365));
            setcookie("aPassword",$password,time()+(60*60*24*365));
        }else{
            setcookie("aEmail","",-1);
            setcookie("aPassword","",-1);
        }
        
    }else{
        echo "Invalid Email or Password";
    }
}

?>