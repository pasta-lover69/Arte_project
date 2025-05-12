<?php
include 'db_connect_arte.php'; // Database connection

$services = [];
$sql = "SELECT srv_id, srv_name, srv_price, srv_type FROM tblservice ORDER BY srv_type, srv_name";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $services[] = $row;
    }
}

$stmt->close();
?>