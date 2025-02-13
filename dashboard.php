<?php
session_start(); // Start session
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}
include './includes/header.php';
include './includes/db.php';

// Fetch total parcels
$result = $conn->query("SELECT COUNT(*) AS total_parcels FROM parcels");
$row = $result->fetch_assoc();
$total_parcels = $row['total_parcels'];

// Fetch parcels in transit
$result = $conn->query("SELECT COUNT(*) AS in_transit FROM parcels WHERE status = 'In Transit'");
$row = $result->fetch_assoc();
$in_transit = $row['in_transit'];

// Fetch delivered parcels
$result = $conn->query("SELECT COUNT(*) AS delivered FROM parcels WHERE status = 'Delivered'");
$row = $result->fetch_assoc();
$delivered = $row['delivered'];
?>

<div class="container mt-4">
    <h2 class="mb-4">Shipment Tracker</h2>
    
    <div class="row">
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Parcels</h5>
                    <p class="card-text fs-3"><?php echo $total_parcels; ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title">In Transit</h5>
                    <p class="card-text fs-3"><?php echo $in_transit; ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Delivered</h5>
                    <p class="card-text fs-3"><?php echo $delivered; ?></p>
                </div>
            </div>
        </div>
    </div>

    <a href="add_parcel.php" class="btn btn-primary mt-3">Add New Parcel</a>
    <a href="view_parcels.php" class="btn btn-secondary mt-3">View All Parcels</a>
</div>

<?php include './includes/footer.php'; ?>
