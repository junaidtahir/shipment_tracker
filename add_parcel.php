<?php
session_start(); // Start session
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}
include './includes/header.php';
include './includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tracking_id = $_POST['tracking_id']; // Updated from parcel_no
    $sender_name = $_POST['sender_name'];
    $sender_phone = $_POST['sender_phone'];
    $sender_country = $_POST['sender_country'];
    $sender_address = $_POST['sender_address'];
    $receiver_name = $_POST['receiver_name'];
    $receiver_phone = $_POST['receiver_phone'];
    $receiver_country = $_POST['receiver_country'];
    $receiver_address = $_POST['receiver_address'];
    $mode_of_transport = $_POST['mode_of_transport'];
    $sent_date = $_POST['sent_date'];
    $arrival_date = $_POST['arrival_date']; // New field added
    $estimated_time = $_POST['estimated_time']; // New field added
    $status = "In Transit"; // Default status

    $stmt = $conn->prepare("INSERT INTO parcels (tracking_id, sender_name, sender_phone, sender_country, sender_address, receiver_name, receiver_phone, receiver_country, receiver_address, mode_of_transport, sent_date, arrival_date, estimated_time, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssssssssss", $tracking_id, $sender_name, $sender_phone, $sender_country, $sender_address, $receiver_name, $receiver_phone, $receiver_country, $receiver_address, $mode_of_transport, $sent_date, $arrival_date, $estimated_time, $status);

    if ($stmt->execute()) {
        echo "<div class='alert alert-success'>Parcel added successfully!</div>";
    } else {
        echo "<div class='alert alert-danger'>Error adding parcel.</div>";
    }

    $stmt->close();
}
?>

<div class="container mt-4">
    <h2 class="mb-4">Add New Parcel</h2>
    <form method="POST" action="">
        <div class="row">
            <div class="col-md-6">
                <h4>Sender's Information</h4>
                <div class="mb-3">
                    <label class="form-label">Full Name</label>
                    <input type="text" class="form-control" name="sender_name" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Phone Number</label>
                    <input type="text" class="form-control" name="sender_phone" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Country</label>
                    <input type="text" class="form-control" name="sender_country" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Address</label>
                    <textarea class="form-control" name="sender_address" required></textarea>
                </div>
            </div>

            <div class="col-md-6">
                <h4>Receiver's Information</h4>
                <div class="mb-3">
                    <label class="form-label">Full Name</label>
                    <input type="text" class="form-control" name="receiver_name" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Phone Number</label>
                    <input type="text" class="form-control" name="receiver_phone" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Country</label>
                    <input type="text" class="form-control" name="receiver_country" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Address</label>
                    <textarea class="form-control" name="receiver_address" required></textarea>
                </div>
            </div>
        </div>

        <h4>Consignment Details</h4>
        <div class="mb-3">
            <label class="form-label">Tracking ID</label>
            <input type="text" class="form-control" name="tracking_id" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Mode of Transport</label>
            <select class="form-control" name="mode_of_transport" required>
                <option value="Air Freight">Air Freight</option>
                <option value="Sea Freight">Sea Freight</option>
                <option value="Road Freight">Road Freight</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Sent Date</label>
            <input type="date" class="form-control" name="sent_date" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Arrival Date</label>
            <input type="date" class="form-control" name="arrival_date" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Estimated Time of Arrival</label>
            <input type="text" class="form-control" name="estimated_time" required>
        </div>

        <button type="submit" class="btn btn-primary">Add Parcel</button>
    </form>
</div>

<?php include './includes/footer.php'; ?>