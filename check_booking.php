<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}// Start the session at the very top
        include 'config/db_connect_arte.php'; 
        $appointmentDetails = "";
        $errorMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $unique_code = trim($_POST['unique_code']);

    // SQL Query to fetch details based on unique_code
    $sql = "SELECT 
                a.*, 
                c.firstname, 
                c.lastname, 
                c.phone 
            FROM tblappointments a
            JOIN tblcustomer c ON a.customer_id = c.customer_id
            WHERE a.unique_code = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $unique_code);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if there is a matching record
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $appointmentDetails = "
                <div class='appointment-details'>
                    <h3>Appointment Details</h3>
                    <p><strong>Name:</strong> " . htmlspecialchars($row['firstname']) . " " . htmlspecialchars($row['lastname']) . "</p>
                    <p><strong>Phone:</strong> " . htmlspecialchars($row['phone']) . "</p>
                    <p><strong>Appointment Date:</strong> " . htmlspecialchars($row['appointment_date']) . "</p>
                    <p><strong>Appointment Time:</strong> " . htmlspecialchars($row['appointment_time']) . "</p>
                    <p><strong>Message:</strong> " . htmlspecialchars($row['message']) . "</p>
                </div>";
        }
    } else {
        $errorMessage = "<p class='error'>No record found for this unique code.</p>";
    }
}


        include 'config/get_service_info.php'; 
        include 'config/review_prcss.php'; 
   

?>
<!-- Navigation -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ARTE' | HOME</title>
  
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        rel="stylesheet">

    
    <link rel="stylesheet" href="assets/css/footer-style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/booking.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/navigation.css?v=<?php echo time(); ?>">

    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    </head>
    <style>

        section{
            height: calc(80vh + 5px);
            background-color: beige;
        }
        .code-container {
            transform: translateY(100px);
            width: 90%;
            max-width: 400px;
            margin: 50px auto; 
            padding: 20px;
            border: 1px solid #ddd;
            background-color: bisque;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            text-align: center; 
       }

            .code-container h2 {
            margin-bottom: 20px;
            color: #333;
       }

            .code-container form {
            display: flex;
            flex-direction: column;
            align-items: center;
       }

            .code-handler {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
       }

            .sumbit-code {
            width: 100%;
            padding: 10px 20px;
            background-color:rgb(152, 157, 149);
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
      }

            .sumbit-code:hover {
            background-color:rgb(48, 52, 57);
     }

            .code-container p,
            .code-container div {
            margin-top: 15px;
            text-align: left; 
            width: 100%; /
            box-sizing: border-box; 
      }

            /* Responsive adjustments */
            @media (max-width: 600px) {
            .code-container {
                width: 95%; 
                margin: 30px auto; 
                padding: 15px;
       }

            .code-handler,
            .sumbit-code {
                padding: 8px; 
       }
     }
    </style>
    <body>
 <header>
    <?php include 'includes/navbar.php' ?>
</header>
<section>
<div class="code-container">
    <h2>Search Appointment</h2>
    <form method="POST">
        <input class="code-handler" type="text" name="unique_code" placeholder="Enter Unique Code" required>
        <button class="sumbit-code" type="submit">Search</button>
    </form>

    <?= $appointmentDetails; ?>
    <?= $errorMessage; ?>
</div>
</section>
<?php include 'modal.php' ?>

<?php include 'includes/footer.php' ?>


<?php if (isset($_SESSION['message'])): ?>
    <div class="message-container">
        <?php 
            echo $_SESSION['message']; 
            unset($_SESSION['message']); 
        ?>
    </div>
</body>
</html>


<?php endif; ?>