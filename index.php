<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>My Dashboard</title>
  <link rel="stylesheet" href="css/styles.css" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
  <style>
    /* Sidebar Styles */
    .sidebar {
      position: fixed;
      top: 0;
      left: -250px;
      width: 220px;
      height: 100%;
      background-color: #101d42;
      padding-top: 60px;
      transition: 0.3s ease;
      z-index: 999;
    }

    .sidebar.active {
      left: 0;
    }

    .sidebar a {
      display: block;
      color: white;
      padding: 12px 20px;
      text-decoration: none;
      font-weight: 600;
    }

    .sidebar a:hover {
      background-color: #00bcd4;
      color: #101d42;
    }

    .sidebar-close {
      position: absolute;
      top: 10px;
      right: 15px;
      font-size: 28px;
      background: none;
      color: white;
      border: none;
      cursor: pointer;
    }

    .hamburger {
      display: none;
      font-size: 28px;
      background: none;
      border: none;
      color: white;
      cursor: pointer;
    }

    @media (max-width: 768px) {
      .nav-links {
        display: none;
      }

      .hamburger {
        display: block;
        position: absolute;
        top: 15px;
        left: 15px;
        z-index: 1000;
      }
    }

    /* Optional: To ensure slider content isn't hidden behind sidebar */
    .slides {
      display: flex;
      transition: transform 0.5s ease-in-out;
      width: 100%;
      overflow: hidden;
    }

    .slide-img {
      width: 100%;
      max-height: 400px;
      object-fit: contain;
    }
  </style>
</head>
<body>

  <!-- Sidebar -->
  <div class="sidebar" id="sidebar">
    <button class="sidebar-close" onclick="toggleSidebar()">&times;</button>
    <a href="index.php">Home</a>
    <a href="services.php">Plans & Services</a>
    <a href="achievement.php">Achievements</a>
    <a href="about.php">About Us</a>
    <a href="contact.php">Contact Us</a>
    <a href="signup.php">Account</a>
  </div>

  <!-- Header -->
  <header>
    <div class="container header-container">
      <button class="hamburger" onclick="toggleSidebar()">&#9776;</button>
      <img src="images/logo.jpeg" alt="Logo" class="logo" />
      <nav>
        <ul class="nav-links">
          <li><a href="index.php">Home</a></li>
          <li><a href="services.php">Plans & Services</a></li>
          <li><a href="achievement.php">Achievements</a></li>
          <li><a href="about.php">About Us</a></li>
          <li><a href="contact.php">Contact Us</a></li>
          <li><a href="signup.php">Account</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <!-- Banner Slider -->
  <section class="slider">
    <button class="arrow left" id="prev">&#10094;</button>
    <div class="slides" id="slides">
      <img src="images/banner0.png" alt="Banner 1" class="slide-img" />
      <img src="images/banner2.png" alt="Banner 2" class="slide-img" />
      <img src="banner3.jpg" alt="Banner 3" class="slide-img" />
      <img src="banner4.jpg" alt="Banner 4" class="slide-img" />
    </div>
    <button class="arrow right" id="next">&#10095;</button>
  </section>

  <!-- Plans Section -->
  <section class="plans">
    <h2>Plans</h2>
    <div class="plan-buttons">
      <div class="plan-card" onclick="location.href='website_plans.php'">
        <img src="https://img.icons8.com/color/96/000000/domain.png" alt="Website Design" class="plan-icon" />
        <p>Website Design</p>
      </div>
      <div class="plan-card"onclick="location.href='mobile_app.php'">
        <img src="https://img.icons8.com/color/96/000000/android-os.png" alt="Mobile App Development" class="plan-icon" />
        <p>Mobile App Development</p>
      </div>
      <div class="plan-card" onclick="location.href='digital_marketing.php'">
        <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="Digital Marketing" class="plan-icon" />
        <p>Digital Marketing</p>
      </div>
      <div class="plan-card">
        <img src="https://img.icons8.com/color/96/000000/shopping-cart.png" alt="E-Commerce Solutions" class="plan-icon" />
        <p>E-Commerce Solutions</p>
      </div>
      <div class="plan-card">
        <img src="https://cdn-icons-png.flaticon.com/512/2910/2910791.png" alt="SEO Services" class="plan-icon" />
        <p>SEO Services</p>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer>
    <p>&copy; 2025 Your Company. All Rights Reserved.</p>
  </footer>

  <script>
    // Slider functionality
    const slides = document.getElementById('slides');
    const images = document.querySelectorAll('.slide-img');
    const totalSlides = images.length;
    let index = 0;
    let interval = setInterval(nextSlide, 5000);

    function showSlide(i) {
      slides.style.transform = `translateX(-${i * 100}%)`;
    }

    function nextSlide() {
      index = (index + 1) % totalSlides;
      showSlide(index);
    }

    function prevSlide() {
      index = (index - 1 + totalSlides) % totalSlides;
      showSlide(index);
    }

    document.getElementById('next').onclick = () => {
      nextSlide();
      resetInterval();
    };
    document.getElementById('prev').onclick = () => {
      prevSlide();
      resetInterval();
    };

    function resetInterval() {
      clearInterval(interval);
      interval = setInterval(nextSlide, 5000);
    }

    // Responsive image fit
    images.forEach(img => {
      img.onload = () => {
        img.style.objectFit = 'contain';
      };
    });

    // Sidebar toggle
    function toggleSidebar() {
      document.getElementById('sidebar').classList.toggle('active');
    }
  </script>

</body>
</html>
