<?php
session_start();
$_SESSION['success_message'] = "Successfully added an account!";
include '../Includes/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $BranchId = $_POST['BranchId'];
    $BranchName = $_POST['BranchName'];
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
    $stmt->bindParam(':BranchName', $BranchName);
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

<!-- External CSS Link -->
<link rel="stylesheet" href="../asset/css/modals.css">

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
            <form action="register.php" method="POST">
                <div class="row mb-3">
                <div class="col-md-6">
                    <label for="branchId" class="form-label">Branch</label>
                    <input type="text" name="Branch" id="branch" class="form-control rounded-pill" required>
                </div>
                <div class="col-md-6">
                    <label for="assetTypeId" class="form-label">Type</label>
                    <input type="text" name="AssetType" id="assetType" class="form-control rounded-pill" required>
                </div>
                </div>

                <div class="row mb-3">
                <div class="col-md-6">
                    <label for="assetName" class="form-label">Brand</label>
                    <input type="text" name="AssetName" id="assetName" class="form-control rounded-pill" required>
                </div>
                <div class="col-md-6">
                    <label for="serialNumber" class="form-label">Serial Number</label>
                    <input type="text" name="SerialNumber" id="serialNumber" class="form-control rounded-pill" required>
                </div>
                </div>

                <div class="row mb-3">
                <div class="col-md-6">
                    <label for="purchasedDate" class="form-label">Purchased Date</label>
                    <input type="date" name="PurchasedDate" id="purchasedDate" class="form-control rounded-pill" required>
                </div>
                <div class="col-md-6">
                    <label for="assetStatus" class="form-label">Status</label>
                    <input type="text" name="AssetStatus" id="assetStatus" class="form-control rounded-pill" required>
                </div>
                </div>

                <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="Description" id="description" class="form-control" rows="3"></textarea>
                </div>

                <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Register Asset</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
            </div>
            </div>
        </div>
        </div>
    </div>