<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_data";
$port = 3307;

$conn = new mysqli($servername, $username, $password, $dbname, $port);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM plans WHERE category = 'Website'";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Website Plans</title>
  <link rel="stylesheet" href="css/styles.css" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    /* Same styles as before... */
    .details-link {
      margin-top: 10px;
      display: inline-block;
      padding: 10px 18px;
      background: #28a745;
      color: #fff;
      text-decoration: none;
      border-radius: 6px;
      font-weight: 600;
    }

    .details-link:hover {
      background: #1e7e34;
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
  <h2>Website Design Plans</h2>
  <div class="plan-buttons">
    <?php if ($result->num_rows > 0): ?>
      <?php while($row = $result->fetch_assoc()): ?>
        <div class="plan-card">
          <img src="uploads/<?php echo htmlspecialchars($row['image']); ?>" alt="Plan Image" class="plan-icon" />
          <h3><?php echo htmlspecialchars($row['plan_name']); ?></h3>
          <p><strong>Price:</strong> ₹<?php echo htmlspecialchars($row['price']); ?></p>
          <p><strong>Validity:</strong> <?php echo htmlspecialchars($row['validity']); ?></p>

          <a href="package_details.php?plan_id=<?= $row['id'] ?>" class="details-link">Package Details</a><br>
          <a href="subscribe.php?plan_id=<?= $row['id'] ?>" class="subscribe-btn">Subscribe</a>
        </div>
      <?php endwhile; ?>
    <?php else: ?>
      <p>No website plans found.</p>
    <?php endif; ?>
  </div>
</section>

<footer>
  <p>&copy; 2025 Your Company. All Rights Reserved.</p>
</footer>

</body>
</html>
