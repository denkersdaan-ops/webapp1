
// Modal functionality
document.addEventListener('DOMContentLoaded', () => {
    const loginModal = document.getElementById('login-modal');
    const loginLink = document.getElementById('login-link');
    const closeBtn = document.querySelector('.close');

    loginLink.addEventListener('click', (e) => {
        e.preventDefault();
        loginModal.style.display = 'block';
    });

    closeBtn.addEventListener('click', () => {
        loginModal.style.display = 'none';
    });

    window.addEventListener('click', (e) => {
        if (e.target === loginModal) {
            loginModal.style.display = 'none';
        }
    });

    document.getElementById('login-form').addEventListener('submit', async (e) => {
        e.preventDefault();
        const username = document.getElementById('username').value.trim();
        const password = document.getElementById('password').value.trim();

        console.log('Username:', username, 'Password:', password);

        if (!username || !password) {
            alert('Please fill in all fields');
            return;
        }

        const formData = new URLSearchParams();
        formData.append('name', username);
        formData.append('password', password);

        console.log('Sending data:', formData.toString());

        try {
            const response = await fetch('php/login.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: formData,
            });
            const text = await response.text();
            console.log('Response text:', text);
            const result = JSON.parse(text);

            if (result.success) {
                alert(result.message);
                loginModal.style.display = 'none';
                // Optionally redirect or update UI
                location.reload(); // Refresh to update login state
            } else {
                alert(result.message);
            }
        } catch (error) {
            alert('Fout bij inloggen: ' + error.message);
        }
    });
});


// Register modal logic: only add submit listener once
document.addEventListener('DOMContentLoaded', () => {
    const registerModal = document.getElementById('register-modal');
    const registerForm = document.getElementById('register-form');
    const closeBtn = registerModal.querySelector('.close');

    // Show modal function
    window.register = function() {
        registerModal.style.display = 'block';
    };

    closeBtn.addEventListener('click', () => {
        registerModal.style.display = 'none';
    });

    document.addEventListener('click', (e) => {
        if (e.target === registerModal) {
            registerModal.style.display = 'none';
        }
    });

    // Only add submit listener once
    registerForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const username = document.getElementById('register-username').value.trim();
        const password = document.getElementById('register-password').value.trim();
        const verifypassword = document.getElementById('verify-password').value.trim();
        const isAdmin = document.getElementById('isAdmin').checked;

        if (!username || !password || !verifypassword) {
            alert('Please fill in all fields');
            return;
        }

        if (password !== verifypassword) {
            alert('Passwords do not match');
            return;
        }

        const formData = new URLSearchParams();
        formData.append('name', username);
        formData.append('password', password);
        formData.append('isAdmin', isAdmin);

        try {
            const response = await fetch('php/register.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: formData,
            });
            const text = await response.text();
            const result = JSON.parse(text);

            if (result.success) {
                alert(result.message);
                registerModal.style.display = 'none';
            } else {
                alert(result.message);
            }
        } catch (error) {
            alert('Fout bij registreren: ' + error.message);
        }
    });
});

