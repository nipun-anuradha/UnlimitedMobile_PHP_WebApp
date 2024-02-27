<?php
session_start();
if (isset($_SESSION["u"])) {
    header("Location: ../index.php");
} else {
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png"  href="../img/titleLogo.png" />

        <title>Unlimited Mobile | My Account</title>

        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">


        <!-- <link type="text/css" rel="stylesheet" href="../css/bootstrap.min.css" /> -->
        <link type="text/css" rel="stylesheet" href="../css/bootstrap.css" />
        <link type="text/css" rel="stylesheet" href="../css/slick.css" />
        <link type="text/css" rel="stylesheet" href="../css/slick-theme.css" />
        <link type="text/css" rel="stylesheet" href="../css/nouislider.min.css" />
        <link rel="stylesheet" href="../css/font-awesome.min.css">

        <link rel="stylesheet" href="../admin/assets/css/lineicons.css">


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
                                <a href="../index.php" class="logo">
                                    <img src="../img/logo.png" alt="">
                                </a>
                            </div>
                        </div>
                        <!-- /LOGO -->


                        <!-- ACCOUNT -->
                        <div class="offset-lg-5 col-md-12 col-lg-4 d-flex justify-content-end clearfix">
                            <div class="row">
                                <div class="header-ctn">
                                    <!-- home -->
                                    <div>
                                        <a href="../index.php">
                                            <i class="fa fa-home"></i>
                                            <span>Home</span>
                                        </a>
                                    </div>
                                    <!-- /home -->

                                    <!-- a -->
                                    <div>
                                        <a href="#">
                                            <i class="fa fa-user-o"></i>
                                            <span>My Account</span>
                                        </a>
                                    </div>
                                    <!-- /a -->

                                    <!-- Wishlist -->
                                    <div>
                                        <a href="#">
                                            <i class="fa fa-heart-o"></i>
                                            <span>Your Wishlist</span>
                                        </a>
                                    </div>
                                    <!-- /Wishlist -->

                                    <!-- cart -->
                                    <div>
                                        <a href="#">
                                            <i class="fa fa-shopping-cart"></i>
                                            <span>Your Cart</span>
                                        </a>
                                    </div>
                                    <!-- /cart -->

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


        <!-- Bcontent -->
        <div class="d-flex justify-content-center">
            <div class="box m-4">

                <div class="mt-3 fw-bold title d-none" id="fp">
                    <span class="text-black">Forget Password</span>
                </div>
                <div class="mt-3 fw-bold title" id="lr">
                    <span class="text-black" id="l" onclick="loginf();">Login </span>|<span class="text-secondary" id="r" onclick="registerf();"> Register</span>
                </div>

                <div id="lbox">
                    <div class="mt-4">
                        <span class="offset-1 col-10 alert-danger" id="serror"></span>
                    </div>
                    <div class="row mt-2">
                        <div class="offset-1 col-10">
                            <input type="text" class="form-control" value="<?php if (isset($_COOKIE["email"])) {
                                                                                echo $_COOKIE["email"];
                                                                            } ?>" placeholder="Username" id="smail" />
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="offset-1 col-10">
                            <input type="password" class="form-control" value="<?php if (isset($_COOKIE["password"])) {
                                                                                    echo $_COOKIE["password"];
                                                                                } ?>" placeholder="Password" id="spass" />
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
                            <button type="submit" class="form-control btn btn-warning" onclick="signIn();">LogIn</button>
                        </div>
                    </div>

                    <div class="row">
                        <a style="cursor:pointer;" class="text-center mt-2 link-warning" onclick="forgetPass();">Forgot Password?</a>
                    </div>

                    <div class="row mt-4">
                        <div class="offset-1 col-10">
                            <button type="submit" class="form-control " onclick=""><img src="../img/googleicon.png" width="32px"> Login with Google</button>
                        </div>
                    </div>
                </div>

                <!-- /reg -->
                <div id="rbox" class="d-none">
                    <span class="offset-1 col-10 alert-danger" id="error"></span>

                    <div class="row mt-2">
                        <div class="offset-1 col-5">
                            <input type="text" class="form-control" placeholder="First name" id="fname" />
                        </div>
                        <div class="col-5">
                            <input type="text" class="form-control" placeholder="Last name" id="lname" />
                        </div>
                    </div>
                    <div class="mt-3">
                        <div class="offset-1 col-10">
                            <div class="form-group">
                                <input type="email" class="form-control" id="mail" placeholder="name@example.com">
                            </div>
                        </div>
                    </div>
                    <div class="mt-3 offset-1 col-10">
                        <div class="form-group">
                            <input type="password" class="form-control" id="pass" placeholder="Password">
                        </div>
                    </div>
                    <div class="mt-3 offset-1 col-10">
                        <div class="form-group">
                            <input type="password" class="form-control" id="cpass" placeholder="Confirm Password">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="offset-1 col-10 mt-1">
                            <small class="form-text text-muted">Your personal data will be used to support your experiance throughout this website, to manage access to your account.</small>
                            <button type="button" class="form-control btn btn-warning" onclick="signUp();">Register</button>
                        </div>
                    </div>
                </div>

                <!-- forget password -->
                <div id="fbox" class="d-none">
                    <div class="mt-3">
                        <span class="offset-1 col-10 alert-danger" id="sendError"></span>
                    </div>

                    <div class="" id="svm">
                        <div class="mt-4">
                            <div class="offset-1 col-10">
                                <div class="form-group">
                                    <input type="email" class="form-control" id="fmail" placeholder="name@example.com">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="offset-1 col-10 mt-3">
                                <small class="form-text text-muted">Enter email to send verification code. Please check your inbox as well as spam folder.</small>
                                <button type="button" class="form-control btn btn-warning" onclick="sendVmail();">Send Verification</button>
                            </div>
                        </div>
                    </div>




                    <div class="d-none" id="np">
                        <div class="mt-3">
                            <span class="offset-1 col-10 alert-danger" id="newError"></span>
                        </div>
                        <div class="mt-1 offset-1 col-10">
                            <div class="form-group">
                                <input type="password" class="form-control" id="vcode" placeholder="Verification Code">
                            </div>
                        </div>
                        <div class="mt-3 offset-1 col-10">
                            <div class="form-group">
                                <input type="password" class="form-control" id="npass" placeholder="New Password">
                            </div>
                        </div>
                        <div class="mt-3 offset-1 col-10">
                            <div class="form-group">
                                <input type="password" class="form-control" id="ncpass" placeholder="Confirm New Password">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="offset-1 col-10 mt-1">
                                <small class="form-text text-muted">Please check your inbox as well as spam folder.</small>
                                <button type="button" class="form-control btn btn-warning" onclick="newPass();">Submit</button>
                            </div>
                        </div>
                    </div>


                </div>

            </div>
        </div>
        <!-- Bcontent -->


<?php require "../footer.php"; ?>

        <script src="script.js"></script>
    </body>

    </html>

<?php
}
?>