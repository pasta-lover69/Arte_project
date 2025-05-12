<?php
include 'db_connect_arte.php'; // Database connection

$serviceDetails = null; // Default: No service selected

if (isset($_POST['service_info'])) {
    $service_id = $_POST['service_info']; // Get service ID from button

    // Prepare and execute query safely
    $stmt = $conn->prepare("SELECT srv_type, srv_name, srv_price FROM tblservice WHERE srv_id = ?");
    $stmt->bind_param("i", $service_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $serviceDetails = $result->fetch_assoc(); // Store fetched data
    }

    $stmt->close();
}

$conn->close();
?>