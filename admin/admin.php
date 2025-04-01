<?php
session_start();
include_once "../includes/connection.php";
include_once "../includes/functions.php";

// Debug information
error_log("Admin page accessed. Session data: " . print_r($_SESSION, true));

// Check if user is logged in first
if (!isLoggedIn()) {
    error_log("User not logged in, redirecting to login page");
    header("Location: ../login.php");
    exit();
}

// Check if user is admin
if (!isAdmin()) {
    error_log("User is not admin (is_admin: " . (isset($_SESSION['is_admin']) ? $_SESSION['is_admin'] : 'not set') . "), redirecting to index");
    header("Location: ../index.php");
    exit();
}

$isSubDirectory = true;
$page_title = "Admin Dashboard - Real Estate Management System";

// Get dashboard statistics
$stats = array();

// Total Properties
$query = "SELECT COUNT(*) as total FROM properties";
$result = mysqli_query($con, $query);
$stats['total_properties'] = mysqli_fetch_assoc($result)['total'];

// Properties for Sale
$query = "SELECT COUNT(*) as total FROM properties WHERE delivery_type = 'Sale'";
$result = mysqli_query($con, $query);
$stats['properties_for_sale'] = mysqli_fetch_assoc($result)['total'];

// Properties for Rent
$query = "SELECT COUNT(*) as total FROM properties WHERE delivery_type = 'Rent'";
$result = mysqli_query($con, $query);
$stats['properties_for_rent'] = mysqli_fetch_assoc($result)['total'];

// Total Agents
$query = "SELECT COUNT(*) as total FROM agent";
$result = mysqli_query($con, $query);
$stats['total_agents'] = mysqli_fetch_assoc($result)['total'];

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
    .container{
        padding-top: 20px;  
    }   
    </style>

</head>
<body>
 
<!-- banner -->
<div class="inside-banner">
    <div class="container">
        <h2>Admin Dashboard</h2>
    </div>
</div>
<!-- banner -->

