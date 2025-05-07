<?php
include "db.php";

session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: admin_login.php");
    exit();
}

if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "Invalid Service ID!";
    exit();
}

$srv_id = $_GET['id'];

// Fetch the service data
$sql = "SELECT srv_id, srv_name, srv_price, srv_type FROM tblservice WHERE srv_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $srv_id);
$stmt->execute();
$result = $stmt->get_result();
$service = $result->fetch_assoc();

if (!$service) {
    echo "Service not found!";
    exit();
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $srv_name = $_POST['srv_name'];
    $srv_price = $_POST['srv_price'];
    $srv_type = $_POST['srv_type'];


    if (empty($srv_name) || empty($srv_price) || empty($srv_type)) {
        echo "Service Name, Price and Type are required!";
        exit();
    }

    $update_sql = "UPDATE tblservice SET srv_name = ?, srv_price = ?, srv_type = ? WHERE srv_id = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("sssi", $srv_name, $srv_price, $srv_type, $srv_id);

    if ($update_stmt->execute()) {
        header("Location: manage_services.php");
        exit();
    } else {
        echo "Error updating service: " . $update_stmt->error;
    }
}

?>

<link rel="stylesheet" href="admin_dashboard.css">
<link rel="stylesheet" href="edit_service.css">


<div class="login-container">
    <h2>Edit Service</h2>


    <form method="POST">
        <div class="container">
            <label for="srv_name">Service Name:</label>
            <input type="text" name="srv_name" id="srv_name" value="<?= htmlspecialchars($service['srv_name']) ?>" required><br>

            <label for="srv_price">Service Price:</label>
            <input type="number" name="srv_price" id="srv_price" step="0.01" value="<?= htmlspecialchars($service['srv_price']) ?>" required><br>

            <label for="srv_type">Service Type:</label>
            <select name="srv_type" id="srv_type" required>
                <option value="Hair Care" <?= ($service['srv_type'] == 'Hair') ? 'selected' : '' ?>>Hair Care</option>
                <option value="Nail Care" <?= ($service['srv_type'] == 'Nails') ? 'selected' : '' ?>>Nail Care</option>
                <option value="Facial Care" <?= ($service['srv_type'] == 'Facial') ? 'selected' : '' ?>>Facial Care</option>
                <option value="Body Care" <?= ($service['srv_type'] == 'Body') ? 'selected' : '' ?>>Body Care</option>
                <option value="Skin Care" <?= ($service['srv_type'] == 'Body') ? 'selected' : '' ?>>Skin Care</option>
                <option value="Other" <?= ($service['srv_type'] == 'Other') ? 'selected' : '' ?>>Other</option>

            </select><br>

            <button class="login-button" type="submit">Update Service</button>
            <a href="manage_services.php">Cancel</a>
        </div>
    </form>
</div>