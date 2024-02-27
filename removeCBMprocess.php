<?php
require "source/connection.php";

$select = $_GET["select"];
$id = $_GET["id"];

switch ($select){
    case "C":
        if($id == "0"){
            echo "No selected item";
        }else{
            $resultset = Database::search("SELECT * FROM `category` WHERE `id`='".$id."' ");
            $n = $resultset->num_rows;
        
            if($n == 1){
                Database::iud("DELETE FROM `category` WHERE `id`='".$id."' ");
                echo "success";
            }else{
                echo "No category found";
                }
        }
        break;
    case "B":
        if($id == "0"){
            echo "No selected item";
        }else{
            $resultset = Database::search("SELECT * FROM `brand` WHERE `id`='".$id."' ");
            $n = $resultset->num_rows;
        
            if($n == 1){
                Database::iud("DELETE FROM `brand` WHERE `id`='".$id."' ");
                echo "success";
            }else{
                echo "No category found";
                }
        }
        break;
    case "M":
        if($id == "0"){
            echo "No selected item";
        }else{
            $resultset = Database::search("SELECT * FROM `model` WHERE `id`='".$id."' ");
            $n = $resultset->num_rows;
        
            if($n == 1){
                Database::iud("DELETE FROM `model_has_brand` WHERE `model_id`='".$id."' ");
                Database::iud("DELETE FROM `model` WHERE `id`='".$id."' ");
                echo "success";
            }else{
                echo "No category found";
                }
        }
        break;
}
