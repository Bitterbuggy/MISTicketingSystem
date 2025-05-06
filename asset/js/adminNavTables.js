// Function to populate the table for pending tickets
function populatePendingTickets(tickets) {
    const tbody = document.getElementById('pending-tickets');
    tbody.innerHTML = ''; // Clear existing rows

    // Sort tickets by date
    tickets.sort((a, b) => new Date(b.dateTime) - new Date(a.dateTime));

    // Get the last 5 tickets
    const recentTickets = tickets.slice(0, 5);

    recentTickets.forEach(ticket => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${ticket.dateTime}</td>
            <td>${ticket.ticketId}</td>
            <td>${ticket.branch}</td>
            <td>${ticket.issue}</td>
            <td>${ticket.assignedIT}</td>
        `;
        tbody.appendChild(row);
    });
}

// Function to populate the table for ongoing tickets
function populateOngoingTickets(tickets) {
    const tbody = document.getElementById('ongoing-tickets');
    tbody.innerHTML = ''; // Clear existing rows

    // Sort tickets by date (assuming dateTime is in a sortable format)
    tickets.sort((a, b) => new Date(b.dateTime) - new Date(a.dateTime));

    // Get the last 5 tickets
    const recentTickets = tickets.slice(0, 5);

    recentTickets.forEach(ticket => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${ticket.ticketId}</td>
            <td>${ticket.issue}</td>
            <td>${ticket.branch}</td>
            <td>${ticket.assignedIT}</td>
            <td>${ticket.dateTime}</td>
        `;
        tbody.appendChild(row);
    });
}

// Function to populate the table for completed tickets
function populateCompletedTickets(tickets) {
    const tbody = document.getElementById('completed-tickets');
    tbody.innerHTML = ''; // Clear existing rows

    // Sort tickets by date
    tickets.sort((a, b) => new Date(b.dateTime) - new Date(a.dateTime));

    // Get the last 5 tickets
    const recentTickets = tickets.slice(0, 5);

    recentTickets.forEach(ticket => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${ticket.ticketId}</td>
            <td>${ticket.issue}</td>
            <td>${ticket.branch}</td>
            <td>${ticket.assignedIT}</td>
            <td>${ticket.dateTime}</td>
        `;
        tbody.appendChild(row);
    });
}