<script>
  var pageTitle = "Ticket Management";
</script>

<?php

include '../Includes/config.php';
include '../Includes/check_session.php';
if ($_SESSION['RoleId'] != 1) {
    header('Location: home.php');
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
    <link rel ="stylesheet" href="../asset/css/admin-sidebar.css">
    <link rel ="stylesheet" href="../asset/css/admin-ticket-mgmt.css">
    <link rel ="stylesheet" href="../asset/css/pagination.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap 5 JS Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Font Awesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Chart.js CDN Link -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Custom JS Link/s -->
    <script src="../asset/js/adminNavTables.js"></script>
    <script src="../asset/js/adminCharts.js"></script>
</head>

<body>
    <div class="layout-container d-flex">
        <!-- Sidebar and Header -->
        <?php include '../admin/inc/adminSidebar.php'; ?>

        <!-- Wrapper for Header + Main -->
        <div class="main-wrapper w-100" style="margin-left: 80px; margin-top: 30px;">
            <!-- Main Content -->
            <main class="px-4 py-5">
                <!-- Ticket Management Navigation -->
                <div class="container-fluid tixmgmt-nav">
                    <div class="row m-2 text-center align-items-center">
                        <div class="col-md-4 mt-2 div-mods inactive" onclick="window.location.href='adminTicketMgmt.php'">
                            <span class="mods">Repair Requests</span>
                        </div>
                        <div class="col-md-4 mt-2 div-mods active" onclick="window.location.href='adminCompletedTickets.php'">
                            <span class="mods">Completed Tickets</span>
                        </div>
                        <div class="col-md-4 mt-2 div-mods inactive" onclick="window.location.href='adminTicketArchive.php'">
                            <span class="mods">Ticket History Archive</span>
                        </div>
                    </div>
                </div>

                <!-- Table for Completed Tickets -->
                <div class="table-container">
                    <div class="tb-control">           
                    <table class="table table-hover" id="tblCompletedTickets">
                        <thead class="thead-dark" style="text-align: center;">
                            <tr>
                                <th style="width: 4%;">Submitted At</th>
                                <th style="width: 3%;">Ticket ID</th>
                                <th style="width: 3%;">Type of Issue</th>
                                <th style="width: 6%;">Branch</th>
                                <th style="width: 5%;">Assigned IT</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Apr 12, 2025, 09:43:15</td>
                                <td id="tixID">1001</td>
                                <td id="tixType">Hardware</td>
                                <td>QCPL</td>
                                <td>Jane Smith</td>  
                            </tr>
                            <tr>
                                <td>Apr 12, 2025, 09:43:15</td>
                                <td>1002</td>
                                <td>Software</td>
                                <td>QCPL</td>
                                <td>John Doe</td>
                            </tr>
                            <tr>
                                <td>Apr 12, 2025, 09:43:15</td>
                                <td>1003</td>
                                <td>Software</td>
                                <td>QCPL</td>
                                <td>Jane Adams</td>
                            </tr>
                            <tr>
                                <td>Apr 12, 2025, 09:43:15</td>
                                <td>1004</td>
                                <td>Software</td>
                                <td>QCPL</td>
                                <td>Jack Johnson</td>
                            </tr>
                        </tbody>
                    </table>
                    </div>
                </div>

                <div class="pagination-container">
                    <ul class="pagination" id="pagination">
                        <!-- Pagination -->
                    </ul>
                </div>
            </main>
        </div>
    </div>
        
    <!-- Custom JS Link/s -->
    <script src="../asset/js/admin-sidebar.js"></script>
    <script src="../asset/js/adminCalendarPicker.js"></script>
    <script src="../asset/js/adminAllTickets.js"></script>
</body>
</html>