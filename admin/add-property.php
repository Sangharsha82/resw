<?php
session_start();
include_once "../includes/connection.php";
include_once "../includes/functions.php";

// Check if user is admin
if (!isAdmin()) {
    header("Location: ../index.php");
    exit();
}

$isSubDirectory = true;
$page_title = "Add Property - Real Estate Management System";

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $property_title = sanitize($_POST['property_title']);
    $property_details = sanitize($_POST['property_details']);
    $delivery_type = sanitize($_POST['delivery_type']);
    $availability = isset($_POST['availability']) ? 0 : 1; // 0 for available, 1 for not available
    $price = floatval($_POST['price']);
    $property_address = sanitize($_POST['property_address']);
    $bed_room = intval($_POST['bed_room']);
    $liv_room = intval($_POST['liv_room']);
    $parking = intval($_POST['parking']);
    $kitchen = intval($_POST['kitchen']);
    $utility = sanitize($_POST['utility']);
    $property_type = sanitize($_POST['property_type']);
    $floor_space = sanitize($_POST['floor_space']);
    $agent_id = intval($_POST['agent_id']);

    // Handle main property image upload
    $target_dir = "../images/properties/";
    $main_image = "";
    if (isset($_FILES["main_image"]) && $_FILES["main_image"]["error"] == 0) {
        $main_image = $target_dir . basename($_FILES["main_image"]["name"]);
        move_uploaded_file($_FILES["main_image"]["tmp_name"], $main_image);
    }

    // Validate numeric fields
    $errors = array();

    if ($price <= 0) {
        $errors[] = "Price must be greater than 0";
    }
    if ($bed_room < 0) {
        $errors[] = "Number of bedrooms cannot be negative";
    }
    if ($liv_room < 0) {
        $errors[] = "Number of living rooms cannot be negative";
    }
    if ($parking < 0) {
        $errors[] = "Number of parking spaces cannot be negative";
    }
    if ($kitchen < 0) {
        $errors[] = "Number of kitchens cannot be negative";
    }

    // If there are no errors, proceed with the insert
    if (empty($errors)) {
        // Insert into properties table
        $query = "INSERT INTO properties (property_title, property_details, delivery_type, availablility, 
                  price, property_address, property_img, bed_room, liv_room, parking, kitchen, 
                  utility, property_type, floor_space, agent_id) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $con->prepare($query);
        $stmt->bind_param(
            "sssiissiiiisssi",
            $property_title,
            $property_details,
            $delivery_type,
            $availability,
            $price,
            $property_address,
            $main_image,
            $bed_room,
            $liv_room,
            $parking,
            $kitchen,
            $utility,
            $property_type,
            $floor_space,
            $agent_id
        );

        if ($stmt->execute()) {
            $property_id = $con->insert_id;

            // Handle additional property images
            if (isset($_FILES["property_images"])) {
                foreach ($_FILES["property_images"]["tmp_name"] as $key => $tmp_name) {
                    if ($_FILES["property_images"]["error"][$key] == 0) {
                        $image_path = $target_dir . basename($_FILES["property_images"]["name"][$key]);
                        if (move_uploaded_file($tmp_name, $image_path)) {
                            $img_query = "INSERT INTO property_image (property_images, property_id) VALUES (?, ?)";
                            $img_stmt = $con->prepare($img_query);
                            $img_stmt->bind_param("si", $image_path, $property_id);
                            $img_stmt->execute();
                        }
                    }
                }
            }
            $message = "Property added successfully!";
        } else {
            $message = "Error adding property: " . $con->error;
        }
    } else {
        // Display errors
        $message = "<div class='alert alert-danger'><ul>";
        foreach ($errors as $error) {
            $message .= "<li>$error</li>";
        }
        $message .= "</ul></div>";
    }
}

