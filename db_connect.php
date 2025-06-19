<?php
$servername = "localhost";
$username = "root";
$password = ""; // change if you set root password
$dbname = "user_data";
$port = 3307;

$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
