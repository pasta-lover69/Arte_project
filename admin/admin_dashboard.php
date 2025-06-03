<?php
include "db.php";

session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: admin_login.php");
    exit();
}
?>

<head>
    <!-- Replace multiple CSS links with single consolidated file -->
    <link rel="stylesheet" href="admin-styles.css?v=<?php echo time(); ?>">
</head>

<div class="admin-container">
    <div class="title"><h2>Admin Dashboard</h2></div>

    <div class="navigation">
        
            <a href="admin_logout.php">Logout</a>
            <a href="admin_appointment_status.php">View Appointment Status</a>
            <a href="manage_services.php">Manage Services</a>
        
    </div>

    <div class="title">All Pending Appointments</div>
    <div class="mesa">
    <table>
        <thead>
            <tr>
                <th>Appointment ID</th>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Phone</th>
                <th>Appointment Date</th>
                <th>Appointment Time</th>
                <th>Service</th>
                <th>Price</th>
                <th>Message</th>
                <th>Unique Code</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT tblappointments.*, tblcustomer.firstname, tblcustomer.lastname, tblcustomer.phone, tblservice.srv_name, tblservice.srv_price
                    FROM tblappointments
                    JOIN tblcustomer ON tblappointments.customer_id = tblcustomer.customer_id
                    JOIN tblstatus ON tblappointments.unique_code = tblstatus.unique_code
                    JOIN tblservice ON tblappointments.srv_id = tblservice.srv_id
                    WHERE tblstatus.status_type = 'Pending'";

            $result = $conn->query($sql);

            if ($result->num_rows > 0):
                while ($row = $result->fetch_assoc()):
                    $appointment_id = $row['appointment_id'];
                    $unique_code = $row['unique_code'];
                    $status = "Pending";
            ?>
                    <tr>
                        <td ><?= htmlspecialchars($row['appointment_id']) ?></td>
                        <td><?= htmlspecialchars($row['firstname']) ?></td>
                        <td><?= htmlspecialchars($row['lastname']) ?></td>
                        <td><?= htmlspecialchars($row['phone']) ?></td>
                        <td><?= htmlspecialchars($row['appointment_date']) ?></td>
                        <td><?= htmlspecialchars($row['appointment_time']) ?></td>
                        <td><?= htmlspecialchars($row['srv_name']) ?></td>
                        <td>₱<?= htmlspecialchars($row['srv_price']) ?></td>
                        <td><?= htmlspecialchars($row['message']) ?></td>
                        <td><?= htmlspecialchars($unique_code) ?></td>
                        <td>
                            <span style="color: orange;">Pending</span>
                        </td>
                        <td>
                            <form action="update_status.php" method="POST">
                                <input type="hidden" name="unique_code" value="<?= htmlspecialchars($unique_code) ?>">
                                <select name="status_type" required>
                                    <option value="Pending" selected>Pending</option>
                                    <option value="Done">Done</option>
                                    <option value="Cancelled">Cancelled</option>
                                </select>
                                <button type="submit">Update Status</button>
                            </form>
                            <a href="admin_edit_appointment.php?id=<?= htmlspecialchars($row['appointment_id']) ?>">Edit</a>
                            <a href="admin_delete_appointment.php?id=<?= htmlspecialchars($row['appointment_id']) ?>" onclick="return confirm('Are you sure you want to delete this appointment?')">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="12">No pending appointments found</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    </div>
</div>