<?php
session_start(); // Start session
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}
include './includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $parcel_id = intval($_POST['parcel_id']);
    $status = $_POST['status'];
    $current_location = trim($_POST['current_location']); // Trim to remove any leading/trailing spaces

    // ✅ Update only the status in the parcels table
    $stmt = $conn->prepare("UPDATE parcels SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $status, $parcel_id);

    if ($stmt->execute()) {
        // ✅ Insert new location only if it's not empty
        if (!empty($current_location)) {
            $location_stmt = $conn->prepare("INSERT INTO parcel_locations (parcel_id, location, updated_at) VALUES (?, ?, NOW())");
            $location_stmt->bind_param("is", $parcel_id, $current_location);
            $location_stmt->execute();
            $location_stmt->close();
        }

        echo "<script>alert('Parcel updated successfully!'); window.location.href='view_parcels.php';</script>";
    } else {
        echo "<script>alert('Error updating parcel!'); window.history.back();</script>";
    }

    $stmt->close();
}

$conn->close();
?>
