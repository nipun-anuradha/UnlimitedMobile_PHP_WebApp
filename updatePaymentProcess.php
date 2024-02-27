<?php
require "source/connection.php";

$invoice_id = $_GET["id"];

Database::iud("UPDATE `invoice` SET `status` = 'Pendding' WHERE id =  '".$invoice_id."' ");

echo "Success";

?>