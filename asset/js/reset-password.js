const passwordInput = document.getElementById('new_password');
    const strengthText = document.getElementById('password-strength-text');

    passwordInput.addEventListener('input', function () {
        const value = passwordInput.value;

        if (value === '') {
            strengthText.textContent = '';
            return;
        }

        const strength = getPasswordStrength(value);
        strengthText.textContent = strength.text;
        strengthText.style.color = strength.color;
    });

    function getPasswordStrength(password) {
        let strength = 0;

        if (password.length >= 6) strength++;
        if (password.match(/[a-z]/) && password.match(/[A-Z]/)) strength++;
        if (password.match(/[0-9]/)) strength++;
        if (password.match(/[^a-zA-Z0-9]/)) strength++;

        if (strength <= 1) {
            return { text: 'Weak password', color: 'red' };
        } else if (strength === 2 || strength === 3) {
            return { text: 'Medium password', color: 'orange' };
        } else {
            return { text: 'Strong password', color: 'green' };
        }
    }