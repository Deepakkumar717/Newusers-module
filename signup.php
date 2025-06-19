 
<?php
$signupSuccess = false;
$errorMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username   = "root";
    $password   = "";
    $dbname     = "user_data";
    $port       = 3307;

    $conn = new mysqli($servername, $username, $password, $dbname, $port);

    if ($conn->connect_error) {
        $errorMessage = "Connection failed: " . $conn->connect_error;
    } else {
        $name     = $conn->real_escape_string(htmlspecialchars(trim($_POST["name"])));
        $email    = $conn->real_escape_string(htmlspecialchars(trim($_POST["email"])));
        $mobile   = $conn->real_escape_string(htmlspecialchars(trim($_POST["mobile"])));
        $address  = $conn->real_escape_string(htmlspecialchars(trim($_POST["address"])));
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

        // Check if email already exists
        $checkEmail = "SELECT * FROM signup WHERE email='$email'";
        $result = $conn->query($checkEmail);
        if ($result && $result->num_rows > 0) {
            $errorMessage = "Email already registered. Please use another email.";
        } else {
            $sql = "INSERT INTO signup (name, email, password, mobile, address)
                    VALUES ('$name', '$email', '$password', '$mobile', '$address')";

            if ($conn->query($sql) === TRUE) {
                header("Location: index.html");
                exit;
            } else {
                $errorMessage = "Error: " . $conn->error;
            }
        }

        $conn->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Signup Form</title>
  <link rel="stylesheet" href="css/signup.css">

</head>
<body>

<div class="left-section">
  <div class="form-container">
    <h2>Create Your Account</h2>

    <form method="POST" action="" onsubmit="return validateForm();">
      <input type="text" name="name" id="name" placeholder="Full Name" required />
      <input type="email" name="email" id="email" placeholder="Email Address" required />
      <input type="password" name="password" id="password" placeholder="Password (min 6 chars)" required />
      <input type="text" name="mobile" id="mobile" placeholder="Mobile Number" maxlength="10" required />
      <textarea name="address" id="address" placeholder="Address" required></textarea>
      <button type="submit">Sign Up</button>

      <?php if (!empty($errorMessage)): ?>
        <div class="message error">
          <strong>Error:</strong><br><?= $errorMessage ?>
        </div>
      <?php endif; ?>
    </form>
  </div>
</div>

<div class="right-section">
  <!-- background visual only -->
</div>

<script>
  function validateForm() {
    const email = document.getElementById('email').value;
    const mobile = document.getElementById('mobile').value;
    const password = document.getElementById('password').value;

    const mobileRegex = /^[6-9]\d{9}$/;
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (!emailRegex.test(email)) {
      alert("Please enter a valid email address.");
      return false;
    }

    if (!mobileRegex.test(mobile)) {
      alert("Enter a valid 10-digit Indian mobile number.");
      return false;
    }

    if (password.length < 6) {
      alert("Password must be at least 6 characters long.");
      return false;
    }

    return true;
  }
</script>

</body>
</html>
