<?php
 
include __DIR__ . '/../config/db_connect_arte.php';

$searchTerm = "";
$results = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $searchTerm = trim($_POST['search']);

    if (!empty($searchTerm)) {
        // SQL query to search for matches in tblService
        $sql = "SELECT * FROM tblService 
                WHERE srv_type LIKE '%$searchTerm%' 
                OR srv_name LIKE '%$searchTerm%' 
                LIMIT 20";
        $query = $conn->query($sql);

        while ($row = $query->fetch_assoc()) {
            $results[] = $row;
        }
    }
}
?>

<nav class="navigation">

    <div class="container">
        
        <div class="logo">
            <a href="./home.php"><img class="logo" src="/Arte_project/assets/imgs/LOGO.png" alt=""></a>
        </div>
      
      
      <!-- Hidden checkbox to toggle search results -->


            <ul class="nav-items">      
                <div class="searchbar-container">
                <label for="toggle-on" class="btn"><i class="ri-menu-line"></i></label>
                    <form action="#" method="POST">
                        <input type="text" name="search" value="<?php echo isset($searchTerm) ? htmlspecialchars($searchTerm) : ''; ?>" placeholder="Search services..." required>
                        <button type="submit"><i class="ri-search-line"></i></button>
                    </form>

                    <!-- Search results container (controlled by the checkbox) -->
                   
                    <div class="search-results-container">
                    <input type="checkbox" id="toggle-result" hidden>
                  
                        <?php if (!empty($results)) : ?>
                         <ul class="search-results">
                            <div class="close">
                            <label for="toggle-result" class=".close-button"><i class="ri-arrow-up-wide-line"></i></label>

                            </div>
                                <?php foreach ($results as $service) : ?>
                                    <li>
                                        <a href="service_details.php?id=<?php echo htmlspecialchars($service['srv_type']); ?>">
                                            <?php echo htmlspecialchars($service['srv_name']); ?> (<?php echo htmlspecialchars($service['srv_type']); ?>)
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>

                          
                        <?php elseif ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
                            <input type="checkbox" id="toggle-mess" hidden>
                            <div class="search-message">
                            <label for="toggle-mess" class=".close-mess"><i class="ri-arrow-up-wide-line"></i></label>
                            <p>No matching services found.</p></div>
                        <?php endif; ?>
                    </div>
                </div>
           


                <input type="checkbox" id="toggle-on" hidden>
                  
                    

              <div class="nav-item-links">    
                <li class="nav-links"><a href="./home.php">Home</a></li>
                <li class="nav-links"><a href="./aboutus.php">About us</a></li>
                <li  class="nav-links"><a  href="#booking-modal">Booking</a></li>
                <li class="nav-links"><a href="./service_details.php">Services</a></li>
                <li class="nav-links"><a href="./check_booking.php">Check booking</a></li>
                </div>  
            </ul>


</div>
</nav>