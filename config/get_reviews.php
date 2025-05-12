<?php
include 'db_connect_arte.php';

$sql = "SELECT tblreviews.*, tblcustomer.firstname, tblcustomer.lastname
        FROM tblreviews
        INNER JOIN tblappointments ON tblreviews.appointment_id = tblappointments.appointment_id
        INNER JOIN tblcustomer ON tblreviews.customer_id = tblcustomer.customer_id";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

if ($result === false) {
    die("Query failed: " . $conn->error);
}

$reviews = [];
$totalRating = 0;
$totalReviews = 0;

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $reviews[] = $row;
        $totalRating += intval($row['rating']);
        $totalReviews++;
    }
}

$averageRating = ($totalReviews > 0) ? number_format($totalRating / $totalReviews, 2) : 0;

function generateStars($rating) {
    return str_repeat('★', $rating) . str_repeat('☆', 5 - $rating);
}

$starString = generateStars(round($averageRating));

echo '<span class="average-rating" id="averageRating">' . htmlspecialchars($averageRating) . '</span>';
echo '<span class="star" id="starRating">' .  $starString . '</span>';
echo '<span class="review-count" id="reviewCount">' . htmlspecialchars($totalReviews) . ' reviews</span>';

$conn->close();
?>