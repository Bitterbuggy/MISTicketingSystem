document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('verify-otp-form');
    const otpInput = document.getElementById('otp');
    const errorDiv = document.getElementById('error-message');
    const resendBtn = document.getElementById('resend-otp-btn');
    const timerSpan = document.getElementById('timer');

    let timer = 60;
    let countdown;

    function startTimer() {
        resendBtn.disabled = true;
        let timeLeft = 60;
    
        resendBtn.innerHTML = `Send Another Code (<span id="timer">${timeLeft}</span>s)`;
    
        const interval = setInterval(() => {
            timeLeft--;
            const timerSpan = resendBtn.querySelector('#timer');
            if (timerSpan) timerSpan.textContent = timeLeft;
    
            if (timeLeft <= 0) {
                clearInterval(interval);
                resendBtn.disabled = false;
                resendBtn.innerHTML = "Send Another Code";
            }
        }, 1000);
    }
    
    startTimer(); // Start immediately when page loads

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        const otp = otpInput.value.trim();

        fetch('verify-otp.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: new URLSearchParams({ otp: otp })
        })
        .then(res => res.json())
        .then(data => {
            if (data.status === 'success') {
                window.location.href = '../auth/reset-password.php'; // ✅ Correct file name
            } else {
                errorDiv.style.display = 'block';
                errorDiv.textContent = data.message;
            }
        })
        .catch(err => {
            console.error('Error:', err);
            errorDiv.style.display = 'block';
            errorDiv.textContent = "Something went wrong.";
        });
    });

    // Optional resend OTP feature
    resendBtn.addEventListener('click', function (e) {
        e.preventDefault();

        fetch('resend-otp.php', { method: 'POST' })
        .then(res => res.json())
        .then(data => {
            if (data.status === 'resent') {
                alert('A new OTP has been sent to your email.');
                resendBtn.innerHTML = 'Send Another Code (<span id="timer">60</span>s)';
                timerSpan.textContent = '60';
                startTimer();
            } else {
                alert('Failed to resend OTP. Try again later.');
            }
        })
        .catch(err => {
            console.error(err);
            alert('Error resending OTP.');
        });
    });
});
