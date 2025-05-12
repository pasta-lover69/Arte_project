<?php
$servername = "localhost"; // Use 'localhost' if the database is hosted locally
$username = "root";        // Replace with your database username
$password = "Jayb7224";    // Replace with your database password
$dbname = "arte_database"; // Replace with your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
