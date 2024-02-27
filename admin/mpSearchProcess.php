<?php

require "../source/connection.php";

$brand = $_POST["b"];
$model = $_POST["m"];
$search_txt = $_POST["s"];


$query = "SELECT product.id AS id, title, `model`.name AS model, `brand`.name AS brand, price, qty, status_id FROM `product` 
INNER JOIN `model_has_brand` ON `product`.model_has_brand_id = `model_has_brand`.id 
INNER JOIN `brand` ON `brand`.id = `model_has_brand`.brand_id INNER JOIN `model` ON `model`.id = `model_has_brand`.model_id ";

$status = 0;

if ($brand != 0 && $model == 0) {
    if ($status == 0) {
        $query .= " WHERE `brand`.id='" . $brand . "' ";
        $status = 1;
    } else if ($status == 1) {
        $query .= " AND `brand`.id='" . $brand . "' ";
    }
}

if ($brand == 0 && $model != 0) {
    if ($status == 0) {
        $query .= " WHERE `model`.id='" . $model . "' ";
        $status = 1;
    } else if ($status == 1) {
        $query .= " AND `model`.id='" . $model . "' ";
    }
}

if ($brand != 0 && $model != 0) {
    if ($status == 0) {
        $query .= " WHERE `brand`.id='" . $brand . "' AND `model`.id='" . $model . "' ";
        $status = 1;
    } else if ($status == 1) {
        $query .= " AND `brand`.id='" . $brand . "' AND `model`.id='" . $model . "' ";
    }
}

if (!empty($search_txt)) {
    if ($status == 0) {
        $query .= " WHERE `title` LIKE '%" . $search_txt . "%'";
        $status = 1;
    }else if($status == 1){
        $query .= " AND `title` LIKE '%" . $search_txt . "%'";
    }
}



?>


<?php
$reslts_rs = Database::search($query);
while ($product = $reslts_rs->fetch_assoc()) {
?>
    <tr>
                                                <td>
                                                    <p><?php echo $product["id"]; ?></p>
                                                </td>

                                                <td class="min-width">
                                                    <div class="lead">
                                                        <div class="lead-image">
                                                            <?php 
                                                            $image_rs = Database::search("SELECT code FROM `image` WHERE product_id = '".$product["id"]."' ");
                                                            $image = $image_rs->fetch_assoc();
                                                            ?>
                                                            <img src="../<?php echo $image["code"]; ?>" />
                                                        </div>
                                                        <div class="lead-text">
                                                            <p><?php echo $product["title"]; ?></p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="min-width">
                                                    <p><a href="#0"><?php echo $product["brand"]; ?></a></p>
                                                </td>
                                                <td class="min-width">
                                                    <p><?php echo $product["model"]; ?></p>
                                                </td>
                                                <td>
                                                    <p><?php echo $product["price"]; ?></p>
                                                </td>
                                                <td class="min-width">
                                                    <p><?php echo $product["qty"]; ?></p>
                                                </td>
                                                <td>
                                                    <div class="action">
                                                        <?php 
                                                            if($product["status_id"] == '1'){
                                                                ?>
                                                                <button class="text-success" id="pstate<?php echo $product["id"]; ?>" onclick="changeProductState(<?php echo $product['id'] ?>);">
                                                                <i class="lni lni-unlock" id="picon<?php echo $product["id"]; ?>"></i>
                                                                </button>
                                                                <?php
                                                            }else{
                                                                ?>
                                                                <button class="text-danger" id="pstate<?php echo $product["id"]; ?>" onclick="changeProductState(<?php echo $product['id'] ?>);">
                                                                    <i class="lni lni-lock" id="picon<?php echo $product["id"]; ?>"></i>
                                                                </button>
                                                                <?php
                                                            }
                                                            ?>
                                                        <button class="text-black">
                                                            <i class="lni lni-pencil-alt"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
<?php
}

?>