<?php include 'config/db_connect_arte.php'; // Database connection

$serviceDetails = null; // Default: No service selected
$showForm = false; // Default: Hide service details
$scrollY = isset($_GET['scroll']) ? intval($_GET['scroll']) : 100;

// Check if service_id is passed from the form
if (isset($_GET['service_id'])) {
    $service_id = $_GET['service_id']; // Get service_id from URL
    $showForm = true; // Show the service details
    // Fetch service details from tblservice
    $sql = "SELECT srv_type, srv_name, srv_price FROM tblservice WHERE srv_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $service_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $serviceDetails = $result->fetch_assoc(); // Fetch service details
    }
}
?>