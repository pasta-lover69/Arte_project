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

<nav class="navbar">
    <div class="logo">
        <a href="./home.php">ARTE'</a>
    </div>
    <input type="checkbox" id="menu-toggle" />
    <label for="menu-toggle" class="menu-icon"><i class="ri-menu-line"></i></label>
    <ul class="nav-links">
        <li><a href="./home.php">Home</a></li>
        <li><a href="./aboutus.php">About Us</a></li>
        <li><a href="#booking-modal" onclick="openModal()">Booking</a></li>
        <li><a href="./service_details.php">Services</a></li>
        <li><a href="./check_booking.php">Check Booking</a></li>
    </ul>
</nav>

<script>
    // JavaScript for Navbar Toggle
    const menuToggle = document.getElementById('menu-toggle');
    const navLinks = document.querySelector('.nav-links');

    menuToggle.addEventListener('change', () => {
        if (menuToggle.checked) {
            navLinks.style.display = 'block';
        } else {
            navLinks.style.display = 'none';
        }
    });
</script>

<style>
    /* Responsive Navbar Styling */
    .menu-icon {
        display: none;
        cursor: pointer;
    }

    @media (max-width: 768px) {
        .nav-links {
            display: none;
            flex-direction: column;
            background-color: #fff;
            position: absolute;
            top: 60px;
            right: 0;
            width: 100%;
            z-index: 1000;
        }

        .menu-icon {
            display: block;
        }
    }
</style>

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