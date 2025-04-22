document.addEventListener("DOMContentLoaded", function () {
  // Greeting based on time of day
  function updateGreeting() {
    const greetingEl = document.getElementById("greeting");
    if (!greetingEl) return; // Check if the element exists before updating

    const now = new Date();
    const hour = now.getHours();
    let greetingText = "Welcome back";
    let icon = "👋";

    if (hour >= 5 && hour < 12) {
      greetingText = "Good morning";
      icon = "☀️";
    } else if (hour >= 12 && hour < 18) {
      greetingText = "Good afternoon";
      icon = "🌤️";
    } else if (hour >= 18 && hour < 24) {
      greetingText = "Good evening";
      icon = "🌙";
    }

      greetingEl.textContent = `${greetingText} ${icon} `;
      greetingText = greetingText.replace() + " " + icon;
  }

  // Live date and time
  function updateTime() {
    const now = new Date();
    const hours = now.getHours().toString().padStart(2, '0');
    const minutes = now.getMinutes().toString().padStart(2, '0');
    const seconds = now.getSeconds().toString().padStart(2, '0');
    const time = `${hours}:${minutes}:${seconds}`;

    const weekday = now.toLocaleDateString('en-US', { weekday: 'long' });
    const fullDate = now.toLocaleDateString('en-US', {
      year: 'numeric',
      month: 'long',
      day: 'numeric'
    });

    // Update live time and date
    document.getElementById('live-date-line1').textContent = weekday;
    document.getElementById('live-date-line2').textContent = fullDate;
    document.getElementById('live-time').innerText = time;
  }

  // Update time and greeting every second
  setInterval(updateTime, 1000);
  setInterval(updateGreeting, 1000);
  updateTime(); // Run immediately to show the initial time and date
  updateGreeting(); // Run immediately to show the initial greeting
});