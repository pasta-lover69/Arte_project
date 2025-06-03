<?php
session_start();
include 'config/db_connect_arte.php'; 
include 'config/get_service_info.php'; 
include 'config/review_prcss.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ARTE' | HOME</title>
  
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Consolidated CSS files -->
    <link rel="stylesheet" href="assets/css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/main.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/navigation.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/booking.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/footer-style.css?v=<?php echo time(); ?>">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>

<header>
    <?php include'includes/navbar.php' ?>
</header>

<?php include 'pages/main-page.php' ?>

<body>
    <?php include 'modal.php' ?>
    <?php include 'includes/footer.php' ?>

    <?php if (isset($_SESSION['message'])): ?>
        <div class="alert alert-info">
            <?php echo $_SESSION['message']; ?>
        </div>
        <?php unset($_SESSION['message']); ?>
    <?php endif; ?>
</body>
</html>