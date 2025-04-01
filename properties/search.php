<?php
session_start();
include_once "../includes/connection.php";
include_once "../includes/functions.php";

$isSubDirectory = true;
$page_title = "Search Results - Real Estate Management System";

// Initialize variables with default values
$search_value = '';
$delivery_type = '';
$search_price = '';
$property_type = '';
$num_results = 0;
$result = null;

if (isset($_POST['submit'])) {
    $search_value = isset($_POST['search']) ? mysqli_real_escape_string($con, $_POST['search']) : '';
    $delivery_type = isset($_POST['delivery_type']) ? mysqli_real_escape_string($con, $_POST['delivery_type']) : '';
    $search_price = isset($_POST['search_price']) ? mysqli_real_escape_string($con, $_POST['search_price']) : '';
    $property_type = isset($_POST['property_type']) ? mysqli_real_escape_string($con, $_POST['property_type']) : '';

    // Debug output
    error_log("Search parameters: " . print_r($_POST, true));

    // Validate required fields
    if (empty($search_value) || empty($delivery_type) || empty($search_price) || empty($property_type)) {
        error_log("Missing required fields");
        echo '<script>alert("All fields are required."); window.location.href="../index.php";</script>';
        exit();
    }

    // Build the query based on price range
    $base_query = "SELECT p.*, a.agent_name, a.agent_contact 
                   FROM properties p 
                   LEFT JOIN agent a ON p.agent_id = a.agent_id 
                   WHERE (p.property_title LIKE '%$search_value%' 
                   OR p.property_details LIKE '%$search_value%' 
                   OR p.property_address LIKE '%$search_value%' 
                   OR p.property_type LIKE '%$search_value%') 
                   AND p.delivery_type = '$delivery_type' 
                   AND p.property_type = '$property_type'";

    switch ($search_price) {
        case '1':
            $base_query .= " AND p.price >= 5000 AND p.price <= 50000";
            break;
        case '2':
            $base_query .= " AND p.price >= 50000 AND p.price <= 100000";
            break;
        case '3':
            $base_query .= " AND p.price >= 100000 AND p.price <= 200000";
            break;
        case '4':
            $base_query .= " AND p.price >= 200000";
            break;
        default:
            error_log("Invalid price range selected");
            echo '<script>alert("Invalid price range selected."); window.location.href="../index.php";</script>';
            exit();
    }

    // Debug output
    error_log("Search query: " . $base_query);

    $result = mysqli_query($con, $base_query);

    if (!$result) {
        error_log("Database error: " . mysqli_error($con));
        echo '<script>alert("A database error occurred."); window.location.href="../index.php";</script>';
        exit();
    }

    $num_results = mysqli_num_rows($result);
    error_log("Number of results found: " . $num_results);

} else {
    // If no form submission, redirect to index
    header("Location: ../index.php");
    exit();
}

include '../includes/nav.php';
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
    .btn-primary {
      background-color: #563207;
      border-color: #563207;
    }
    
    .btn-primary:hover {
      background-color: #3E2405;
      border-color: #3E2405;
    }
  </style>
</head>

<!-- banner -->
<div class="inside-banner">
    <div class="container">
        <h2>Search Results</h2>
    </div>
</div>
<!-- banner -->

<div class="container">
    <div class="properties-listing spacer">
        <div class="row">
            <div class="col-lg-3 col-sm-4 hidden-xs">
                <div class="search-form">
                    <h4><span class="glyphicon glyphicon-search"></span> Search for</h4>
                    <form action="search.php" method="post" name="search">
                        <input type="text" class="form-control" name="search" placeholder="Search of Properties" value="<?php echo htmlspecialchars($search_value); ?>">
                        <div class="row">
                            <div class="col-lg-5">
                                <select name="delivery_type" class="form-control">
                                    <option value="">Delivery Type</option>
                                    <option value="Rent" <?php echo $delivery_type == 'Rent' ? 'selected' : ''; ?>>Rent</option>
                                    <option value="Sale" <?php echo $delivery_type == 'Sale' ? 'selected' : ''; ?>>Sale</option>
                                </select>
                            </div>
                            <div class="col-lg-7">
                                <select name="search_price" class="form-control">
                                    <option value="">Price</option>
                                    <option value="1" <?php echo $search_price == '1' ? 'selected' : ''; ?>>Rs5000 - Rs50,000</option>
                                    <option value="2" <?php echo $search_price == '2' ? 'selected' : ''; ?>>Rs50,000 - Rs100,000</option>
                                    <option value="3" <?php echo $search_price == '3' ? 'selected' : ''; ?>>Rs100,000 - Rs200,000</option>
                                    <option value="4" <?php echo $search_price == '4' ? 'selected' : ''; ?>>Rs200,000 - above</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <select name="property_type" class="form-control">
                                    <option value="">Property Type</option>
                                    <option value="Apartment" <?php echo $property_type == 'Apartment' ? 'selected' : ''; ?>>Apartment</option>
                                    <option value="Building" <?php echo $property_type == 'Building' ? 'selected' : ''; ?>>Building</option>
                                    <option value="Office-Space" <?php echo $property_type == 'Office-Space' ? 'selected' : ''; ?>>Office-Space</option>
                                </select>
                            </div>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Find Now</button>
                    </form>
                </div>
            </div>

            <div class="col-lg-9 col-sm-8">
                <h2>Search Results</h2>
                <?php if ($num_results > 0): ?>
                    <div class="row">
                        <?php while ($property = mysqli_fetch_assoc($result)): ?>
                            <div class="col-lg-4 col-sm-6">
                                <div class="properties">
                                    <div class="image-holder">
                                        <img src="<?php echo !empty($property['property_img']) ? '../' . $property['property_img'] : '../images/properties/default1.png'; ?>" class="img-responsive" alt="properties" />
                                    </div>
                                    <h4><a href="property-detail.php?id=<?php echo $property['property_id']; ?>"><?php echo htmlspecialchars($property['property_title']); ?></a></h4>
                                    <p class="price">Price: Rs<?php echo number_format($property['price'], 2); ?></p>
                                    <div class="listing-detail">
                                        <span data-toggle="tooltip" data-placement="bottom" data-original-title="Bed Room"><?php echo $property['bed_room']; ?></span>
                                        <span data-toggle="tooltip" data-placement="bottom" data-original-title="Living Room"><?php echo $property['liv_room']; ?></span>
                                        <span data-toggle="tooltip" data-placement="bottom" data-original-title="Parking"><?php echo $property['parking']; ?></span>
                                        <span data-toggle="tooltip" data-placement="bottom" data-original-title="Kitchen"><?php echo $property['kitchen']; ?></span>
                                    </div>
                                    <a class="btn btn-primary" href="property-detail.php?id=<?php echo $property['property_id']; ?>">View Details</a>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php else: ?>
                    <div class="alert alert-info">
                        No properties found matching your search criteria.
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>