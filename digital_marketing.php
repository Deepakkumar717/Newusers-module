<?php
include "db_connect.php";

$sql = "SELECT * FROM plans WHERE category = 'Digital Marketing'";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Digital Marketing Plans</title>
  <link rel="stylesheet" href="css/styles.css" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      margin: 0;
      background: #f7f7f7;
    }

    header {
      background: #fff;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .header-container {
      display: flex;
      align-items: center;
      justify-content: space-between;
      max-width: 1200px;
      margin: auto;
      padding: 15px 20px;
    }

    .logo {
      height: 50px;
    }

    .nav-links {
      list-style: none;
      display: flex;
      gap: 20px;
      margin: 0;
      padding: 0;
    }

    .nav-links li a {
      text-decoration: none;
      color: #333;
      font-weight: 600;
    }

    .plans {
      max-width: 1200px;
      margin: 50px auto;
      padding: 0 20px;
      text-align: center;
    }

    .plans h2 {
      font-size: 28px;
      margin-bottom: 30px;
    }

    .plan-buttons {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 30px;
    }

    .plan-card {
      background: #fff;
      border-radius: 10px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.05);
      padding: 20px;
      width: 280px;
      text-align: center;
      transition: 0.3s ease;
    }

    .plan-card:hover {
      transform: translateY(-5px);
    }

    .plan-icon {
      width: 100px;
      height: 100px;
      object-fit: cover;
    }

    .plan-card h3 {
      font-size: 20px;
      margin: 15px 0 10px;
    }

    .plan-card p {
      margin: 5px 0;
      font-size: 14px;
      color: #444;
    }

    .subscribe-btn, .details-btn {
      display: inline-block;
      margin-top: 10px;
      padding: 10px 18px;
      background: #007BFF;
      color: #fff;
      border: none;
      border-radius: 6px;
      text-decoration: none;
      font-weight: 600;
      transition: 0.3s;
      cursor: pointer;
    }

    .subscribe-btn:hover,
    .details-btn:hover {
      background: #0056b3;
    }

    footer {
      background: #222;
      color: #ccc;
      text-align: center;
      padding: 20px;
      margin-top: 60px;
    }

    @media (max-width: 768px) {
      .nav-links {
        flex-wrap: wrap;
        gap: 10px;
      }

      .plan-card {
        width: 100%;
      }
    }
  </style>
</head>
<body>

<header>
  <div class="container header-container">
    <img src="images/logo.jpeg" alt="Logo" class="logo" />
    <nav>
      <ul class="nav-links">
        <li><a href="index.php">Home</a></li>
        <li><a href="services.php">Plans & Services</a></li>
        <li><a href="#">Achievements</a></li>
        <li><a href="about.php">About Us</a></li>
        <li><a href="contact.php">Contact Us</a></li>
        <li><a href="signup.php">Account</a></li>
      </ul>
    </nav>
  </div>
</header>

<section class="plans">
  <h2>Digital Marketing Plans</h2>
  <div class="plan-buttons">
    <?php if ($result->num_rows > 0): ?>
      <?php while($row = $result->fetch_assoc()): ?>
        <div class="plan-card">
          <img src="uploads/<?php echo htmlspecialchars($row['image']); ?>" alt="Plan Image" class="plan-icon" />
          <h3><?php echo htmlspecialchars($row['plan_name']); ?></h3>
          <p><strong>Price:</strong> ₹<?php echo htmlspecialchars($row['price']); ?></p>
          <p><strong>Validity:</strong> <?php echo htmlspecialchars($row['validity']); ?></p>
          <a href="package_details.php?plan_id=<?php echo $row['id']; ?>" class="details-btn">Package Details</a>
          <a href="subscribe.php?plan_id=<?php echo $row['id']; ?>" class="subscribe-btn">Subscribe</a>
        </div>
      <?php endwhile; ?>
    <?php else: ?>
      <p>No digital marketing plans found.</p>
    <?php endif; ?>
  </div>
</section>

<footer>
  <p>&copy; 2025 Your Company. All Rights Reserved.</p>
</footer>

</body>
</html>
