<?php
session_start();
if (isset($_SESSION["a"])) {
?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="icon" type="image/png"  href="img/titleLogo.png" />


		<title>Unlimited Mobile | Add Product</title>

		<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">


		<!-- <link type="text/css" rel="stylesheet" href="./css/bootstrap.min.css" /> -->
		<link type="text/css" rel="stylesheet" href="./css/bootstrap.css" />
		<link type="text/css" rel="stylesheet" href="./css/slick.css" />
		<link type="text/css" rel="stylesheet" href="./css/slick-theme.css" />
		<link type="text/css" rel="stylesheet" href="./css/nouislider.min.css" />
		<link rel="stylesheet" href="./css/font-awesome.min.css">

		<link type="text/css" rel="stylesheet" href="./css/style.css" />
		<script src="https://cdn.ckeditor.com/4.22.1/full/ckeditor.js"></script>
	</head>

	<body style="font-size: 14px;">
		<?php
		require "source/connection.php";
		?>
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
								<a href="admin/dashboard.php" class="logo">
									<img src="./img/logo.png" alt="">
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
										<a href="admin/dashboard.php">
											<i class="fa fa-th-large"></i>
											<span>Dashboard</span>
										</a>
									</div>
									<!-- /home -->

									<!-- a -->
									<div>
										<a href="index.php">
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
		<h3 class="d-flex justify-content-center m-1">Add New Product</h3>


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
								?>
									<option value="<?php echo $category_data["id"]; ?>"><?php echo $category_data["name"]; ?></option>
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
							<label class="form-label fw-bold" >Select Brand</label>
						</div>
						<div class="col-11 mb-1">
							<select class="form-select" id="brand" onchange="loadModel();">

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
								?>
									<option value="<?php echo $model_data["id"]; ?>"><?php echo $model_data["name"]; ?></option>
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
							<input type="text" class="form-control" id="title" />
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
								<div class="offset-1 col-11 col-lg-4 ms-5 form-check">
									<input class="form-check-input" type="radio" type="radio" name="condition" id="bn" checked>
									<label class="form-check-label" for="bn">
										Brand new
									</label>
								</div>
								<div class="offset-1 col-11 col-lg-3 ms-5 form-check">
									<input class="form-check-input" type="radio" name="condition" id="us">
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
									<input type="text" class="form-control" id="op">
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
									<input type="text" class="form-control" aria-label="Amount (to the nearest rupee)" id="cost">
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
						<input type="number" class="form-control" value="1" min="1" id="qty" />
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
								?>
									<option value="<?php echo $clr_data["id"]; ?>"><?php echo $clr_data["name"]; ?></option>
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
							<button class="btn btn-outline-secondary btn-sm " onclick="newcolor();" >Add</button>
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
							<textarea class="form-control" name="editor1" cols="10" rows="10" id="editor1"></textarea>
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
							<br />
							<label class="form-label">Recomanded image size for select 600 x 600 pixel.</label>
						</div>
						<div class="offset-lg-3 col-12 col-lg-6">
							<div class="row d-flex justify-content-center">

								<div class="col-3 border border-secondary rounded">
									<img class="img-fluid" src="img/add.png" id="preview0" style="width: 250px;" />
								</div>
								<div class="col-3 border border-secondary rounded">
									<img class="img-fluid" src="img/add.png" id="preview1" style="width: 250px;" />
								</div>
								<div class="col-3 border border-secondary rounded">
									<img class="img-fluid" src="img/add.png" id="preview2" style="width: 250px;" />
								</div>

							</div>
						</div>

						<div class="offset-lg-4 col-12 col-lg-4 d-grid mb-3 mt-3">
							<button class="btn btn-warning fw-bold" onclick="addProduct();">Add Product</button>
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
			<!-- top footer -->
			<div class="container section">
				<div class="row" style="font-size: 13px;">

					<div class="col-md-3 col-12">
						<div class="footer">
							<h3 class="footer-title">About Us</h3>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut.</p>
							<ul class="footer-links">
								<li><a href="#"><i class="fa fa-map-marker"></i>1734 Stonecoal Road</a></li>
								<li><a href="#"><i class="fa fa-phone"></i>+021-95-51-84</a></li>
								<li><a href="#"><i class="fa fa-envelope-o"></i>email@email.com</a></li>
							</ul>
						</div>
					</div>

					<div class="col-md-3 col-12">
						<div class="footer">
							<h3 class="footer-title">Categories</h3>
							<ul class="footer-links">
								<li><a href="#">Hot deals</a></li>
								<li><a href="#">Laptops</a></li>
								<li><a href="#">Smartphones</a></li>
								<li><a href="#">Cameras</a></li>
								<li><a href="#">Accessories</a></li>
							</ul>
						</div>
					</div>

					<div class="col-md-3 col-12">
						<div class="footer">
							<h3 class="footer-title">Information</h3>
							<ul class="footer-links">
								<li><a href="#">About Us</a></li>
								<li><a href="#">Contact Us</a></li>
								<li><a href="#">Privacy Policy</a></li>
								<li><a href="#">Orders and Returns</a></li>
								<li><a href="#">Terms & Conditions</a></li>
							</ul>
						</div>
					</div>

					<div class="col-md-3 col-12">
						<div class="footer">
							<h3 class="footer-title">Service</h3>
							<ul class="footer-links">
								<li><a href="#">My Account</a></li>
								<li><a href="#">View Cart</a></li>
								<li><a href="#">Wishlist</a></li>
								<li><a href="#">Track My Order</a></li>
								<li><a href="#">Help</a></li>
							</ul>
						</div>
					</div>

				</div>
			</div>
			<!-- /top footer -->

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

		<script src="script.js"></script>
		<script src="admin/assets/js/script.js"></script>
		<script>
			CKEDITOR.replace('editor1');
		</script>
	</body>

	</html>
<?php
} else {
	header("Location: admin/index.php");
}
?>