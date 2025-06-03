document.addEventListener('DOMContentLoaded', function() {
    // Get elements
    const notifToggle = document.getElementById('notifToggle');
    const dropdown = document.getElementById('notification-dropdown');
    const badge = document.getElementById('notification-badge');
    const filterBtns = document.querySelectorAll('.filter-btn');
    const notifItems = document.querySelectorAll('.notif-item');
    const emptyState = document.getElementById('empty-state');
    const emptyMessage = document.getElementById('empty-message');
    
    // Update badge count based on unread notifications
    function updateBadge() {
        const unreadCount = document.querySelectorAll('.notif-item.unread').length;
        if (unreadCount > 0) {
            badge.textContent = unreadCount;
            badge.style.display = 'flex';
        } else {
            badge.style.display = 'none';
        }
    }
    
    // Toggle dropdown visibility
    function toggleDropdown() {
        if (dropdown.classList.contains('hidden')) {
            // Show dropdown
            dropdown.classList.remove('hidden');
            setTimeout(() => dropdown.classList.add('show'), 10);
        } else {
            // Hide dropdown
            dropdown.classList.remove('show');
            setTimeout(() => dropdown.classList.add('hidden'), 200);
        }
    }
    
    // Close dropdown
    function closeDropdown() {
        dropdown.classList.remove('show');
        setTimeout(() => dropdown.classList.add('hidden'), 200);
    }
    
    // Show/hide empty state based on visible notifications
    function updateEmptyState(filter) {
        const visibleNotifs = Array.from(notifItems).filter(item => {
            return item.style.display !== 'none';
        });
        
        if (visibleNotifs.length === 0) {
            // Show empty state
            emptyState.style.display = 'block';
            emptyMessage.textContent = filter === 'unread' ? 'All caught up! 🎉' : 'No messages yet';
        } else {
            // Hide empty state
            emptyState.style.display = 'none';
        }
    }
    
    // Filter notifications with empty state handling
    function filterNotifications(filter) {
        notifItems.forEach(item => {
            if (filter === 'all') {
                item.style.display = 'block';
            } else if (filter === 'unread') {
                item.style.display = item.classList.contains('unread') ? 'block' : 'none';
            }
        });
        
        // Update empty state after filtering
        updateEmptyState(filter);
    }
    
    // Mark notification as read
    function markAsRead(item) {
        if (item.classList.contains('unread')) {
            item.classList.remove('unread');
            updateBadge();
            
            // Check if we need to update empty state for unread filter
            const activeFilter = document.querySelector('.filter-btn.active').getAttribute('data-filter');
            if (activeFilter === 'unread') {
                // Hide this item since it's no longer unread
                item.style.display = 'none';
                updateEmptyState('unread');
            }
        }
    }
    
    // Event Listeners
    // Toggle dropdown on bell click
    notifToggle.addEventListener('click', function(e) {
        e.stopPropagation();
        toggleDropdown();
    });
    
    // Close dropdown when clicking outside
    document.addEventListener('click', function(e) {
        if (!notifToggle.contains(e.target) && !dropdown.contains(e.target)) {
            closeDropdown();
        }
    });
    
    // Prevent dropdown close when clicking inside
    dropdown.addEventListener('click', function(e) {
        e.stopPropagation();
    });
    
    // Filter button functionality
    filterBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            // Remove active class from all buttons
            filterBtns.forEach(b => b.classList.remove('active'));
            // Add active class to clicked button
            this.classList.add('active');
            // Filter notifications
            const filter = this.getAttribute('data-filter');
            filterNotifications(filter);
        });
    });
    
    // Click notification to mark as read
    notifItems.forEach(item => {
        item.addEventListener('click', function() {
            markAsRead(this);
        });
    });
    
    // Initialize badge count and empty state
    updateBadge();
    updateEmptyState('all'); // Start with 'all' filter active
});