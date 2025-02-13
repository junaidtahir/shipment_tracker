<?php
$host = "localhost";  // Change if using a different host
$user = "root";       // Database username
$pass = "";           // Database password (set it if needed)
$dbname = "shipment_tracker_db";  // Database name

// Create connection
$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

