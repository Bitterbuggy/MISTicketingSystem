<script>
  var pageTitle = "Ticket Management";
</script>

<?php

include '../Includes/config.php';
include '../Includes/check_session.php';
if ($_SESSION['RoleId'] != 4) {
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
    <link rel ="stylesheet" href="../asset/css/sidebar.css">
    <link rel="stylesheet" href="../asset/css/notif.css">
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
    <script src="../asset/js/notif.js"></script>
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
                        <div class="div-mods inactive" onclick="window.location.href='empticketMgmt.php'">
                            <span class="mods">Repair Requests</span>
                        </div>
                        <div class="div-mods active" onclick="window.location.href='empCompletedTickets.php'">
                            <span class="mods">Completed Tickets</span>
                        </div>
                        <div class="div-mods inactive" onclick="window.location.href='empArchivedTickets.php'">
                            <span class="mods">Ticket History Archive</span>
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
                                <li><a class="dropdown-item" href="#"><i class="fa-solid fa-gear me-2"></i>Type of Issue</a></li>
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

            <!-- Completed Tickets Table -->
            <div class="row no-gutters mt-3">
            <div class="col-12">
                <div class="table-responsive"> 
                    <table class="table table-striped table-hover" id="tblCompletedTickets">
                    <thead class="thead-dark" style="text-align: center;">
                        <tr>
                            <th style="width: 4%;">Submitted At</th>
                            <th style="width: 3%;">Ticket ID</th>
                            <th style="width: 3%;">Type of Issue</th>
                            <th style="width: 5%;">Assigned IT</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Apr 12, 2025, 09:43:15</td>
                            <td id="tixID">1001</td>
                            <td id="tixType">Hardware</td>
                            <td>Jane Smith</td>  
                        </tr>
                        <tr>
                            <td>Apr 12, 2025, 09:43:15</td>
                            <td>1002</td>
                            <td>Software</td>
                            <td>John Doe</td>
                        </tr>
                        <tr>
                            <td>Apr 12, 2025, 09:43:15</td>
                            <td>1003</td>
                            <td>Software</td>
                            <td>Jane Adams</td>
                        </tr>
                        <tr>
                            <td>Apr 12, 2025, 09:43:15</td>
                            <td>1004</td>
                            <td>Software</td>
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
    <!-- Account Profile Update Modal -->
    <?php include '../auth/updateAcc.php'; ?>

    <!-- Account Password Update Modal -->
    <?php include '../auth/updatePass.php'; ?>
</body>
</html>