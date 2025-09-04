<script>
  var pageTitle = "Ticket Management";
</script>

<?php

include '../Includes/config.php';
include '../Includes/check_session.php';

$sql = "SELECT
    t_tickets.TicketId,
    MIN(t_tickets.TimeSubmitted) as TimeSubmitted,
    t_branch.BranchName,
    GROUP_CONCAT(t_issuedtype.IssueType SEPARATOR ', ') as Issues,
        CONCAT(emp_user.FirstName, ' ', emp_user.LastName) AS EmployeeName,
    CONCAT(t_users.FirstName, ' ', t_users.LastName) AS AssignedStaffName,
    t_tickets.TicketStatus,
    t_tickets.TimeResolved,
    t_tickets.Resolution
FROM t_ticketissues
JOIN t_tickets ON t_ticketissues.TicketId = t_tickets.TicketId
JOIN t_branch ON t_tickets.BranchId = t_branch.BranchId
JOIN t_issuedtype ON t_ticketissues.IssueId = t_issuedtype.IssueId
LEFT JOIN t_users ON t_tickets.AssignedITstaffId = t_users.UserId
LEFT JOIN t_useremp ON t_tickets.EmployeeId = t_useremp.EmployeeId
LEFT JOIN t_users AS emp_user ON t_useremp.UserId = emp_user.UserId

GROUP BY t_tickets.TicketId, t_branch.BranchName, AssignedStaffName, t_tickets.TicketStatus, t_tickets.TimeResolved, t_tickets.Resolution
ORDER BY TimeSubmitted ASC;";


$stmt = $conn->prepare($sql);
$stmt->execute();
$tickets = $stmt->fetchAll(PDO::FETCH_ASSOC);


$pendingCount = 0;
$ongoingCount = 0;
$completedCount = 0;

foreach ($tickets as $ticket) {
    switch (strtolower($ticket['TicketStatus'])) {
        case 'pending':
            $pendingCount++;
            break;
        case 'ongoing':
            $ongoingCount++;
            break;
        case 'completed':
            $completedCount++;
            break;
    }
}

$totalCount = count($tickets);


