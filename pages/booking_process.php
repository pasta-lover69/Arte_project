<?php
session_start();
include '../config/db_connect_arte.php';

function generateUniqueCode() {
    return strtoupper(bin2hex(random_bytes(4)));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];
    $phone = $_POST['phone'];
    $appointment_date = $_POST['appointment_date'];
    $appointment_time = $_POST['appointment_time'];
    $service = $_POST['service'];
    $mess = $_POST['message'];

    if (empty($fname) || empty($lname) || empty($phone) || empty($appointment_date) || empty($appointment_time)) {
        $_SESSION['message'] = "❌ Please fill in all fields.";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }

    // Retrieve Service ID
    $service_query = $conn->prepare("SELECT srv_id FROM tblservice WHERE srv_name = ?");
    $service_query->bind_param("s", $service);
    $service_query->execute();
    $service_query->bind_result($srv_id);
    $service_query->fetch();
    $service_query->close();

    if (!$srv_id) {
        $_SESSION['message'] = "❌ Error: Selected service does not exist.";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }

    // Check if Customer Already Exists
    $customer_query = $conn->prepare("SELECT customer_id FROM tblcustomer WHERE firstname = ? AND lastname = ? AND phone = ?");
    $customer_query->bind_param("sss", $fname, $lname, $phone);
    $customer_query->execute();
    $customer_query->bind_result($customer_id);
    $customer_query->fetch();
    $customer_query->close();

    if (!$customer_id) {
        // Insert New Customer
        $stmt = $conn->prepare("INSERT INTO tblcustomer (firstname, lastname, phone) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $fname, $lname, $phone);
        $stmt->execute();
        $customer_id = $stmt->insert_id;
        $stmt->close();
    }

    // Insert Appointment
    $unique_code = generateUniqueCode();
    $stmt = $conn->prepare("INSERT INTO tblappointments (customer_id, appointment_date, appointment_time, srv_id, unique_code, message) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ississ", $customer_id, $appointment_date, $appointment_time, $srv_id, $unique_code, $mess);
    $stmt->execute();
    $stmt->close();

    $_SESSION['message'] = "Your appointment has been successfully booked! Your unique code is: $unique_code";
    header("Location: ../home.php");
    exit();
}
?>