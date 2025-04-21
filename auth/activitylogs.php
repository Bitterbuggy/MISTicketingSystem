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
    <title>Activity Logs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
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
