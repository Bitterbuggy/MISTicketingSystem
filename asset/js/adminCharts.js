// Donut Chart: Branches with Most Tickets
const donutCtx = document.getElementById('branchMostTicketChart').getContext('2d');
new Chart(donutCtx, {
type: 'doughnut',
data: {
    labels: ['Main Branch', 'Branch A', 'Branch B', 'Branch C'],
    datasets: [{
    data: [30, 15, 25, 10],
    backgroundColor: ['#007bff', '#28a745', '#ffc107', '#dc3545'],
    borderRadius: 5,
    hoverOffset: 8
    }]
},

options: {
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
    legend: {
        position: 'bottom',
        padding: {
            top: 18,
            bottom: 5,
            left: 0,
            right: 0
        },
        font: {
            size: 12,
            family: "Inter"
        }
    },
    title: {
        display: true,
        text: "Branches with Most Tickets",
        position: 'top',
        align: 'center',
        font: {
            size: 20,
            family: 'Inter',
            weight: 'bold'
        },
        padding: {
            top: 5,
            bottom: 12,
            left: 0,
            right: 0
            }
        }
    }
}
// Donut Chart: Branches with Most Tickets
const donutCtx = document.getElementById('branchMostTicketChart').getContext('2d');
new Chart(donutCtx, {
type: 'doughnut',
data: {
    labels: ['Main Branch', 'Branch A', 'Branch B', 'Branch C'],
    datasets: [{
    data: [30, 15, 25, 10],
    backgroundColor: ['#007bff', '#28a745', '#ffc107', '#dc3545'],
    borderRadius: 5,
    hoverOffset: 8
    }]
},

options: {
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
    legend: {
        position: 'bottom',
        padding: {
            top: 18,
            bottom: 5,
            left: 0,
            right: 0
        },
        font: {
            size: 12,
            family: "Inter"
        }
    },
    title: {
        display: true,
        text: "Branches with Most Tickets",
        position: 'top',
        align: 'center',
        font: {
            size: 20,
            family: 'Inter',
            weight: 'bold'
        },
        padding: {
            top: 5,
            bottom: 12,
            left: 0,
            right: 0
            }
        }
    }
}
});

// Chart 2: Software Issues
const ctx2 = document.getElementById('mostSoftwareIssueChart').getContext('2d');
const gradient2 = [
    createGradient(ctx2, '#00c6ff', '#0072ff'),  // Light to deep blue
    createGradient(ctx2, '#f7971e', '#ffd200'),  // Orange to yellow
    createGradient(ctx2, '#43cea2', '#185a9d')   // Green to blue
];

new Chart(ctx2, {
    type: 'doughnut',
    data: {
        labels: ['OS Errors', 'App Crashes', 'Licensing'],
        datasets: [{
            data: [12, 5, 3],
            backgroundColor: gradient2,
            borderWidth: 0,
            borderRadius: 10
        }]
    },
    options: getOptions('Top Software Issues')
});

// Chart 3: Hardware Issues
const ctx3 = document.getElementById('mostHardwareIssueChart').getContext('2d');
const gradient3 = [
    createGradient(ctx3, '#ff6a00', '#ee0979'),  // Orange to pink
    createGradient(ctx3, '#2193b0', '#6dd5ed'),  // Blue gradient
    createGradient(ctx3, '#a1c4fd', '#c2e9fb')   // Soft blue tones
];

new Chart(ctx3, {
    type: 'doughnut',
    data: {
        labels: ['Monitors', 'CPUs', 'Printers'],
        datasets: [{
            data: [9, 7, 4],
            backgroundColor: gradient3,
            borderWidth: 0,
            borderRadius: 10
        }]
    },
    options: getOptions('Top Hardware Issues')
});
