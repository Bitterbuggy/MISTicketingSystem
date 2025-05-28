<?php

include '../Includes/config.php';
include '../Includes/check_session.php';

$sql = "SELECT
            t_tickets.TicketId,
            MIN(t_tickets.TimeSubmitted) as TimeSubmitted,
            t_branch.BranchName,
            GROUP_CONCAT(t_issuedtype.IssueType SEPARATOR ', ') as Issues,
            t_tickets.AssignedITstaffId,
            t_tickets.TicketStatus
        FROM t_ticketissues
        JOIN t_tickets ON t_ticketissues.TicketId = t_tickets.TicketId
        JOIN t_branch ON t_tickets.BranchId = t_branch.BranchId
        JOIN t_issuedtype ON t_ticketissues.IssueId = t_issuedtype.IssueId
        GROUP BY t_tickets.TicketId, t_branch.BranchName, t_tickets.AssignedITstaffId, t_tickets.TicketStatus
        ORDER BY TimeSubmitted ASC";


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


if ($_SESSION['RoleId'] != 3) {
    header('Location: ../employee/home.php');
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QCPL STS - Dashboard</title>
    <link rel="icon" type="image/x-icon" href="../asset/img/qcpl-sts-logo.png">

       <!-- External CSS Link/s -->
    <link rel ="stylesheet" href="../asset/css/sidebar.css">
    <link rel="stylesheet" href="../asset/css/greeting.css">
    <link rel="stylesheet" href="../asset/css/ticket-cards.css">
    <link rel="stylesheet" href="../asset/css/navtabs.css">
    <link rel="stylesheet" href="../asset/css/tbl_charts.css">
    <link rel="stylesheet" href="../asset/css/tbl-controls.css">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    

    <!-- Font Awesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

  
   
</head>

<body>
    <div class="layout-container d-flex">
        <!-- Sidebar and Header -->
        <?php include '../admin/inc/sidebar.php'; ?>

        <!-- Wrapper for Header + Main -->
        <div class="main-wrapper w-100" style="margin-left: 80px; margin-top: 30px;">
            <!-- Main Content -->
            <main class="px-4 py-5">
                <div class="row no-gutters mt-1 align-items-center">
                    <!-- Welcome Card -->
                    <div class="col-md-6 mb-3">
                        <div class="welcome-card">
                            <div class="card-content">
                                <h3 id="greeting"></h3>
                                <h1 class="fw-bold"><?php echo $_SESSION['FirstName']; ?></h1>
                                <div class="location-tag">
                                    <i class="fa-solid fa-location-dot"></i>
                                    <span id="location">Quezon City, Philippines</span>
                                </div>
                            </div>
                            <img src="../asset/img/dashboard-welcome-card.png" alt="QCPL STS Welcome Card" class="card-image">
                        </div>
                    </div>
<?php
try {
    $recentQuery = "
        SELECT
            t_tickets.TicketId,
            t_tickets.TimeSubmitted,
            t_branch.BranchName,
            GROUP_CONCAT(t_issuedtype.IssueType SEPARATOR ', ') AS Issues,
            t_tickets.TicketStatus
        FROM t_ticketissues
        JOIN t_tickets ON t_ticketissues.TicketId = t_tickets.TicketId
        JOIN t_branch ON t_tickets.BranchId = t_branch.BranchId
        JOIN t_issuedtype ON t_ticketissues.IssueId = t_issuedtype.IssueId
        GROUP BY t_tickets.TicketId, t_tickets.TimeSubmitted, t_branch.BranchName, t_tickets.TicketStatus
        ORDER BY t_tickets.TimeSubmitted DESC
        LIMIT 1
    ";

    $stmt = $conn->prepare($recentQuery);
    $stmt->execute();
    $recentTicket = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$displayTicketId = substr($recentTicket['TicketId'], -6);


function abbreviateBranch($branchName) {
    $words = explode(' ', $branchName);
    $abbreviation = '';
    foreach ($words as $word) {
        $abbreviation .= strtoupper($word[0]);
    }
    return $abbreviation;
}

$abbreviatedBranch = abbreviateBranch($recentTicket['BranchName']);


?>
                    <!-- Recent Ticket Card -->
<div class="col-md-4 mb-3">
    <div class="ticket-container">
        <div class="ticket-header">
            <h5 class="fw-bold text-center" id="ticket-title">RECENT TICKET</h5>
        </div>
        
        <div class="ticket-body">
            <div class="ticket-grid">
                <div>Ticket ID<br><span id="ticket-id"><?= htmlspecialchars($displayTicketId) ?></span></div>

                <div>Status<br><span id="ticket-status"><?= htmlspecialchars($recentTicket['TicketStatus']) ?></span></div>
            </div>
            <div class="ticket-grid">
                <div>Branch<br><span id="ticket-branch"><?= htmlspecialchars($abbreviatedBranch) ?></span></div>

                <div>Issue<br><span id="ticket-issue"><?= htmlspecialchars($recentTicket['Issues']) ?></span></div>
            </div>

            <?php
                $dateTime = new DateTime($recentTicket['TimeSubmitted']);
                $formattedDate = $dateTime->format('F d, Y');
                $formattedTime = $dateTime->format('H:i:s');
            ?>
            <div class="ticket-grid">
                <div>Date<br><span id="ticket-date"><?= $formattedDate ?></span></div>
                <div>Time<br><span id="ticket-time"><?= $formattedTime ?></span></div>
            </div>
        </div>
    </div>
</div>


                    <!-- Live Date and Time Card -->
                    <div class="col-md-2 mb-3">
                        <div class="live-card text-center">
                            <h6 class="fw-semibold text-muted mb-2"><i class="fa-solid fa-calendar"></i><br>Today is</h6>
                            <h5 id="live-date-line1" class="fw-bold"></h5>
                            <h5 id="live-date-line2" class="fw-bold"></h5>
                            <hr class="my-3">
                            <h6 class="fw-semibold text-muted mb-2"><i class="fa-solid fa-clock"></i><br>Right now, it's</h6>
                            <h1 id="live-time" class="fw-bold" style="font-size: 34px;"></h1>
                        </div>
                    </div>
                </div>

                <!-- Ticket Summary Cards -->
                <div class="row no-gutters mt-3 align-items-center">
                    <h3 class="fw-bold mb-3" id="ticket-summary-title">Ticket Summary</h3>

                    <!-- Pending -->
<div class="col-md-3 mb-3">
    <div class="ticket-card pending h-100">
        <i class="fa-solid fa-triangle-exclamation"></i>
        <h5>Pending</h5>
        <p class="ticket-count"><?= $pendingCount ?></p>
    </div>
</div>

<!-- On Going -->
<div class="col-md-3 mb-3">
    <div class="ticket-card ongoing h-100">
        <i class="fa-solid fa-sync-alt fa-spin"></i>
        <h5>On Going</h5>
        <p class="ticket-count"><?= $ongoingCount ?></p>
    </div>
</div>

<!-- Completed -->
<div class="col-md-3 mb-3">
    <div class="ticket-card completed h-100">
        <i class="fa-solid fa-circle-check"></i>
        <h5>Completed</h5>
        <p class="ticket-count"><?= $completedCount ?></p>
    </div>
</div>

<!-- Total -->
<div class="col-md-3 mb-3">
    <div class="ticket-card total h-100">
        <i class="fa-solid fa-clipboard"></i>
        <h5>Total</h5>
        <p class="ticket-count"><?= $totalCount ?></p>
    </div>
</div>

                        <!-- Tabs for Ticket Summary -->
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

                        <!-- View All Tickets Link -->
                        <p class="view m-0"><a href="adminTicketMgmt.php">View All Tickets <i class="fa-solid fa-chevron-right"></i></a></p>
                        </div>

                        <!-- Tab Content Container -->
                        <div class="tab-content" id="nav-tix-content">
                           <!-- Pending Tab -->
<div class="tab-pane fade show active" id="pending" role="tabpanel" aria-labelledby="pending-tab">
    <div class="table-responsive mt-3">
        <table id="TicketTablePending" class="table table-striped table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>Ticket Id</th>
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
                            <td><?= htmlspecialchars($ticket['TimeSubmitted']) ?></td>
                            <td><?= htmlspecialchars($ticket['BranchName']) ?></td>
                            <td><?= htmlspecialchars($ticket['Issues']) ?></td>
                            <td><?= htmlspecialchars($ticket['AssignedITstaffId']) ?></td>
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

                       
                       
                        </div>

                        <!-- On Going Tab -->
                        
<div class="tab-pane fade" id="ongoing" role="tabpanel" aria-labelledby="ongoing-tab">
    <div class="table-responsive mt-3">
        <table id="TicketTableOngoing" class="table table-striped table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>Ticket Id</th>
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
                            <td><?= htmlspecialchars($ticket['TimeSubmitted']) ?></td>
                            <td><?= htmlspecialchars($ticket['BranchName']) ?></td>
                            <td><?= htmlspecialchars($ticket['Issues']) ?></td>
                            <td><?= htmlspecialchars($ticket['AssignedITstaffId']) ?></td>
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
                            <table class="table table-md table-bordered table-striped table-hover">
                                <thead class="thead-dark">
                                    <tr>
                                        <th class="dateTime"style="width: 5%">Submitted At</th>
                                        <th class="tixId" style="width: 4%">Ticket ID</th>
                                        <th class="branch"style="width: 7%">Branch</th>
                                        <th class="issue"style="width: 7%">Issue</th>
                                        <th class="assignedIT"style="width: 5%">Assigned IT</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Rows will be populated by JavaScript -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
               
            </div>
        </div>
        </div>
            </main>
        </div>
    </div>

   
     <!-- External JS Link/s -->
    <script src="../asset/js/sidebar.js"></script>
    <script src="../asset/js/greetingCard.js"></script>
    <script src="../asset/js/recentTicket.js"></script>
    <script src="../asset/js/ticketSummary.js"></script>
    <script src="../asset/js/adminNavTables.js"></script>
   
<!-- Bootstrap 5 JS Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>