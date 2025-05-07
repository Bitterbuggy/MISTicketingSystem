// Sidebar toggle
document.getElementById('sidebarCollapse')?.addEventListener('click', function () {
    document.getElementById('sidebar').classList.toggle('collapsed');
    document.getElementById('body')?.classList.toggle('collapsed');
});

// Active sidebar highlighter
document.addEventListener('DOMContentLoaded', function () {
    const sidebarItems = document.querySelectorAll('.sidebar-item');
    const currentPage = window.location.pathname.split('/').pop().split('?')[0]; // Get the file name only
    let matched = false;

    // Remove active from all
    sidebarItems.forEach(item => item.classList.remove('active'));

    // Ticket pages
    const ticketsPages = ['adminTicketMgmt.php', 'adminCompletedTickets.php', 'adminArchivedTickets.php'];
    if (ticketsPages.includes(currentPage)) {
        sidebarItems.forEach(item => {
            const link = item.querySelector('a');
            if (link && link.getAttribute('href').endsWith('adminTicketMgmt.php')) {
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
            if (link && link.getAttribute('href').endsWith('adminAssetMgmt.php')) {
                item.classList.add('active');
                matched = true;
            }
        });
    }

    // Staff page
    else if (currentPage === 'adminStaffMgmt.php') {
        sidebarItems.forEach(item => {
            const link = item.querySelector('a');
            if (link && link.getAttribute('href').endsWith('adminStaffMgmt.php')) {
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
            if (link && link.getAttribute('href').endsWith('adminBranchMgmt.php')) {
                item.classList.add('active');
                matched = true;
            }
        });
    }

    // Activity Logs
    else if (currentPage === 'activityLogs.php') {
        sidebarItems.forEach(item => {
            const link = item.querySelector('a');
            if (link && link.getAttribute('href').endsWith('activityLogs.php')) {
                item.classList.add('active');
                matched = true;
            }
        });
    }

    // Dashboard
    else if (currentPage === 'admindashboard.php') {
        sidebarItems.forEach(item => {
            const link = item.querySelector('a');
            if (link && link.getAttribute('href').endsWith('admindashboard.php')) {
                item.classList.add('active');
                matched = true;
            }
        });
    }

    // Fallback
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