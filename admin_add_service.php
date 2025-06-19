<?php
include "db_connect.php";

// --- DELETE SERVICE ---
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);

    // Delete associated image
    $imgQuery = $conn->query("SELECT image FROM services WHERE id=$id");
    if ($img = $imgQuery->fetch_assoc()) {
        if (file_exists($img['image'])) {
            unlink($img['image']);
        }
    }

    // Delete service from DB
    $conn->query("DELETE FROM services WHERE id=$id");
    header("Location: admin_add_service.php"); // Refresh the page
    exit;
}

// --- ADD NEW SERVICE ---
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $price = $_POST['price'];
    $description = $conn->real_escape_string($_POST['description']);
    $addons = $conn->real_escape_string($_POST['addons']);

    // Handle image upload
    $imageName = $_FILES['image']['name'];
    $targetDir = "uploads/";
    $imagePath = $targetDir . basename($imageName);

    if (move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
        $sql = "INSERT INTO services (name, price, description, addons, image)
                VALUES ('$name', '$price', '$description', '$addons', '$imagePath')";

        if ($conn->query($sql)) {
            echo "<p style='color: green;'>Service added successfully!</p>";
        } else {
            echo "<p style='color: red;'>Database error: " . $conn->error . "</p>";
        }
    } else {
        echo "<p style='color: red;'>Image upload failed.</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Admin - Add Services</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      padding: 20px;
    }
    form {
      margin-bottom: 30px;
      border: 1px solid #ccc;
      padding: 20px;
      border-radius: 10px;
      max-width: 500px;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 30px;
    }
    th, td {
      padding: 10px;
      border: 1px solid #ccc;
    }
    img {
      width: 60px;
    }
    .delete-link {
      color: red;
      text-decoration: none;
    }
    .delete-link:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <h2>Add New Service</h2>
  <form method="POST" enctype="multipart/form-data">
    <label>Service Name:</label><br>
    <input name="name" required><br><br>

    <label>Price (₹):</label><br>
    <input name="price" type="number" step="0.01" required><br><br>

    <label>Description (1 point per line):</label><br>
    <textarea name="description" rows="5" cols="40" required></textarea><br><br>

    <label>Add-ons:</label><br>
    <textarea name="addons" rows="3" cols="40"></textarea><br><br>

    <label>Upload Image:</label><br>
    <input type="file" name="image" accept="image/*" required><br><br>

    <button type="submit">Add Service</button>
  </form>

  <hr>
  <h2>All Added Services</h2>
  <table>
    <tr>
      <th>ID</th>
      <th>Image</th>
      <th>Name</th>
      <th>Price</th>
      <th>Description</th>
      <th>Add-ons</th>
      <th>Action</th>
    </tr>
    <?php
    $services = $conn->query("SELECT * FROM services");

    while ($row = $services->fetch_assoc()):
    ?>
    <tr>
      <td><?= $row['id'] ?></td>
      <td><img src="<?= $row['image'] ?>" alt="<?= $row['name'] ?>"></td>
      <td><?= htmlspecialchars($row['name']) ?></td>
      <td>₹<?= $row['price'] ?></td>
      <td><pre><?= htmlspecialchars($row['description']) ?></pre></td>
      <td><pre><?= htmlspecialchars($row['addons']) ?></pre></td>
      <td>
        <a class="delete-link" href="?delete=<?= $row['id'] ?>" onclick="return confirm('Delete this service?')">🗑 Delete</a>
      </td>
    </tr>
    <?php endwhile; ?>
  </table>
</body>
</html>
