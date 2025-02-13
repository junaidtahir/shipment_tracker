<?php
include './includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $location_id = intval($_POST['location_id']);
    $delivered = intval($_POST['delivered']);

    // ✅ Update delivered status
    $stmt = $conn->prepare("UPDATE parcel_locations SET delivered = ? WHERE id = ?");
    $stmt->bind_param("ii", $delivered, $location_id);

    if ($stmt->execute()) {
        echo "<script>alert('Location updated successfully!'); window.history.back();</script>";
    } else {
        echo "<script>alert('Error updating location!'); window.history.back();</script>";
    }

    $stmt->close();
}

$conn->close();
?>
