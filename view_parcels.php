<?php
session_start(); // Start session
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}
include './includes/header.php';
include './includes/db.php';

// Fetch all parcels from the database
$result = $conn->query("SELECT * FROM parcels ORDER BY id DESC");
?>

<div class="container mt-4">
    <h2 class="mb-4">All Parcels</h2>
    
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Tracking ID</th> <!-- ✅ Changed from Parcel No to Tracking ID -->
                <th>Sender</th>
                <th>Receiver</th>
                <th>Transport Mode</th>
                <th>Sent Date</th>
                <th>Status</th>
                <th>Location</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) { $parcel_id = $row['id'];?>
                <tr>
                    <td><?php echo htmlspecialchars($row['tracking_id']); ?></td>
                    <td><?php echo htmlspecialchars($row['sender_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['receiver_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['mode_of_transport']); ?></td>
                    <td><?php echo htmlspecialchars($row['sent_date']); ?></td>
                    <td>
                        <span class="badge bg-<?php echo ($row['status'] == 'Delivered') ? 'success' : 'warning'; ?>">
                            <?php echo htmlspecialchars($row['status']); ?>
                        </span>
                    </td>
                    <td>
                    <?php
                        $location_result = $conn->query("SELECT location FROM parcel_locations WHERE parcel_id = $parcel_id ORDER BY updated_at ASC");
                        $locations = [];
                        while ($loc = $location_result->fetch_assoc()) {
                            $locations[] = htmlspecialchars($loc['location']);
                        }
                        echo !empty($locations) ? implode(', ', $locations) : 'Not Available';
                    ?>
                </td>

                <td>
                    <a href="update_parcel.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-primary">Update</a>
                    <a href="delete_parcel.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?');">Delete</a>
                    <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#addLocationModal" onclick="setParcelId(<?php echo $row['id']; ?>)">
                        Add Location
                    </button>
                </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <a href="add_parcel.php" class="btn btn-success mt-3">Add New Parcel</a>
</div>





<!-- Modal -->
<div class="modal fade" id="addLocationModal" tabindex="-1" aria-labelledby="addLocationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addLocationModalLabel">Add Parcel Location</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="locationForm" method="POST" action="add_location.php">
                    <input type="hidden" name="parcel_id" id="parcel_id" value="">
                    
                    <div class="mb-3">
                        <label for="location" class="form-label">New Location</label>
                        <input type="text" class="form-control" id="location" name="location" required>
                    </div>

                    <button type="submit" class="btn btn-success">Save Location</button>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    function setParcelId(parcelId) {
        document.getElementById('parcel_id').value = parcelId;
    }
</script>


<?php include './includes/footer.php'; ?>
