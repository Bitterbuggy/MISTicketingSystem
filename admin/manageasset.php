<?php
include '../Includes/config.php';



// Fetch the assets with branch name
$sql = "SELECT 
            t_branch.BranchName,
            t_asset.AssetName,
            t_assettype.AssetTypeName,
            t_asset.SerialNumber,
            t_asset.PurchasedDate,
            t_asset.AssetStatus,
            t_asset.Description
        FROM 
            t_asset
        JOIN 
            t_branch ON t_asset.BranchId = t_branch.BranchId
        JOIN
            t_assettype ON t_asset.AssetTypeId = t_assettype.AssetTypeId";

$stmt = $conn->prepare($sql);
$stmt->execute();
$assets = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QCPL STS - Dashboard</title>
    <link rel="icon" type="image/x-icon" href="../asset/img/qcpl-sts-logo.png">

    <!-- External CSS Link/s -->
    <link rel ="stylesheet" href="../asset/css/admin-sidebar.css">
    <link rel="stylesheet" href="../asset/css/admin-dashboard.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap 5 JS Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Font Awesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
         .table {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .table th, .table td {
            text-align: center;
            padding: 12px 15px;
            vertical-align: middle;
        }
        .table thead {
            background-color: #343a40;
            color: white;
        }
        .table tbody tr:nth-child(odd) {
            background-color: #f1f1f1;
        }
        .table tbody tr:hover {
            background-color: #e9ecef;
            cursor: pointer;
        }
        h2 {
            font-size: 2rem;
            font-weight: 600;
            color: #333;
        }
    </style>
</head>

<body style="background-color: #f3f2f7;">
    <div class="d-flex">
        <!-- Include Sidebar -->
        <?php include '../admin/inc/admin-sidebar.php'; ?>

         <!-- Wrapper for Header + Main -->
         <div class="main-wrapper w-100" style="margin-left: 80px; margin-top: 30px;">

<!-- Main Content (separate from header) -->
<main class="px-4 py-5">
            <div class="main-content" style="margin-left: 260px; padding: 20px;">
            <div class="SubNavbar">
            <ul>
                <li> <a href="../admin/registerasset.php"> Add New Asset </a></li>
            
            </ul>
        </div>

                <h2 class="mt-4">View Assets</h2>

                <!-- Table for displaying assets -->
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Branch Name</th>
                            <th>Asset Name</th>
                            <th>Asset Type Name</th>
                            <th>Serial Number</th>
                            <th>Purchased Date</th>
                            <th>Asset Status</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($assets as $asset): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($asset['BranchName']); ?></td>
                                <td><?php echo htmlspecialchars($asset['AssetName']); ?></td>
                                <td><?php echo htmlspecialchars($asset['AssetTypeName']); ?></td>
                                <td><?php echo htmlspecialchars($asset['SerialNumber']); ?></td>
                                <td><?php echo htmlspecialchars($asset['PurchasedDate']); ?></td>
                                <td><?php echo htmlspecialchars($asset['AssetStatus']); ?></td>
                                <td><?php echo htmlspecialchars($asset['Description']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>