<?php
include "../Arte_Project/config/db_connect_arte.php";

$sql = "SELECT tblreviews.*, tblcustomer.firstname, tblcustomer.lastname
        FROM tblreviews
        INNER JOIN tblappointments ON tblreviews.appointment_id = tblappointments.appointment_id
        INNER JOIN tblcustomer ON tblreviews.customer_id = tblcustomer.customer_id";  
$result = $conn->query($sql);

if ($result === false) {
    die("Query failed: " . $conn->error);
}

$reviews = array();
$totalRating = 0;
$totalReviews = 0;

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $reviews[] = $row;
        $totalRating += intval($row['Rating']);
        $totalReviews++;
    }
}


$averageRating = ($totalReviews > 0) ? number_format($totalRating / $totalReviews, 2) : 0;
$starString = generateStars(round($averageRating));

echo '<span class="average-rating" id="averageRating">' . htmlspecialchars($averageRating) . '</span>';
echo '<span class="star" id="starRating">' .  $starString . '</span>';
echo '<span class="review-count" id="reviewCount">' . htmlspecialchars($totalReviews) . ' reviews</span>';


$conn->close();

function generateStars($rating) {
    $stars = '';
    for ($i = 0; $i < $rating; $i++) {
        $stars .= '<span class="star">★</span>'; 
    }
    return $stars;
}

?>