<?php
session_start();
include_once "../includes/connection.php";
include_once "../includes/functions.php";

$isSubDirectory = true;
$page_title = "All Listing Properties - Real Estate Management System";

$query = "select * from properties";
$result = mysqli_query($con, $query);

if (!$result) {
  echo "Error Found!!!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>All Listing Properties - Real Estate Management System</title>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.css" />
  <link rel="stylesheet" href="../assets/style.css" />
  <link rel="stylesheet" href="../assets/navbar.css" />
  <script src="../assets/jquery-1.9.1.min.js"></script>
  <script src="../assets/bootstrap/js/bootstrap.js"></script>
  <script src="../assets/script.js"></script>

  <!-- Owl stylesheet -->
  <link rel="stylesheet" href="../assets/owl-carousel/owl.carousel.css">
  <link rel="stylesheet" href="../assets/owl-carousel/owl.theme.css">
  <script src="../assets/owl-carousel/owl.carousel.js"></script>
  <!-- Owl stylesheet -->

  <!-- slitslider -->
  <link rel="stylesheet" type="text/css" href="../assets/slitslider/css/style.css" />
  <link rel="stylesheet" type="text/css" href="../assets/slitslider/css/custom.css" />
  <script type="text/javascript" src="../assets/slitslider/js/modernizr.custom.79639.js"></script>
  <script type="text/javascript" src="../assets/slitslider/js/jquery.ba-cond.min.js"></script>
  <script type="text/javascript" src="../assets/slitslider/js/jquery.slitslider.js"></script>
  <!-- slitslider -->

  <script src='../assets/google_analytics_auto.js'></script>
</head>

<body>

<?php include '../includes/nav.php'; ?>

  <!-- banner -->
  <div class="inside-banner">
    <div class="container">
      <h2>Listing All Properties</h2>
    </div>
  </div>
  <!-- banner -->

  <div class="container">
    <div class="properties-listing spacer">

      <div class="row">
        <div class="col-lg-3 col-sm-4 ">

          <div class="search-form">
            <h4><span class="glyphicon glyphicon-search"></span> Search for</h4>
            <form action="search.php" method="post" id="searchForm" onsubmit="return validateSearch()">
              <input type="text" class="form-control" name="search" placeholder="Search of Properties" required>
              <div class="row">
                <div class="col-lg-5">
                  <select name="delivery_type" class="form-control" required>
                    <option value="">Select Type</option>
                    <option value="Rent">Rent</option>
                    <option value="Sale">Sale</option>
                  </select>
                </div>
                <div class="col-lg-7">
                  <select name="search_price" class="form-control" required>
                    <option value="">Select Price Range</option>
                    <option value="1">Rs5000 - Rs50,000</option>
                    <option value="2">Rs50,000 - Rs100,000</option>
                    <option value="3">Rs100,000 - Rs200,000</option>
                    <option value="4">Rs200,000 - above</option>
                  </select>
                </div>
              </div>

              <div class="row">
                <div class="col-lg-12">
                  <select name="property_type" class="form-control" required>
                    <option value="">Select Property Type</option>
                    <option value="Apartment">Apartment</option>
                    <option value="Building">Building</option>
                    <option value="Office-Space">Office-Space</option>
                  </select>
                </div>
              </div>
              <button name="submit" class="btn btn-primary">Find Now</button>
            </form>

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
          </div>






        </div>

        <div class="col-lg-9 col-sm-8">
          <div class="sortby clearfix">
            <div class="pull-left result">Showing: All Listing Properties </div>
            <div class="pull-right">
            </div>

          </div>
          <div class="row">

            <!-- properties -->
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
              <div class="col-lg-4 col-sm-6">
                <div class="properties">
                  <div class="image-holder">
                    <img src="<?php echo $property_img ? '../images/properties/' . $property_img : '../images/properties/default1.png'; ?>" class="img-responsive"
                      alt="properties">
                  </div>
                  <h4><a href="property-detail.php?id=<?php echo $id; ?>"><?php echo $property_title; ?></a></h4>
                  <p class="price">Price: $<?php echo $price; ?></p>
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
                  <a class="btn btn-primary" href="property-detail.php?id=<?php echo $id; ?>">View Details</a>
                </div>
              </div>
            <?php } ?>
            <!-- properties -->


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
            <li class="col-lg-12 col-sm-12 col-xs-3"><a href="../index.php">Home</a></li>
            <li class="col-lg-12 col-sm-12 col-xs-3"><a href="../about.php">About</a></li>
            <li class="col-lg-12 col-sm-12 col-xs-3"><a href="../contact.php">Contact</a></li>
          </ul>
        </div>



        <div class="col-lg-3 col-sm-3">
          <h4>Follow us</h4>
          <a href="#"><img src="../images/facebook.png" alt="facebook"></a>
          <a href="#"><img src="../images/twitter.png" alt="twitter"></a>
          <a href="#"><img src="../images/linkedin.png" alt="linkedin"></a>
          <a href="#"><img src="../images/instagram.png" alt="instagram"></a>
        </div>

        <div class="col-lg-3 col-sm-3">
          <h4>Contact us</h4>
          <p><b>Jaggamandu</b><br>
            <span class="glyphicon glyphicon-map-marker"></span>Bhaktapur<br>
            <span class="glyphicon glyphicon-envelope"></span>www.jaggadhaninepalbkt.com<br>
            <span class="glyphicon glyphicon-earphone"></span> +123456789
        </div>
      </div>
      <p class="copyright">Copyright 2021. All rights reserved. </p>


    </div>
  </div>




  <!-- Modal -->
  <div id="loginpop" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="row">
          <div class="col-sm-6 login">
            <h4>Login</h4>
            <form class="" role="form">
              <div class="form-group">
                <label class="sr-only" for="exampleInputEmail2">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail2" placeholder="Enter email">
              </div>
              <div class="form-group">
                <label class="sr-only" for="exampleInputPassword2">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword2" placeholder="Password">
              </div>
              <div class="checkbox">
                <label>
                  <input type="checkbox"> Remember me
                </label>
              </div>
              <button type="submit" class="btn btn-success">Sign in</button>
            </form>
          </div>
          <div class="col-sm-6">
            <h4>New User Sign Up</h4>
            <p>Join today and get updated with all the properties deal happening around.</p>
            <button type="submit" class="btn btn-info" onclick="window.location.href='register.html'">Join Now</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /.modal -->



</body>

</html>