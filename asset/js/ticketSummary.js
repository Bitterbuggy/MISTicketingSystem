// ticketCounts.js

function fetchTicketCounts() {
    fetch('api/ticket-counts.php') // Change this to your actual API route
      .then(response => response.json())
      .then(data => {
        document.getElementById('pending-count').innerText = data.pending;
        document.getElementById('ongoing-count').innerText = data.ongoing;
        document.getElementById('completed-count').innerText = data.completed;
        document.getElementById('total-count').innerText = data.total;
      })
      .catch(error => console.error('Error fetching ticket counts:', error));
  }
  
  // Fetch immediately when page loads
  fetchTicketCounts();
  
  // Auto-refresh every 10 seconds
  setInterval(fetchTicketCounts, 10000);
  