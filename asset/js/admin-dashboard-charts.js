// Register plugin for center text
Chart.register({
    id: 'centerText',
    beforeDraw(chart) {
        const { width, height } = chart;
        const ctx = chart.ctx;
        ctx.restore();
        const fontSize = (height / 140).toFixed(2);
        ctx.font = `${fontSize}em Inter, sans-serif`;
        ctx.textBaseline = 'middle';
        ctx.fillStyle = '#aaa';
        const text = '';
        const textX = Math.round((width - ctx.measureText(text).width) / 2);
        const textY = height / 2;
        ctx.fillText(text, textX, textY);
        ctx.save();
    }
});

// Function to create gradients
function createGradient(ctx, color1, color2) {
    const gradient = ctx.createLinearGradient(0, 0, 200, 200);
    gradient.addColorStop(0, color1);
    gradient.addColorStop(1, color2);
    return gradient;
}

// Shared chart options
function getOptions(title) {
    return {
        responsive: true,
        cutout: '65%',
        borderRadius: 10,
        plugins: {
            legend: { display: false },
            title: {
                display: true,
                text: title,
                padding: { top: 10, bottom: 20 },
                font: { size: 18, weight: 'bold', family: "'Inter', sans-serif" }
            },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        return `${context.label}: ${context.raw}`;
                    }
                }
            }
        }
    };
}

// Chart 1: Branch Most Tickets
const ctx1 = document.getElementById('branchMostTicketChart').getContext('2d');
const gradient1 = [
    createGradient(ctx1, '#ff7e5f', '#feb47b'),  // Red-Orange
    createGradient(ctx1, '#f9d423', '#ff4e50'),  // Yellow-Red
    createGradient(ctx1, '#24c6dc', '#514a9d')   // Blue-Purple
];

new Chart(ctx1, {
    type: 'doughnut',
    data: {
        labels: ['Main', 'Satellite 1', 'Satellite 2'],
        datasets: [{
            data: [10, 8, 7],
            backgroundColor: gradient1,
            borderWidth: 0,
            borderRadius: 10
        }]
    },
    options: getOptions('Top Branches')
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
    options: getOptions('Software Issues')
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
    options: getOptions('Hardware Issues')
});
