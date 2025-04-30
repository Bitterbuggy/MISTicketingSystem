// Sidebar toggle
document.getElementById('sidebarCollapse')?.addEventListener('click', function () {
    document.getElementById('sidebar').classList.toggle('collapsed');
    document.getElementById('body')?.classList.toggle('collapsed');
});

// New smarter active sidebar highlighter
const sidebarItems = document.querySelectorAll('.sidebar-item');

sidebarItems.forEach(item => {
    const link = item.querySelector('a');
    if (link) {
        const href = link.getAttribute('href');
        const currentPage = window.location.pathname.split('/').pop();
        
        if (href === currentPage) {
            item.classList.add('active');
        } else {
            item.classList.remove('active');
        }
    }
});

// Set page title
document.addEventListener("DOMContentLoaded", function() {
    const titleElement = document.getElementById('page-title');
    if (typeof pageTitle !== 'undefined' && titleElement) {
      titleElement.textContent = pageTitle;
    }
});