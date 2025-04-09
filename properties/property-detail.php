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
$price = 0;
$property_address = "No address available";
$property_img = "";
$floor_space = "";
$agent_id = 0;

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
    
    // Debug output for property data
    error_log("Property data loaded successfully");
    echo "<!-- Property Data:";
    foreach($property_result as $key => $value) {
      echo "\n  $key: $value";
    }
    echo "\n-->";
    
    $property_title = $property_result['property_title'];
    $property_details = $property_result['property_details'];
    $price = $property_result['price'];
    $property_address = $property_result['property_address'];
    $property_img = $property_result['property_img'];
    $floor_space = $property_result['floor_space'];
    $agent_id = $property_result['agent_id'];

    // Debug output for images
    $images = explode(',', $property_img);
    error_log("Number of images found: " . count($images));
    echo "<!-- Debug: Number of images: " . count($images) . " -->";
    foreach($images as $index => $img) {
      echo "<!-- Debug: Image " . ($index + 1) . ": " . $img . " -->";
      echo "<!-- Debug: Full path would be: '../" . $img . "' -->";
      echo "<!-- Debug: File exists check: " . (file_exists('../' . $img) ? 'Yes' : 'No') . " -->";
    }

    $agent_name = $property_result['agent_name'] ?: "Not available";
    $agent_address = $property_result['agent_address'] ?: "Not available";
    $agent_contact = $property_result['agent_contact'] ?: "Not available";
    $agent_email = $property_result['agent_email'] ?: "Not available";
  } else {
    error_log("No property found with ID: " . $property_id);
    echo "<!-- No property found with ID: " . $property_id . " -->";
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
    
    .btn-primary {
      background-color: #563207;
      border-color: #563207;
    }
    
    .btn-primary:hover {
      background-color: #3E2405;
      border-color: #3E2405;
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
                    <?php 
                    $images = explode(',', $property_img);
                    $main_image = !empty($images[0]) ? '../' . $images[0] : '../images/properties/default1.png';
                    ?>
                    <img src="<?php echo $main_image; ?>" class="properties img-responsive" alt="<?php echo htmlspecialchars($property_title); ?>">
                  </div>
                  <!-- #Item 0 -->

                  <!-- Item 1 -->
                  <?php
                  if (!empty($images)) {
                    // Start from index 1 since we already used the first image
                    for ($i = 1; $i < count($images); $i++) {
                      if (!empty($images[$i])) {
                        echo '<div class="item">';
                        echo '<img src="../' . $images[$i] . '" class="properties img-responsive" alt="' . htmlspecialchars($property_title) . '">';
                        echo '</div>';
                      }
                    }
                  }
                  ?>
                  <!-- #Item 1 -->
                </div>
                <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                  <span class="glyphicon glyphicon-chevron-left"></span>
                </a>
                <a class="right carousel-control" href="#myCarousel" data-slide="next">
                  <span class="glyphicon glyphicon-chevron-right"></span>
                </a>
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

              <div class="well"><span class="glyphicon glyphicon-home"></span> &nbsp; <b>Floor Space - <?php echo $floor_space; ?></b></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include '../includes/footer.php';   ?>    
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