<?php

session_start();
require "source/connection.php";

if (isset($_SESSION["a"])) {

    $category = $_POST["c"];
    $brand = $_POST["b"];
    $model = $_POST["m"];
    $title = $_POST["t"];
    $op = $_POST["op"];
    $clr = $_POST["clr"];
    $condition = $_POST["con"];
    $cost = $_POST["cost"];
    $qty = $_POST["qty"];
    $description = $_POST["desc"];

    $status = 1;

    if ($category == "0") {
        echo "Please select a category";
    } else if ($brand == "0") {
        echo "Please select a brand";
    } else if ($model == "0") {
        echo "Please select a model";
    } else if (empty($title)) {
        echo "Please enter the title of your product";
    }else if(preg_match('/[!#$%^&*()_+{}\[\]:;<>,.?~\\/\-\'"]/', $title)){
        echo "Title should not contain special characters";
    } else if (strlen($title) > 100) {
        echo "Your title should have 100 or less than character length";
    } else if (empty($qty)) {
        echo "Please add a quantity";
    } else if ($qty == "0" || $qty == "e" ||  $qty < 0) {
        echo "Please enter valid quantity";
    } else if (empty($cost)) {
        echo "Please enter unit price of your product";
    } else if (!is_numeric($cost)) {
        echo "Please enter valid price";
    } else if (!empty($op) && ( !is_numeric($op) || ($op <= $cost) )) {
        echo "Please check old price";
    } else if (empty($description)) {
        echo "Please enter a description";
    }else if (!isset($_FILES["img0"])) {
        echo "Please add an image";
    } else {

        $mhb_rs = Database::search("SELECT * FROM `model_has_brand` WHERE `model_id`='" . $model . "' && `brand_id`='" . $brand . "' ");

        $model_has_brand_id;

        if ($mhb_rs->num_rows == 1) {
            $mhb_data = $mhb_rs->fetch_assoc();
            $model_has_brand_id = $mhb_data["id"];
        } else {

            Database::iud("INSERT INTO `model_has_brand`(`model_id`, `brand_id`) VALUES ('" . $model . "', '" . $brand . "') ");
            $model_has_brand_id = Database::$connection->insert_id;
        }

        Database::iud("INSERT INTO `product`(`price`, `qty`, `description`, `title`, `category_id`,
        `model_has_brand_id`, `status_id`, `condition_id` ) VALUES
        ('" . $cost . "', '" . $qty . "', '" . $description . "', '" . $title . "', '" . $category . "', '" . $model_has_brand_id . "',
          '" . $status . "', '" . $condition . "') ");

        // echo "Product added successfully";

        $product_id = Database::$connection->insert_id;

        if (!empty($op)) {
            Database::iud("UPDATE `product` SET `oldPrice`='" . $op . "' WHERE `id`='".$product_id."' ");
        }
        if ($clr != 0) {
            Database::iud("UPDATE `product` SET `color_id`='" . $clr . "' WHERE `id`='".$product_id."' ");
        }


        $allowed_img_extentions = array("image/jpg", "image/jpeg", "image/png", "image/svg+xml");


        if (isset($_FILES["img0"])) {

            //--
            $imgArr = array();

            if (isset($_FILES["img0"])) {
                $imgArr[0] = $_FILES["img0"];
                if (isset($_FILES["img1"])) {
                    $imgArr[1] = $_FILES["img1"];
                    if (isset($_FILES["img2"])) {
                        $imgArr[2] = $_FILES["img2"];
                    }
                }
            }
            //--

            for ($x = 0; $x < count($imgArr); $x++) {
                $image = $imgArr[$x];
                $file_ex = $image["type"];

                if (in_array($file_ex, $allowed_img_extentions)) {

                    $new_img_extention;

                    if ($file_ex == "image/jpg") {
                        $new_img_extention = ".jpg";
                    } else if ($file_ex == "image/jpeg") {
                        $new_img_extention = ".jpeg";
                    } else if ($file_ex == "image/png") {
                        $new_img_extention = ".png";
                    } else if ($file_ex == "image/svg+xml") {
                        $new_img_extention = ".svg";
                    }

                    $file_name = "product_img/" . uniqid() . $new_img_extention;

                    move_uploaded_file($image["tmp_name"], $file_name);

                    Database::iud("INSERT INTO `image` (`code`, `product_id`) VALUES ('" . $file_name . "', '" . $product_id . "') ");
                } else {
                    echo "Invalid image type";
                }
            }
            echo "success";
        } else {
            echo "Please add an image";
        }
    }
} else {
    echo "Please Sign In as admin";
}
