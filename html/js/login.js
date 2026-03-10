
// Modal functionality
document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('login-modal');
    const loginLink = document.getElementById('login-link');
    const closeBtn = document.querySelector('.close');

    loginLink.addEventListener('click', (e) => {
        e.preventDefault();
        modal.style.display = 'block';
    });

    closeBtn.addEventListener('click', () => {
        modal.style.display = 'none';
    });

    window.addEventListener('click', (e) => {
        if (e.target === modal) {
            modal.style.display = 'none';
        }
    });

    document.getElementById('login-form').addEventListener('submit', async (e) => {
        e.preventDefault();
        const username = document.getElementById('username').value;
        const password = document.getElementById('password').value;

        const formData = new FormData();
        formData.append('username', username);
        formData.append('password', password);

        console.log('Attempting login with:', formData.get('username'), formData.get('password'));
        
        try {
            const response = await fetch('login.php', {
                method: 'POST',
                body: formData
            });
            const text = await response.text();
            console.log('Response text:', text);
            const result = JSON.parse(text);

            if (result.success) {
                alert(result.message);
                modal.style.display = 'none';
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