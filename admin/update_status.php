<?php

include "db.php";


session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: admin_login.php");
    exit();
}


if (isset($_POST['status_type']) && isset($_POST['unique_code'])) {
    $status_type = $_POST['status_type'];
    $unique_code = $_POST['unique_code'];

    $update_status_sql = "UPDATE tblstatus SET status_type = ? WHERE unique_code = ?";
    $stmt = $conn->prepare($update_status_sql);
    $stmt->bind_param("ss", $status_type, $unique_code);
    $stmt->execute();
    $stmt->close();


    header("Location: admin_dashboard.php");
    exit();
} else {

    header("Location: admin_dashboard.php");
    exit();
}
?>