if ($_SESSION['RoleId'] != 1) {
    header('Location: ../employee/home.php');
    exit();
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QCPL STS - Ticket Management</title>
    <link rel="icon" type="image/x-icon" href="../asset/img/qcpl-sts-logo.png">

    <!-- External CSS Link/s -->
    <link rel ="stylesheet" href="../asset/css/sidebar.css">
    <link rel ="stylesheet" href="../asset/css/admin-ticket-mgmt.css">
    <link rel ="stylesheet" href="../asset/css/pagination.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap 5 JS Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Font Awesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Custom JS Link/s -->
    <script src="../asset/js/adminNavTables.js"></script>
    <script src="../asset/js/sidebar.js"></script>
    <script src="../asset/js/adminAllTickets.js"></script>
</head>

<body>
    <div class="layout-container d-flex">
        <!-- Sidebar and Header -->
        <?php include '../admin/inc/sidebar.php'; ?>

        <!-- Wrapper for Header + Main -->
        <div class="main-wrapper w-100" style="margin-left: 80px; margin-top: 30px;">
            <!-- Main Content -->
            <main class="px-4 py-5">
            <div class="col-12">
            <div class="container-fluid tixmgmt-nav">
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mt-2">
                    <!-- Tabs Section -->
                    <div class="d-flex flex-wrap gap-2">
                        <div class="div-mods active" onclick="window.location.href='adminTicketMgmt.php'">
                            <span class="mods">Repair Requests</span>
                        </div>
                        <div class="div-mods inactive" onclick="window.location.href='adminCompletedTickets.php'">
                            <span class="mods">All Tickets</span>
                        </div>
                      
                    </div>

                    <!-- Controls Section -->
                    <div class="d-flex flex-wrap flex-lg-nowrap align-items-center gap-2">
                        <!-- Search -->
                        <div class="input-group" style="max-width: 280px;">
                            <input type="text" class="form-control" placeholder="Search" aria-label="Search">
                            <span class="input-group-text control-btn"><i class="fa fa-search"></i></span>
                        </div>

                        <!-- Date Button -->
                        <button class="btn btn-outline-secondary control-btn" type="button">
                            <i class="fa fa-calendar me-1"></i> Select Date
                        </button>

                        <!-- Filter Dropdown -->
                        <div class="dropdown">
                            <button class="btn btn-outline-secondary dropdown-toggle control-btn" type="button" data-bs-toggle="dropdown">
                                <i class="fa fa-filter me-1"></i>
                            </button>
                            <ul class="dropdown-menu shadow-sm p-2 rounded-3 border-0">
                                <li><a class="dropdown-item" href="#"><i class="fa-solid fa-chart-simple me-2"></i>Status</a></li>
                                <li><a class="dropdown-item" href="#"><i class="fa-solid fa-location-dot me-2"></i>Type of Issue</a></li>
                                <li><a class="dropdown-item" href="#"><i class="fa-solid fa-book-open me-2"></i>Branch</a></li>
                                <li><a class="dropdown-item" href="#"><i class="fa-solid fa-user-circle me-2"></i>IT Technician</a></li>
                            </ul>
                        </div>

                        <!-- Sort Dropdown -->
                        <div class="dropdown">
                            <button class="btn btn-outline-secondary dropdown-toggle control-btn" type="button" data-bs-toggle="dropdown">
                                <i class="fa fa-sort me-1"></i>
                            </button>
                            <ul class="dropdown-menu shadow-sm p-2 rounded-3 border-0">
                                <li><a class="dropdown-item" href="#"><i class="fa-solid fa-sort-alpha-up me-2"></i>Ascending</a></li>
                                <li><a class="dropdown-item" href="#"><i class="fa-solid fa-sort-alpha-down me-2"></i>Descending</a></li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>

        <!-- Repair Requests Table -->
            <div class="row no-gutters mt-4">
            <!-- Tabs Header -->
            <div class="d-flex justify-content-between align-items-center mb-1">
                <ul class="nav nav-tabs mt-2" id="nav-tix" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="pending-tab" data-bs-toggle="tab" href="#pending" role="tab" aria-controls="pending" aria-selected="true">Pending</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="ongoing-tab" data-bs-toggle="tab" href="#ongoing" role="tab" aria-controls="ongoing" aria-selected="false">On Going</a>
                    </li>
                    <li class="nav-item">
                                <a class="nav-link" id="completed-tab" data-bs-toggle="tab" href="#completed" role="tab" aria-controls="completed" aria-selected="false">Completed</a>
                    </li>
                </ul>
            </div>


            <!-- All Repair Tickets Submitted Table -->
            <!-- Tabs Content -->
            <div class="tab-content" id="nav-tix-content">
                <!-- Pending Tab Pane -->
              <div class="tab-pane fade show active" id="pending" role="tabpanel" aria-labelledby="pending-tab">
                <div class="table-responsive mt-3">
                    <table id="TicketTablePending" class="table table-striped table-bordered table-hover">
                        <thead class="thead-dark">
                                     <tr>
                                        <th>Ticket Id</th>
                                        <th>Submitted By</th>
                                        <th>Submitted At</th>
                                        <th>Branch</th>
                                        <th>Issue</th>
                                        <th>Assigned IT</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>

                                </thead>
                               <tbody>
                                    <?php foreach ($tickets as $ticket) : ?>
                                        <?php if ($ticket['TicketStatus'] == 'Pending') : ?>
                                            <tr>
                                                <td><?= htmlspecialchars($ticket['TicketId']) ?></td>
                                                <td><?= htmlspecialchars($ticket['EmployeeName']) ?></td>
                                                <td><?= htmlspecialchars($ticket['TimeSubmitted']) ?></td>
                                                <td><?= htmlspecialchars($ticket['BranchName']) ?></td>
                                                <td><?= htmlspecialchars($ticket['Issues']) ?></td>
                                                <td><?= htmlspecialchars($ticket['AssignedStaffName']) ?></td>
                                                <td><?= htmlspecialchars($ticket['TicketStatus']) ?></td>
                                                <td>
                                                    <a href="ticketDetails.php?id=<?= urlencode($ticket['TicketId']) ?>" class="btn btn-sm btn-primary">View</a>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                       
                        </tbody>
                        </div>
                    </table>
                </div>

                <!-- Ongoing Tab Pane -->
                <div class="tab-pane fade" id="ongoing" role="tabpanel" aria-labelledby="ongoing-tab">
                    <div class="table-responsive mt-3">
                        <table id="TicketTableOngoing" class="table table-striped table-bordered table-hover">
                            <thead class="thead-dark">
                             <tr>
                                <th>Ticket Id</th>
                                <th>Submitted By:</th>
                                <th>Submitted At</th>
                                <th>Branch</th>
                                <th>Issue</th>
                                <th>Assigned IT</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                <?php foreach ($tickets as $ticket) : ?>
                    <?php if ($ticket['TicketStatus'] == 'Ongoing') : ?>
                        <tr>
                            <td><?= htmlspecialchars($ticket['TicketId']) ?></td>
                            <td><?= htmlspecialchars($ticket['EmployeeName']) ?></td>
                            <td><?= htmlspecialchars($ticket['TimeSubmitted']) ?></td>
                            <td><?= htmlspecialchars($ticket['BranchName']) ?></td>
                            <td><?= htmlspecialchars($ticket['Issues']) ?></td>
                           <td><?= htmlspecialchars($ticket['AssignedStaffName']) ?></td>
                            <td><?= htmlspecialchars($ticket['TicketStatus']) ?></td>
                            <td>
                                <a href="ticketDetails.php?id=<?= urlencode($ticket['TicketId']) ?>" class="btn btn-sm btn-primary">View</a>
                            </td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            </tbody>
</table>

                    </div>
                </div>

                <!-- Completed Tab -->  
                       <div class="tab-pane fade" id="completed" role="tabpanel" aria-labelledby="completed-tab">
    <div class="table-responsive mt-3">
        <table id="TicketTableCompleted" class="table table-striped table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>Ticket Id</th>
                    <th>Submitted By:</th>
                    <th>Submitted At</th>
                    <th>Branch</th>
                    <th>Issue</th>
                    <th>Assigned IT</th>
                    <th>Status</th>
                    <th>Resolved At</th>
                    <th>Resolution</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tickets as $ticket) : ?>
                    <?php if ($ticket['TicketStatus'] === 'Completed') : ?>
                        <tr>
                            <td><?= htmlspecialchars($ticket['TicketId']) ?></td>
                            <td><?= htmlspecialchars($ticket['EmployeeName']) ?></td>
                            <td><?= htmlspecialchars($ticket['TimeSubmitted']) ?></td>
                            <td><?= htmlspecialchars($ticket['BranchName']) ?></td>
                            <td><?= htmlspecialchars($ticket['Issues']) ?></td>
                           <td><?= htmlspecialchars($ticket['AssignedStaffName']) ?></td>
                            <td><?= htmlspecialchars($ticket['TicketStatus']) ?></td>
                            <td><?= htmlspecialchars($ticket['TimeResolved']) ?></td>
                            <td><?= nl2br(htmlspecialchars($ticket['Resolution'])) ?></td>
                            <td>
                                <a href="ticketDetails.php?id=<?= urlencode($ticket['TicketId']) ?>" class="btn btn-sm btn-info">View</a>
                            </td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
                </div>
            </div>
        </div>

            <!-- Pagination -->
            <div class="pagination-container">
                <ul class="pagination" id="pagination">
                    <!-- Pagination -->
                </ul>
            </div>
            </main>
        </div>
    </div>
    <!-- End of Main Content -->


</body>
</html>