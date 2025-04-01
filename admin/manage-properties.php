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
$page_title = "Manage Properties - Admin Dashboard";

// Handle property deletion
if (isset($_POST['delete_property'])) {
    $property_id = mysqli_real_escape_string($con, $_POST['property_id']);
    
    // Delete property images first
    $query = "SELECT property_img FROM properties WHERE property_id = '$property_id'";
    $result = mysqli_query($con, $query);
    if ($row = mysqli_fetch_assoc($result)) {
        if ($row['property_img'] && file_exists('../' . $row['property_img'])) {
            unlink('../' . $row['property_img']);
        }
    }
    
    // Delete the property
    $query = "DELETE FROM properties WHERE property_id = '$property_id'";
    mysqli_query($con, $query);
    
    $_SESSION['success_msg'] = "Property deleted successfully!";
    header("Location: manage-properties.php");
    exit();
}

// Fetch all properties
$query = "SELECT * FROM properties ORDER BY property_id DESC";
$result = mysqli_query($con, $query);

include '../includes/nav.php';
?>

<!-- banner -->
<div class="inside-banner">
    <div class="container">
        <h2>Manage Properties</h2>
    </div>
</div>
<!-- banner -->

<div class="container">
    <div class="properties-listing spacer">
        <?php if (isset($_SESSION['success_msg'])): ?>
            <div class="alert alert-success">
                <?php 
                echo $_SESSION['success_msg'];
                unset($_SESSION['success_msg']);
                ?>
            </div>
        <?php endif; ?>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">All Properties</h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Type</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($property = mysqli_fetch_assoc($result)): ?>
                                <tr>
                                    <td>
                                        <img src="<?php echo '../' . ($property['property_img'] ?: 'images/properties/default1.png'); ?>" 
                                             alt="<?php echo htmlspecialchars($property['property_title']); ?>"
                                             style="width: 100px; height: 70px; object-fit: cover;">
                                    </td>
                                    <td><?php echo htmlspecialchars($property['property_title']); ?></td>
                                    <td><?php echo htmlspecialchars($property['delivery_type']); ?></td>
                                    <td>Rs<?php echo number_format($property['price']); ?></td>
                                    <td><?php echo htmlspecialchars($property['availablility']); ?></td>
                                    <td>
                                        <a href="edit-property.php?id=<?php echo $property['property_id']; ?>" 
                                           class="btn btn-primary btn-sm">
                                            <i class="glyphicon glyphicon-edit"></i> Edit
                                        </a>
                                        <form action="" method="POST" style="display: inline-block;" 
                                              onsubmit="return confirm('Are you sure you want to delete this property?');">
                                            <input type="hidden" name="property_id" value="<?php echo $property['property_id']; ?>">
                                            <button type="submit" name="delete_property" class="btn btn-danger btn-sm">
                                                <i class="glyphicon glyphicon-trash"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
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

.btn-sm {
    margin: 2px;
}

.table > thead > tr > th {
    background-color: #f5f5f5;
}

.alert {
    margin-bottom: 20px;
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

<?php include '../includes/footer.php';   ?>    

<link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.css" />
<link rel="stylesheet" href="../assets/style.css" />
<link rel="stylesheet" href="../assets/navbar.css" />

</body>

</html> 