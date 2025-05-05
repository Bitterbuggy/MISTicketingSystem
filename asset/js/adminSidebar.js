// Sidebar toggle
document.getElementById('sidebarCollapse')?.addEventListener('click', function () {
    document.getElementById('sidebar').classList.toggle('collapsed');
    document.getElementById('body')?.classList.toggle('collapsed');
});

// Active sidebar highlighter
document.addEventListener('DOMContentLoaded', function() {
    const sidebarItems = document.querySelectorAll('.sidebar-item');
    const currentPage = window.location.pathname.split('/').pop().split('?')[0];
    let matched = false; // 👈 flag to prevent double highlights

    // Remove active from all
    sidebarItems.forEach(item => item.classList.remove('active'));

    // Ticket pages
    const ticketsPages = ['adminTicketMgmt.php', 'adminCompletedTickets.php', 'adminArchivedTickets.php'];
    if (ticketsPages.includes(currentPage)) {
        sidebarItems.forEach(item => {
            const link = item.querySelector('a');
            if (link && link.getAttribute('href') === 'adminTicketMgmt.php') {
                item.classList.add('active');
                matched = true;
            }
        });
    }

    // Asset pages
    const assetPages = ['adminAssetMgmt.php', 'adminTransferRequestsList.php'];
    if (assetPages.includes(currentPage)) {
        sidebarItems.forEach(item => {
            const link = item.querySelector('a');
            if (link && link.getAttribute('href') === 'adminAssetMgmt.php') {
                item.classList.add('active');
                matched = true;
            }
        });
    }

    // Staff page
    else if (currentPage === 'adminStaffMgmt.php') {
        sidebarItems.forEach(item => {
            const link = item.querySelector('a');
            if (link && link.getAttribute('href') === 'adminStaffMgmt.php') {
                item.classList.add('active');
                matched = true;
            }
        });
    }

    // Branch pages
    const branchPages = ['adminBranchMgmt.php', 'adminEmployeeList.php'];
    if (branchPages.includes(currentPage)) {
        sidebarItems.forEach(item => {
            const link = item.querySelector('a');
            if (link && link.getAttribute('href') === 'adminBranchMgmt.php') {
                item.classList.add('active');
                matched = true;
            }
        });
    }

    // Reports page
    else if (currentPage === 'adminReports.php') {
        sidebarItems.forEach(item => {
            const link = item.querySelector('a');
            if (link && link.getAttribute('href') === 'adminReports.php') {
                item.classList.add('active');
                matched = true;
            }
        });
    }

    // Activity Logs page
    else if (currentPage === '../auth/adminActivityLogs.php') {
        sidebarItems.forEach(item => {
            const link = item.querySelector('a');
            if (link && link.getAttribute('href') === 'adminActivityLogs.php') {
                item.classList.add('active');
                matched = true;
            }
        });
    }

    // Dashboard page
    else if (currentPage === 'adminDashboard.php') {
        sidebarItems.forEach(item => {
            if (item.classList.contains('default')) {
                item.classList.add('active');
                matched = true;
            }
        });
    }

    // Fallback to dashboard only if no match
    if (!matched) {
        sidebarItems.forEach(item => {
            if (item.classList.contains('default')) {
                item.classList.add('active');
            }
        });
    }

    document.documentElement.classList.remove('js-sidebar-initializing');
});


// Set page title
document.addEventListener("DOMContentLoaded", function() {
    const titleElement = document.getElementById('page-title');
    if (typeof pageTitle !== 'undefined' && titleElement) {
      titleElement.textContent = pageTitle;
    }
});