<?php

include '../Includes/config.php';
include '../Includes/check_session.php';
if ($_SESSION['RoleId'] != 3) {
    header('Location: home.php');
    exit();
}

include '../Includes/get-location.php';

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
</head>

<body>
    <div class="layout-container d-flex">
        <!-- Sidebar and Header -->
        <?php include '../ITstaff/inc/IT-sidebar.php'; ?>

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
            </nav>
           

             <!-- Main Content Container -->
             <div class="main-content" style="margin-left: 260px; padding: 20px;">
                <h2>Welcome Admin, <?php echo $_SESSION['FirstName']; ?>!</h2>
                <p>You are now logged in as an IT.</p>
                <br>
                <!-- Ticket Summary -->
            <div class="row g-3 mt-4">
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
            </div>
            </div>

            <!-- Pie Chart 
            <div class="col-md-3">
                <canvas id="branchMostTicketChart" width="150" height="150"></canvas>
            </div> -->

            <div class="row no-gutters mt-1 align-items-center">
            <div class="d-flex justify-content-between align-items-center mt-3">
                <!-- Tabs -->
                <ul class="nav nav-tabs mt-4" id="nav-tix" role="tablist">
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
                <p class="view m-0"><a href="tickets.php">View All Tickets<i class="fa-solid fa-chevron-right"></i></a>
                </p>
            </div>

        <!-- Tab Content Container -->
        <div class="tab-content" id="nav-tix-content">
            <!-- Pending Tab -->
            <div class="tab-pane fade show active" id="pending" role="tabpanel" aria-labelledby="pending-tab">
                <table class="table table-sm table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>Ticket ID</th>
                            <th>Type of Issue</th>
                            <th>Branch</th>
                            <th>Assigned IT</th>
                            <th>Date and Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#P001</td>
                            <td>Computer not booting</td>
                            <td>2025-04-08</td>
                            <td>John Doe</td>
                            <td>2025-04-08 10:00:05 AM</td>
                        </tr>
                        <tr>
                            <td>#P002</td>
                            <td>Printer not working</td>
                            <td>2025-04-07</td>
                            <td>John Doe</td>
                            <td>2025-04-07 12:30:13 PM</td>
                        </tr>
                        <tr>
                            <td>#P003</td>
                            <td>Email issues</td>
                            <td>2025-04-06</td>
                            <td>John Doe</td>
                            <td>2025-04-06 09:45:32 AM</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- On Going Tab -->
            <div class="tab-pane fade" id="ongoing" role="tabpanel" aria-labelledby="ongoing-tab">
                <table class="table table-sm table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>Ticket ID</th>
                            <th>Type of Issue</th>
                            <th>Branch</th>
                            <th>Assigned IT</th>
                            <th>Date and Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#O001</td>
                            <td>Software installation</td>
                            <td>2025-04-08</td>
                            <td>John Doe</td>
                            <td>2025-04-08 10:00:05 AM</td>
                        </tr>
                        <tr>
                            <td>#O002</td>
                            <td>Network setup</td>
                            <td>2025-04-07</td>
                            <td>John Doe</td>
                            <td>2025-04-07 12:30:02 PM</td>
                        </tr>
                        <tr>
                            <td>#O003</td>
                            <td>Scanner configuration</td>
                            <td>2025-04-06</td>
                            <td>John Doe</td>
                            <td>2025-04-06 09:15:01 AM</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Completed Tab -->
            <div class="tab-pane fade" id="completed" role="tabpanel" aria-labelledby="completed-tab">
                <table class="table table-sm table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>Ticket ID</th>
                            <th>Type of Issue</th>
                            <th>Branch</th>
                            <th>Assigned IT</th>
                            <th>Date and Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#C001</td>
                            <td>Monitor replacement</td>
                            <td>2025-04-08</td>
                            <td>John Doe</td>
                            <td>2025-04-08 10:00:45 AM</td>
                        </tr>
                        <tr>
                            <td>#C002</td>
                            <td>Password reset</td>
                            <td>2025-04-07</td>
                            <td>Jane Smith</td>
                            <td>2025-04-07 12:30:13 PM</td>
                        </tr>
                        <tr>
                            <td>#C003</td>
                            <td>Keyboard issue</td>
                            <td>2025-04-06</td>
                            <td>Bob Johnson</td>
                            <td>2025-04-06 09:15:15 AM</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        </div>
        </main>
        </div>
    </div>

<script src="../asset/js/greeting-card.js"></script>
<script src="../asset/js/branchMostTicketChart.js"></script>
<script src="../asset/js/mostIssueChart.js"></script>
</body>
</html>