<script>
  var pageTitle = "Ticket Management";
</script>

<?php

include '../Includes/config.php';
include '../Includes/check_session.php';

$userId = $_SESSION['UserId']; // Current logged-in IT staff ID

$sql = "SELECT
            t_tickets.TicketId,
            MIN(t_tickets.TimeSubmitted) as TimeSubmitted,
            t_branch.BranchName,
            GROUP_CONCAT(t_issuedtype.IssueType SEPARATOR ', ') as Issues,
            t_tickets.AssignedITstaffId,
            t_tickets.TicketStatus,
            t_tickets.TimeResolved,
            t_tickets.Resolution
        FROM t_ticketissues
        JOIN t_tickets ON t_ticketissues.TicketId = t_tickets.TicketId
        JOIN t_branch ON t_tickets.BranchId = t_branch.BranchId
        JOIN t_issuedtype ON t_ticketissues.IssueId = t_issuedtype.IssueId
        WHERE 
            t_tickets.TicketStatus = 'pending'
            OR (t_tickets.TicketStatus = 'ongoing' AND t_tickets.AssignedITstaffId = :userId)
            OR (t_tickets.TicketStatus = 'completed' AND t_tickets.AssignedITstaffId = :userId)
        GROUP BY 
            t_tickets.TicketId, t_branch.BranchName, t_tickets.AssignedITstaffId, 
            t_tickets.TicketStatus, t_tickets.TimeResolved, t_tickets.Resolution
        ORDER BY TimeSubmitted ASC";

$stmt = $conn->prepare($sql);
$stmt->bindParam(':userId', $userId);
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
$totalCount = $pendingCount + $ongoingCount + $completedCount;


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
    <title>QCPL STS - Ticket Management</title>
    <link rel="icon" type="image/x-icon" href="../asset/img/qcpl-sts-logo.png">

    <!-- External CSS Link/s -->
    <link rel ="stylesheet" href="../asset/css/sidebar.css">
    <link rel="stylesheet" href="../asset/css/div_mods.css">
    <link rel="stylesheet" href="../asset/css/navtabs.css">
    <link rel="stylesheet" href="../asset/css/tbl_charts.css">
    <link rel="stylesheet" href="../asset/css/tbl-controls.css">
    <link rel="stylesheet" href="../asset/css/buttons.css">
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
                        <div class="div-mods active" onclick="window.location.href='ITticketMgmt.php'">
                            <span class="mods">Repair Requests</span>
                        </div>
                        <div class="div-mods inactive" onclick="window.location.href='ITcompletedTickets.php'">
                            <span class="mods">Completed Tickets</span>
                        </div>
                        
                    </div>

                    <!-- Controls Section -->
                    <div class="d-flex flex-wrap flex-lg-nowrap align-items-center gap-2">
                        <!-- Search Bar -->
                    <div class="input-group" style="max-width: 380px;">
                    <input type="text" id="searchInput" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="search-icon">

                    <span class="input-group-text control-btn" id="search-icon">
                        <i class="fa fa-search"></i>
                    </span>
                    </div>

                     

                        <!-- Sort Dropdown -->