<div class="container">
    <!-- Statistics Cards -->
    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Total Properties</h3>
                </div>
                <div class="panel-body">
                    <h3><?php echo $stats['total_properties']; ?></h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title">Properties for Sale</h3>
                </div>
                <div class="panel-body">
                    <h3><?php echo $stats['properties_for_sale']; ?></h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">Properties for Rent</h3>
                </div>
                <div class="panel-body">
                    <h3><?php echo $stats['properties_for_rent']; ?></h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-warning">
                <div class="panel-heading">
                    <h3 class="panel-title">Total Agents</h3>
                </div>
                <div class="panel-body">
                    <h3><?php echo $stats['total_agents']; ?></h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Property Actions and Quick Actions -->
    <!-- Property Actions -->
    <div class="row">
        <div class="col-md-12">
            <div class="panel" style="background: transparent; border: none; box-shadow: none;">
                <div class="panel-heading" style="background: #337ab7; color: white; border-radius: 4px;">
                    <h3 class="panel-title">Property Actions</h3>
                </div>
                <div class="panel-body" style="background: #222; padding: 15px; border-radius: 4px;">
                    <div class="row" style="display: flex; flex-wrap: wrap;">
                        <div class="col-md-4" style="padding: 0 15px; display: flex;">
                            <div style="background: #1e472e; border-radius: 4px; width: 100%; display: flex; flex-direction: column;">
                                <div style="padding: 12px 10px 5px; text-align: center; color: white;">
                                    <i class="glyphicon glyphicon-plus" style="font-size: 28px;"></i>
                                    <h4 style="margin: 8px 0;">Add Property</h4>
                                </div>
                                <div style="padding: 5px 10px 12px; text-align: center; color: #ccc; flex-grow: 1; display: flex; flex-direction: column; justify-content: space-between;">
                                    <p style="margin: 5px 0;">Add a new property listing to the system</p>
                                    <a href="add-property.php" class="btn btn-primary" style="background: #563207; border: none; margin-top: 5px; padding: 6px 12px;">
                                        Add New Property
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4" style="padding: 0 15px; display: flex;">
                            <div style="background: #1b4b5a; border-radius: 4px; width: 100%; display: flex; flex-direction: column;">
                                <div style="padding: 12px 10px 5px; text-align: center; color: white;">
                                    <i class="glyphicon glyphicon-edit" style="font-size: 28px;"></i>
                                    <h4 style="margin: 8px 0;">Edit Property</h4>
                                </div>
                                <div style="padding: 5px 10px 12px; text-align: center; color: #ccc; flex-grow: 1; display: flex; flex-direction: column; justify-content: space-between;">
                                    <p style="margin: 5px 0;">Modify existing property listings</p>
                                    <a href="manage-properties.php" class="btn" style="background: #2a7286; border: none; color: white; margin-top: 5px; padding: 6px 12px;">
                                        Edit Properties
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4" style="padding: 0 15px; display: flex;">
                            <div style="background: #4a1f1f; border-radius: 4px; width: 100%; display: flex; flex-direction: column;">
                                <div style="padding: 12px 10px 5px; text-align: center; color: white;">
                                    <i class="glyphicon glyphicon-trash" style="font-size: 28px;"></i>
                                    <h4 style="margin: 8px 0;">Delete Property</h4>
                                </div>
                                <div style="padding: 5px 10px 12px; text-align: center; color: #ccc; flex-grow: 1; display: flex; flex-direction: column; justify-content: space-between;">
                                    <p style="margin: 5px 0;">Remove property listings from the system</p>
                                    <a href="manage-properties.php" class="btn btn-danger" style="background: #8b3232; border: none; margin-top: 5px; padding: 6px 12px;">
                                        Delete Properties
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row" style="margin-top: 20px;">
        <div class="col-md-12">
            <div class="panel" style="background: transparent; border: none; box-shadow: none;">
                <div class="panel-heading" style="background: #333; color: white; border-radius: 4px;">
                    <h3 class="panel-title">Quick Actions</h3>
                </div>
                <div class="panel-body" style="background: #222; padding: 15px; border-radius: 4px;">
                    <div class="row" style="display: flex; flex-wrap: wrap;">
                        <div class="col-md-4" style="padding: 0 15px; display: flex;">
                            <div style="background: #4a4a1f; border-radius: 4px; width: 100%; display: flex; flex-direction: column;">
                                <div style="padding: 12px 10px 5px; text-align: center; color: white;">
                                    <i class="glyphicon glyphicon-user" style="font-size: 28px;"></i>
                                    <h4 style="margin: 8px 0;">Manage Agents</h4>
                                </div>
                                <div style="padding: 5px 10px 12px; text-align: center; color: #ccc; flex-grow: 1; display: flex; flex-direction: column; justify-content: space-between;">
                                    <p style="margin: 5px 0;">Add, edit, or remove agents</p>
                                    <a href="manage-agents.php" class="btn" style="background: #7d7d33; border: none; color: white; margin-top: 5px; padding: 6px 12px;">
                                        Manage Agents
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4" style="padding: 0 15px; display: flex;">
                            <div style="background: #1b4b5a; border-radius: 4px; width: 100%; display: flex; flex-direction: column;">
                                <div style="padding: 12px 10px 5px; text-align: center; color: white;">
                                    <i class="glyphicon glyphicon-users" style="font-size: 28px;"></i>
                                    <h4 style="margin: 8px 0;">Manage Users</h4>
                                </div>
                                <div style="padding: 5px 10px 12px; text-align: center; color: #ccc; flex-grow: 1; display: flex; flex-direction: column; justify-content: space-between;">
                                    <p style="margin: 5px 0;">Manage user accounts and permissions</p>
                                    <a href="manage-users.php" class="btn" style="background: #2a7286; border: none; color: white; margin-top: 5px; padding: 6px 12px;">
                                        Manage Users
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4" style="padding: 0 15px; display: flex;">
                            <div style="background: #4a1f4a; border-radius: 4px; width: 100%; display: flex; flex-direction: column;">
                                <div style="padding: 12px 10px 5px; text-align: center; color: white;">
                                    <i class="glyphicon glyphicon-envelope" style="font-size: 28px;"></i>
                                    <h4 style="margin: 8px 0;">Messages</h4>
                                </div>
                                <div style="padding: 5px 10px 12px; text-align: center; color: #ccc; flex-grow: 1; display: flex; flex-direction: column; justify-content: space-between;">
                                    <p style="margin: 5px 0;">View and manage user messages</p>
                                    <a href="messages.php" class="btn" style="background: #7d337d; border: none; color: white; margin-top: 5px; padding: 6px 12px;">
                                        View Messages
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<?php include '../includes/footer.php';   ?>    
</body>
</html> 