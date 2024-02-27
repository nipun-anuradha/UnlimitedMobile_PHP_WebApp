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
    <title>Manage User</title>

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
                                <h2>Manage Users</h2>
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
                                            User
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
                                        
                                    <div class="col-10 col-lg-3">
                                            <input type="text" class="form-control form-control-sm" id="st">
                                    </div>
                                    <div class="col-2 col-lg-2">
                                            <button class="btn btn-dark" onclick="userSearch();"><i class="lni lni-search"></i></button>
                                    </div>
                                </div>



                                <div class="table-wrapper table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <h6>User</h6>
                                                </th>
                                                <th>
                                                    <h6>First Name</h6>
                                                </th>
                                                <th>
                                                    <h6>Last Name</h6>
                                                </th>
                                                <th>
                                                    <h6>Mobile</h6>
                                                </th>
                                                <th>
                                                    <h6>Joined Date</h6>
                                                </th>
                                                <th>
                                                    <h6>Actions</h6>
                                                </th>
                                            </tr>
                                            <!-- end table row-->
                                        </thead>
                                        <tbody id="tbody">
                                            <?php
                                            $user_rs = Database::search("SELECT * FROM `user` ");
                                            $user_num = $user_rs->num_rows;
                                            for($p=0; $p < $user_num; $p++){
                                                $user = $user_rs->fetch_assoc();
                                                ?>
                                                <tr>
                                                <td class="min-width">
                                                    <div class="lead">
                                                        <div class="lead-image">
                                                            <img src="../img/usericon.jpg"/>
                                                        </div>
                                                        <div class="lead-text">
                                                            <p><?php echo $user["email"]; ?></p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="min-width">
                                                    <p><a href="#0"><?php echo $user["fname"];; ?></a></p>
                                                </td>
                                                <td class="min-width">
                                                    <p><?php echo $user["lname"];; ?></p>
                                                </td>
                                                <td>
                                                    <p><?php echo $user["mobile"]; ?></p>
                                                </td>
                                                <td class="min-width">
                                                    <p><?php echo $user["joined_date"]; ?></p>
                                                </td>
                                                <td>
                                                    <div class="action">
                                                        <?php 
                                                            if($user["status_id"] == '1'){
                                                                ?>
                                                                <button class="text-success" id="c<?php echo $user['email']; ?>" onclick="blockUser('<?php echo $user['email']; ?>');">
                                                                <i class="lni lni-unlock" id="i<?php echo $user['email']; ?>"></i>
                                                                </button>
                                                                <?php
                                                            }else{
                                                                ?>
                                                                <button class="text-danger" id="c<?php echo $user['email']; ?>" onclick="blockUser('<?php echo $user['email']; ?>');">
                                                                    <i class="lni lni-lock" id="i<?php echo $user['email']; ?>"></i>
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