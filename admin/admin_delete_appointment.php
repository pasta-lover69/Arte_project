<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: admin_login.php");
    exit();
}

include "db.php";

if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "Invalid Appointment ID!";
    exit();
}

$appointment_id = $_GET['id'];

$sql_check = "SELECT * FROM tblappointments WHERE appointment_id = ?";
$stmt_check = $conn->prepare($sql_check);
$stmt_check->bind_param("i", $appointment_id);
$stmt_check->execute();
$result_check = $stmt_check->get_result();

if ($result_check->num_rows > 0) {

    $sql = "DELETE FROM tblappointments WHERE appointment_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $appointment_id);
    $stmt->execute();


    header("Location: admin_dashboard.php");
    exit();
} else {
    echo "Appointment not found!";
    exit();
}
?>
