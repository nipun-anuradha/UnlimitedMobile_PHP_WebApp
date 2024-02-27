<?php
require "source/connection.php";

$clr = $_GET["clr"];

if (empty($clr)) {
    echo "empty";
} else {
    $clr_rs = Database::search("SELECT * FROM `color` WHERE `name`='" . $clr . "' ");

    if ($clr_rs->num_rows == 1) {
        echo "found";
    } else {
        Database::iud("INSERT INTO `color`(`name`) VALUES ('" . $clr . "') ");

        ?>
        <option value="0">Select Color</option>
        <?php
        $clr_rs = Database::search("SELECT * FROM `color` ORDER BY `name` ASC ");
        $clr_num = $clr_rs->num_rows;

        for ($y = 0; $y < $clr_num; $y++) {
            $clr_data = $clr_rs->fetch_assoc();
?>
            <option value="<?php echo $clr_data["id"]; ?>"><?php echo $clr_data["name"]; ?></option>
<?php
        }
    }
}
?>