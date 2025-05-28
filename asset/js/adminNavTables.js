function populateTickets(tickets) {
    // Clear all tables
    document.getElementById('pending-tickets').innerHTML = '';
    document.getElementById('ongoing-tickets').innerHTML = '';
    document.getElementById('completed-tickets').innerHTML = '';

    // Sort all tickets by date
    tickets.sort((a, b) => new Date(b.dateTime) - new Date(a.dateTime));

    // Loop through and append to correct table
    tickets.forEach(ticket => {
        const row = document.createElement('tr');

        const rowHTML = `
            <td>${ticket.ticketId}</td>
            <td>${ticket.dateTime}</td>
            <td>${ticket.branch}</td>
            <td>${ticket.issue}</td>
            <td>${ticket.assignedIT}</td>
            ${ticket.status !== 'Completed' ? `<td>${ticket.status}</td><td><a href="ticketDetails.php?id=${encodeURIComponent(ticket.ticketId)}" class="btn btn-sm btn-primary">View</a></td>` : ''}
        `;

        row.innerHTML = rowHTML;

        // Append to correct table
        if (ticket.status === 'Pending') {
            document.getElementById('pending-tickets').appendChild(row);
        } else if (ticket.status === 'Ongoing') {
            document.getElementById('ongoing-tickets').appendChild(row);
        } else if (ticket.status === 'Completed') {
            document.getElementById('completed-tickets').appendChild(row);
        }
    });
}
