<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
} // Start the session at the very top
        include 'config/db_connect_arte.php'; 
        include 'config/get_service.php'; 
        include 'config/review_prcss.php'; 
        include 'config/get_service_info.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>About Us - Arte Services</title>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="assets/css/footer-style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/main.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/booking.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/service-info.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/navigation.css?v=<?php echo time(); ?>">




    <link rel="stylesheet" href="assets/css/aboutus.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/review.css?v=<?php echo time(); ?>">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=EB+Garamond:ital,wght@0,400..800;1,400..800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="./assets/imgs/LOGOHD.png">
    <style>
        .star {
            color: gold;
            font-size: 1.2em;
        }
    </style>
</head>
<body>
<?php include 'includes/navbar.php' ?>
<?php include 'modal.php' ?>


<?php
    session_start(); 

    if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];
        unset($_SESSION['message']); 
    }
    ?>


  
        
    

            
      <section class="cover_section">
        <div class="container_cover">
            <div class="cover_img">
                <img src="./assets/imgs/cover.jpg" alt="About Us Image">
            </div>
            <div class="content">
                <h1>About Us</h1>
                <p>Arte Aesthetic & Wellness Services is a local beauty lounge that truly has it all, including new innovative technology to give you the highest quality of services. Our latest aesthetic technology, great customer service, and variety of artistic services make this place perfect for a full spa getaway.</p>
            </div>
        </div>
    </section>
    <main>
        <div class="image-separator"></div>
        <section class="our-story-detailed">
            <h3>Our Mission</h3>
            <div class="container">
                <p>Our mission is to provide affordable yet quality and excellent services for each and everyone! We have professional and well-trained staff to give high quality services that any customer deserves.</p>
            </div>
        </section>
        <section class="holistic-wellness" style="Background-color: white;">
            <div class="container" >
                <div class="image-container">
                    <img src="./assets/imgs/LOGOHD.png" alt="Holistic Wellness">
                </div>
                <div class="content" >
                    <h2>Arte Est. 2020</h2>
                    <p>Arte Aesthetic & Wellness Services, a newly established beauty lounge in Davao City since May 2023, presents a comprehensive range of aesthetic and wellness treatments.</p>
                    <p>Their offerings span from basic beauty services like facials, manicures, and pedicures to advanced medical aesthetics, laser treatments, and slimming procedures.</p>
                    <p> The lounge emphasizes affordability without compromising quality, aiming to provide accessible high-quality services to a wide clientele.  With a focus on customer service and utilizing modern aesthetic technology, Arte aims to create a relaxing and rejuvenating spa experience.  Their extensive service menu caters to diverse needs, including skincare, anti-aging, hair care, and body treatments.</p>
                </div>
            </div>
        </section>
        <section class="holistic-wellness">
            <div class="container">
                <div class="content">
                    <h2>Offers a wide array of beauty and wellness treatments. </h2>
                    <p>Basic Beauty & Wellness: We offer standard services such as facials, manicures, pedicures, and hair care treatments.  Additionally, we provide body peeling and waxing, suggesting a focus on overall skin health and maintenance.</p>
                    <p>Advanced Aesthetic Treatments: The inclusion of glutathione IV drips, laser treatments, slimming and tightening procedures, and medical aesthetics indicates a focus on more specialized and potentially technologically advanced treatments.  These services suggest a commitment to addressing a range of aesthetic concerns, from skin rejuvenation to body contouring.</p>
                    <p>Emphasis on Affordability and Quality: The company's mission statement emphasizes providing "affordable yet quality and excellent services," suggesting they aim to make aesthetic treatments accessible to a wider audience. This could imply a focus on competitive pricing or package deals.</p>
                </div>
                <div class="image-container">
                    <img src="./assets/imgs/bg1.jpg" alt="Holistic Wellness">
                </div>
            </div>
        </section>
        <section class="our-promise" style="Background-color: white;">
            <div class="container">
                <h2>Branch</h2>           
                <p>Arte Aesthetic & Wellness Services is situated in a seemingly accessible location within Davao City, Philippines. Specifically, it's located at #61 D. Ponce St., Barangay 24-C, Poblacion. This suggests a location within a potentially central or well-established area of the city. For inquiries or appointments, they can be reached at the Philippine mobile number 09675375585.  Additionally, they provide an email address, arteaestheticwellnessservices@gmail.com, for potential communication and service inquiries.</p>
            </div>
        </section>
        <section class="Testimonials_section">
        <div class="slider-container">
        <h2 style="color: white;">TESTIMONIES</h2>

  <div class="slider">
    <div class="slide">
    <div class="testimonials_card">
                        <img src="./assets/imgs/01_testimony.jpg" alt="01_testimony.jpg">
                        <div class="info">
                            <h4>"Result agad after 2 weeks of Exosome!"</h4>
                            <p>I recently tried Arte's Exosome Therapy, and I'm genuinely impressed with the results. After just two weeks, I noticed a significant improvement in my skin's texture and overall appearance. The "before" picture shows my skin with noticeable pores and a slightly uneven tone. However, the "after" picture reveals a smoother, more refined texture with a visible reduction in pore size.  My skin also feels more hydrated and has a healthy glow.</p>
                            <h1>Jana Lee</h1>
                            <h5>Exosome Therapy</h5>
                        </div>
                        
            </div>
    </div>
    <div class="slide">
    <div class="testimonials_card">
                        <img src="./assets/imgs/02_Testimony.jpg" alt="02_Testimony.jpg">
                        <div class="info">
                            <h4>"Grabe! It was a huge difference after I had it!"</h4>
                            <p>I recently tried Traptox: Botox, and I'm really pleased with the results. After the treatment, I noticed a visible change in my shoulder area. The "before" picture shows my shoulders looking a bit more rounded, while the "after" picture reveals a sleeker, more contoured appearance.  I also noticed a significant reduction in muscle tension, which was a nice bonus!  </p>
                            <h1>Trixy Manoos</h1>
                            <h5>Traptox: Botox</h5>
                        </div>
            </div>
    </div>
    <div class="slide">
    <div class="testimonials_card">
                        <img src="./assets./imgs/03_Testimony.jpg" alt="face.jpg">
                        <div class="info">
                            <h4>"It looks and feels natural! parang natural beauty!"</h4>
                            <p>I tried the Hiko Noselift, and I'm really happy with the results. Looking at the "before" picture, you can see my nose bridge was a bit flatter. The "after" picture shows a noticeable lift and more definition. It really enhanced my profile!  While everyone's experience is different, I'm personally very pleased with the outcome and would recommend the Hiko Noselift to anyone looking for a subtle but effective nose enhancement.</p>
                            <h1>Nancy Viduya</h1>
                            <h5>Hiko Nose Lift</h5>
                        </div>
            </div>
    </div>
    <div class="slide">
    <div class="testimonials_card">
                        <img src="./assets/imgs/01_testimony.jpg" alt="01_testimony.jpg">
                        <div class="info">
                            <h4>"Result agad after 2 weeks of Exosome!"</h4>
                            <p>I recently tried Arte's Exosome Therapy, and I'm genuinely impressed with the results. After just two weeks, I noticed a significant improvement in my skin's texture and overall appearance. The "before" picture shows my skin with noticeable pores and a slightly uneven tone. However, the "after" picture reveals a smoother, more refined texture with a visible reduction in pore size.  My skin also feels more hydrated and has a healthy glow.</p>
                            <h1>Caroline Henari</h1>
                            <h5>Exosome Therapy</h5>
                        </div>
                        
            </div>
    </div>
    <div class="slide">
    <div class="testimonials_card">
                        <img src="./assets/imgs/02_Testimony.jpg" alt="02_Testimony.jpg">
                        <div class="info">
                            <h4>"Grabe! It was a huge difference after I had it!"</h4>
                            <p>I recently tried Traptox: Botox, and I'm really pleased with the results. After the treatment, I noticed a visible change in my shoulder area. The "before" picture shows my shoulders looking a bit more rounded, while the "after" picture reveals a sleeker, more contoured appearance.  I also noticed a significant reduction in muscle tension, which was a nice bonus!  </p>
                            <h1>Raven Babiano</h1>
                            <h5>Traptox: Botox</h5>
                        </div>
            </div>
    </div>
  </div>
