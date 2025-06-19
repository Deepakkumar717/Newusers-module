<?php
include 'db_connect.php';

$result = $conn->query("SELECT * FROM plans");
?>
<h2>All Plans</h2>
<a href="admin_dashboard.php">Add New Plan</a>
<table border='1' cellspacing="0" cellpadding="10">
<tr>
    <th>ID</th><th>Name</th><th>Price</th><th>Validity</th>
    <th>Category</th><th>Image</th><th>Actions</th>
</tr>
<?php while ($row = $result->fetch_assoc()): ?>
<tr>
    <td><?= $row['id'] ?></td>
    <td><?= $row['plan_name'] ?></td>
    <td><?= $row['price'] ?></td>
    <td><?= $row['validity'] ?></td>
    <td><?= $row['category'] ?></td>
    <td><img src="uploads/<?= $row['image'] ?>" width="100"></td>
    <td>
        <a href="admin_dashboard.php?edit_id=<?= $row['id'] ?>">Edit</a> |
        <a href="delete_plan.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure you want to delete this plan?')">Delete</a>
    </td>
</tr>
<?php endwhile; ?>
</table>
