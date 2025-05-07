<?php
include 'db_connect_arte.php'; // Database connection

$services = [];
$sql = "SELECT * FROM tblService";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $services[] = $row;
    }
}
?>