<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: admin_login.php");
    exit();
}

include "db.php";

if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "Invalid Appointment ID!";
    exit();
}

$appointment_id = $_GET['id'];

$sql = "SELECT * FROM tblappointments WHERE appointment_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $appointment_id);
$stmt->execute();
$result = $stmt->get_result();
$appointment = $result->fetch_assoc();

if (!$appointment) {
    echo "Appointment not found!";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $appointment_date = $_POST['appointment_date'];
    $appointment_time = $_POST['appointment_time'];
    $message = $_POST['message'];
    $srv_id = $_POST['service']; 

    if (empty($appointment_date) || empty($appointment_time) || empty($message) || empty($srv_id)) {
        echo "All fields are required!";
        exit();
    }

    $update_sql = "UPDATE tblappointments SET appointment_date = ?, appointment_time = ?, message = ?, srv_id = ? WHERE appointment_id = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("sssii", $appointment_date, $appointment_time, $message, $srv_id, $appointment_id);

    if ($update_stmt->execute()) {
        header("Location: admin_dashboard.php");
        exit();
    } else {
        echo "Error updating appointment. Please try again.";
        exit();
    }
}
?>

<link rel="stylesheet" href="edit_service.css">
<a href="admin_dashboard.php" style="padding: 7px; background-color: blanchedalmond; color: black; width: max-content; position: absolute;top:0;left:0;"> back to dashboard</a>
<div class="edit-container" style="max-width: 600px; margin: 20px auto;background-color:beige; padding: 20px; border: 1px solid #ccc; border-radius: 5px; text-align: center;">
  <h2 style="margin-bottom: 20px;">Edit Appointment</h2>

  <form method="POST" style="display: inline-block; text-align: left; width: 100%;">
    <div style="margin-bottom: 10px;">
      <label for="appointment_date" style="display: block; margin-bottom: 5px;">Appointment Date:</label>
      <input type="date" name="appointment_date" value="<?= htmlspecialchars($appointment['appointment_date']) ?>" required style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box;">
    </div>

    <div style="margin-bottom: 10px;">
      <label for="appointment_time" style="display: block; margin-bottom: 5px;">Appointment Time:</label>
      <input type="time" name="appointment_time" value="<?= htmlspecialchars($appointment['appointment_time']) ?>" required style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box;">
    </div>

    <!-- Service Selection -->
    <div class="form-group" style="margin-bottom: 10px;">
      <label for="service" style="display: block; margin-bottom: 5px;">Select Service:</label>
      <select id="service" name="service" required style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box;">
        <option value="">-- Select a Service --</option>
        <?php
        $sqlServices = "SELECT srv_id, srv_name, srv_price FROM tblservice";
        $resultServices = $conn->query($sqlServices);

        if ($resultServices->num_rows > 0) {
          while ($row = $resultServices->fetch_assoc()) {
            $selected = ($appointment['srv_id'] == $row["srv_id"]) ? 'selected' : '';
            echo '<option value="' . htmlspecialchars($row["srv_id"]) . '" ' . $selected . '>' . htmlspecialchars($row["srv_name"]) . ' - $' . htmlspecialchars($row["srv_price"]) . '</option>';
          }
        } else {
          echo '<option value="">No services available</option>';
        }
        ?>
      </select>
    </div>

    <div style="margin-bottom: 10px;">
      <label for="message" style="display: block; margin-bottom: 5px;">Message:</label>
      <textarea name="message" required style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box; height: 100px;"><?= htmlspecialchars($appointment['message']) ?></textarea>
    </div>

    <input type="submit" value="Update Appointment" style="background-color: #4CAF50; color: white; padding: 12px 20px; border: none; border-radius: 4px; cursor: pointer; float: right;">
  </form>
</div>