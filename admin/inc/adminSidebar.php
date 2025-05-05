<!-- Start of Header -->
<aside class="layout-container d-flex">
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
            <img src="../../asset/img/qcpl-sts-logo.png" alt="QCPL STS Logo" class="logo-img">
            <div class="sidebar-title mt-2">QCPL-STS</div>
        </div>

        <div class="sidebar-menu flex-grow-1">
            <ul class="sidebar-nav p-0">
            <li class="sidebar-item default">
                <a href="adminDashboard.php">
                <span class="icon"><i class="fa fa-house"></i></span>
                <span class="text">Dashboard</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="adminTicketMgmt.php">
                <span class="icon"><i class="fa fa-ticket"></i></span>
                <span class="text">Tickets</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="adminAssetMgmt.php">
                <span class="icon"><i class="fa fa-toolbox"></i></span>
                <span class="text">Assets</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="adminStaffMgmt.php">
                <span class="icon"><i class="fa fa-id-card-clip"></i></span>
                <span class="text">IT Staff</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="adminBranchMgmt.php">
                <span class="icon"><i class="fa fa-book-open"></i></span>
                <span class="text">Branches</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="adminReports.php">
                <span class="icon"><i class="fa-solid fa-diagram-next"></i></span>
                <span class="text">Reports</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="../auth/adminActivityLogs.php">
                <span class="icon"><i class="fa-solid fa-box"></i></span>
                <span class="text">Activity Logs</span>
                </a>
            </li>
            </ul>
        </div>

        <!-- Sidebar logout section -->
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
    <!-- End of Sidebar -->
</div>
</aside>
