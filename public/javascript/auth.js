document.getElementById('loginForm').addEventListener('submit', function(event) {
event.preventDefault();

let form = event.target;
let formData = new FormData(form);

fetch('/auth/login', {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
            'Accept': 'application/json'
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok: ' + response.statusText);
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            localStorage.setItem('user', JSON.stringify(data.user));
            window.location.href = '/dashboard';
        } else {
            alert(data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('There was a problem with the login request: ' + error.message);
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const user = localStorage.getItem('user');
    const currentPath = window.location.pathname;

    // Check if the user check has been performed in this session
    const checkPerformed = sessionStorage.getItem('checkPerformed');

    if (!checkPerformed) {
        if (user) {
            console.log('User is logged in:', JSON.parse(user));
            if (currentPath !== '/dashboard') {
                window.location.href = '/dashboard';
            }
        } else {
            console.log('User is not logged in');
            if (currentPath !== '/') {
                window.location.href = '/';
            }
        }

        // Set the flag to indicate the check has been performed
        sessionStorage.setItem('checkPerformed', 'true');
    }
});
