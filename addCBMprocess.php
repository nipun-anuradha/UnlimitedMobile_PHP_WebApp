<?php
require "source/connection.php";

$select = $_GET["select"];
$text = $_GET["t"];

switch ($select){
    case "C":
        if(empty($text)){
            echo "Enter Category Name";
        }else if(strlen($text) > 30){
            echo "Name should be less than 30 characters";
        }else{
            $resultset = Database::search("SELECT * FROM `category` WHERE `name`='".$text."' ");
            $n = $resultset->num_rows;
        
            if($n == 1){
                echo "category already exists";
            }else{
                Database::iud("INSERT INTO `category`(`name`) VALUES('".$text."'); ");
                echo "success";
            }
        }
        break;
    case "B":
        if(empty($text)){
            echo "Enter Brand Name";
        }else if(strlen($text) > 30){
            echo "Name should be less than 30 characters";
        }else{
            $resultset = Database::search("SELECT * FROM `brand` WHERE `name`='".$text."' ");
            $n = $resultset->num_rows;
        
            if($n == 1){
                echo "brand already exists";
            }else{
                Database::iud("INSERT INTO `brand`(`name`) VALUES('".$text."'); ");
                echo "success";
            }
        }
        break;
    case "M":
        $brand = $_GET["brand"];
        if($brand == "0"){
            echo "Select a brand";
        }else if(empty($text)){
            echo "Enter Model Name";
        }else if(strlen($text) > 30){
            echo "Name should be less than 30 characters";
        }else{
            $resultset = Database::search("SELECT * FROM `model` WHERE `name`='".$text."' ");
            $n = $resultset->num_rows;
        
            if($n == 1){
                echo "model already exists";
            }else{
                Database::iud("INSERT INTO `model`(`name`) VALUES('".$text."'); ");
                $model_id = Database::$connection->insert_id;

                Database::iud("INSERT INTO `model_has_brand`(`brand_id`, `model_id`) VALUES('".$brand."', '".$model_id."'); ");

                echo "success";
            }
        }
        break;
}


?>