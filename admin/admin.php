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
                                    <a href="add-property.php" class="btn btn-success" style="background: #2d6a44; border: none; margin-top: 5px; padding: 6px 12px;">
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
                    <span class="glyphicon glyphicon-envelope"></span>jaggamandubkt@gmail.com<br>
                    <span class="glyphicon glyphicon-earphone"></span> +123456789
                </p>
            </div>
        </div>
    </div>
</div>

</body>

</html> 