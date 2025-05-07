<?php

include 'db_connect_arte.php';

$uniqueCode = $_GET['unique_code'] ?? '';

if (empty($uniqueCode)) {
    die('Missing Unique Code.');
}

$uniqueCode = $conn->real_escape_string($uniqueCode);

$sql_appt_id = "SELECT appointment_id FROM tblappointments WHERE unique_code = ?";
$stmt_appt_id = $conn->prepare($sql_appt_id);

if ($stmt_appt_id === false) {
    die('Prepare failed (find appt id): ' . $conn->error);
}

$stmt_appt_id->bind_param("s", $uniqueCode);
$stmt_appt_id->execute();
$result_appt_id = $stmt_appt_id->get_result();

if ($result_appt_id->num_rows == 0) {
    echo 'Appointment not found';
    $stmt_appt_id->close();
    $conn->close();
    exit();
}

$row_appt_id = $result_appt_id->fetch_assoc();
$appointmentID = $row_appt_id['appointment_id'];

$stmt_appt_id->close();

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
    echo 'Already Reviewed';
    $conn->close();
    exit();
}

$sql = "SELECT st.status_type
        FROM tblstatus AS st
        WHERE st.unique_code = ?";

$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die('Prepare failed: ' . $conn->error);
}

$stmt->bind_param("s", $uniqueCode);

if ($stmt->execute()) {
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo 'SUCCESS:' . $row['status_type'];
    } else {
        echo 'Appointment not found.';
    }
} else {
    echo 'Error retrieving status: ' . $stmt->error;
}

$stmt->close();
$conn->close();
?>