<?php
include 'db_connect.php';

$id = $_GET['id'] ?? 0;

if ($id) {
    $stmt = $conn->prepare("DELETE FROM plans WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}

header("Location: view_plans.php");
exit;