<div class="dropdown">
  <button class="btn btn-outline-secondary dropdown-toggle control-btn" type="button" data-bs-toggle="dropdown">
    <i class="fa fa-sort me-1"></i> Sort
  </button>
  <ul class="dropdown-menu shadow-sm p-2 rounded-3 border-0">
    <li><a class="dropdown-item" href="#" onclick="sortTable('TicketTableAlltickets', 0, true)">Ticket ID ↑</a></li>
    <li><a class="dropdown-item" href="#" onclick="sortTable('TicketTableAlltickets', 0, false)">Ticket ID ↓</a></li>
    <li><a class="dropdown-item" href="#" onclick="sortTable('TicketTableAlltickets', 1, true)">Submitted At ↑</a></li>
    <li><a class="dropdown-item" href="#" onclick="sortTable('TicketTableAlltickets', 1, false)">Submitted At ↓</a></li>
    <li><a class="dropdown-item" href="#" onclick="sortTable('TicketTableAlltickets', 2, true)">Branch ↑</a></li>
    <li><a class="dropdown-item" href="#" onclick="sortTable('TicketTableAlltickets', 2, false)">Branch ↓</a></li>
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

            <!-- Tabs Content -->
            <div class="tab-content" id="nav-tix-content">
            <!-- Pending Tab Pane -->
            <div class="tab-pane fade show active" id="pending" role="tabpanel" aria-labelledby="pending-tab">
                <div class="table-responsive mt-0">
                    <table class="table table-bordered table-striped table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th>Ticket ID</th>
                                <th>Submitted At</th>
                                <th>Branch</th>
                                <th>Issue</th>
                                <th>Assigned IT</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($tickets as $ticket) : ?>
                                <?php if ($ticket['TicketStatus'] === 'Pending') : ?>
                                    <tr>
                                        <td><?php echo $ticket['TicketId']; ?></td>
                                        <td><?php echo $ticket['TimeSubmitted']; ?></td>
                                        <td><?php echo $ticket['BranchName']; ?></td>
                                        <td><?php echo $ticket['IssueType']; ?></td>
                                        <td><?php echo $ticket['AssignedITstaffId']; ?></td>
                                        <td><?php echo $ticket['TicketStatus']; ?></td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Ongoing Tab Pane -->
            <div class="tab-pane fade" id="ongoing" role="tabpanel" aria-labelledby="ongoing-tab">
                <div class="table-responsive mt-0">
                    <table class="table table-bordered table-striped table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th>Ticket ID</th>
                                <th>Submitted At</th>
                                <th>Branch</th>
                                <th>Issue</th>
                                <th>Assigned IT</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($tickets as $ticket) : ?>
                                <?php if ($ticket['TicketStatus'] === 'Ongoing') : ?>
                                    <tr>
                                        <td><?php echo $ticket['TicketId']; ?></td>
                                        <td><?php echo $ticket['TimeSubmitted']; ?></td>
                                        <td><?php echo $ticket['BranchName']; ?></td>
                                        <td><?php echo $ticket['IssueType']; ?></td>
                                        <td><?php echo $ticket['AssignedITstaffId']; ?></td>
                                        <td><?php echo $ticket['TicketStatus']; ?></td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- All Tickets Tab Pane -->
            <div class="tab-pane fade" id="alltix" role="tabpanel" aria-labelledby="alltix-tab">
                <div class="table-responsive mt-0">
                    <table class="table table-bordered table-striped table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th>Ticket ID</th>
                                <th>Submitted At</th>
                                <th>Branch</th>
                                <th>Issue</th>
                                <th>Assigned IT</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Rows will be dynamically added via JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
    <!-- End of Main Content -->

    <script>
  document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('searchInput');

    if (!searchInput) return; // Prevent errors if input is missing

    searchInput.addEventListener('keyup', function () {
      const filter = this.value.toLowerCase();

      const tableIds = ['TicketTablePending', 'TicketTableOngoing', 'TicketTableCompleted'];

      tableIds.forEach(tableId => {
        const rows = document.querySelectorAll(`#${tableId} tbody tr`);
        rows.forEach(row => {
          const cells = Array.from(row.getElementsByTagName('td'));
          const match = cells.some(cell => cell.textContent.toLowerCase().includes(filter));
          row.style.display = match ? '' : 'none';
        });
      });
    });
  });
</script>

<script>
  function sortTable(columnIndex, ascending = true) {
    const tableIds = ['TicketTablePending', 'TicketTableOngoing', 'TicketTableCompleted'];

    tableIds.forEach(tableId => {
      const table = document.getElementById(tableId);
      if (!table) return;

      const rows = Array.from(table.querySelectorAll('tbody tr'));

      rows.sort((a, b) => {
        const cellA = a.cells[columnIndex]?.innerText.trim().toLowerCase() || '';
        const cellB = b.cells[columnIndex]?.innerText.trim().toLowerCase() || '';

        const isNumeric = !isNaN(Date.parse(cellA)) || !isNaN(cellA);

        let valA = isNumeric ? (isNaN(Date.parse(cellA)) ? parseFloat(cellA) : new Date(cellA)) : cellA;
        let valB = isNumeric ? (isNaN(Date.parse(cellB)) ? parseFloat(cellB) : new Date(cellB)) : cellB;

        if (valA < valB) return ascending ? -1 : 1;
        if (valA > valB) return ascending ? 1 : -1;
        return 0;
      });

      const tbody = table.querySelector('tbody');
      rows.forEach(row => tbody.appendChild(row));
    });
  }
</script>


</body>
</html>