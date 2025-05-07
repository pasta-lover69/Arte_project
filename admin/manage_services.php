<?php
include "db.php";

session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: admin_login.php");
    exit();
}
?>

<link rel="stylesheet" href="aa-style.css">


<div class="admin-container" style="background-color: red;">
    <div class="title">Manage Services</div> 
    <div class="navigation">
        <a href="admin_dashboard.php">Back to Dashboard</a>
    </div>

    <div class="add-service">
        <div></div>
        <div></div>
    Add New Service
    <div></div>
    <form action="add_service.php" method="POST">
        <label for="srv_name">Service Name:</label>
        <input type="text" name="srv_name" id="srv_name" required><br>

        <label for="srv_price">Service Price:</label>
        <input type="number" name="srv_price" id="srv_price" step="0.01" required><br>

        <label for="srv_type">Service Type:</label>
        <select name="srv_type" id="srv_type" required>
            <option value="Hair Care">Hair Care</option>
            <option value="Nail Care">Nail Care</option>
            <option value="Body Care">Body Care</option>
            <option value="Skin Care">Skin Care</option>
            <option value="Facial Care">Facial Care</option>
            <option value="Other">Other </option>
        </select><br>

        <button type="submit">Add Service</button>
    </form>
    </div>
<div class="mesa">
    <h3>Existing Services</h3>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Type</th> 
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT srv_id, srv_name, srv_price, srv_type FROM tblservice";
            $result = $conn->query($sql);

            if ($result->num_rows > 0):
                while ($row = $result->fetch_assoc()):
            ?>
                    <tr>
                        <td><?= htmlspecialchars($row['srv_id']) ?></td>
                        <td><?= htmlspecialchars($row['srv_name']) ?></td>
                        <td>₱<?= htmlspecialchars($row['srv_price']) ?></td>
                        <td><?= htmlspecialchars($row['srv_type']) ?></td>
                        <td>
                            <a href="edit_service.php?id=<?= htmlspecialchars($row['srv_id']) ?>">Edit</a>
                            <a href="delete_service.php?id=<?= htmlspecialchars($row['srv_id']) ?>" onclick="return confirm('Are you sure you want to delete this service?')">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">No services found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    </div>
</div>