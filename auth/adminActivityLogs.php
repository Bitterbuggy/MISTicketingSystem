<?php
session_start();
include '../Includes/config.php';

if (!isset($_SESSION['UserId']) || !isset($_SESSION['RoleId'])) {
    header('Location: ../login.php');
    exit();
}

$userId = $_SESSION['UserId'];
$roleId = $_SESSION['RoleId'];
$firstName = $_SESSION['FirstName'];

if ($roleId == 1) {
    // Admin sees all logs
    $sql = "SELECT al.id, u.FirstName, al.activity_type, al.activity_time 
            FROM t_activitylogs al
            JOIN t_users u ON al.UserId = u.UserId
            ORDER BY al.activity_time DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
} else {
    // Other users (IT staff, regular users, etc.) see their own logs
    $sql = "SELECT al.id, al.activity_type, al.activity_time 
            FROM t_activitylogs al
            WHERE al.UserId = :UserId
            ORDER BY al.activity_time DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['UserId' => $userId]);
}

$logs = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Redirect link based on role
$redirectLink = match ($roleId) {
    1 => '../admin/admindashboard.php',
    2 => '../branchadmin/bradmindashboard.php',
    3 => '../ITstaff/ITdashboard.php',
    default => '../home.php',
};
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QCPL STS - Branch Management</title>
    <link rel="icon" type="image/x-icon" href="../asset/img/qcpl-sts-logo.png">

    <!-- External CSS Link/s -->
    <link rel ="stylesheet" href="../asset/css/admin-sidebar.css">
    <link rel ="stylesheet" href="../asset/css/admin-branch-mgmt.css">
    <link rel ="stylesheet" href="../asset/css/pagination.css">
    <link rel ="stylesheet" href="../asset/css/modals.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap 5 JS Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Font Awesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- External JS Files -->
    <script src="../asset/js/adminSidebar.js"></script>

</head>
<body>
    <div class="container">
        <a href="<?= $redirectLink ?>" class="btn btn-primary mb-4"><i class="fa fa-arrow-left"></i> Back</a>
        <h2 class="mb-4"><?= $roleId == 1 ? "All User Activity Logs" : "$firstName's Activity Logs" ?></h2>

        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <?php if ($roleId == 1): ?>
                            <th>User</th>
                        <?php endif; ?>
                        <th>Activity</th>
                        <th>Timestamp</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($logs) > 0): ?>
                        <?php foreach ($logs as $log): ?>
                            <tr>
                                <?php if ($roleId == 1): ?>
                                    <td><?= htmlspecialchars($log['FirstName']) ?></td>
                                <?php endif; ?>
                                <td><?= htmlspecialchars($log['activity_type']) ?></td>
                                <td><?= htmlspecialchars($log['activity_time']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="<?= $roleId == 1 ? 3 : 2 ?>" class="text-center">No activity logs found.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <a href="<?= $redirectLink ?>" class="btn btn-secondary mt-3">Back to Dashboard</a>
    </div>
</body>
</html>