// Get agents for dropdown
$agents_query = "SELECT agent_id, agent_name FROM agent";
$agents_result = mysqli_query($con, $agents_query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Add Property - Real Estate Management System</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" href="../assets/style.css" />
    <link rel="stylesheet" href="../assets/navbar.css" />
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
</head>

<body>
    <?php include '../includes/nav.php'; ?>

    <!-- banner -->
    <div class="inside-banner">
        <div class="container">
            <h2>Add New Property</h2>
        </div>
    </div>
    <!-- banner -->

    <!-- Main Content -->
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php if ($message): ?>
                    <div class="alert alert-info"><?php echo $message; ?></div>
                <?php endif; ?>

                <form method="POST" action="" enctype="multipart/form-data" class="form-horizontal">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Property Title</label>
                        <div class="col-sm-10">
                            <input type="text" name="property_title" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Property Details</label>
                        <div class="col-sm-10">
                            <textarea name="property_details" class="form-control" rows="4" required></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Delivery Type</label>
                        <div class="col-sm-10">
                            <select name="delivery_type" class="form-control" required>
                                <option value="">Select Type</option>
                                <option value="Sale">Sale</option>
                                <option value="Rent">Rent</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Property Type</label>
                        <div class="col-sm-10">
                            <select name="property_type" class="form-control" required>
                                <option value="">Select Type</option>
                                <option value="Apartment">Apartment</option>
                                <option value="Building">Building</option>
                                <option value="Office-Space">Office-Space</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Price</label>
                        <div class="col-sm-10">
                            <input type="number" name="price" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Property Address</label>
                        <div class="col-sm-10">
                            <input type="text" name="property_address" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Floor Space</label>
                        <div class="col-sm-10">
                            <input type="text" name="floor_space" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Utilities</label>
                        <div class="col-sm-10">
                            <input type="text" name="utility" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Bedrooms</label>
                        <div class="col-sm-10">
                            <input type="number" name="bed_room" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Living Rooms</label>
                        <div class="col-sm-10">
                            <input type="number" name="liv_room" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Parking Spaces</label>
                        <div class="col-sm-10">
                            <input type="number" name="parking" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Kitchens</label>
                        <div class="col-sm-10">
                            <input type="number" name="kitchen" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Agent</label>
                        <div class="col-sm-10">
                            <select name="agent_id" class="form-control" required>
                                <option value="">Select Agent</option>
                                <?php while ($agent = mysqli_fetch_assoc($agents_result)): ?>
                                    <option value="<?php echo $agent['agent_id']; ?>">
                                        <?php echo $agent['agent_name']; ?>
                                    </option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Main Image</label>
                        <div class="col-sm-10">
                            <input type="file" name="main_image" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Additional Images</label>
                        <div class="col-sm-10">
                            <input type="file" name="property_images[]" class="form-control" multiple>
                            <p class="help-block">You can select multiple images</p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Availability</label>
                        <div class="col-sm-10">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="availability"> Available
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary">Add Property</button>
                            <a href="admin.php" class="btn btn-default">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php include '../includes/footer.php';   ?>    
    <!-- Add JavaScript validation -->
    <script>
        document.querySelector('form').addEventListener('submit', function (e) {
            const price = parseFloat(document.querySelector('input[name="price"]').value);
            const bedRoom = parseInt(document.querySelector('input[name="bed_room"]').value);
            const livRoom = parseInt(document.querySelector('input[name="liv_room"]').value);
            const parking = parseInt(document.querySelector('input[name="parking"]').value);
            const kitchen = parseInt(document.querySelector('input[name="kitchen"]').value);

            let errors = [];

            if (price <= 0) {
                errors.push("Price must be greater than 0");
            }
            if (bedRoom < 0) {
                errors.push("Number of bedrooms cannot be negative");
            }
            if (livRoom < 0) {
                errors.push("Number of living rooms cannot be negative");
            }
            if (parking < 0) {
                errors.push("Number of parking spaces cannot be negative");
            }
            if (kitchen < 0) {
                errors.push("Number of kitchens cannot be negative");
            }

            if (errors.length > 0) {
                e.preventDefault();
                alert(errors.join("\n"));
            }
        });
    </script>
</body>

</html>