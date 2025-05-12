<?php
session_start();
include 'config/db_connect_arte.php';
include 'config/review_prcss.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Write a Review</title>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/review.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/footer-style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/main.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/booking.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/service-info.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/herosection.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/navigation.css?v=<?php echo time(); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
</head>

<header>
    <?php include 'includes/navbar.php' ?>
</header>

<body>
    <?php include 'modal.php' ?>

    <div class="Container01">
        <div class="form">
            <form action="config/submit_review.php" method="POST">
                <label for="unique_code">Unique Code:</label>
                <input type="text" id="unique_code" name="unique_code" required>
                <label for="reviewText">Review:</label>
                <textarea id="reviewText" name="reviewText" rows="4" required></textarea>
                <label for="rating">Rating:</label>
                <select id="rating" name="rating" required>
                    <option value="5">5 - Excellent</option>
                    <option value="4">4 - Good</option>
                    <option value="3">3 - Average</option>
                    <option value="2">2 - Poor</option>
                    <option value="1">1 - Terrible</option>
                </select>
                <button type="submit">Submit Review</button>
            </form>
        </div>
    </div>
</body>
<?php include 'includes/footer.php' ?>

</html>