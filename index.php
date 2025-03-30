<?php
session_start();
include_once "includes/connection.php";
include_once "includes/functions.php";

$query = "select * from properties";
$result = mysqli_query($con, $query);

if (!$result) {
  echo "Error Found!!!";
}
?>

<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from thebootstrapthemes.com/live/thebootstrapthemes-realestate/index.php by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 11 Apr 2017 02:43:16 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
  <title>Real Estate Management System</title>
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

    /* Property Image Styles - Only for Featured Properties */
    .properties .image-holder {
      width: 100%;
      position: relative;
      overflow: hidden;
      height: 180px;
    }

    .properties .image-holder img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      object-position: center;
    }

    /* Featured Properties in Owl Carousel */
    #owl-example .item img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .owl-item .properties {
      margin: 0 15px;
      height: auto;
      display: flex;
      flex-direction: column;
      padding: 10px;
      background: #fff;
      border: 1px solid #ddd;
      border-radius: 4px;
      box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }

    /* Property details styling */
    .properties h4 {
      margin: 8px 0;
      font-size: 16px;
      line-height: 1.4;
      height: auto;
      overflow: hidden;
    }

    .properties .price {
      font-size: 13px;
      margin: 3px 0;
      color: #666;
    }

    .properties .listing-detail {
      margin: 10px 0;
    }

    .properties .btn {
      margin-top: auto;
      padding: 6px 12px;
    }

    /* Status badge positioning */
    .properties .status {
      position: absolute;
      top: 10px;
      right: 10px;
      z-index: 1;
    }

    /* Make featured property images responsive */
    @media (max-width: 768px) {
      .properties .image-holder {
        height: 180px;
      }
    }

    /* New color scheme styles */
    .inside-banner {
      background-color: #2c3e50;
      color: white;
    }

    .banner-search {
      background-color: #34495e;
      color: white;
    }

    .properties-listing h2 {
      color: #2c3e50;
    }

    .properties h4 a {
      color: #2c3e50;
    }

    .properties h4 a:hover {
      color: #3498db;
    }

    .btn-primary {
      background-color: #3498db;
      border-color: #3498db;
    }

    .btn-primary:hover {
      background-color: #2980b9;
      border-color: #2980b9;
    }

    .footer-section {
      background-color: #2c3e50;
      color: white;
      padding: 40px 0;
    }

    .footer-section h4 {
      color: #3498db;
    }

    .footer-section a {
      color: #ecf0f1;
    }

    .footer-section a:hover {
      color: #3498db;
    }

    .copyright {
      color: #bdc3c7;
    }
  </style>
</head>

<body>

