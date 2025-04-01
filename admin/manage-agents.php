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
$page_title = "Manage Agents - Admin Dashboard";

// Initialize variables
$edit_agent = array(
    'agent_id' => '',
    'agent_name' => '',
    'agent_address' => '',
    'agent_contact' => '',
    'agent_email' => ''
);

// Handle agent deletion
if (isset($_POST['delete_agent'])) {
    $agent_id = mysqli_real_escape_string($con, $_POST['agent_id']);
    $query = "DELETE FROM agent WHERE agent_id = '$agent_id'";
    mysqli_query($con, $query);
    
    $_SESSION['success_msg'] = "Agent deleted successfully!";
    header("Location: manage-agents.php");
    exit();
}

// Handle agent addition/update
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_agent'])) {
    $agent_name = mysqli_real_escape_string($con, $_POST['agent_name']);
    $agent_address = mysqli_real_escape_string($con, $_POST['agent_address']);
    $agent_contact = mysqli_real_escape_string($con, $_POST['agent_contact']);
    $agent_email = mysqli_real_escape_string($con, $_POST['agent_email']);
    $agent_id = isset($_POST['agent_id']) ? mysqli_real_escape_string($con, $_POST['agent_id']) : null;
    
    if ($agent_id) {
        // Update existing agent
        $query = "UPDATE agent SET 
                  agent_name = '$agent_name',
                  agent_address = '$agent_address',
                  agent_contact = '$agent_contact',
                  agent_email = '$agent_email'
                  WHERE agent_id = '$agent_id'";
        $message = "Agent updated successfully!";
    } else {
        // Add new agent
        $query = "INSERT INTO agent (agent_name, agent_address, agent_contact, agent_email) 
                  VALUES ('$agent_name', '$agent_address', '$agent_contact', '$agent_email')";
        $message = "Agent added successfully!";
    }
    
    if (mysqli_query($con, $query)) {
        $_SESSION['success_msg'] = $message;
        header("Location: manage-agents.php");
        exit();
    } else {
        $_SESSION['error_msg'] = "Error: " . mysqli_error($con);
    }
}

// Get agent for editing if ID is provided
if (isset($_GET['edit'])) {
    $agent_id = mysqli_real_escape_string($con, $_GET['edit']);
    $query = "SELECT * FROM agent WHERE agent_id = '$agent_id'";
    $result = mysqli_query($con, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        $edit_agent = mysqli_fetch_assoc($result);
    }
}

// Fetch all agents
$query = "SELECT * FROM agent ORDER BY agent_id DESC";
$result = mysqli_query($con, $query);
$agents = array();
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $agents[] = $row;
    }
}

include '../includes/nav.php';
?>

<!-- banner -->
<div class="inside-banner">
    <div class="container">
        <h2>Manage Agents</h2>
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

        <div class="row">
            <!-- Add/Edit Agent Form -->
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?php echo isset($edit_agent['agent_id']) && $edit_agent['agent_id'] ? 'Edit Agent' : 'Add New Agent'; ?></h3>
                    </div>
                    <div class="panel-body">
                        <form action="" method="POST">
                            <?php if (isset($edit_agent['agent_id']) && $edit_agent['agent_id']): ?>
                                <input type="hidden" name="agent_id" value="<?php echo htmlspecialchars($edit_agent['agent_id']); ?>">
                            <?php endif; ?>
                            
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="agent_name" class="form-control" 
                                       value="<?php echo htmlspecialchars($edit_agent['agent_name']); ?>" required>
                            </div>
                            
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" name="agent_address" class="form-control" 
                                       value="<?php echo htmlspecialchars($edit_agent['agent_address']); ?>" required>
                            </div>
                            
                            <div class="form-group">
                                <label>Contact</label>
                                <input type="text" name="agent_contact" class="form-control" 
                                       value="<?php echo htmlspecialchars($edit_agent['agent_contact']); ?>" required>
                            </div>
                            
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="agent_email" class="form-control" 
                                       value="<?php echo htmlspecialchars($edit_agent['agent_email']); ?>" required>
                            </div>
                            
                            <div class="form-group">
                                <button type="submit" name="submit_agent" class="btn btn-primary">
                                    <?php echo isset($edit_agent['agent_id']) && $edit_agent['agent_id'] ? 'Update Agent' : 'Add Agent'; ?>
                                </button>
                                <?php if (isset($edit_agent['agent_id']) && $edit_agent['agent_id']): ?>
                                    <a href="manage-agents.php" class="btn btn-default">Cancel</a>
                                <?php endif; ?>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Agents List -->
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">All Agents</h3>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Address</th>
                                        <th>Contact</th>
                                        <th>Email</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($agents as $agent): ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($agent['agent_name']); ?></td>
                                            <td><?php echo htmlspecialchars($agent['agent_address']); ?></td>
                                            <td><?php echo htmlspecialchars($agent['agent_contact']); ?></td>
                                            <td><?php echo htmlspecialchars($agent['agent_email']); ?></td>
                                            <td>
                                                <a href="?edit=<?php echo $agent['agent_id']; ?>" 
                                                   class="btn btn-primary btn-sm">
                                                    <i class="glyphicon glyphicon-edit"></i> Edit
                                                </a>
                                                <form action="" method="POST" style="display: inline-block;" 
                                                      onsubmit="return confirm('Are you sure you want to delete this agent?');">
                                                    <input type="hidden" name="agent_id" value="<?php echo $agent['agent_id']; ?>">
                                                    <button type="submit" name="delete_agent" class="btn btn-danger btn-sm">
                                                        <i class="glyphicon glyphicon-trash"></i> Delete
                                                    </button>
                                                </form>
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

.table > thead > tr > th {
    background-color: #f5f5f5;
}

.form-group {
    margin-bottom: 20px;
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
</div>

<link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.css" />
<link rel="stylesheet" href="../assets/style.css" />
<link rel="stylesheet" href="../assets/navbar.css" />

</body>

</html> 