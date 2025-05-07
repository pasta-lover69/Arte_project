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

$sql = "DELETE FROM tblservice WHERE srv_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $srv_id);

if ($stmt->execute()) {
    header("Location: manage_services.php");
    exit();
} else {
    echo "Error deleting service: " . $stmt->error;
}
?>