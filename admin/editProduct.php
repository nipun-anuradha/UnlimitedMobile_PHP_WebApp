<?php
require "../source/connection.php";

session_start();
if (isset($_SESSION["a"])) {
	$pid = $_GET['pid'];

	$product_rs = Database::search("SELECT * FROM `product` INNER JOIN `model_has_brand` ON `model_has_brand`.id=`product`.model_has_brand_id WHERE `product`.id='" . $pid . "' ");
	$product_data = $product_rs->fetch_assoc();

?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="icon" type="image/png" href="../img/titleLogo.png" />


		<title>Unlimited Mobile | Edit Product</title>

		<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">


		<!-- <link type="text/css" rel="stylesheet" href="./css/bootstrap.min.css" /> -->
		<link type="text/css" rel="stylesheet" href="../css/bootstrap.css" />
		<link type="text/css" rel="stylesheet" href="../css/slick.css" />
		<link type="text/css" rel="stylesheet" href="../css/slick-theme.css" />
		<link type="text/css" rel="stylesheet" href="../css/nouislider.min.css" />
		<link rel="stylesheet" href="../css/font-awesome.min.css">

		<link type="text/css" rel="stylesheet" href="../css/style.css" />
		<script src="https://cdn.ckeditor.com/4.22.1/full/ckeditor.js"></script>
	</head>

	<body style="font-size: 14px;">
		<!-- HEADER -->
		<header>
			<!-- MAIN HEADER -->
			<div id="header">
				<!-- container -->
				<div class="container-fluid">
					<!-- row -->
					<div class="row">
						<!-- LOGO -->
						<div class="col-md-3">
							<div class="header-logo">
								<a href="dashboard.php" class="logo">
									<img src="../img/logo.png" alt="">
								</a>
							</div>
						</div>
						<!-- /LOGO -->


						<!-- ACCOUNT -->
						<div class="offset-lg-5 col-md-12 col-lg-4 d-flex justify-content-center clearfix">
							<div class="row">
								<div class="header-ctn">
									<!-- home -->
									<div>
										<a href="dashboard.php">
											<i class="fa fa-th-large"></i>
											<span>Dashboard</span>
										</a>
									</div>
									<!-- /home -->

									<!-- a -->
									<div>
										<a href="../index.php">
											<i class="fa fa-home"></i>
											<span>Home</span>
										</a>
									</div>
									<!-- /a -->

									<div>
										<a href="#" onclick="adminSignOut();">
											<i class="fa fa-power-off"></i>
											<span>Sign Out</span>
										</a>
									</div>

								</div>
							</div>

						</div>
						<!-- /ACCOUNT -->
					</div>
					<!-- row -->
				</div>
				<!-- container -->
			</div>
			<!-- /MAIN HEADER -->
		</header>
		<!-- /HEADER -->

		<nav id="navigation"></nav>
		<h3 class="d-flex justify-content-center m-1">Edit Product</h3>

		<!-- Bcontent -->
		<div class="container">
			<div class="row">

				<div class="col-12 col-lg-4">
					<div class="row">
						<div class="col-12">
							<label class="form-label fw-bold">Select product Category</label>
						</div>
						<div class="col-11 mb-1">
							<select class="form-select" id="category">
								<option value="0">Select Category</option>

								<?php
								$category_rs = Database::search("SELECT * FROM  `category` ");
								$category_num = $category_rs->num_rows;

								for ($x = 0; $x < $category_num; $x++) {
									$category_data = $category_rs->fetch_assoc();

									$selectC = ($product_data["category_id"] == $category_data["id"]) ? 'selected' : '';
								?>
									<option value="<?php echo $category_data["id"]; ?>" <?php echo $selectC; ?>><?php echo $category_data["name"]; ?></option>
								<?php
								}
								?>
							</select>
						</div>
						<div class="d-flex justify-content-end col-1">
							<button class="btn btn-outline-secondary btn-sm" onclick="cview();" style="height: 38px;">+</button>
						</div>

						<div class="mb-2 d-none" id="cedit">
							<input type="text" class="form-control mb-1" id="ctext">
							<button class="btn btn-warning" onclick="addCategory();">Add</button>
							<button class="btn btn-outline-warning" onclick="removeCategory();">Delete</button>
						</div>

					</div>
				</div>

				<div class="col-12 col-lg-4">
					<div class="row">
						<div class="col-12">
							<label class="form-label fw-bold">Select Brand</label>
						</div>
						<div class="col-11 mb-1">
							<select class="form-select" id="brand" onchange="loadModel();">

								<option value="0">Select Brand</option>

								<?php
								$brand_rs = Database::search("SELECT * FROM `brand` ");
								$brand_num = $brand_rs->num_rows;

								for ($y = 0; $y < $brand_num; $y++) {
									$brand_data = $brand_rs->fetch_assoc();

									$selectB = ($product_data["brand_id"] == $brand_data["id"]) ? 'selected' : '';
								?>
									<option value="<?php echo $brand_data["id"]; ?>" <?php echo $selectB; ?>><?php echo $brand_data["name"]; ?></option>
								<?php
								}
								?>
							</select>
						</div>
						<div class="d-flex justify-content-end col-1">
							<button class="btn btn-outline-secondary btn-sm " onclick="bview();" style="height: 38px;">+</button>
						</div>

						<div class="mb-2 d-none" id="bedit">
							<input type="text" class="form-control mb-1" id="btext">
							<button class="btn btn-warning" onclick="addBrand();">Add</button>
							<button class="btn btn-outline-warning" onclick="removeBrand();">Delete</button>
						</div>

					</div>
				</div>
				<div class="col-12 col-lg-4">
					<div class="row">
						<div class="col-12">
							<label class="form-label fw-bold">Select product Model</label>
						</div>
						<div class="col-11 mb-1">
							<select class="form-select" id="model">

								<option value="0">Select Model</option>
								<?php
								$model_rs = Database::search("SELECT * FROM `model` ");
								$model_num = $model_rs->num_rows;

								for ($z = 0; $z < $model_num; $z++) {
									$model_data = $model_rs->fetch_assoc();

									$selectM = ($product_data["model_id"] == $model_data["id"]) ? 'selected' : '';
								?>
									<option value="<?php echo $model_data["id"]; ?>" <?php echo $selectM; ?>><?php echo $model_data["name"]; ?></option>
								<?php
								}
								?>
							</select>
						</div>
						<div class="d-flex justify-content-end col-1">
							<button class="btn btn-outline-secondary btn-sm " onclick="mview();" style="height: 38px;">+</button>
						</div>

						<div class="mb-2 d-none" id="medit">
							<input type="text" class="form-control mb-1" id="mtext">
							<button class="btn btn-warning" onclick="addModel();">Add</button>
							<button class="btn btn-outline-warning" onclick="removeModel();">Delete</button>
						</div>
					</div>
				</div>

				<div class="col-12">
					<hr style="height:3px; width:100%; border-width:0; color:red; background-color:red">
				</div>

				<div class="col-12 mb-3">
					<div class="row">

						<div class="col-12">
							<label class="form-label fw-bold">Add a title to your Product</label>
						</div>

						<div class="offset-0 offset-lg-2 col-12 col-lg-8">
							<input type="text" class="form-control" id="title" value="<?php echo $product_data["title"] ?>" />
						</div>

					</div>
				</div>

				<div class="col-12">
					<hr style="height:3px; width:100%; border-width:0; color:red; background-color:red">
				</div>

				<div class="col-12">
					<div class="row">

						<div class="col-12 col-lg-4">
							<div class="row">

								<div class="col-12">
									<label class="form-label fw-bold">Select Product Condition</label>
								</div>

								<?php
								$brand_new_checked = ($product_data["condition_id"] == 1) ? 'checked' : '';
								$used_checked = ($product_data["condition_id"] == 2) ? 'checked' : '';
								?>

								<div class="offset-1 col-11 col-lg-4 ms-5 form-check">
									<input class="form-check-input" type="radio" type="radio" name="condition" id="bn" <?php echo $brand_new_checked; ?>>
									<label class="form-check-label" for="bn">
										Brand new
									</label>
								</div>
								<div class="offset-1 col-11 col-lg-3 ms-5 form-check">
									<input class="form-check-input" type="radio" name="condition" id="us" <?php echo $used_checked; ?>>
									<label class="form-check-label" for="us">
										Used
									</label>
								</div>

							</div>
						</div>

						<div class="col-12 col-lg-4">
							<div class="row">

								<div class="col-12">
									<label class="form-label fw-bold">Old Price</label>
								</div>
								<div class="input-group mb-3">
									<span class="input-group-text">Rs.</span>
									<input type="text" class="form-control" id="op" value="<?php echo $product_data["oldPrice"] ?>">
									<span class="input-group-text">.00</span>
								</div>

							</div>
						</div>

						<div class="col-12 col-lg-4">
							<div class="row">

								<div class="col-12">
									<label class="form-label fw-bold">Cost per Item</label>
								</div>
								<div class="input-group mb-3">
									<span class="input-group-text">Rs.</span>
									<input type="text" class="form-control" aria-label="Amount (to the nearest rupee)" id="cost" value="<?php echo $product_data["price"] ?>">
									<span class="input-group-text">.00</span>
								</div>

							</div>
						</div>

					</div>
				</div>

				<div class="col-12">
					<hr style="height:3px; width:100%; border-width:0; color:red; background-color:red">
				</div>

				<div class="col-12 col-lg-4">
					<div class="row m-1">
						<label class="form-label fw-bold">Add Product Quentity</label>
						<input type="number" class="form-control" value="<?php echo $product_data["qty"] ?>" min="1" id="qty" />
					</div>
				</div>

				<div class="col-12 col-lg-4">
					<div class="row">
						<div class="col-12">
							<label class="form-label fw-bold">Select Color</label>
						</div>
						<div class="col-11 mb-1">
							<select class="form-select" id="clrS">

								<option value="0">Select Color</option>

								<?php
								$clr_rs = Database::search("SELECT * FROM `color` ORDER BY `name` ASC ");
								$clr_num = $clr_rs->num_rows;

								for ($y = 0; $y < $clr_num; $y++) {
									$clr_data = $clr_rs->fetch_assoc();

									$selectClr = ($product_data["color_id"] == $clr_data["id"]) ? 'selected' : '';
								?>
									<option value="<?php echo $clr_data["id"]; ?>" <?php echo $selectClr; ?>><?php echo $clr_data["name"]; ?></option>
								<?php
								}
								?>
							</select>
						</div>
					</div>
				</div>

				<div class="col-12 col-lg-4">
					<div class="row">
						<div class="col-12">
							<label class="form-label fw-bold">New Color</label>
						</div>
						<div class="col-10">
							<input type="text" class="form-control" id="nc" />
						</div>
						<div class="d-flex justify-content-end col-2">
							<button class="btn btn-outline-secondary btn-sm " onclick="newcolor();">Add</button>
						</div>
					</div>
				</div>

				<div class="col-12">
					<hr style="height:3px; width:100%; border-width:0; color:red; background-color:red">
				</div>

				<div class="col-12">
					<div class="row">

						<div class="col-12">
							<label class="form-label fw-bold lbl1">Product Description</label>
						</div>
						<div class="col-12">
							<textarea class="form-control" name="editor1" cols="10" rows="10" id="editor1">
							<?php echo $product_data["description"]; ?>
							</textarea>
						</div>

					</div>
				</div>

				<div class="col-12">
					<hr style="height:3px; width:100%; border-width:0; color:red; background-color:red">
				</div>

				<div class="col-12">
					<div class="row">

						<div class="col-6 col-lg-2">
							<label class="form-label fw-bold lbl1">Add Product Images</label>
						</div>
						<div class="col-6 col-lg-2 mb-2">
							<input type="file" accept="img/*" class="d-none" name="file[]" id="imgUpload" multiple />
							<label for="imgUpload" class="col-12 btn btn-warning btn-sm" onclick="changeProductImg();">Select Images</label>
						</div>
						<div class="col-12">
							<label class="form-label fw-bold lbl1">Notice...</label>
							<br/>
							<label class="form-label">Recomanded image size for select 600 x 600 pixel.</label>
						</div>
						<div class="offset-lg-3 col-12 col-lg-6">
							<div class="row d-flex justify-content-center">

								<?php
								$image_rs = Database::search("SELECT * FROM `image` WHERE product_id='" . $pid . "' ");
								$image_count = $image_rs->num_rows;

								$default_image_path = "img/add.png";

								// Display up to 3 images
								for ($i = 0; $i < 3; $i++) {
									$image_data = ($i < $image_count) ? $image_rs->fetch_assoc() : null;
									$image_src = ($image_data) ? $image_data['code'] : $default_image_path;
								?>

									<div class="col-3 border border-secondary rounded">
										<img class="img-fluid" src="../<?php echo $image_src; ?>" id="preview<?php echo $i; ?>" style="width: 250px;" />
									</div>

								<?php
								}
								?>

							</div>
						</div>

						<div class="offset-lg-4 col-12 col-lg-4 d-grid mb-3 mt-3">
							<button class="btn btn-warning fw-bold" onclick="editProduct(<?php echo $pid; ?>);">Update Product</button>
						</div>

					</div>
				</div>

			</div>
		</div>


		</div>
		</div>
		<!-- Bcontent -->

		<!-- FOOTER -->
		<footer id="footer">

			<!-- bottom footer -->
			<div id="bottom-footer" class="section">
				<div class="container">
					<!-- row -->
					<div class="row">
						<div class="col-md-12 text-center">
							<ul class="footer-payments">
								<li><a><i class="fa fa-cc-visa"></i></a></li>
								<li><a><i class="fa fa-credit-card"></i></a></li>
								<li><a><i class="fa fa-cc-paypal"></i></a></li>
								<li><a><i class="fa fa-cc-mastercard"></i></a></li>
								<li><a><i class="fa fa-cc-discover"></i></a></li>
								<li><a><i class="fa fa-cc-amex"></i></a></li>
							</ul>
							<span class="copyright">
								Copyright &copy;<script>
									document.write(new Date().getFullYear());
								</script> All rights reserved | developed by <a href="https://nipun-anuradha.github.io/" style="color: gray;"> Acxa Solutions </a>
							</span>
						</div>
					</div>
					<!-- /row -->
				</div>
				<!-- /container -->
			</div>
			<!-- /bottom footer -->
		</footer>
		<!-- /FOOTER -->

		<script src="../script.js"></script>
		<script src="assets/js/script.js"></script>
		<script>
			CKEDITOR.replace('editor1');
		</script>
	</body>

	</html>
<?php
} else {
	header("Location: index.php");
}
?>