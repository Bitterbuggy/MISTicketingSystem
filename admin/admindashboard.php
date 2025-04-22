<?php

include 'config.php';
include 'check_session.php';
if ($_SESSION['RoleId'] != 1) {
    header('Location: home.php');
    exit();
}

include 'get-location.php';

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QCPL STS - Dashboard</title>
    <link rel="icon" type="image/x-icon" href="../asset/img/qcpl-sts-logo.png">

    <!-- External CSS Link/s -->
    <link rel ="stylesheet" href="../asset/css/header-sidebar.css">
    <link rel="stylesheet" href="../asset/css/admin-dashboard.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap 5 JS Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Font Awesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <div class="layout-container d-flex">
        <!-- Sidebar and Header -->
        <?php include 'header-sidebar.php'; ?>

        <!-- Wrapper for Header + Main -->
        <div class="main-wrapper w-100" style="margin-left: 80px; margin-top: 30px;">

            <!-- Main Content (separate from header) -->
            <main class="px-4 py-5">
                <div class="row align-items-stretch">
                    <!-- Welcome Card -->
                    <div class="col-md-8 mb-3">
                        <div class="welcome-card">
                            <div class="card-content">
                                <h2 id="greeting"></h2>
                                <h1 class="fw-bold"><?php echo $_SESSION['FirstName']; ?></h1>
                                <div class="location-tag">
                                    <i class="fa-solid fa-location-dot"></i> <?php echo $location; ?>
                                </div>
                            </div>
                            <img src="../asset/img/dashboard-welcome-card.png" alt="QCPL STS Welcome Card" class="card-image">
                        </div>
                    </div>

                    <!-- Live Date and Time Card -->
                    <div class="col-md-2 mb-3">
                        <div class="live-card p-3 text-center shadow-sm">
                            <h6 class="fw-semibold text-muted mb-2"><i class="fa-solid fa-calendar"></i><br>Today is</h6>
                            <h4 id="live-date-line1" class="fw-bold"></h4>
                            <h4 id="live-date-line2" class="fw-bold mb-3"></h4>
                            <hr class="my-3">
                            <h6 class="fw-semibold text-muted mb-2"><i class="fa-solid fa-clock"></i><br>Right now, it's</h6>
                            <h1 id="live-time" class="fw-bold"></h1>
                        </div>
                    </div>

                    <!-- Recent Ticket Card -->

                    <div class="col-md-2 mb-3">
                        <div class="recent-ticket-card p-3 shadow-sm">
                            <h6 class="text-uppercase fw-bold border-bottom pb-2">Recent Ticket</h6>
                            <p class="mb-1"><strong>Branch:</strong> Marikina</p>
                            <p class="mb-1"><strong>Ticket ID:</strong> #TK-0349</p>
                            <p class="mb-1"><strong>Issue:</strong> Printer not working</p>
                            <p class="mb-1"><strong>Date:</strong> Apr 18, 2025</p>
                            <p class="mb-0"><strong>Status:</strong> Pending</p>
                        </div>
                    </div>
                </div>

            <!-- Ticket Summary Cards: Pending, On Going, Completed-->
            <div class="row g-3 mt-4 align-items-center">

            <!-- Pending -->
            <div class="col-md-3">
                <div class="ticket-card pending">
                <h5>Pending</h5>
                <p class="ticket-count">12</p>
                </div>
            </div>

            <!-- On Going -->
            <div class="col-md-3">
                <div class="ticket-card ongoing">
                <h5>On Going</h5>
                <p class="ticket-count">8</p>
                </div>
            </div>

            <!-- Completed -->
            <div class="col-md-3">
                <div class="ticket-card completed">
                <h5>Completed</h5>
                <p class="ticket-count">25</p>
                </div>
            </nav>
           

             <!-- Main Content Container -->
             <div class="main-content" style="margin-left: 260px; padding: 20px;">
                <h2>Welcome Admin, <?php echo $_SESSION['FirstName']; ?>!</h2>
                <p>You are now logged in as Admin.</p>
                <br>
                
        </div>
    </div>
</body>
</html>

  



