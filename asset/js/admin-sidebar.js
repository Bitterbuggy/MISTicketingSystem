// Sidebar toggle
document.getElementById('sidebarCollapse')?.addEventListener('click', function () {
    document.getElementById('sidebar').classList.toggle('collapsed');
    document.getElementById('body')?.classList.toggle('collapsed');
});

// Active sidebar highlighter
document.addEventListener('DOMContentLoaded', function() {
    const sidebarItems = document.querySelectorAll('.sidebar-item');
    const currentPage = window.location.pathname.split('/').pop(); // get current filename

    let matched = false;

    sidebarItems.forEach(item => {
        const link = item.querySelector('a');
        if (link) {
            const hrefPage = link.getAttribute('href').split('/').pop();
            if (currentPage === hrefPage) {
                sidebarItems.forEach(i => i.classList.remove('active')); // Remove active from all
                item.classList.add('active'); // Set active to matched link
                matched = true;
            }
        }
    });

    // If NO match found, keep the default active (Dashboard)
    if (!matched) {
        document.querySelector('.sidebar-item.default')?.classList.add('active');
    }
});

// Set page title
document.addEventListener("DOMContentLoaded", function() {
    const titleElement = document.getElementById('page-title');
    if (typeof pageTitle !== 'undefined' && titleElement) {
      titleElement.textContent = pageTitle;
    }
});