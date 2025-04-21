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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QCPL STS - Dashboard</title>
    <link rel="icon" type="image/x-icon" href="../asset/img/qcpl-logo.png">

    <!-- CSS Link/s -->
    <link rel="stylesheet" href="../asset/css/sidenavbar_admin.css">

    <!-- Bootstrap CSS -->
    <link href="../../vendor/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body style="background-color: #f3f2f7;">
    <div class="d-flex">
        <!-- Include Sidebar -->
        <?php include '../admin/inc/admin-sidebar.php'; ?>

        <!-- Main Content -->
        <div class="container-fluid p-0 cont" id="body">
            <nav class="navbar sticky-top">
                <div class="row no-gutters">
                    <div class="col-1">
                        <button type="button" class="toggler-btn">
                            <i class="fa-solid fa-align-justify"></i>
                        </button>
                    </div>
                </div>
            </nav>

            <!-- Main Content Container -->
            <div class="main-content" style="margin-left: 260px; padding: 20px;">
                <h2>Welcome, <?php echo $_SESSION['FirstName']; ?>!</h2>
                <p> Add an asset.</p>
                <br>
                
                <h2>Register a New Asset</h2>
                <form action="registerasset.php" method="POST">
                    <label for="branchId">Branch ID:</label>
                    <input type="number" name="BranchId" id="branchId" required><br><br>

                    <label for="assetName">Asset Name:</label>
                    <input type="text" name="AssetName" id="assetName" required><br><br>

                    <label for="assetTypeId">Asset Type ID:</label>
                    <input type="number" name="AssetTypeId" id="assetTypeId" required><br><br>

                    <label for="serialNumber">Serial Number:</label>
                    <input type="text" name="SerialNumber" id="serialNumber" required><br><br>

                    <label for="purchasedDate">Purchased Date:</label>
                    <input type="date" name="PurchasedDate" id="purchasedDate" required><br><br>

                    <label for="assetStatus">Asset Status:</label>
                    <input type="text" name="AssetStatus" id="assetStatus" required><br><br>

                    <label for="description">Description:</label>
                    <textarea name="Description" id="description"></textarea><br><br>

                    <button type="submit">Register Asset</button>
                    <a href="../admin/manageasset.php"> Back </a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>