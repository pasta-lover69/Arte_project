<?php
// Start the session at the very top
include __DIR__ . '/../config/db_connect_arte.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["review"])) {
    
    $service = $_POST["service"];

    $service_query = $conn->prepare("SELECT srv_id, srv_price, srv_type FROM tblService WHERE srv_name = ?");

    if ($service_query === false) {
        $_SESSION['message'] = "❌ Error preparing service query: " . $conn->error;
        header("Location: " . $_SERVER["PHP_SELF"]);
        exit();

    } else {

        $service_query->bind_param("s", $service);
        $service_query->execute();
        $service_query->bind_result($srv_id, $srv_price, $srv_type);
        $service_query->fetch();
        $service_query->close();

    }

    // ✅ Store booking details in session (Including service price & type)
    $_SESSION["booking_details"] = [
        "firstname"        => htmlspecialchars($_POST["firstname"]),
        "lastname"         => htmlspecialchars($_POST["lastname"]),
        "phone"            => htmlspecialchars($_POST["phone"]),
        "appointment_date" => htmlspecialchars($_POST["appointment_date"]),
        "appointment_time" => htmlspecialchars($_POST["appointment_time"]),
        "service"     => htmlspecialchars($service),
        "srv_price"    => htmlspecialchars($srv_price),  // ✅ Store service price
        "srv_type"     => htmlspecialchars($srv_type),   // ✅ Store service type
        "message"          => htmlspecialchars($_POST["message"])
    ];

    // ✅ Redirect to the same page with GET parameter and anchor for review modal
    header("Location: " . $_SERVER["PHP_SELF"] . "?review=1#review-modal");
    exit();
}
?>
