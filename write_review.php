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
            <form action="" method="GET">
                <label for="unique_code">
                    Your Unique Code:
                    <input type="text" id="reviewID" name="unique_code" placeholder="Unique Code"
                        value="<?php echo isset($_GET['unique_code']) ? htmlspecialchars($_GET['unique_code']) : ''; ?>">
                    <button class="checkstatus" type="submit">Check Appointment Status</button>
                </label>
                <?php
                $statusMessage = '';
                $canReview = false;
                $alreadyReviewed = false;
                $uniqueCode = isset($_GET['unique_code']) ? htmlspecialchars($_GET['unique_code']) : '';

                if (isset($_GET['unique_code']) && !empty($_GET['unique_code'])) {
                    ob_start();
                    include 'config/check_appointment_status.php';
                    $status = ob_get_clean();

                    if ($status === 'ALREADY_REVIEWED') {
                        $alreadyReviewed = true;
                        $canReview = false;
                        $statusMessage = 'Already Reviewed';
                    } elseif (strpos($status, 'SUCCESS:') !== false) {
                        $statusMessage = trim(str_replace('SUCCESS:', '', $status));
                        if ($statusMessage === 'Done') {
                            $canReview = true;
                        } else {
                            $canReview = false;
                        }
                    } else {
                        $statusMessage = $status;
                        $canReview = false;
                    }

                    echo '<span id="appointmentStatus">' . htmlspecialchars($statusMessage) . '</span>';
                }
                ?>
            </form>

            <?php if ($canReview): ?>
                <form class="show-name" action="config/submit_review.php" method="POST" id="reviewForm">
                    <!-- Hidden input for unique_code -->
                    <input type="hidden" name="unique_code" value="<?php echo htmlspecialchars($uniqueCode); ?>">

                    Do you want to show your name on your review?
                    <div class="namedisplay">
                        <label for="ShowName">
                            <input type="radio" id="showname" name="showName" value="showName">
                            Show Name
                        </label>
                        <label for="Anonymous">
                            <input type="radio" id="showAnonymous" name="showName" value="anonymous" checked>
                            Anonymous
                        </label>
                    </div>
                    <div class="review-container">
                        Write your review:
                        <label for="WriteReview">
                            <textarea id="review" name="reviewText" rows="3" cols="1180"></textarea>
                        </label>

                        <h5 class="rateus">Rate us:</h5>

                        <div class="star-rating">
                            <input type="radio" id="star5" name="rating" value="5" hiiden><label for="star5"
                                title="5 stars">★</label>
                            <input type="radio" id="star4" name="rating" value="4" hiiden><label for="star4"
                                title="4 stars">★</label>
                            <input type="radio" id="star3" name="rating" value="3" hiiden><label for="star3"
                                title="3 stars">★</label>
                            <input type="radio" id="star2" name="rating" value="2" hiiden><label for="star2"
                                title="2 stars">★</label>
                            <input type="radio" id="star1" name="rating" value="1" hiiden><label for="star1"
                                title="1 star">★</label>
                        </div>
                    </div>

                    <button class="SubmitBTN" type="submit">Submit Review</button>
                </form>
            <?php endif; ?>
        </div>
    </div>
</body>
<?php include 'includes/footer.php' ?>

</html>