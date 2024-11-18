$(document).ready(function() {

    $('#loginForm').on('submit', function(e) {
    e.preventDefault();

    const email = $('#email').val().trim();
    const password = $('#password').val().trim();
    let isValid = true;

    // Clear previous toast messages {green,0}
    $('.toast').toast('dispose');

    // Validate Email
    if (email === "") {
        showToast('invalidMessage', 'The email field is empty');
        return;
    } else if (!validateEmail(email)) {
        showToast('warningMessage', 'The email is not valid');
        return;
    }

    // Validate Password{green,0}
    if (password === "") {
        showToast('invalidMessage', 'Password field is empty');
        isValid = false;
    } else if (password.length < 8) {
        showToast('warningMessage', 'Password must be at least 8 characters long');
        isValid = false;
    }

    // Proceed if all fields are valid{green,0}
    if (isValid) {
        $('#loadingScreen').removeClass('d-none');

        $.ajax({
            url: 'login_handler.php',
            type: 'POST',
            data: {
                email: email,
                password: password
            },
            success: function(response) {
                console.log('AJAX success response:', response);
                $('#loadingScreen').addClass('d-none'); 

                try {
                    const res = JSON.parse(response);
                    if (res.success) {
                        showToast('validMessage', 'Login successful!');
                            setTimeout(() => {
                                window.location.href = '/Emailing/dashboard/index.php';
                            }, 1000); // Redirect after 1 second
                    } else {
                        showToast('invalidMessage', res.message);
                    }
                } catch (error) {
                    console.error('Error parsing JSON response:', error);
                    showToast('invalidMessage', 'An unexpected error occurred.');
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX error:', error);
                $('#loadingScreen').addClass('d-none'); 
                showToast('invalidMessage', 'Cannot access server.');
                }
            });
        }
    });

    function validateEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    function showToast(toastId, message) {
        var toastElement = new bootstrap.Toast(document.getElementById(toastId));
        document.getElementById(toastId).querySelector('.toast-body').textContent = message;
        toastElement.show();
    }
});