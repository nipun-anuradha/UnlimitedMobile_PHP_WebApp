<?php
require "source/connection.php";
session_start();
if (isset($_SESSION["u"])) {
?>

	<!DOCTYPE html>
	<html lang="en">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="icon" type="image/png"  href="img/titleLogo.png" />

		<title>Unlimited Mobile | Cart</title>

		<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">


		<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />
		<link type="text/css" rel="stylesheet" href="css/slick.css" />
		<link type="text/css" rel="stylesheet" href="css/slick-theme.css" />
		<link type="text/css" rel="stylesheet" href="css/nouislider.min.css" />
		<link rel="stylesheet" href="css/font-awesome.min.css">

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

		<link type="text/css" rel="stylesheet" href="css/style.css" />

	</head>

	<body>
		<?php require "header.php"; ?>


		<!-- Red line, side menu -->
		<nav id="navigation">
			<div class="container">
				<!-- responsive-nav -->
				<div id="responsive-nav">
					<!-- NAV -->
					<ul class="main-nav nav navbar-nav">
						<li class="active"><a href="#">Home</a></li>
						<li><a href="#"><b>| Advance Search |</b></a></li>
						<li><a href="#">Hot Deals</a></li>
						<li><a href="#">Smart Watches</a></li>
						<li><a href="#">Smartphones</a></li>
						<li><a href="#">Cameras</a></li>
						<li><a href="#">Accessories</a></li>
					</ul>
					<!-- /NAV -->
				</div>
				<!-- /responsive-nav -->
			</div>
		</nav>


		<!-- BREADCRUMB -->
		<div id="breadcrumb" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<h3 class="breadcrumb-header">SHOPPING CART</h3>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /BREADCRUMB -->

		<?php

		$uemail = $_SESSION["u"]["email"];
		$cart_rs = Database::search("SELECT * FROM `cart` WHERE `user_email`='" . $uemail . "'");
		$cart_num = $cart_rs->num_rows;

		if ($cart_num == 0) {
		?>
			<h2 class="text-center text-muted"><i class="fa fa-shopping-cart"></i> Cart is empty</h2>
			<?php
		} else {
			$total = 0;
			$items = 0;

			for ($x = 0; $x < $cart_num; $x++) {
				$cart_data = $cart_rs->fetch_assoc();

				$product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $cart_data["product_id"] . "'");
				$product_data = $product_rs->fetch_assoc();

				$c_rs = Database::search("SELECT * FROM `condition` WHERE `id`='" . $product_data["condition_id"] . "' ");
				$c = $c_rs->fetch_assoc();

				$total = $total + ($product_data["price"] * $cart_data["qty"]);
				$items += $cart_data["qty"];
			?>
				<div class="c-card">
					<div class="row">

						<div class="col-xs-4 col-md-3">
							<?php

							$img_rs = Database::search("SELECT * FROM `image` WHERE `product_id`='" . $product_data["id"] . "'");
							$img_data = $img_rs->fetch_assoc();

							?>
							<img src="<?php echo $img_data["code"]; ?>" style="width: 200px;">
						</div>
						<div class="col-xs-5 col-md-4" style="margin-top: 30px;">
							<h3 class=""><?php echo $product_data["title"]; ?></h3>
							<?php 
								if($product_data["color_id"] != ""){
									$clr_rs = Database::search("SELECT * FROM `color` WHERE `id`='".$product_data["color_id"]."' ");
									$clr = $clr_rs->fetch_assoc();
									?>
									<span class="c-text">Color : <?php echo $clr["name"]; ?></span> &nbsp; | &nbsp;
									<?php
								}
							?>
							<span class="c-text">Condition : <?php echo $c["name"]; ?></span>

							<br />

							<span class="c-text">Price :</span>&nbsp;
							<span class="c-text">Rs. <?php echo $product_data["price"]; ?>.00</span>

							<br />

						</div>
						<div class="col-xs-2 col-md-2">
							<label class="form-label fw-bold" style="margin-top: 40px;">Quentity</label>
							<input type="number" class="form-control " onchange="updateQty(<?php echo $product_data['id']; ?>, <?php echo $cart_data['qty']; ?>);" value="<?php echo $cart_data["qty"]; ?>" min="1" id="qty<?php echo  $product_data['id'] ?>" style="width: 60px;" />
						</div>
						<div class="col-xs-2 col-md-2" style="margin-top: 60px;">
							<button class="btn btn-danger" onclick="deleteFromCart(<?php echo $cart_data['id']; ?>);"><i class="fa fa-close"></i> Remove</button>
						</div>

					</div>
				</div>
			<?php
			}
			?>
			<div class="row col-md-11">
				<div class="text-right">
					<h5><span id="inum"><?php echo $items; ?></span> Items</h5>
					<h5 id="tot">SUBTOTAL : Rs.<?php echo $total; ?>.00</h5>
					<button class="btn btn-warning" onclick="checkout();">Checkout</button>
				</div>
			</div>
		<?php
		}
		?>



		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->


		<?php require "footer.php"; ?>

		<!-- jQuery Plugins -->
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/slick.min.js"></script>
		<script src="js/nouislider.min.js"></script>
		<script src="js/jquery.zoom.min.js"></script>
		<script src="js/main.js"></script>

		<script src="script.js"></script>

	</body>

	</html>

<?php
} else {
	header("Location: my-account/index.php");
}
?>