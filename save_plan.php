<?php
include 'db_connect.php';

$plan_name = $_POST['plan_name'];
$price = $_POST['price'];
$validity = $_POST['validity'];
$category = $_POST['category'];
$image = $_FILES['image']['name'] ?? '';
$image_path = '';

if (!empty($image)) {
    $image_path = 'uploads/' . basename($image);
    move_uploaded_file($_FILES['image']['tmp_name'], $image_path);
}

if (isset($_POST['plan_id'])) {
    // Update
    $id = $_POST['plan_id'];
    if ($image) {
        $query = "UPDATE plans SET plan_name=?, price=?, validity=?, category=?, image=? WHERE id=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sdsssi", $plan_name, $price, $validity, $category, $image, $id);
    } else {
        $query = "UPDATE plans SET plan_name=?, price=?, validity=?, category=? WHERE id=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sdssi", $plan_name, $price, $validity, $category, $id);
    }
} else {
    // Insert
    $query = "INSERT INTO plans (plan_name, price, validity, category, image) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sdsss", $plan_name, $price, $validity, $category, $image);
}

$stmt->execute();
header("Location: view_plans.php");
exit;
