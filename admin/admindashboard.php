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
    <title>QCPL STS - Dashboard</title>
    <link rel="icon" type="image/x-icon" href="../asset/img/qcpl-logo.png">

    <!-- CSS Link/s -->
    <link rel="stylesheet" href="../asset/css/sidenavbar_admin.css">
    <link rel="stylesheet" href="../admin/inc/admin-dashboard.css">

    <!-- Bootstrap CSS -->
    <link href="../../vendor/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body style="background-color: #f3f2f7;">
    <div class="d-flex">
        <!-- Include Sidebar -->
        <?php include '../admin/inc/admin-sidebar.php'; ?>

        <!-- Main Content -->
        <div class="container-fluid p-0 cont" id="body">
             
            <nav class="navbar sticky-top">
                <div class="row no-gutters">
                    <div class="col-1">
                        <button type="button" class="toggler-btn">
                            <i class="fa-solid fa-align-justify"></i>
                        </button>
                    </div>
                    <!--<div class="col-8 sticky-top" style="width: 60rem; margin-left: 2rem; margin-top: -2.2rem;">
                        <h1 class="nav-title">Dashboard</h1>
                    </div>-->
                </div>
            </nav>
           

             <!-- Main Content Container -->
             <div class="main-content" style="margin-left: 260px; padding: 20px;">
                <h2>Welcome Admin, <?php echo $_SESSION['FirstName']; ?>!</h2>
                <p>You are now logged in as Admin.</p>
                <br>
                <!-- Ticket Summary -->
            <div class="row g-3 mt-4">
            <!-- Pending -->
            <div class="col-md-4">
                <div class="ticket-card pending">
                <h5>Pending</h5>
                <p class="ticket-count">12</p>
                </div>
            </div>
            <!-- On Going -->
            <div class="col-md-4">
                <div class="ticket-card ongoing">
                <h5>On Going</h5>
                <p class="ticket-count">8</p>
                </div>
            </div>
            <!-- Completed -->
            <div class="col-md-4">
                <div class="ticket-card completed">
                <h5>Completed</h5>
                <p class="ticket-count">25</p>
                </div>
            </div>
            </div>

            <div class="row no-gutters mt-1 align-items-center">
            <div class="d-flex justify-content-between align-items-center mt-3">
                <!-- Tabs -->
                <ul class="nav nav-tabs" id="nav-tix" role="tablist">
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
    </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const tabLinks = document.querySelectorAll('#nav-tix .nav-link');
        const tabContents = document.querySelectorAll('#nav-tix-content .tab-pane');

        // Initially hide all tab panes except the active one
        tabContents.forEach(pane => {
            if (!pane.classList.contains('active')) {
                pane.style.display = 'none';
            }
        });

        tabLinks.forEach(link => {
            link.addEventListener('click', function (e) {
                // Remove show & active from all tab panes
                tabContents.forEach(pane => {
                    pane.classList.remove('show', 'active');
                    pane.style.display = 'none';
                });

                // Remove active class from all nav links
                tabLinks.forEach(nav => nav.classList.remove('active'));

                // Add active class to the clicked nav link
                this.classList.add('active');

                // Get the target tab content
                const targetId = this.getAttribute('href').substring(1);
                const targetPane = document.getElementById(targetId);

                // Show and activate the target tab
                if (targetPane) {
                    targetPane.classList.add('show', 'active');
                    targetPane.style.display = 'block';
                }

                // Prevent default anchor behavior
                e.preventDefault();
            });
        });
    });
</script>

</body>
</html>