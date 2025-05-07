<?php
include "db.php";

session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: admin_login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $srv_name = $_POST['srv_name'];
    $srv_price = $_POST['srv_price'];
    $srv_type = $_POST['srv_type'];

    if (empty($srv_name) || empty($srv_price) || empty($srv_type)) {
        echo "Service Name, Price, and Type are required!";
        exit();
    }

    $sql = "INSERT INTO tblservice (srv_name, srv_price, srv_type) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $srv_name, $srv_price, $srv_type);

    if ($stmt->execute()) {
        header("Location: manage_services.php");
        exit();
    } else {
        echo "Error adding service: " . $stmt->error;
    }
} else {
    header("Location: manage_services.php");
    exit();
}
?>