</div>
            
            
                    
            </div>
        </section>
    </main>
    <section class="customer-reviews">
        <h1>Reviews</h1>
        <div class="container">
            <div class="reviews-header">
                <h2>What our clients say about us</h2>
                <div class="rating">
                    <?php
                        include './config/get_reviews.php';
                    ?>
                </div>
                <a href="write_review.php" class="write-review-btn">Write a review</a>
            </div>
            <div class="reviews-grid" id="customerReviews">
                 <?php
                    if (!empty($reviews)) {
                        foreach ($reviews as $review) {
                            echo '<div class="review-card">';
                            echo '  <div class="review-header">';
                            echo '      <div class="stars">' . generateStars($review['Rating']) . '</div>';
                            echo '      <div class="review-date">' . htmlspecialchars($review['ReviewDate']) . '</div>';
                            echo '  </div>';
                            echo '  <div class="review-text">' . htmlspecialchars($review['ReviewText']) . '</div>';
                            echo '  <div class="reviewer">';
                            echo '      <div class="reviewer-info">';
                            echo '          <span class="reviewer-name">';
                            echo (htmlspecialchars($review['ShowName']) === 'showName' ? htmlspecialchars($review['firstname'] . ' ' . $review['lastname']) : 'Anonymous');
                            echo '          </span>';
                            echo '      </div>';
                            echo '  </div>';
                            echo '</div>';
                        }
                    } else {
                        echo '<p>No reviews available.</p>';
                    }
                    ?>
            </div>
        </div>
    </section>

    <?php include 'includes/footer.php' ?>
    
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
