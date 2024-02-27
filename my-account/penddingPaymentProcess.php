<?php
require "../source/connection.php";

$invoice_id = $_GET["id"];

$invoice_rs = Database::search("SELECT total, fname, lname, `invoice`.user_email AS email, contact_no, line1, line2, city  FROM `invoice` 
INNER JOIN `user_has_address` ON `user_has_address`.id=`invoice`.user_has_address_id WHERE `invoice`.id = '".$invoice_id."' ");
$invoice_data = $invoice_rs->fetch_assoc();


$hash = strtoupper(
    md5(
        "1225445" . 
        $invoice_id . 
        number_format($invoice_data["total"], 2, '.', '') . 
        "LKR" .  
        strtoupper(md5("MzI3NDc1MTAxNTIyMzYwMjIyNjczMTkxNTA0ODEyMzAzMzAyNTY3MQ=="))
    ) 
);

$address = $invoice_data["line1"] .",". $invoice_data["line2"] ;

$jsonObject = '{
    "invoiceId":"'.$invoice_id.'",
    "items":"Order Id - '.$invoice_id.' ",
    "amount":"'.$invoice_data["total"].'",
    "hash":"'.$hash.'",
    "fname":"'.$invoice_data["fname"].'",
    "lname":"'.$invoice_data["lname"].'",
    "email":"'.$invoice_data["email"].'",
    "phone":"'.$invoice_data["contact_no"].'",
    "address":"'.$address.'",
    "city":"'.$invoice_data["city"].'"
 }';

echo $jsonObject;

?>