<?php
session_start(); // Start the session at the very top
include 'config/db_connect_arte.php'; 
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="assets/css/service_details.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/footer-style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/booking.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/service-info.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/navigation.css?v=<?php echo time(); ?>">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>

<header>
    <?php include 'includes/navbar.php'; ?>
</header>


<body>
<section class="service_section" id="service_details">


<div class="service-herosection">

      <div class="content">
              
          <div class="img-container-service">
              <img src="assets/imgs/bg1.jpg" alt="">
          </div>
        
          <div class="description-container">
          <h2>Arte Services</h2> 
              <p> Tailored beauty & wellness solutions to match your unique needs. Explore our range of services, from relaxing spa treatments to expert beauty enhancements, all designed to give you the best? </p>
             
          </div>
          
     </div>

</div>    

</section>





<!-- Services Grid Section -->
<div class="container mt-4">
<h2 style="text-align:center;">Available Services</h2>
    
    <?php
    // Fetch services grouped by type
    $services = [];
    $query = "SELECT srv_type, srv_name, srv_price, srv_id FROM tblservice ORDER BY srv_type, srv_name";
    $res = $conn->query($query);

    while ($row = $res->fetch_assoc()) {
        $services[$row['srv_type']][] = $row;
    }
    ?>

    <div class="grid-container">
        <?php foreach ($services as $type => $serviceList): ?>
            <div class="grid-item">
                <div class="service-header"><?php echo htmlspecialchars($type); ?></div>
                <?php foreach ($serviceList as $service): ?>
                    <div class="service-row">
                        <p><?php echo htmlspecialchars($service['srv_name']); ?></p>
                        <p>₱<?php echo number_format($service['srv_price'], 2); ?></p>
                        <a class="btn-cta-book" href="#booking-modal">Booking</a></li>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- Booking Form Modal -->
<?php include 'modal.php'; ?>
<?php include 'includes/footer.php'; ?>

<?php if (isset($_SESSION['message'])): ?>
    <div class="message-container">
        <?php 
            echo $_SESSION['message']; 
            unset($_SESSION['message']); 
        ?>
    </div>
<?php endif; ?>

</body>
</html>
