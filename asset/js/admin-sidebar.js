// Sidebar toggle
document.getElementById('sidebarCollapse').addEventListener('click', function () {
    document.getElementById('sidebar').classList.toggle('collapsed');
    document.getElementById('body')?.classList.toggle('collapsed');
});

// Active sidebar item switching
const sidebarLinks = document.querySelectorAll('.sidebar-item');

sidebarLinks.forEach(link => {
    link.addEventListener('click', function () {
        // Remove .active from all
        sidebarLinks.forEach(item => item.classList.remove('active'));
        // Add .active to clicked
        this.classList.add('active');
    });
});
