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
    <link rel="stylesheet" href="../asset/css/admin-ticket-mgmt.css">

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
                <div class="container-fluid tixmgt-nav">
                    <div class="row m-2 text-center align-items-center">
                        <div class="col-md-4 mt-2 div-mods active" onclick="window.location.href='adminTicketMgmt.php'">
                            <a href="#" class="mods">Repair Requests</a>
                        </div>
                        <div class="col-md-4 mt-2 div-mods" onclick="window.location.href='#.php'">
                            <a href="#" class="mods">Completed Tickets</a>
                        </div>
                        <div class="col-md-4 mt-2 div-mods" onclick="window.location.href='#.php'">
                            <a href="#" class="mods">Ticket History Archive</a>
                        </div>
                    </div>
                </div>

                <!-- Table for Repair Requests -->
                <div class="repair-requests table-container">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th></th>
                            </tr>

            </main>
        </div>
    </div>
        
    <!-- Custom JS Link/s -->
    <script src="../asset/js/admin-sidebar.js"></script>
</body>
</html>