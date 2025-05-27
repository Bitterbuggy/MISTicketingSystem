<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$roleId = $_SESSION['RoleId'];
?>

<!-- Start of Header -->
<div class="layout-container d-flex">
    <div class="header d-flex justify-content-between align-items-center">
        <h3 class="mt-0" id="page-title"></h3>
        <div class="header-right d-flex align-items-center">
            <!-- Notification Icon -->
            <div class="notification-icon">
                <i class="fa-solid fa-bell"></i>
            </div>
            <!-- User Profile -->
            <div class="profile-icon">
                <i class="fa-solid fa-user-circle"></i>
            </div>
        </div>
    </div>
    <!-- End of Header -->

    <!-- Start of Sidebar -->
    <div class="layout-container d-flex">
        <div id="sidebar" class="sidebar d-flex flex-column">
            <div class="sidebar-header text-center py-3">
                <img src="../asset/img/qcpl-sts-logo.png" alt="QCPL STS Logo" class="logo-img">
                <div class="sidebar-title mt-2">QCPL-STS</div>
            </div>

            <div class="sidebar-menu flex-grow-1">
                <ul class="sidebar-nav p-0">

                    <!-- Admin -->
                    <?php if ($roleId == 1): ?>
                        <li class="sidebar-item default">
                            <a href="../admin/admindashboard.php">
                                <span class="icon"><i class="fa fa-house"></i></span>
                                <span class="text">Dashboard</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="../admin/adminTicketMgmt.php">
                                <span class="icon"><i class="fa fa-ticket"></i></span>
                                <span class="text">Tickets</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="../admin/adminAssetMgmt.php">
                                <span class="icon"><i class="fa fa-toolbox"></i></span>
                                <span class="text">Assets</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="../admin/adminStaffMgmt.php">
                                <span class="icon"><i class="fa fa-id-card-clip"></i></span>
                                <span class="text">IT Staff</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="../admin/adminBranchMgmt.php">
                                <span class="icon"><i class="fa fa-book-open"></i></span>
                                <span class="text">Branches</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="../auth/activityLogs.php">
                                <span class="icon"><i class="fa-solid fa-boxes-packing"></i></span>
                                <span class="text">History</span>
                            </a>
                        </li>

                    <!-- IT Staff -->
                    <?php elseif ($roleId == 3): ?>
                        <li class="sidebar-item default">
                            <a href="../ITstaff/ITdashboard.php">
                                <span class="icon"><i class="fa fa-house"></i></span>
                                <span class="text">Dashboard</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="../ITstaff/ITticketMgmt.php">
                                <span class="icon"><i class="fa fa-ticket"></i></span>
                                <span class="text">Tickets</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="/ITstaff/ITassetMgmt.php">
                                <span class="icon"><i class="fa fa-toolbox"></i></span>
                                <span class="text">Assets</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="/ITstaff/ITbranchMgmt.php">
                                <span class="icon"><i class="fa fa-book-open"></i></span>
                                <span class="text">Branches</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="/auth/activityLogs.php">
                                <span class="icon"><i class="fa-solid fa-boxes-packing"></i></span>
                                <span class="text">History</span>
                            </a>
                        </li>

                    <!-- Branch Admin / LIC -->
                    <?php elseif ($roleId == 2): ?>
                        <li class="sidebar-item default">
                            <a href="../branchadmin/bradmindashboard.php">
                                <span class="icon"><i class="fa fa-house"></i></span>
                                <span class="text">Dashboard</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="../branchadmin/bradminTicketMgmt.php">
                                <span class="icon"><i class="fa fa-ticket"></i></span>
                                <span class="text">Tickets</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="../branchadmin/bradminAssetMgmt.php">
                                <span class="icon"><i class="fa fa-toolbox"></i></span>
                                <span class="text">Assets</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="../branchadmin/licRegisterEmployee.php">
                                <span class="icon"><i class="fa fa-users"></i></span>
                                <span class="text">Employees</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="../auth/activityLogs.php">
                                <span class="icon"><i class="fa-solid fa-boxes-packing"></i></span>
                                <span class="text">History</span>
                            </a>
                        </li>

                    <!-- Regular Employee -->
                    <?php else: ?>
                        <li class="sidebar-item default">
                            <a href="../employee/home.php">
                                <span class="icon"><i class="fa fa-house"></i></span>
                                <span class="text">Dashboard</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="../employee/empticketMgmt.php">
                                <span class="icon"><i class="fa fa-ticket"></i></span>
                                <span class="text">Tickets</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="../employee/empAssetMgmt.php">
                                <span class="icon"><i class="fa fa-toolbox"></i></span>
                                <span class="text">Branch Assets</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="../auth/activityLogs.php">
                                <span class="icon"><i class="fa-solid fa-boxes-packing"></i></span>
                                <span class="text">History</span>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>

            <!-- Logout -->
            <div class="sidebar-logout">
                <ul class="sidebar-nav p-0">
                    <li class="sidebar-item">
                        <a href="../auth/logout.php">
                            <span class="icon"><i class="fa-solid fa-right-from-bracket"></i></span>
                            <span class="text">Log Out</span>
                        </a>
                    </li>
                </ul>
            </div>  
        </div>
    </div>
    <!-- End of Sidebar -->
</div>