<?php 
session_start();
	if (!isset($_SESSION["a"])) {
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" type="image/png"  href="assets/images/titleLogo.png" />

    <title>Unlimited Mobile | Admin</title>

    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">


    <!-- <link type="text/css" rel="stylesheet" href="../css/bootstrap.min.css" /> -->
    <link type="text/css" rel="stylesheet" href="../css/bootstrap.css" />
    <link type="text/css" rel="stylesheet" href="../css/slick.css" />
    <link type="text/css" rel="stylesheet" href="../css/slick-theme.css" />
    <link type="text/css" rel="stylesheet" href="../css/nouislider.min.css" />
    <link rel="stylesheet" href="../css/font-awesome.min.css">

    <link type="text/css" rel="stylesheet" href="../css/style.css" />
</head>

<body>
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
                            <a href="#" class="logo">
                                <img src="../img/logo.png">
                            </a>
                        </div>
                    </div>
                    <!-- /LOGO -->
                </div>
                <!-- row -->
            </div>
            <!-- container -->
        </div>
        <!-- /MAIN HEADER -->
    </header>
    <!-- /HEADER -->

    <nav id="navigation"></nav>


    <!-- Bcontent -->
    <div class="d-flex justify-content-center mt-5">
        <div class="box m-4">
            <div class="mt-3 fw-bold title">
                <span class="text-black">Login </span>
            </div>

            <div id="lbox">
                <div class="mt-4">
                    <span class="offset-1 col-10 alert-danger" id="error"></span>
                </div>
                <div class="row mt-2">
                    <div class="offset-1 col-10">
                        <input type="text" class="form-control" value="<?php if (isset($_COOKIE["aEmail"])) {
                                                                            echo $_COOKIE["aEmail"];
                                                                        } ?>" placeholder="Username" id="mail" />
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="offset-1 col-10">
                        <input type="password" class="form-control" value="<?php if (isset($_COOKIE["aPassword"])) {
                                                                                echo $_COOKIE["aPassword"];
                                                                            } ?>" placeholder="Password" id="pass" />
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="offset-1 col-10">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="rem">
                            <label class="form-check-label" for="flexCheckDefault">
                                Remember me
                            </label>
                        </div>
                    </div>
                </div>

                <div class="row mt-1">
                    <div class="offset-1 col-10">
                        <button type="submit" class="form-control btn btn-warning" onclick="adminSignIn();">LogIn</button>
                    </div>
                </div>

                <div class="row">
                    <a href="#" class="text-center mt-2 link-warning">Forgot Password?</a>
                </div>
            </div>

        </div>
    </div>
    <!-- Bcontent -->


    <!-- FOOTER -->
    <footer id="footer" class="mt-5">
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
                            </script> All rights reserved | developed by Nipun Anuradha
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
<script src="assets/js/script.js"></script>
</body>

</html>

<?php
	}else{
		header("Location: dashboard.php");
	}
?>