<?php include 'includes/nav.php'; ?>

  <div class="">
    <div id="slider" class="sl-slider-wrapper">

      <div class="sl-slider">

        <div class="sl-slide" data-orientation="horizontal" data-slice1-rotation="-25" data-slice2-rotation="-25"
          data-slice1-scale="2" data-slice2-scale="2">
          <div class="sl-slide-inner">
            <div class="bg-img bg-img-1"></div>
            <h2><a href="#">2 Bed Rooms and 1 Dinning Room Aparment on Sale</a></h2>
            <blockquote>
              <p class="location"><span class="glyphicon glyphicon-map-marker"></span>Byasi Bhaktapur </p>
              <p>Until he extends the circle of his compassion to all living things, man will not himself find peace.
              </p>
              <cite>Rs20,000,000</cite>
            </blockquote>
          </div>
        </div>

        <div class="sl-slide" data-orientation="vertical" data-slice1-rotation="10" data-slice2-rotation="-15"
          data-slice1-scale="1.5" data-slice2-scale="1.5">
          <div class="sl-slide-inner">
            <div class="bg-img bg-img-2"></div>
            <h2><a href="#">2 Bed Rooms and 1 Dinning Room Aparment on Sale</a></h2>
            <blockquote>
              <p class="location"><span class="glyphicon glyphicon-map-marker"></span> Suryabinkayak Bhaktapur</p>
              <p>Until he extends the circle of his compassion to all living things, man will not himself find peace.
              </p>
              <cite>Rs20,000,000</cite>
            </blockquote>
          </div>
        </div>

        <div class="sl-slide" data-orientation="horizontal" data-slice1-rotation="3" data-slice2-rotation="3"
          data-slice1-scale="2" data-slice2-scale="1">
          <div class="sl-slide-inner">
            <div class="bg-img bg-img-3"></div>
            <h2><a href="#">2 Bed Rooms and 1 Dinning Room Aparment on Sale</a></h2>
            <blockquote>
              <p class="location"><span class="glyphicon glyphicon-map-marker"></span> Jagati Bhaktapur</p>
              <p>Until he extends the circle of his compassion to all living things, man will not himself find peace.
              </p>
              <cite>Rs 20,000,000</cite>
            </blockquote>
          </div>
        </div>

        <div class="sl-slide" data-orientation="vertical" data-slice1-rotation="-5" data-slice2-rotation="25"
          data-slice1-scale="2" data-slice2-scale="1">
          <div class="sl-slide-inner">
            <div class="bg-img bg-img-4"></div>
            <h2><a href="#">2 Bed Rooms and 1 Dinning Room Aparment on Sale</a></h2>
            <blockquote>
              <p class="location"><span class="glyphicon glyphicon-map-marker"></span>Thimi Bhaktapur</p>
              <p>Until he extends the circle of his compassion to all living things, man will not himself find peace.
              </p>
              <cite>Rs 20,000,000</cite>
            </blockquote>
          </div>
        </div>

        <div class="sl-slide" data-orientation="horizontal" data-slice1-rotation="-5" data-slice2-rotation="10"
          data-slice1-scale="2" data-slice2-scale="1">
          <div class="sl-slide-inner">
            <div class="bg-img bg-img-5"></div>
            <h2><a href="#">2 Bed Rooms and 1 Dinning Room Aparment on Sale</a></h2>
            <blockquote>
              <p class="location"><span class="glyphicon glyphicon-map-marker"></span> Kamalbinayak Bhaktapur</p>
              <p>Until he extends the circle of his compassion to all living things, man will not himself find peace.
              </p>
              <cite>RS 20,000,000</cite>
            </blockquote>
          </div>
        </div>
      </div><!-- /sl-slider -->



      <nav id="nav-dots" class="nav-dots">
        <span class="nav-dot-current"></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
      </nav>

    </div><!-- /slider-wrapper -->
  </div>



  <div class="banner-search">
    <div class="container">
      <!-- banner -->
      <h3>Buy, Sale & Rent</h3>
      <div class="searchbar">
        <div class="row">
          <div class="col-lg-6 col-sm-6">
            <form action="search.php" method="post" id="searchForm" onsubmit="return validateSearch()">
              <input name="search" type="text" class="form-control" placeholder="Property title" required>
              <div class="row">
                <div class="col-lg-3 col-sm-3 ">
                  <select name="delivery_type" class="form-control" required>
                    <option value="">Select Type</option>
                    <option value="Rent">Rent</option>
                    <option value="Sale">Sale</option>
                  </select>
                </div>
                <div class="col-lg-3 col-sm-4">
                  <select name="search_price" class="form-control" required>
                    <option value="">Select Price Range</option>
                    <option value="1">Rs5000 - Rs50,000</option>
                    <option value="2">Rs50,000 - Rs100,000</option>
                    <option value="3">Rs100,000 - Rs200,000</option>
                    <option value="4">Rs200,000 - above</option>
                  </select>
                </div>
                <div class="col-lg-3 col-sm-4">
                  <select name="property_type" class="form-control" required>
                    <option value="">Select Property Type</option>
                    <option value="Apartment">Apartment</option>
                    <option value="Building">Building</option>
                    <option value="Office-Space">Office-Space</option>
                  </select>
                </div>
                <div class="col-lg-3 col-sm-4">
                  <button name="submit" class="btn btn-success">Find Now</button>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="properties-listing spacer"> <a href="properties/list-properties.php" class="pull-right viewall">View All
        Listing</a>
      <h2>Featured Properties</h2>
      <div id="owl-example" class="owl-carousel">



        <?php
        while ($property_result = mysqli_fetch_assoc($result)) {
          $id = $property_result['property_id'];
          $property_title = $property_result['property_title'];
          $delivery_type = $property_result['delivery_type'];
          $availablility = $property_result['availablility'];
          $price = $property_result['price'];
          $property_img = $property_result['property_img'];
          $bed_room = $property_result['bed_room'];
          $liv_room = $property_result['liv_room'];
          $parking = $property_result['parking'];
          $kitchen = $property_result['kitchen'];
          $utility = $property_result['utility'];

          ?>
          <div class="properties">
            <div class="image-holder"><img src="<?php echo $property_img; ?>" class="img-responsive" alt="properties">
            </div>
            <h4><?php echo $property_title; ?></h4>
            <p class="price">Price: Rs<?php echo $price; ?></p>
            <p class="price">Delivery Type: <?php echo $delivery_type; ?></p>
            <p class="price">Utilities: <?php echo $utility; ?></p>
            <div class="listing-detail">
              <span data-toggle="tooltip" data-placement="bottom"
                data-original-title="Bed Room"><?php echo $bed_room; ?></span>
              <span data-toggle="tooltip" data-placement="bottom"
                data-original-title="Living Room"><?php echo $liv_room; ?></span>
              <span data-toggle="tooltip" data-placement="bottom"
                data-original-title="Parking"><?php echo $parking; ?></span>
              <span data-toggle="tooltip" data-placement="bottom"
                data-original-title="Kitchen"><?php echo $kitchen; ?></span>
            </div>
            <a class="btn btn-primary" href="properties/property-detail.php?id=<?php echo $id; ?>">View Details</a>
          </div>

        <?php } ?>

      </div>
    </div>
    <div class="spacer">
      <div class="row">
        <div class="col-lg-12 col-sm-12 recent-view">
          <h3>About Us</h3>
          <p>At Real Estate, you are number one. Whether you are a property owner, tenant, or buyer, we value your
            business and will provide you with the individual attention and service you deserve. We believe in a
            strict
            Code of Ethics. We believe in integrity, commitment to excellence, a professional attitude, and
            personalized
            care.<br><a href="about.php">Learn More</a></p>
          <p>At Real Estate, you are number one. Whether you are a property owner, tenant, or buyer, we value your
            business and will provide you with the individual attention and service you deserve. We believe in a
            strict
            Code of Ethics. We believe in integrity, commitment to excellence, a professional attitude, and
            personalized
            care.<br><a href="about.php">Learn More</a></p>
          <p>At Real Estate, you are number one. Whether you are a property owner, tenant, or buyer, we value your
            business and will provide you with the individual attention and service you deserve. We believe in a
            strict
            Code of Ethics. We believe in integrity, commitment to excellence, a professional attitude, and
            personalized
            care.<br><a href="about.php">Learn More</a></p>

        </div>

      </div>
    </div>
  </div>



  <div class="footer-section">
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

  <script>
    function validateSearch() {
      var searchInput = document.querySelector('input[name="search"]').value;
      var deliveryType = document.querySelector('select[name="delivery_type"]').value;
      var searchPrice = document.querySelector('select[name="search_price"]').value;
      var propertyType = document.querySelector('select[name="property_type"]').value;

      if (!searchInput.trim()) {
        alert('Please enter a search term');
        return false;
      }
      if (!deliveryType) {
        alert('Please select a delivery type');
        return false;
      }
      if (!searchPrice) {
        alert('Please select a price range');
        return false;
      }
      if (!propertyType) {
        alert('Please select a property type');
        return false;
      }
      return true;
    }
  </script>

</body>

<!-- Mirrored from thebootstrapthemes.com/live/thebootstrapthemes-realestate/index.php by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 11 Apr 2017 02:43:16 GMT -->

</html>