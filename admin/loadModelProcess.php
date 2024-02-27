<?php
require "../source/connection.php";

$bid = $_GET["bid"];

$resultset = Database::search("SELECT `model`.id AS mid, `name` FROM `model_has_brand` INNER JOIN `model` on `model`.id = `model_has_brand`.model_id WHERE `brand_id`='".$bid."' ");
$resultset_num = $resultset->num_rows;
?>
<option value="0">Select Model</option>
<?php
while($result_data = $resultset->fetch_assoc()){
    ?>
    <option value="<?php echo $result_data["mid"]; ?>"><?php echo $result_data["name"]; ?></option>
    <?php
}


?>