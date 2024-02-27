<?php

require "../source/connection.php";

$email = $_POST["e"];
$password = $_POST["p"];
$rememberMe = $_POST["rm"];

if (empty($email)) {
    echo "Please enter Email Address";
} elseif (strlen($email) > 100) {
    echo "Email Address should be less than 100 characters.";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Invalid Email Address.";
} elseif (empty($password)) {
    echo "Please enter your Password";
} elseif (strlen($password) < 8 || strlen($password) > 20) {
    echo "Invalid Password";
} else {
    $resultset = Database::search("SELECT * FROM `user` WHERE `email`='".$email."' ");

    if ($resultset->num_rows == 1) {
        $row = $resultset->fetch_assoc();
        $hashedPassword = $row["password"];

        if (password_verify($password, $hashedPassword)) {
            if ($row["status_id"] == "1") {
                echo "success";

                session_start();
                $_SESSION["u"] = $row;
                
                if ($rememberMe == "true") {
                    setcookie("email", $email, time() + (60 * 60 * 24 * 365));
                    setcookie("password", $password, time() + (60 * 60 * 24 * 365));
                } else {
                    setcookie("email", "", -1);
                    setcookie("password", "", -1);
                }
            } else {
                echo "Your account has been blocked by admin. Please contact Unlimited Mobile help center.";
            }
        } else {
            echo "Invalid Email or Password";
        }
    } else {
        echo "Invalid Email or Password";
    }
}
?>
