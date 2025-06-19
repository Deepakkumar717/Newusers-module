<?php
include "db_connect.php";
$result = $conn->query("SELECT * FROM contact ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html>
<head>
  <title>Admin - Contact Entries</title>
  <style>
    body { font-family: Arial; padding: 20px; background: #f2f2f2; }
    h2 { text-align: center; }
    table {
      border-collapse: collapse;
      width: 100%;
      background: white;
      margin-top: 20px;
    }
    th, td {
      padding: 12px;
      border: 1px solid #ccc;
      text-align: left;
    }
    th { background: #007BFF; color: white; }
  </style>
</head>
<body>
  <h2>All Contact Enquiries</h2>
  <table>
    <tr>
      <th>#</th>
      <th>Name</th>
      <th>Mobile</th>
      <th>Location</th>
      <th>Email</th>
      <th>Date</th>
    </tr>
    <?php $i = 1; while ($row = $result->fetch_assoc()): ?>
    <tr>
      <td><?= $i++ ?></td>
      <td><?= htmlspecialchars($row['name']) ?></td>
      <td><?= htmlspecialchars($row['mobile']) ?></td>
      <td><?= htmlspecialchars($row['location']) ?></td>
      <td><?= htmlspecialchars($row['email']) ?></td>
      <td><?= $row['created_at'] ?></td>
    </tr>
    <?php endwhile; ?>
  </table>
</body>
</html>
