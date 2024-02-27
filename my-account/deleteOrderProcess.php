<?php
require "../source/connection.php";

$invoiceId = $_GET['id'];

Database::iud("DELETE FROM `invoice_item` WHERE invoice_id='".$invoiceId."' ");

Database::iud("DELETE FROM `invoice` WHERE id='".$invoiceId."' ");

echo "success";


?>