<?php
session_start();
include_once "../includes/connection.php";
include_once "../includes/functions.php";

$isSubDirectory = true;
$page_title = "Property Details - Real Estate Management System";

// Initialize all variables with default values
$property_id = 0;
$property_title = "Property Not Found";
$property_details = "No details available";
$delivery_type = "";
$availablility = 0;
$price = 0;
$property_address = "No address available";
$property_img = "";
$main_image_path = '../images/properties/default1.png';
$bed_room = 0;
$liv_room = 0;
$parking = 0;
$kitchen = 0;
$utility = "";
$property_type = "";
$floor_space = 0;
$agent_name = "Not available";
$agent_address = "Not available";
$agent_contact = "Not available";
$agent_email = "Not available";

if (isset($_GET['id'])) {
  $property_id = $_GET['id'];
} else {
  header("Location: ../index.php");
  exit;
}

// Debug output
error_log("Loading property ID: " . $property_id);
echo "<!-- Debug Information -->";
echo "<!-- Property ID: " . $property_id . " -->";

$query = "SELECT p.*, a.agent_name, a.agent_address, a.agent_contact, a.agent_email 
          FROM properties p 
          LEFT JOIN agent a ON p.agent_id = a.agent_id 
          WHERE p.property_id = '" . mysqli_real_escape_string($con, $property_id) . "'";
$result = mysqli_query($con, $query);

if (!$result) {
  error_log("Database Error: " . mysqli_error($con));
  echo "<!-- Database Error: " . mysqli_error($con) . " -->";
  echo "Error Found!!!";
} else {
  if (mysqli_num_rows($result) > 0) {
    $property_result = mysqli_fetch_assoc($result);
    
    // Debug output for all property data
    error_log("Property data loaded successfully");
    echo "<!-- Property Data:";
    foreach($property_result as $key => $value) {
      echo "\n  $key: $value";
    }
    echo "\n-->";
    
    $property_title = $property_result['property_title'];
    $property_details = $property_result['property_details'];
    $delivery_type = $property_result['delivery_type'];
    $availablility = $property_result['availablility'];
    $price = $property_result['price'];
    $property_address = $property_result['property_address'];
    $property_img = $property_result['property_img'];
    
    // Add proper path construction and validation for main property image
    $main_image_path = !empty($property_img) ? '../' . $property_img : '../images/properties/default1.png';
    if (!file_exists($main_image_path)) {
      $main_image_path = '../images/properties/default1.png';
    }
    
    echo "<!-- Debug: Property image from DB: " . $property_img . " -->";
    $bed_room = $property_result['bed_room'];
    $liv_room = $property_result['liv_room'];
    $parking = $property_result['parking'];
    $kitchen = $property_result['kitchen'];
    $utility = $property_result['utility'];
    $property_type = $property_result['property_type'];
    $floor_space = $property_result['floor_space'];

    $agent_name = $property_result['agent_name'] ?: "Not available";
    $agent_address = $property_result['agent_address'] ?: "Not available";
    $agent_contact = $property_result['agent_contact'] ?: "Not available";
    $agent_email = $property_result['agent_email'] ?: "Not available";
  } else {
    error_log("No property found with ID: " . $property_id);
    echo "<!-- No property found with ID: " . $property_id . " -->";
  }
}

// Get property images
$imgquery = "SELECT * FROM property_image WHERE property_id = '" . mysqli_real_escape_string($con, $property_id) . "'";
$imgresult = mysqli_query($con, $imgquery);

