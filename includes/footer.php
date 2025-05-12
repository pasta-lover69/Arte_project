<link rel="stylesheet" href="../assets/navigation">

<footer class="footer">
      <div class="link-box">
       <ul class="quick-links">
        <li class="links"> <a href="./home.php">Home</a></li>
        <li class="links"><a href="./aboutus.php">About us</a></li>
        <li class="links"><a href="#booking-modal">Booking</a></li>
        <li class="links"><a href="./service_details.php">Service</a></li>
        <li class="links"><a href="./check_booking.php">Check Booking</a></li>
        </div>
     
      <div class="media">
        <ul class="media-links">
          <li class="links"><a href="https://www.facebook.com/ArteAestheticandWellness"><i class="ri-facebook-box-fill"></i></a></li>
          <li class="links"><a href="https://www.instagram.com/arteaestheticandwellness/?hl=en"><i class="ri-instagram-fill"></i></a></li>
         
          <li class="links"><a href="mailto:arteaestheticwellnessservices@gmail.com"><i class="ri-mail-line"></i></a></li>
        </ul>
      </div>
      <div class="contacts-box">
        <ul class="contacts">
       
           <li>
            <a href="tel:+(082) 308 1925"> 
              <i class="ri-phone-fill"></i>
               (082) 308 1925</a> 
           </li>
           <li>
            <a href="tel:+ 09675375585"> 
              <i class="ri-smartphone-line"></i>
              09675375585</a> 
           </li>
        </ul>
        </div>
        <button id="back-to-top" onclick="scrollToTop()">↑</button>
  </footer>

<script>
    // JavaScript for Back-to-Top Button
    const backToTopButton = document.getElementById('back-to-top');

    window.addEventListener('scroll', () => {
        if (window.scrollY > 300) {
            backToTopButton.style.display = 'block';
        } else {
            backToTopButton.style.display = 'none';
        }
    });

    function scrollToTop() {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }
</script>

<style>
    /* Back-to-Top Button Styling */
    #back-to-top {
        position: fixed;
        bottom: 20px;
        right: 20px;
        display: none;
        background-color: #987b67;
        color: #fff;
        border: none;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        cursor: pointer;
        font-size: 18px;
    }
</style>