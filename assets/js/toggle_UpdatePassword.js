$(document).ready(function(){
    $('#toggleCurrentPassword').on('click', function() {
        // Toggle the password input type
        const passwordInput = $('#currentPassword');
        const type = passwordInput.attr('type') === 'password' ? 'text' : 'password';
        passwordInput.attr('type', type);
        
        // Toggle the eye icon
        $(this).toggleClass('fa-eye fa-eye-slash');
    });

    $('#toggleNewPassword').on('click', function() {
        // Toggle the confirm password input type
        const confirmPasswordInput = $('#newPassword');
        const type = confirmPasswordInput.attr('type') === 'password' ? 'text' : 'password';
        confirmPasswordInput.attr('type', type);
        
        // Toggle the eye icon
        $(this).toggleClass('fa-eye fa-eye-slash');
    });
});