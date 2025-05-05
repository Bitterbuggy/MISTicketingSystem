<?php
session_start();
$_SESSION['success_message'] = "Successfully added an account!";
include '../Includes/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $BranchId = $_POST['BranchId'];
    $AssetName = $_POST['AssetName'];
    $AssetTypeId = $_POST['AssetTypeId'];
    $SerialNumber = $_POST['SerialNumber'];
    $PurchasedDate = $_POST['PurchasedDate']; 
    $AssetStatus = $_POST['AssetStatus'];
    $Description = $_POST['Description'];

    // Prepare the SQL query using PDO
    $sql = "INSERT INTO t_asset (BranchId, AssetName, AssetTypeId, SerialNumber, PurchasedDate, AssetStatus, Description)
            VALUES (:BranchId, :AssetName, :AssetTypeId, :SerialNumber, :PurchasedDate, :AssetStatus, :Description)";

    // Prepare the statement
    $stmt = $conn->prepare($sql);

    // Bind parameters to the SQL query
    $stmt->bindParam(':BranchId', $BranchId);
    $stmt->bindParam(':AssetName', $AssetName);
    $stmt->bindParam(':AssetTypeId', $AssetTypeId);
    $stmt->bindParam(':SerialNumber', $SerialNumber);
    $stmt->bindParam(':PurchasedDate', $PurchasedDate);
    $stmt->bindParam(':AssetStatus', $AssetStatus);
    $stmt->bindParam(':Description', $Description);

    // Execute the statement and check for success
    if ($stmt->execute()) {
        echo "New asset registered successfully!";
    } else {
        echo "Error: Unable to register asset.";
    }
}
?>

<!-- Register Asset Modal -->
    <div class="modal fade" id="registerAssetModal" tabindex="-1" aria-labelledby="registerAssetModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <form action="adminRegisterAsset.php" method="POST">
            <div class="modal-header">
            <h5 class="modal-title" id="registerAssetModalLabel">Register a New Asset</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
            <div class="mb-3">
                <label for="branchId" class="form-label">Branch ID</label>
                <input type="number" class="form-control" name="BranchId" id="branchId" required>
            </div>

            <div class="mb-3">
                <label for="assetName" class="form-label">Asset Name</label>
                <input type="text" class="form-control" name="AssetName" id="assetName" required>
            </div>

            <div class="mb-3">
                <label for="assetTypeId" class="form-label">Asset Type ID</label>
                <input type="number" class="form-control" name="AssetTypeId" id="assetTypeId" required>
            </div>

            <div class="mb-3">
                <label for="serialNumber" class="form-label">Serial Number</label>
                <input type="text" class="form-control" name="SerialNumber" id="serialNumber" required>
            </div>

            <div class="mb-3">
                <label for="purchasedDate" class="form-label">Purchased Date</label>
                <input type="date" class="form-control" name="PurchasedDate" id="purchasedDate" required>
            </div>

            <div class="mb-3">
                <label for="assetStatus" class="form-label">Asset Status</label>
                <input type="text" class="form-control" name="AssetStatus" id="assetStatus" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" name="Description" id="description" rows="3"></textarea>
            </div>
            </div>

            <div class="modal-footer">
            <button type="submit" class="btn btn-success">Register Asset</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </form>
        </div>
    </div>
    </div>