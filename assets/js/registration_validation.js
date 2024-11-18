$(document).ready(function(){
    var maxChars = 50;

    // Update character count and limit for the username field{green,0}
    $('#username').on('input', function () {
        var currentText = $(this).val();
        var charCount = currentText.length;

        if (charCount > maxChars) {
            
            $(this).val(currentText.substring(0, maxChars));
            charCount = maxChars;
        }

        $('#usernameCount').text(charCount + '/' + maxChars + ' characters');
    });

    // PASS STRENGTH INDICATOR {green, 0}
    $('#password').on('input', function () {
        var password = $(this).val();
        var strength = checkPasswordStrength(password);

        $('#passwordStrength').text('Password Strength: ' + strength.label);
        $('#passwordStrength').removeClass('weak strong very-strong').addClass(strength.class);
    });

    function checkPasswordStrength(password) {
        var strength = {
            label: 'Weak',
            class: 'weak'
        };

        var regexWeak = /[a-z]/;
        var regexStrong = /(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])/;
        var regexVeryStrong = /(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[\W])/;

        if (password.length >= 8 && regexVeryStrong.test(password)) {
            strength = {
                label: 'Very Strong',
                class: 'very-strong'
            };
        } else if (password.length >= 6 && regexStrong.test(password)) {
            strength = {
                label: 'Strong',
                class: 'strong'
            };
        }

        return strength;
    }

    // INPUT FIELD VALIDATIONS{green,0}
    $('#registrationForm').on('submit', function(e){
        e.preventDefault();

        const username = $('#username').val().trim();
        const email = $('#email').val().trim();
        const password = $('#password').val().trim();
        const confirmPassword = $('#confirm_password').val().trim();

        let isValid = true;

        // Clear previous toast messages{green,0}
        $('.toast').toast('dispose');

        // Validate Username{green,0}
        if (username === "") {
            showToast('invalidMessage', 'The username field is empty');
            isValid = false;
        }

        // Validate Email{green,0}
        if (isValid && email === "") {
            showToast('invalidMessage', 'The email field is empty');
            isValid = false;
        } else if (isValid && !validateEmail(email)) {
            showToast('warningMessage', 'The email is not valid');
            isValid = false;
        }

        // Validate Password{green,0}
        if (isValid && password === "") {
            showToast('invalidMessage', 'Password field is empty');
            isValid = false;
        } else if (isValid && password.length < 8) {
            showToast('warningMessage', 'Password must be at least 8 characters long');
            isValid = false;
        }

        // Validate Confirm Password{green,0}
        if (isValid && confirmPassword === "") {
            showToast('invalidMessage', 'Confirm password field is empty');
            isValid = false;
        } else if (isValid && confirmPassword !== password) {
            showToast('warningMessage', 'Passwords do not match');
            isValid = false;
        }

        // shows valid messages if fields are valid{green,0}
        if (isValid) {
            $.ajax({
                url: 'connection/register.php',
                type: 'POST',
                data: {
                    username: username,
                    email: email,
                    password: password
                },
                success: function(response) {
                    var res = JSON.parse(response);
                    if (res.success) {
                        showToast('validMessage', 'Successfully Registered!');
                        $('#loadingScreen').removeClass('d-none');

                        setTimeout(function() {
                            window.location.href = 'login.php';
                        }, 3000);
                    } else {
                        showToast('invalidMessage', res.message);
                    }
                }
            });
        }
    });

    // show toast message{green,0}
    function showToast(toastId, message) {
        var toastElement = new bootstrap.Toast($('#' + toastId));
        $('#' + toastId + ' .toast-body').text(message);
        toastElement.show();
    }

    // validate email format{green,0}
    function validateEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }
});