<?php
require "../source/connection.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/png"  href="assets/images/titleLogo.png" />
    <title>Manage Product</title>

    <!-- ========== All CSS files linkup ========= -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/lineicons.css" />
    <link rel="stylesheet" href="assets/css/materialdesignicons.min.css" />
    <link rel="stylesheet" href="assets/css/fullcalendar.css" />
    <link rel="stylesheet" href="assets/css/main.css" />

    <style>
        .container {
            position: relative;
            overflow: hidden;
            width: 100%;
            padding-top: 56.25%;
            /* 16:9 Aspect Ratio (divide 9 by 16 = 0.5625) */
        }

        /* Then style the iframe to fit in the container div with full height and width */

        .responsive-iframe {
            position: absolute;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            width: 100%;
            height: 100%;
        }
    </style>
</head>

<body>
<?php require "header.php"; ?>

        <!-- ========== section start ========== -->
        <section class="section">
            <div class="container-fluid">
                <!-- ========== title-wrapper start ========== -->
                <div class="title-wrapper pt-30">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <div class="titlemb-30">
                                <h2>Manage Products</h2>
                            </div>
                        </div>
                        <!-- end col -->
                        <div class="col-md-6">
                            <div class="breadcrumb-wrapper mb-30">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item">
                                            <a href="dashboard.php">Dashboard</a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">
                                            Product
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->
                </div>
                <!-- ========== title-wrapper end ========== -->
            </div>
            <!-- end container -->
        </section>
        <!-- ========== section end ========== -->




        <!-- ========== table components start ========== -->
        <section class="table-components">
            <div class="container-fluid">

                <!-- ========== tables-wrapper start ========== -->
                <div class="tables-wrapper">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card-style mb-30">
                                <h6 class="mb-10">Filter Options:</h6>
                                <!-- <p class="text-sm mb-20">
                                    For basic styling—light padding and only horizontal dividers—use the class table.
                                </p> -->
                                <div class="row">
                                    <div class="col-6 col-lg-3">
                                        <div class="col-11 mb-1">
                                            <select class="form-select form-select-sm" id="brand" onchange="loadModel();">
                                                <option value="0">Select Brand</option>
                                                <?php
                                                $brand_rs = Database::search("SELECT * FROM `brand` ");
                                                $brand_num = $brand_rs->num_rows;

                                                for ($y = 0; $y < $brand_num; $y++) {
                                                    $brand_data = $brand_rs->fetch_assoc();
                                                ?>
                                                    <option value="<?php echo $brand_data["id"]; ?>"><?php echo $brand_data["name"]; ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6 col-lg-3">
                                        <div class="col-11 mb-1">
                                            <select class="form-select form-select-sm" id="model">
                                                <option value="0">Select Model</option>
                                                <?php
                                                $model_rs = Database::search("SELECT * FROM `model` ");
                                                $model_num = $model_rs->num_rows;

                                                for ($y = 0; $y < $model_num; $y++) {
                                                    $model_data = $model_rs->fetch_assoc();
                                                ?>
                                                    <option value="<?php echo $model_data["id"]; ?>"><?php echo $model_data["name"]; ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-10 col-lg-3">
                                            <input type="text" class="form-control form-control-sm" id="st">
                                    </div>
                                    <div class="col-2 col-lg-2">
                                            <button class="btn btn-dark" onclick="mpsearch();"><i class="lni lni-search"></i></button>
                                    </div>
                                </div>



                                <div class="table-wrapper table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <h6>ID</h6>
                                                </th>
                                                <th>
                                                    <h6>Product</h6>
                                                </th>
                                                <th>
                                                    <h6>Brand</h6>
                                                </th>
                                                <th>
                                                    <h6>Model</h6>
                                                </th>
                                                <th>
                                                    <h6>Price</h6>
                                                </th>
                                                <th>
                                                    <h6>Qty</h6>
                                                </th>
                                                <th>
                                                    <h6>Action</h6>
                                                </th>
                                            </tr>
                                            <!-- end table row-->
                                        </thead>
                                        <tbody id="tbody">
                                            <?php
                                            $product_rs = Database::search("SELECT product.id AS id, title, `model`.name AS model, `brand`.name AS brand, price, qty, status_id FROM `product` 
                                            INNER JOIN `model_has_brand` ON `product`.model_has_brand_id = `model_has_brand`.id 
                                            INNER JOIN `brand` ON `brand`.id = `model_has_brand`.brand_id INNER JOIN `model` ON `model`.id = `model_has_brand`.model_id ");
                                            $product_num = $product_rs->num_rows;
                                            for($p=0; $p < $product_num; $p++){
                                                $product = $product_rs->fetch_assoc();
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
                                                            <a href="editProduct.php?pid=<?php echo $product['id']; ?> "><i class="lni lni-pencil-alt" ></i></a>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                                <?php
                                            }
                                            ?>
                                            
                                        </tbody>
                                    </table>
                                    <!-- end table -->
                                </div>
                            </div>
                            <!-- end card -->
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->




                </div>
                <!-- ========== tables-wrapper end ========== -->
            </div>
            <!-- end container -->
        </section>
        <!-- ========== table components end ========== -->

        <?php require "footer.php"; ?>
        
    </main>
    <!-- ======== main-wrapper end =========== -->

    <!-- ========= All Javascript files linkup ======== -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/Chart.min.js"></script>
    <script src="assets/js/dynamic-pie-chart.js"></script>
    <script src="assets/js/moment.min.js"></script>
    <script src="assets/js/fullcalendar.js"></script>
    <script src="assets/js/jvectormap.min.js"></script>
    <script src="assets/js/world-merc.js"></script>
    <script src="assets/js/polyfill.js"></script>
    <script src="assets/js/main.js"></script>

    <script src="assets/js/script.js"></script>
</body>

</html>