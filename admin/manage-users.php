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
$page_title = "Manage Users - Admin Dashboard";

// Handle user deletion
if (isset($_POST['delete_user'])) {
    $user_id = mysqli_real_escape_string($con, $_POST['user_id']);
    
    // Don't allow deleting the admin user
    $query = "SELECT is_admin FROM users WHERE user_id = '$user_id'";
    $result = mysqli_query($con, $query);
    $user = mysqli_fetch_assoc($result);
    
    if ($user && !$user['is_admin']) {
        $query = "DELETE FROM users WHERE user_id = '$user_id'";
        if (mysqli_query($con, $query)) {
            $_SESSION['success_msg'] = "User deleted successfully!";
        } else {
            $_SESSION['error_msg'] = "Error deleting user: " . mysqli_error($con);
        }
    } else {
        $_SESSION['error_msg'] = "Cannot delete admin user!";
    }
    
    header("Location: manage-users.php");
    exit();
}

// Handle user status toggle
if (isset($_POST['toggle_status'])) {
    $user_id = mysqli_real_escape_string($con, $_POST['user_id']);
    $new_status = $_POST['new_status'] == '1' ? '1' : '0';
    
    // Don't allow changing admin status
    $query = "SELECT is_admin FROM users WHERE user_id = '$user_id'";
    $result = mysqli_query($con, $query);
    $user = mysqli_fetch_assoc($result);
    
    if ($user && !$user['is_admin']) {
        $query = "UPDATE users SET status = '$new_status' WHERE user_id = '$user_id'";
        if (mysqli_query($con, $query)) {
            $_SESSION['success_msg'] = "User status updated successfully!";
        } else {
            $_SESSION['error_msg'] = "Error updating user status: " . mysqli_error($con);
        }
    } else {
        $_SESSION['error_msg'] = "Cannot modify admin user status!";
    }
    
    header("Location: manage-users.php");
    exit();
}

// Fetch all users except current admin
$query = "SELECT * FROM users WHERE user_id != '" . $_SESSION['user_id'] . "' ORDER BY created_at DESC";
$result = mysqli_query($con, $query);
$users = array();
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $users[] = $row;
    }
}

include '../includes/nav.php';
?>

<!-- banner -->
<div class="inside-banner">
    <div class="container">
        <h2>Manage Users</h2>
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

        <?php if (isset($_SESSION['error_msg'])): ?>
            <div class="alert alert-danger">
                <?php 
                echo $_SESSION['error_msg'];
                unset($_SESSION['error_msg']);
                ?>
            </div>
        <?php endif; ?>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">All Users</h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Status</th>
                                <th>Registration Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $user): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($user['username']); ?></td>
                                    <td><?php echo htmlspecialchars($user['full_name']); ?></td>
                                    <td><?php echo htmlspecialchars($user['email']); ?></td>
                                    <td><?php echo htmlspecialchars($user['phone']); ?></td>
                                    <td>
                                        <?php if (!$user['is_admin']): ?>
                                            <form action="" method="POST" style="display: inline-block;">
                                                <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">
                                                <input type="hidden" name="new_status" value="<?php echo isset($user['status']) && $user['status'] == '1' ? '0' : '1'; ?>">
                                                <button type="submit" name="toggle_status" class="btn btn-xs <?php echo isset($user['status']) && $user['status'] == '1' ? 'btn-success' : 'btn-warning'; ?>">
                                                    <?php echo isset($user['status']) && $user['status'] == '1' ? 'Active' : 'Inactive'; ?>
                                                </button>
                                            </form>
                                        <?php else: ?>
                                            <span class="label label-primary">Admin</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo date('Y-m-d', strtotime($user['created_at'])); ?></td>
                                    <td>
                                        <?php if (!$user['is_admin']): ?>
                                            <form action="" method="POST" style="display: inline-block;" 
                                                  onsubmit="return confirm('Are you sure you want to delete this user?');">
                                                <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">
                                                <button type="submit" name="delete_user" class="btn btn-danger btn-sm">
                                                    <i class="glyphicon glyphicon-trash"></i> Delete
                                                </button>
                                            </form>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
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
    margin-bottom: 30px;
}

.panel-heading {
    background-color: #337ab7 !important;
    color: white !important;
    border-radius: 3px 3px 0 0;
}

.btn-sm {
    margin: 2px;
}

.btn-xs {
    padding: 1px 5px;
    font-size: 12px;
    line-height: 1.5;
    border-radius: 3px;
}

.table > thead > tr > th {
    background-color: #f5f5f5;
}

.alert {
    margin-bottom: 20px;
}

.label {
    display: inline-block;
    padding: 4px 8px;
    font-size: 12px;
    border-radius: 3px;
}
</style>

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