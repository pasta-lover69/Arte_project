<?php

include "db_connect_arte.php";

echo "<pre>";  // To format the output for readability
var_dump($_POST);
echo "</pre>";

$unique_code = $_POST['unique_code'] ?? '';
$reviewText = $_POST['reviewText'] ?? '';
$rating = $_POST['rating'] ?? '';
$showName = $_POST['showName'] ?? 'anonymous';

if (empty($unique_code) || empty($reviewText) || empty($rating)) {
    die('Missing required fields.');
}

$unique_code = $conn->real_escape_string($unique_code);
$reviewText = $conn->real_escape_string($reviewText);
$rating = intval($rating);
$showName = $conn->real_escape_string($showName);

error_log("unique_code ID: " . $unique_code);
error_log("Review Text: " . $reviewText);
error_log("Rating: " . $rating);
error_log("Show Name: " . $showName);

$sql_select = "SELECT appointment_id FROM tblappointments WHERE unique_code = ?";
$stmt_select = $conn->prepare($sql_select);

if ($stmt_select === false) {
    die('Prepare failed (select): ' . $conn->error);
}

$stmt_select->bind_param("s", $unique_code);

if ($stmt_select->execute()) {
    $result = $stmt_select->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $appointmentID = $row['appointment_id'];
    } else {
        die('Appointment not found.');
    }
} else {
    die('Error retrieving appointment_id: ' . $stmt_select->error);
}

$stmt_select->close();

$sql_select2 = "SELECT customer_id FROM tblappointments WHERE unique_code = ?";
$stmt_select2 = $conn->prepare($sql_select2);

if ($stmt_select2 === false) {
    die('Prepare failed (select): ' . $conn->error);
}

$stmt_select2->bind_param("s", $unique_code);

if ($stmt_select2->execute()) {
    $result = $stmt_select2->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $customer_id = $row['customer_id'];
    } else {
        die('Appointment not found.');
    }
} else {
    die('Error retrieving customer_id: ' . $stmt_select2->error);
}

$stmt_select2->close();

$check_sql = "SELECT COUNT(*) FROM tblreviews WHERE appointment_id = ?";
$check_stmt = $conn->prepare($check_sql);

if ($check_stmt === false) {
    die('Prepare failed (check): ' . $conn->error);
}

$check_stmt->bind_param("s", $appointmentID);
$check_stmt->execute();
$check_stmt->bind_result($review_count);
$check_stmt->fetch();
$check_stmt->close();


if ($review_count > 0) {
    echo 'ALREADY_REVIEWED';
    $conn->close();
    exit;
}

$sql_insert = "INSERT INTO tblreviews (appointment_id, customer_id, Rating, ReviewText, ShowName) VALUES (?, ?, ?, ?, ?)";
$stmt_insert = $conn->prepare($sql_insert);

if ($stmt_insert === false) {
    die('Prepare failed (insert): ' . $conn->error);
}

$stmt_insert->bind_param("iiiss", $appointmentID, $customer_id, $rating, $reviewText, $showName);

if ($stmt_insert->execute()) {
    header("Location: http://localhost/Arte_project/aboutus.php");
    exit();
} else {
    echo 'Error submitting review: ' . $stmt_insert->error;
}

$stmt_insert->close();
$conn->close();
?>