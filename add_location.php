<?php
session_start(); // Start session
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}
include './includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $parcel_id = $_POST['parcel_id'];
    $location = $_POST['location'];

    if (!empty($parcel_id) && !empty($location)) {
        $stmt = $conn->prepare("INSERT INTO parcel_locations (parcel_id, location, updated_at) VALUES (?, ?, NOW())");
        $stmt->bind_param("is", $parcel_id, $location);
        if ($stmt->execute()) {
            echo "<script>alert('Location added successfully!'); window.location.href='view_parcels.php';</script>";
        } else {
            echo "<script>alert('Error adding location!'); window.history.back();</script>";
        }

        $stmt->close();
    }
}

$conn->close();
