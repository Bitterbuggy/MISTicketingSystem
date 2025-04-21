document.getElementById('verify-otp-form').addEventListener('submit', function (e) {
    e.preventDefault();

    const otp = document.getElementById('otp').value;

    fetch('verify-otp-handler.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `otp=${encodeURIComponent(otp)}`
    })
    .then(response => response.json())
    .then(data => {
        console.log(data);  // Check the server response for debugging
        const errorDiv = document.getElementById('error-message');
        if (data.status === 'success') {
            window.location.href = '../auth/reset-password.php'; // redirect to reset page
        } else {
            errorDiv.style.display = 'block';
            errorDiv.innerText = data.message;
        }
    });
});