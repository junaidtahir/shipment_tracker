<?php
session_start(); // Start session
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}
include './includes/header.php';
include './includes/db.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Parcel ID is missing.");
}

$parcel_id = intval($_GET['id']); // Ensure it's an integer

// Fetch parcel details
$parcel_query = $conn->prepare("SELECT * FROM parcels WHERE id = ?");
$parcel_query->bind_param("i", $parcel_id);
$parcel_query->execute();
$parcel_result = $parcel_query->get_result();
$parcel = $parcel_result->fetch_assoc();

if (!$parcel) {
    die("Parcel not found.");
}
 
// Fetch all locations for this parcel
$location_query = $conn->prepare("SELECT id, location, updated_at, delivered FROM parcel_locations WHERE parcel_id = ? ORDER BY updated_at ASC");
$location_query->bind_param("i", $parcel_id);
$location_query->execute();
$locations_result = $location_query->get_result();
?>
<div class="container mt-4">
    <h2>Update Parcel</h2>

    <form method="POST" action="process_update_parcel.php">
        <input type="hidden" name="parcel_id" value="<?php echo $parcel_id; ?>">

        <!-- Parcel Number -->
        <div class="mb-3">
            <label class="form-label">Tracking Id:</label>
            <input type="text" class="form-control" value="<?php echo htmlspecialchars($parcel['tracking_id'] ?? 'Not Available'); ?>" disabled>
        </div>

        <!-- Current Status -->
        <div class="mb-3">
            <label class="form-label">Current Status:</label>
            <select name="status" class="form-control" required>
                <option value="In Transit" <?php echo ($parcel['status'] == 'In Transit') ? 'selected' : ''; ?>>In Transit</option>
                <option value="Delivered" <?php echo ($parcel['status'] == 'Delivered') ? 'selected' : ''; ?>>Delivered</option>
                <option value="Pending" <?php echo ($parcel['status'] == 'Pending') ? 'selected' : ''; ?>>Pending</option>
            </select>
        </div>

        <!-- Current Location -->
        <div class="mb-3">
            <label class="form-label">Add Location:</label>
            <input type="text" name="current_location" class="form-control" value=""  >
        </div>

        <button type="submit" class="btn btn-success">Update Parcel</button>
    </form>

    <!-- Parcel Locations Table -->
    <h3 class="mt-4">Parcel Locations</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Location</th>
                <th>Updated At</th>
                <th>Delivered</th>
             </tr>
        </thead>
        <tbody>
            <?php while ($location = $locations_result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($location['location']); ?></td>
                    <td><?php echo htmlspecialchars($location['updated_at']); ?></td>
                    <td>
                        <form action="update_location_status.php" method="POST">
                            <input type="hidden" name="location_id" value="  <?php echo htmlspecialchars($location['id']); ?> ">
                            <select name="delivered" class="form-control">
                                <option value="0" <?php echo (isset($location['delivered']) && $location['delivered'] == 0) ? 'selected' : ''; ?>>Not Delivered</option>
                                <option value="1" <?php echo (isset($location['delivered']) && $location['delivered'] == 1) ? 'selected' : ''; ?>>Delivered</option>
                            </select>
                            <button type="submit" class="btn btn-sm btn-primary mt-1">Update</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

</div>

<?php include './includes/footer.php'; ?>
