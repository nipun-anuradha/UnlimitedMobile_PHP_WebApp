<?php
require "../source/connection.php";

$search_txt = $_POST["s"];
$page = $_POST["page"];

$query = "SELECT `date`,`invoice`.`status`, `invoice`.id AS oid, `product`.id AS pid, `product`.title, `brand`.name AS bname, `model`.name AS mname, `invoice_item`.qty, fname, lname,
line1, line2, city, postal_code, `distric`.name AS dname, `province`.name AS pname, contact_no FROM `invoice` INNER JOIN `invoice_item` ON `invoice`.id = `invoice_item`.invoice_id
INNER JOIN `product` ON `invoice_item`.product_id = `product`.id INNER JOIN `model_has_brand` ON 
`product`.model_has_brand_id = `model_has_brand`.id INNER JOIN `model` ON `model_has_brand`.model_id=`model`.id
INNER JOIN `brand` ON `model_has_brand`.brand_id=`brand`.id INNER  JOIN `user_has_address` ON 
`invoice`.user_has_address_id=`user_has_address`.id INNER JOIN `distric` ON `distric`.id=`user_has_address`.distric_id 
INNER JOIN `province` ON `province`.id=`distric`.province_id  ";

if ($page == 'o') {
    $query .= " WHERE `invoice`.status = 'pendding' AND  `invoice`.id='" . $search_txt . "' ";

    $order_rs = Database::search($query);

    $order_num = $order_rs->num_rows;
    $prevId = "";

    for ($p = 0; $p < $order_num; $p++) {
        $order = $order_rs->fetch_assoc();

        //-
        $item_rs = Database::search("SELECT COUNT(invoice_id) AS items FROM `invoice_item` WHERE `invoice_id`='" . $order["oid"] . "' ");
        $item = $item_rs->fetch_assoc()["items"];
        //-

        //group items in same order
        $currentId = $order["oid"];
        if ($prevId != $currentId) {
?>
            <tr>
                <td colspan="7">
                    <hr>
                </td>
            </tr>
        <?php
        }

        //group items in same order

        ?>
        <tr id="<?php echo $order["oid"]; ?>">
            <?php
            if ($prevId != $currentId) {
            ?>
                <td <?php if ($item > 1) {
                        echo "rowspan= '" . $item . "' ";
                    } ?>>
                    <p><?php echo $order["oid"]; ?></p>
                </td>
            <?php
            }
            ?>

            <td class="min-width">
                <div class="lead">
                    <div class="lead-image">
                        <?php
                        $image_rs = Database::search("SELECT code FROM `image` WHERE product_id = '" . $order["pid"] . "' ");
                        $image = $image_rs->fetch_assoc();
                        ?>
                        <img src="../<?php echo $image["code"]; ?>" />
                    </div>
                    <div class="lead-text">
                        <p><?php echo $order["title"]; ?></p>
                    </div>
                </div>
            </td>
            <td class="min-width">
                <p><a href="#0"><?php echo $order["bname"]; ?></a></p>
            </td>
            <td class="min-width">
                <p><?php echo $order["mname"]; ?></p>
            </td>
            <td>
                <p><?php echo $order["qty"]; ?></p>
            </td>
            <?php
            if ($prevId != $currentId) {

            ?>
                <td class="min-width" <?php if ($item > 1) {
                                            echo "rowspan= '" . $item . "' ";
                                        } ?>>
                    <p><?php echo "<i><b>(" . $order["date"] . ")</b></i><br>" . $order["fname"] . " " . $order["lname"] . "<br>" . $order["line1"] . ", " . $order["line2"] . "<br>" . $order["city"] . "<br>" .
                            $order["pname"] . "<br>" . $order["dname"] . "<br>" . $order["postal_code"] . "<br>" . $order["contact_no"]; ?></p>
                </td>
                <td <?php if ($item > 1) {
                        echo "rowspan= '" . $item . "' ";
                    } ?>>
                    <div class="action">
                        <button class="text-black mr-10" onclick="completeOrder(<?php echo $order['oid']; ?>);">
                            <i class="lni lni-delivery"></i>
                        </button>

                        <button class="text-danger" onclick="cancleOrder(<?php echo $order['oid']; ?>);">
                            <i class="lni lni-close"></i>
                        </button>
                    </div>
                </td>
            <?php
            }
            $prevId = $currentId;
            ?>


        </tr>
        <?php
    }
} else if ($page == 'h') {
    $query .= " WHERE `invoice`.status IN ('refund','cancle','completed') AND  `invoice`.id='" . $search_txt . "' ORDER BY `invoice`.id desc ";
    $order_rs = Database::search($query);

    $order_num = $order_rs->num_rows;
    $prevId = "";

    for ($p = 0; $p < $order_num; $p++) {
        $order = $order_rs->fetch_assoc();

        //-
        $item_rs = Database::search("SELECT COUNT(invoice_id) AS items FROM `invoice_item` WHERE `invoice_id`='" . $order["oid"] . "' ");
        $item = $item_rs->fetch_assoc()["items"];
        //-

        //group items in same order
        $currentId = $order["oid"];
        if ($prevId != $currentId) {
        ?>
            <tr>
                <td colspan="7">
                    <hr>
                </td>
            </tr>
        <?php
        }

        //group items in same order

        ?>
        <tr>
            <?php
            if ($prevId != $currentId) {
            ?>
                <td <?php if ($item > 1) {
                        echo "rowspan= '" . $item . "' ";
                    } ?>>
                    <p><?php echo $order["oid"]; ?></p>
                </td>
            <?php
            }
            ?>

            <td class="min-width">
                <div class="lead">
                    <div class="lead-image">
                        <?php
                        $image_rs = Database::search("SELECT code FROM `image` WHERE product_id = '" . $order["pid"] . "' ");
                        $image = $image_rs->fetch_assoc();
                        ?>
                        <img src="../<?php echo $image["code"]; ?>" />
                    </div>
                    <div class="lead-text">
                        <p><?php echo $order["title"]; ?></p>
                    </div>
                </div>
            </td>
            <td class="min-width">
                <p><a href="#0"><?php echo $order["bname"]; ?></a></p>
            </td>
            <td class="min-width">
                <p><?php echo $order["mname"]; ?></p>
            </td>
            <td>
                <p><?php echo $order["qty"]; ?></p>
            </td>
            <?php
            if ($prevId != $currentId) {

            ?>
                <td class="min-width" <?php if ($item > 1) {
                                            echo "rowspan= '" . $item . "' ";
                                        } ?>>
                    <p><?php echo "<i><b>(" . $order["date"] . ")</b></i><br>" . $order["fname"] . " " . $order["lname"] . "<br>" . $order["line1"] . ", " . $order["line2"] . "<br>" . $order["city"] . "<br>" .
                            $order["pname"] . "<br>" . $order["dname"] . "<br>" . $order["postal_code"] . "<br>" . $order["contact_no"]; ?></p>
                </td>
                <td <?php if ($item > 1) {
                        echo "rowspan= '" . $item . "' ";
                    } ?>>
                    <?PHP
                    if ($order["status"] == 'refund') {
                    ?>
                        <span class="status-btn warning-btn">Refund</span>
                    <?php
                    } else if ($order["status"] == 'cancle') {
                    ?>
                        <span class="status-btn close-btn">Canceled</span>
                    <?php
                    } else if ($order["status"] == 'completed') {
                    ?>
                        <span class="status-btn success-btn">Completed</span>
                    <?php
                    }
                    ?>
                </td>
                <td class="min-width" <?php if ($item > 1) {
                                            echo "rowspan= '" . $item . "' ";
                                        } ?>>
                    <div class="action justify-content-end">
                        <button class="more-btn ml-10 dropdown-toggle" id="moreAction1" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="lni lni-more-alt"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="moreAction1">
                            <li class="dropdown-item">
                                <a href="#0" class="text-gray" onclick="changeOrderState(<?php echo $order['oid']; ?> , 'R');">Refund</a>
                            </li>
                            <li class="dropdown-item">
                                <a href="#0" class="text-gray" onclick="changeOrderState(<?php echo $order['oid']; ?> , 'Ca');">Cancle</a>
                            </li>
                            <li class="dropdown-item">
                                <a href="#0" class="text-gray" onclick="changeOrderState(<?php echo $order['oid']; ?> , 'Co');">Completed</a>
                            </li>
                        </ul>
                    </div>
                </td>
            <?php
            }
            $prevId = $currentId;
            ?>
        </tr>
<?php
    }
}

?>