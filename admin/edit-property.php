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
$page_title = "Edit Property - Admin Dashboard";

// Get property details
if (isset($_GET['id'])) {
    $property_id = mysqli_real_escape_string($con, $_GET['id']);
    $query = "SELECT * FROM properties WHERE property_id = '$property_id'";
    $result = mysqli_query($con, $query);
    $property = mysqli_fetch_assoc($result);
    
    if (!$property) {
        header("Location: manage-properties.php");
        exit();
    }
} else {
    header("Location: manage-properties.php");
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = mysqli_real_escape_string($con, $_POST['title']);
    $type = mysqli_real_escape_string($con, $_POST['type']);
    $price = mysqli_real_escape_string($con, $_POST['price']);
    $status = mysqli_real_escape_string($con, $_POST['status']);
    $bedrooms = mysqli_real_escape_string($con, $_POST['bedrooms']);
    $bathrooms = mysqli_real_escape_string($con, $_POST['bathrooms']);
    $living_rooms = mysqli_real_escape_string($con, $_POST['living_rooms']);
    $kitchen = mysqli_real_escape_string($con, $_POST['kitchen']);
    $parking = mysqli_real_escape_string($con, $_POST['parking']);
    $utilities = mysqli_real_escape_string($con, $_POST['utilities']);
    
    // Handle image upload
    $image_path = $property['property_img'];
    if (isset($_FILES['property_image']) && $_FILES['property_image']['size'] > 0) {
        $target_dir = "../images/properties/";
        $file_extension = strtolower(pathinfo($_FILES["property_image"]["name"], PATHINFO_EXTENSION));
        $new_filename = uniqid() . '.' . $file_extension;
        $target_file = $target_dir . $new_filename;
        
        // Check if file is an actual image
        if (getimagesize($_FILES["property_image"]["tmp_name"]) !== false) {
            // Delete old image if exists
            if ($property['property_img'] && file_exists('../' . $property['property_img'])) {
                unlink('../' . $property['property_img']);
            }
            
            // Upload new image
            if (move_uploaded_file($_FILES["property_image"]["tmp_name"], $target_file)) {
                $image_path = "images/properties/" . $new_filename;
            }
        }
    }
    
    // Update property
    $query = "UPDATE properties SET 
              property_title = '$title',
              delivery_type = '$type',
              price = '$price',
              availablility = '$status',
              bed_room = '$bedrooms',
              liv_room = '$living_rooms',
              parking = '$parking',
              kitchen = '$kitchen',
              utility = '$utilities',
              property_img = '$image_path'
              WHERE property_id = '$property_id'";
              
    if (mysqli_query($con, $query)) {
        $_SESSION['success_msg'] = "Property updated successfully!";
        header("Location: manage-properties.php");
        exit();
    }
}

include '../includes/nav.php';
?>

<!-- banner -->
<div class="inside-banner">
    <div class="container">
        <h2>Edit Property</h2>
    </div>
</div>
<!-- banner -->

<div class="container">
    <div class="properties-listing spacer">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Edit Property Details</h3>
            </div>
            <div class="panel-body">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Property Title</label>
                                <input type="text" name="title" class="form-control" value="<?php echo htmlspecialchars($property['property_title']); ?>" required>
                            </div>
                            
                            <div class="form-group">
                                <label>Type</label>
                                <select name="type" class="form-control" required>
                                    <option value="Sale" <?php echo $property['delivery_type'] == 'Sale' ? 'selected' : ''; ?>>Sale</option>
                                    <option value="Rent" <?php echo $property['delivery_type'] == 'Rent' ? 'selected' : ''; ?>>Rent</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label>Price</label>
                                <input type="number" name="price" class="form-control" value="<?php echo $property['price']; ?>" required>
                            </div>
                            
                            <div class="form-group">
                                <label>Status</label>
                                <select name="status" class="form-control" required>
                                    <option value="Available" <?php echo $property['availablility'] == 'Available' ? 'selected' : ''; ?>>Available</option>
                                    <option value="Sold" <?php echo $property['availablility'] == 'Sold' ? 'selected' : ''; ?>>Sold</option>
                                    <option value="Reserved" <?php echo $property['availablility'] == 'Reserved' ? 'selected' : ''; ?>>Reserved</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Bedrooms</label>
                                <input type="number" name="bedrooms" class="form-control" value="<?php echo $property['bed_room']; ?>" required>
                            </div>
                            
                            <div class="form-group">
                                <label>Living Rooms</label>
                                <input type="number" name="living_rooms" class="form-control" value="<?php echo $property['liv_room']; ?>" required>
                            </div>
                            
                            <div class="form-group">
                                <label>Parking Spaces</label>
                                <input type="number" name="parking" class="form-control" value="<?php echo $property['parking']; ?>" required>
                            </div>
                            
                            <div class="form-group">
                                <label>Kitchen</label>
                                <input type="number" name="kitchen" class="form-control" value="<?php echo $property['kitchen']; ?>" required>
                            </div>
                            
                            <div class="form-group">
                                <label>Utilities</label>
                                <input type="text" name="utilities" class="form-control" value="<?php echo htmlspecialchars($property['utility']); ?>" required>
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Property Image</label>
                                <input type="file" name="property_image" class="form-control" accept="image/*">
                                <?php if ($property['property_img']): ?>
                                    <p class="help-block">Current image: 
                                        <img src="<?php echo '../' . $property['property_img']; ?>" 
                                             alt="Current Property Image"
                                             style="max-width: 200px; max-height: 150px; margin-top: 10px;">
                                    </p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Update Property</button>
                        <a href="manage-properties.php" class="btn btn-default">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
.inside-banner {
    background-color: #337ab7;
    color: white;
    padding: 40px 0;
    margin-bottom: 40px;
}

.inside-banner h2 {
    margin: 0;
    color: white;
}

.panel {
    border-radius: 4px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
}

.panel-heading {
    background-color: #337ab7 !important;
    color: white !important;
    border-radius: 3px 3px 0 0;
}

.form-group {
    margin-bottom: 20px;
}

.help-block {
    margin-top: 10px;
}
</style>

<div class="col-lg-3 col-sm-3">
    <h4>Contact us</h4>
    <p><b>Jaggamandu</b><br>
        <span class="glyphicon glyphicon-map-marker"></span>Bhaktapur<br>
        <span class="glyphicon glyphicon-envelope"></span>jaggamandubkt@gmail.com<br>
        <span class="glyphicon glyphicon-earphone"></span> +123456789
    </p>
</div>

</body>

</html> 