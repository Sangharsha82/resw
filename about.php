<?php
session_start();
include_once "includes/connection.php";
include_once "includes/functions.php";

$current_page = basename($_SERVER['PHP_SELF']);
$page_title = "About Us - Real Estate Management System";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $page_title; ?></title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" href="assets/style.css" />
    <link rel="stylesheet" href="assets/navbar.css" />
    <script src="assets/jquery-1.9.1.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.js"></script>
    <script src="assets/script.js"></script>

    <!-- Owl stylesheet -->
    <link rel="stylesheet" href="assets/owl-carousel/owl.carousel.css">
    <link rel="stylesheet" href="assets/owl-carousel/owl.theme.css">
    <script src="assets/owl-carousel/owl.carousel.js"></script>
    <!-- Owl stylesheet -->

    <!-- slitslider -->
    <link rel="stylesheet" type="text/css" href="assets/slitslider/css/style.css" />
    <link rel="stylesheet" type="text/css" href="assets/slitslider/css/custom.css" />
    <script type="text/javascript" src="assets/slitslider/js/modernizr.custom.79639.js"></script>
    <script type="text/javascript" src="assets/slitslider/js/jquery.ba-cond.min.js"></script>
    <script type="text/javascript" src="assets/slitslider/js/jquery.slitslider.js"></script>
    <!-- slitslider -->

    <script src='assets/google_analytics_auto.js'></script>

    <style>
        /* Navigation styles */
        .navbar {
            min-height: 50px;
        }

        .navbar-brand {
            padding: 0 15px;
            height: 50px;
            line-height: 50px;
        }

        .navbar-brand img {
            display: inline-block;
            vertical-align: middle;
        }

        .navbar-nav>li>a {
            line-height: 50px;
            padding-top: 0;
            padding-bottom: 0;
        }

        @media (max-width: 767px) {
            .navbar-nav>li>a {
                line-height: normal;
                padding-top: 10px;
                padding-bottom: 10px;
            }
        }

        /* New color scheme styles */
        .inside-banner {
            background-color: #2c3e50;
            color: white;
        }

        .btn-primary {
            background-color: #3498db;
            border-color: #3498db;
        }

        .btn-primary:hover {
            background-color: #2980b9;
            border-color: #2980b9;
        }
    </style>
</head>

<body>

<?php include 'includes/nav.php'; ?>

<!-- banner -->
<div class="inside-banner">
    <div class="container">
        <h2>About Us</h2>
    </div>
</div>
<!-- banner -->

<div class="container">
    <div class="spacer">
        <div class="row">
            <div class="col-lg-8 col-sm-12">
                <h2>About Jaggamandu</h2>
                <p>Jaggamandu is your trusted partner in real estate. We specialize in connecting buyers and
                    renters with their perfect properties. Our mission is to make the property search process
                    simple, transparent, and efficient.</p>
                <p>With years of experience in the real estate market, we understand the unique needs of our clients
                    and work tirelessly to provide the best property solutions.</p>
            </div>
            <div class="col-lg-4 col-sm-12">
                <div class="well">
                    <h3>Why Choose Us?</h3>
                    <ul>
                        <li>Extensive Property Database</li>
                        <li>Professional Agents</li>
                        <li>Transparent Process</li>
                        <li>Customer Support</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div style="background-color: #0BE0FD">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-sm-3">
                <h4>Information</h4>
                <ul class="row">
                    <li class="col-lg-12 col-sm-12 col-xs-3"><a href="index.php">Home</a></li>
                    <li class="col-lg-12 col-sm-12 col-xs-3"><a href="about.php">About</a></li>
                    <li class="col-lg-12 col-sm-12 col-xs-3"><a href="contact.php">Contact</a></li>
                </ul>
            </div>

            <div class="col-lg-3 col-sm-3">
                <h4>Follow us</h4>
                <a href="#"><img src="images/facebook.png" alt="facebook"></a>
                <a href="#"><img src="images/twitter.png" alt="twitter"></a>
                <a href="#"><img src="images/linkedin.png" alt="linkedin"></a>
                <a href="#"><img src="images/instagram.png" alt="instagram"></a>
            </div>

            <div class="col-lg-3 col-sm-3">
                <h4>Contact us</h4>
                <p><b>Jaggamandu</b><br>
                    <span class="glyphicon glyphicon-map-marker"></span>Bhaktapur<br>
                    <span class="glyphicon glyphicon-envelope"></span>jaggamandubkt@gmail.com<br>
                    <span class="glyphicon glyphicon-earphone"></span> +123456789
                </p>
            </div>
        </div>
    </div>
</div>
</body>
</html>