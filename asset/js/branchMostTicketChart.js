const ctx = document.getElementById('branchMostTicketChart').getContext('2d');
const branchMostTicketChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: ['Main', 'Satellite 1', 'Satellite 2'],
        datasets: [{
            label: 'Tickets by Branch',
            data: [10, 8, 7], // Replace with  actual data
            backgroundColor: [
                '#007bff',
                '#28a745',
                '#ffc107'
            ],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                display: true,
                position: 'bottom'
            },
            title: {
                display: true,
                text: 'Branches with Most Tickets'
            }
        }
    }
});