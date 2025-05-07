<?php

include "db.php";

session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: admin_login.php");
    exit();
}


function displayAppointmentsByStatus($conn, $status) {
    $sql = "SELECT tblappointments.*, tblcustomer.firstname, tblcustomer.lastname, tblcustomer.phone, tblservice.srv_name, tblservice.srv_price
            FROM tblappointments
            JOIN tblcustomer ON tblappointments.customer_id = tblcustomer.customer_id
            JOIN tblstatus ON tblappointments.unique_code = tblstatus.unique_code
            JOIN tblservice ON tblappointments.srv_id = tblservice.srv_id
            WHERE tblstatus.status_type = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $status);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {

        echo "<h3 style='font-size: 20px; margin-bottom: 10px; color: #333;'>" . htmlspecialchars(ucfirst($status)) . " Appointments</h3>";
        echo "<table style='border-collapse: collapse; width: 100%; margin-bottom: 20px; font-family: Arial, sans-serif; font-size: 14px;'>";
        echo "<thead style='background-color: #f2f2f2;'>";
        echo "<tr>";
        echo "<th style='border: 1px solid #ddd; padding: 8px; text-align: left; font-weight: bold; text-transform: uppercase;'>Appointment ID</th>";
        echo "<th style='border: 1px solid #ddd; padding: 8px; text-align: left; font-weight: bold; text-transform: uppercase;'>Firstname</th>";
        echo "<th style='border: 1px solid #ddd; padding: 8px; text-align: left; font-weight: bold; text-transform: uppercase;'>Lastname</th>";
        echo "<th style='border: 1px solid #ddd; padding: 8px; text-align: left; font-weight: bold; text-transform: uppercase;'>Phone</th>";
        echo "<th style='border: 1px solid #ddd; padding: 8px; text-align: left; font-weight: bold; text-transform: uppercase;'>Appointment Date</th>";
        echo "<th style='border: 1px solid #ddd; padding: 8px; text-align: left; font-weight: bold; text-transform: uppercase;'>Appointment Time</th>";
        echo "<th style='border: 1px solid #ddd; padding: 8px; text-align: left; font-weight: bold; text-transform: uppercase;'>Service</th>";
        echo "<th style='border: 1px solid #ddd; padding: 8px; text-align: left; font-weight: bold; text-transform: uppercase;'>Price</th>";
        echo "<th style='border: 1px solid #ddd; padding: 8px; text-align: left; font-weight: bold; text-transform: uppercase;'>Message</th>";
        echo "<th style='border: 1px solid #ddd; padding: 8px; text-align: left; font-weight: bold; text-transform: uppercase;'>Unique Code</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
    
        $i = 0; // Initialize counter for zebra striping
        while ($row = $result->fetch_assoc()) {
            $row_style = ($i % 2 == 0) ? "" : "background-color: #f9f9f9;"; // Apply to even rows
    
            echo "<tr style='$row_style'>";
            echo "<td style='border: 1px solid #ddd; padding: 8px; text-align: left;'>" . htmlspecialchars($row['appointment_id']) . "</td>";
            echo "<td style='border: 1px solid #ddd; padding: 8px; text-align: left;'>" . htmlspecialchars($row['firstname']) . "</td>";
            echo "<td style='border: 1px solid #ddd; padding: 8px; text-align: left;'>" . htmlspecialchars($row['lastname']) . "</td>";
            echo "<td style='border: 1px solid #ddd; padding: 8px; text-align: left;'>" . htmlspecialchars($row['phone']) . "</td>";
            echo "<td style='border: 1px solid #ddd; padding: 8px; text-align: left;'>" . htmlspecialchars($row['appointment_date']) . "</td>";
            echo "<td style='border: 1px solid #ddd; padding: 8px; text-align: left;'>" . htmlspecialchars($row['appointment_time']) . "</td>";
            echo "<td style='border: 1px solid #ddd; padding: 8px; text-align: left;'>" . htmlspecialchars($row['srv_name']) . "</td>";
            echo "<td style='border: 1px solid #ddd; padding: 8px; text-align: right;'>₱" . htmlspecialchars($row['srv_price']) . "</td>";
            echo "<td style='border: 1px solid #ddd; padding: 8px; text-align: left;'>" . htmlspecialchars($row['message']) . "</td>";
            echo "<td style='border: 1px solid #ddd; padding: 8px; text-align: left;'>" . htmlspecialchars($row['unique_code']) . "</td>";
            echo "</tr>";
            $i++;
        }
    
        echo "</tbody>";
        echo "</table>";
    } else {
        echo "<p>No " . htmlspecialchars($status) . " appointments found.</p>";
    }
}
?>

<link rel="stylesheet" href="aa-style.css">

    <h2 style="background-color:aqua; padding: 30px; background-color: rgb(42, 42, 42); font-size: 30px; color: white;">
    Admin Dashboard - Appointment Status
    </h2>

    <div style="display: flex; flex-direction: row; gap: 20px; justify-content: flex-start; margin-bottom: 20px;">
    <a href="admin_logout.php" style="display: inline-block; padding: 10px 15px; background-color:rgb(175, 76, 76); color: white; text-decoration: none; border-radius: 5px; transition: background-color 0.3s ease;" onmouseover="this.style.backgroundColor='#367c39'" onmouseout="this.style.backgroundColor='#4CAF50'">Logout</a>
    <a href="admin_dashboard.php" style="display: inline-block; padding: 10px 15px; background-color:rgb(175, 76, 76); color: white; text-decoration: none; border-radius: 5px; transition: background-color 0.3s ease;" onmouseover="this.style.backgroundColor='#367c39'" onmouseout="this.style.backgroundColor='#4CAF50'">Back to All Appointments</a>
</div>


<?php

displayAppointmentsByStatus($conn, "Done");
    echo "<br>";

displayAppointmentsByStatus($conn, "Cancelled");
?> 