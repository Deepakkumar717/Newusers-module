<?php
$host = "crossover.proxy.rlwy.net";
$port = 32488;
$username = "root";
$password = "OHtebhVoTYDpgZgrVwjtJJnBDnAUGScb";
$database = "railway";

// Create connection
$conn = new mysqli($host, $username, $password, $database, $port);

// Check connection
if ($conn->connect_error) {
    die("❌ Connection failed: " . $conn->connect_error);
}
?>