<?php
session_start(); // Start session
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}
include './includes/db.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Invalid Parcel ID.");
}

$parcel_id = $_GET['id'];

// Delete the parcel
$stmt = $conn->prepare("DELETE FROM parcels WHERE id = ?");
$stmt->bind_param("i", $parcel_id);

if ($stmt->execute()) {
    header("Location: view_parcels.php?success=Parcel deleted successfully!");
    exit;
} else {
    echo "<div class='alert alert-danger'>Error deleting parcel.</div>";
}
?>
