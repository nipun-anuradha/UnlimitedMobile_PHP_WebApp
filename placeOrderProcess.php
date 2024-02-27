<?php
require "source/connection.php";
session_start();

if (isset($_SESSION["u"])) {
    $fname = $_POST["fn"];
    $lname = $_POST["ln"];
    // $mail = $_POST["m"];
    $provi = $_POST["p"];
    $dis = $_POST["d"];
    $line1 = $_POST["l1"];
    $line2 = $_POST["l2"];
    $city = $_POST["c"];
    $zcode = $_POST["z"];
    $tel = $_POST["t"];
    $note = $_POST["n"];
    // $total = $_POST["tot"];
    
    $terms = $_POST["terms"];


    if (empty($fname)) {
        echo "Please Enter First Name";
    } else if (empty($lname)) {
        echo "Please Enter Last Name";
    } else if ($provi == "0") {
        echo "Please Select Province";
    } else if ($dis == "0") {
        echo "Please Enter Distric";
    } else if (empty($line1)) {
        echo "Please Enter Address Line 1";
    } else if (empty($line2)) {
        echo "Please Enter Address Line 2";
    } else if (empty($city)) {
        echo "Please Enter City";
    } else if (empty($zcode)) {
        echo "Please Enter Zip Code";
    } else if (empty($tel)) {
        echo "Please Enter Telephone";
    } else if (strlen($tel) != 10) {
        echo "Invalid Mobile Number";
    } else if (!preg_match("/07[0,1,2,4,5,6,7,8][0-9]/", $tel)) {
        echo "Please Enter Telephone";
    } else if ($terms == 0) {
        echo "Please agree to the terms and conditions.";
    } else if ($_POST["shipping_add"] == "1") {
        $fname_s = $_POST["fn_s"];
        $lname_s = $_POST["ln_s"];
        $provi_s = $_POST["p_s"];
        $dis_s = $_POST["d_s"];
        $line1_s = $_POST["l1_s"];
        $line2_s = $_POST["l2_s"];
        $city_s = $_POST["c_s"];
        $zcode_s = $_POST["z_s"];
        $tel_s = $_POST["t_s"];

        if (empty($fname_s)) {
            echo "Please Enter First Name In Shipping Address";
        } else if (empty($lname_s)) {
            echo "Please Enter Last Name In Shipping Address";
        } else if ($provi_s == "0") {
            echo "Please Select Province In Shipping Address";
        } else if ($dis_s == "0") {
            echo "Please Enter Distric In Shipping Address";
        } else if (empty($line1_s)) {
            echo "Please Enter Address Line 1 In Shipping Address";
        } else if (empty($line2_s)) {
            echo "Please Enter Address Line 2 In Shipping Address";
        } else if (empty($city_s)) {
            echo "Please Enter City In Shipping Address";
        } else if (empty($zcode_s)) {
            echo "Please Enter Zip Code In Shipping Address";
        } else if (empty($tel_s)) {
            echo "Please Enter Telephone In Shipping Address";
        } else {
            //to shipping address

        }
    } else {
        //normal order
        if (isset($_SESSION["u"])) {
            $uemail = $_SESSION["u"]["email"];

            $address = Database::search("SELECT * FROM `user_has_address` WHERE `user_email` = '" . $uemail . "' ");
            $n = $address->num_rows;
            if ($n > 0) {
                $address = Database::search("SELECT id FROM `user_has_address`  WHERE fname='" . $fname . "' AND lname='" . $lname . "' AND line1='" . $line1 . "' AND line2='" . $line2 . "' AND city='" . $city . "' AND contact_no='" . $tel . "' AND postal_code='" . $zcode . "' AND
                distric_id='" . $dis . "' AND `user_email` = '" . $uemail . "' ");
                $n = $address->num_rows;
                if ($n > 0) {
                    $address_id = $address->fetch_assoc()["id"];
                } else {
                    Database::iud("INSERT INTO `user_has_address` (`user_email`, `fname`, `lname`, `line1`, `line2`, `city`, `contact_no`, `postal_code`, `distric_id` ) 
                        VALUES('" . $uemail . "', '" . $fname . "', '" . $lname . "', '" . $line1 . "', '" . $line2 . "', '" . $city . "', '" . $tel . "', '" . $zcode . "', '" . $dis . "') ");
                    $address_id = Database::$connection->insert_id;
                }

                // Database::iud("UPDATE `user_has_address` SET  fname='".$fname."', lname='".$lname."', line1='".$line1."', line2='".$line2."', city='".$city."', contact_no='".$tel."', postal_code='".$zcode."',
                // distric_id='".$dis."' WHERE user_email='".$uemail."' ");

                // $a_rs = Database::search("SELECT `id` FROM `user_has_address` WHERE `user_email`='".$uemail."' ");
                // $address_id = $a_rs->fetch_assoc() ["id"];
            } else {
                Database::iud("INSERT INTO `user_has_address` (`user_email`, `fname`, `lname`, `line1`, `line2`, `city`, `contact_no`, `postal_code`, `distric_id` ) 
                        VALUES('" . $uemail . "', '" . $fname . "', '" . $lname . "', '" . $line1 . "', '" . $line2 . "', '" . $city . "', '" . $tel . "', '" . $zcode . "', '" . $dis . "') ");
                $address_id = Database::$connection->insert_id;
            }





            $d = new DateTime();
            $tz = new DateTimeZone("Asia/Colombo");
            $d->setTimezone($tz);
            $date = $d->format("Y-m-d H:i:s");

            //cal total from cart
            $total = 0;

            $c_rs = Database::search("SELECT * FROM `cart` WHERE `user_email`='" . $uemail . "'");
            $c_num = $c_rs->num_rows;

            if ($c_num != 0) {

                for ($x = 0; $x < $c_num; $x++) {
                    $c_data = $c_rs->fetch_assoc();

                    $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $c_data["product_id"] . "'");
                    $product_data = $product_rs->fetch_assoc();

                    $total = $total + ($product_data["price"] * $c_data["qty"]);
                }
            }
            //

            Database::iud("INSERT INTO `invoice` (`user_email`, `total`, `date`, `user_has_address_id`, `status`, `note` ) 
                    VALUES('" . $uemail . "', '" . $total . "', '" . $date . "', '" . $address_id . "', 'NotPay', '" . $note. "' ) ");
            $invoice_id = Database::$connection->insert_id;






            $cart_rs = Database::search("SELECT * FROM `cart` WHERE `user_email`='" . $uemail . "'");
            $cart_num = $cart_rs->num_rows;
            if ($cart_num != 0) {

                for ($x = 0; $x < $cart_num; $x++) {
                    $cart_data = $cart_rs->fetch_assoc();

                    Database::iud("INSERT INTO `invoice_item` (`product_id`, `qty`, `invoice_id`) 
                            VALUES('" . $cart_data["product_id"] . "', '" . $cart_data["qty"] . "', '" . $invoice_id . "') ");

                    Database::iud("DELETE FROM `cart` WHERE `id`='" . $cart_data["id"] . "' ");
                }

                // echo "success";

                $hash = strtoupper(
                    md5(
                        "1225445" . 
                        $invoice_id . 
                        number_format($total, 2, '.', '') . 
                        "LKR" .  
                        strtoupper(md5("MzI3NDc1MTAxNTIyMzYwMjIyNjczMTkxNTA0ODEyMzAzMzAyNTY3MQ=="))
                    ) 
                );

                $obj = '{"invoiceId":"'.$invoice_id.'", "items":"Order Id - '.$invoice_id.'", "amount":"'.$total.'", "fname":"'.$fname.'", "lname":"'.$lname.'", "email":"'.$uemail.'", "phone":"'.$tel.'", "address":"'.$line1.$line2.'", "city":"'.$city.'", "hash":"'.$hash.'" }';
                echo $obj;
            }
        }
    }
} else {
    echo "Please Sign In First";
}
