// Populates the table for all tickets
function populateRepairTickets() {
    const tbody = document.getElementById("tblRepairTickets");
    tbody.innerHTML = "";

tickets.forEach(ticket => {
    const row = document.createElement("tr");

    // Check condition for assigned IT
    const assignedIT = (ticket.status === "Pending" || ticket.status === "Cancelled") ? "-" : ticket.assigned;

    row.innerHTML = `
    <td>${ticket.submittedAt}</td>
    <td style="text-align:center;">${ticket.id}</td>
    <td style="text-align:center;">${ticket.type}</td>
    <td>${ticket.branch}</td>
    <td>${assignedIT}</td>
    <td style="text-align:center;">${ticket.status}</td>
    `;

    tbody.appendChild(row);
});
}

// Populates the table for completed tickets
document.addEventListener("DOMContentLoaded", function () {
const tbody = document.getElementById("tblCompletedTickets");

completedTickets.forEach(ticket => {
    const row = document.createElement("tr");
    row.innerHTML = `
    <td style="text-align:center;">${ticket.submittedAt}</td>
    <td style="text-align:center;">${ticket.id}</td>
    <td style="text-align:center;">${ticket.type}</td>
    <td style="text-align:center;">${ticket.branch}</td>
    <td style="text-align:center;">${ticket.assignedIT}</td>
    `;
    tbody.appendChild(row);
});
});

// Populates the table for archived tickets
document.addEventListener("DOMContentLoaded", function () {
const tbody = document.getElementById("tblTicketArchive");

archiveTickets.forEach(ticket => {
    const row = document.createElement("tr");
    row.innerHTML = `
    <td style="text-align:center;">${ticket.submittedAt}</td>
    <td style="text-align:center;">${ticket.id}</td>
    <td style="text-align:center;">${ticket.type}</td>
    <td style="text-align:center;">${ticket.branch}</td>
    <td style="text-align:center;">${ticket.assignedIT}</td>
    `;
    tbody.appendChild(row);
});
});

populateTable();
populateCompletedTickets(completedTickets);
populateArchivedTickets(archiveTickets);