if (!$imgresult) {
  error_log("Database Error for property images: " . mysqli_error($con));
  echo "<!-- Database Error for property images: " . mysqli_error($con) . " -->";
  echo "Error Found!!!";
} else {
  echo "<!-- Debug: Number of additional images: " . mysqli_num_rows($imgresult) . " -->";
  while ($img = mysqli_fetch_assoc($imgresult)) {
    echo "<!-- Debug: Additional image from DB: " . $img['property_images'] . " -->";
    echo "<!-- Debug: Full path would be: '../" . $img['property_images'] . "' -->";
    echo "<!-- Debug: File exists check: " . (file_exists('../' . $img['property_images']) ? 'Yes' : 'No') . " -->";
  }
  // Reset the pointer to beginning
  if (mysqli_num_rows($imgresult) > 0) {
    mysqli_data_seek($imgresult, 0);
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title><?php echo $page_title; ?></title>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.css" />
  <link rel="stylesheet" href="../assets/style.css" />
  <style>
    .property-images {
      margin-bottom: 30px;
    }
    
    .property-images img.properties {
      width: 100%;
      height: 400px;
      object-fit: cover;
    }
    
    #myCarousel {
      background: #fff;
      margin-bottom: 20px;
    }
    
    .carousel-inner > .item {
      background: #fff;
    }
    
    .carousel-control.left,
    .carousel-control.right {
      background-image: none;
    }
    
    .carousel-control {
      color: #333;
      opacity: 0.8;
    }
    
    .carousel-control:hover {
      color: #72b70f;
    }
  </style>
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
    <h2>Property Details</h2>
  </div>
</div>
<!-- banner -->

<div class="container">
  <div class="properties-listing spacer">
    <div class="row">
      <div class="col-lg-3 col-sm-4 hidden-xs">
        <div class="search-form">
          <h4><span class="glyphicon glyphicon-search"></span> Search for</h4>
          <form action="search.php" method="post">
            <input type="text" class="form-control" name="search" placeholder="Search of Properties" required>
            <div class="row">
              <div class="col-lg-5">
                <select name="delivery_type" class="form-control" required>
                  <option value="">Delivery Type</option>
                  <option value="Rent">Rent</option>
                  <option value="Sale">Sale</option>
                </select>
              </div>
              <div class="col-lg-7">
                <select name="search_price" class="form-control" required>
                  <option value="">Price</option>
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
                  <option value="">Property Type</option>
                  <option value="Apartment">Apartment</option>
                  <option value="Building">Building</option>
                  <option value="Office-Space">Office-Space</option>
                </select>
              </div>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Find Now</button>
          </form>
        </div>
      </div>

      <div class="col-lg-9 col-sm-8">
        <h2><?php echo htmlspecialchars($property_title); ?></h2>
        <div class="row">
          <div class="col-lg-8">
            <div class="property-images">
              <!-- Slider Starts -->
              <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <div class="carousel-inner">
                  <!-- Item 0 -->
                  <div class="item active">
                    <img src="<?php echo $main_image_path; ?>" class="properties" alt="<?php echo htmlspecialchars($property_title); ?>" />
                  </div>
                  <!-- #Item 0 -->

                  <!-- Item 1 -->
                  <?php
                  mysqli_data_seek($imgresult, 0);
                  while($imageresult = mysqli_fetch_assoc($imgresult)){
                    $image = $imageresult['property_images'];
                    $additional_image_path = '../' . $image;
                    echo "<!-- Debug: Processing image: " . $image . " -->";
                    echo "<!-- Debug: Full path: " . $additional_image_path . " -->";
                    echo "<!-- Debug: File exists: " . (file_exists($additional_image_path) ? 'Yes' : 'No') . " -->";
                    if (!file_exists($additional_image_path)) {
                        echo "<!-- Debug: Skipping non-existent image: " . $image . " -->";
                        continue; // Skip if image doesn't exist
                    }
                  ?>
                  <div class="item">
                    <img src="<?php echo $additional_image_path; ?>" class="properties" alt="<?php echo htmlspecialchars($property_title); ?>" />
                  </div>
                  <?php } ?>
                  <!-- #Item 1 -->
                </div>
                <a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
                <a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
              </div>
              <!-- #Slider Ends -->
            </div>

            <div class="spacer">
              <h4><span class="glyphicon glyphicon-th-list"></span> Properties Detail</h4>
              <p><?php echo nl2br(htmlspecialchars($property_details)); ?></p>
            </div>
            <div>
              <h4><span class="glyphicon glyphicon-map-marker"></span> Location</h4>
              <div class="well"><?php echo htmlspecialchars($property_address); ?></div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="col-lg-12 col-sm-6">
              <div class="property-info">
                <div class="well">
                  <b>Agent Details:</b> <br>
                  <span class="glyphicon glyphicon-user"></span> <?php echo htmlspecialchars($agent_name); ?><br>
                  <span class="glyphicon glyphicon-map-marker"></span> <?php echo htmlspecialchars($agent_address); ?><br>
                  <span class="glyphicon glyphicon-phone-alt"></span> <?php echo htmlspecialchars($agent_contact); ?><br>
                  <span class="glyphicon glyphicon-envelope"></span> <?php echo htmlspecialchars($agent_email); ?><br>
                </div>

                <div class="well">
                  <p class="price">Rs<?php echo number_format($price); ?></p>
                </div>

                <p class="area">
                  <div class="well"><span class="glyphicon glyphicon-map-marker"></span> <?php echo htmlspecialchars($property_address); ?></div>
                </p>
              </div>

              <div class="well"><span class="glyphicon glyphicon-check"></span> &nbsp; <b>Availabilty - <?php if($availablility == 0){echo "Available";} else {echo "Not Available";} ?></b></div>
              <div class="well"><span class="glyphicon glyphicon-home"></span> &nbsp; <b>Property Type - <?php echo $property_type; ?></b></div>

              <div class="listing-detail">
                <div class="well">
                  <b>Rooms: &nbsp;</b>
                  <span data-toggle="tooltip" data-placement="bottom" data-original-title="Bed Room"><?php echo $bed_room; ?></span>
                  <span data-toggle="tooltip" data-placement="bottom" data-original-title="Living Room"><?php echo $liv_room; ?></span>
                  <span data-toggle="tooltip" data-placement="bottom" data-original-title="Parking"><?php echo $parking; ?></span>
                  <span data-toggle="tooltip" data-placement="bottom" data-original-title="Kitchen"><?php echo $kitchen; ?></span>
                </div>
              </div>

              <div class="well"><span class="glyphicon glyphicon-check"></span> &nbsp; <b>Floor Space - <?php echo $floor_space; ?></b></div>
            </div>
          </div>
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
        </p>
      </div>
    </div>
    <p class="copyright">Copyright 2021. All rights reserved.</p>
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