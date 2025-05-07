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

    if (empty($fname) || empty($lname)  || empty($phone) || empty($appointment_date) || empty($appointment_time)) {
        $_SESSION['message'] = "❌ Please fill in all fields.";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }

    // 🔹 Retrieve Service ID
    $service_query = $conn->prepare("SELECT srv_id FROM tblservice WHERE srv_name = ?");
    if ($service_query === false) {
        $_SESSION['message'] = "❌ Error preparing service query: " . $conn->error;
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }

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

    // 🔹 Check if Customer Already Exists
    $customer_query = $conn->prepare("SELECT customer_id FROM tblcustomer WHERE firstname = ? AND lastname = ? AND phone = ?");
    if ($customer_query === false) {
        $_SESSION['message'] = "❌ Error preparing customer query: " . $conn->error;
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }

    $customer_query->bind_param("sss", $fname, $lname, $phone);
    $customer_query->execute();
    $customer_query->bind_result($customer_id);
    $customer_query->fetch();
    $customer_query->close();

    if (!$customer_id) {
        // 🔹 Insert New Customer
        $stmt = $conn->prepare("INSERT INTO tblcustomer (firstname, lastname, phone) VALUES (?, ?, ?)");
        if ($stmt === false) {
            $_SESSION['message'] = "❌ Error preparing customer insert query: " . $conn->error;
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();
        }

        $stmt->bind_param("sss", $fname, $lname, $phone);
        $stmt->execute();
        $customer_id = $stmt->insert_id; // Get new customer ID
        $stmt->close();

        $_SESSION['message'] = "
        <div class='user-msg-container'>
            <br>
            <p>🎉 Welcome, <b>$fname</b>! Thank you for choosing us!</p>
            <br>
        </div>";
    } else {
        $_SESSION['message'] = "
        <div class='user-msg-container'>
            <br>
            <p>🎉 Great to see you again, <b>$fname</b>! Thank you for choosing us once more!</p>
            <br>
        </div>";
    }

    // 🔹 Insert Appointment (Always Insert)
    $unique_code = generateUniqueCode();
    $stmt = $conn->prepare("INSERT INTO tblappointments (customer_id, appointment_date, appointment_time, srv_id, unique_code, message) VALUES (?, ?, ?, ?, ?, ?)");
    
    if ($stmt === false) {
        $_SESSION['message'] = "❌ Error preparing appointment query: " . $conn->error;
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }

    $stmt->bind_param("ississ", $customer_id, $appointment_date, $appointment_time, $srv_id, $unique_code, $mess);
    $stmt->execute();
    $stmt->close();

    // ✅ Store success message in SESSION
    $_SESSION['message'] .= "
                <input type='checkbox' id='hide-message' class='close-checkbox-mess'>
                <div id='success-msg' class='success-message'>
                    <label for='hide-message' class='close-mess'>&times;</label> 
                    <h3>Your appointment has been successfully booked!</h3> 
                    <p>Your Appointment Code:</p>
                    <input class='code' type='text' value='$unique_code' class='Code' readonly onclick='this.select()'>
                    <br><br>
                    <b>Please copy and save this code or take a screenshot.</b> You will need it for your appointment.
                    <br><br>
                </div>";
                $insert_status_sql = "INSERT INTO tblstatus (unique_code, status_type) VALUES (?, 'Pending')";
                $stmt = $conn->prepare($insert_status_sql);
                $stmt->bind_param("s", $unique_code);
                $stmt->execute();
                $stmt->close();
    // ✅ Redirect back to the booking form
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}
?>