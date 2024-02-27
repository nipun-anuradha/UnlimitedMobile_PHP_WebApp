<?php
require "../source/connection.php";

require "../source/SMTP.php";
require "../source/PHPMailer.php";
require "../source/Exception.php";
use PHPMailer\PHPMailer\PHPMailer;

if(isset($_GET["e"])){
    $email = $_GET["e"];

    $resultset = Database::search("SELECT * FROM `user` WHERE `email`='".$email."' ");
    $n = $resultset->num_rows;

    if($n == 1){
        
        $code = uniqid();
        Database::iud("UPDATE `user` SET `varification_code`='".$code."' WHERE `email`='".$email."' ");

        $mailbody = "<h3 style='color: rgb(207, 42, 30);'>Unlimited Mobile</h3><h5>Your Verification Code: </h5>";

        $mail = new PHPMailer;
            $mail->IsSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true; 
            $mail->Username = 'agamers2000@gmail.com'; 
            $mail->Password = 'wdxcezcrnnyuwjel'; 
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->setFrom('agamers2000@gmail.com', 'UM');
            $mail->addReplyTo('agamers2000@gmail.com', 'UM');
            $mail->addAddress($email);  
            $mail->isHTML(true);
            $mail->Subject = 'Unlimited Mobile - Varification Code'; 
            $bodyContent = $mailbody . $code; 
            $mail->Body    = $bodyContent;

            if (!$mail->send()) {
                echo 'Verification code sending failed';
            } else {
                echo 'Success';
            }

    }else{
        echo "Email address not found";
    }
}else{
    echo "Please Enter Your Email Address";
}

?>