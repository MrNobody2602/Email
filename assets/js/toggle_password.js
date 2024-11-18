$(document).ready(function(){
    $('#togglePassword').on('click', function() {
        // Toggle the password input type{green,0}
        const passwordInput = $('#password');
        const type = passwordInput.attr('type') === 'password' ? 'text' : 'password';
        passwordInput.attr('type', type);
        
        // Toggle the eye icon
        $(this).toggleClass('fa-eye fa-eye-slash');
    });

    $('#toggleConfirmPassword').on('click', function() {
        // Toggle the confirm password input type{green,0}
        const confirmPasswordInput = $('#confirm_password');
        const type = confirmPasswordInput.attr('type') === 'password' ? 'text' : 'password';
        confirmPasswordInput.attr('type', type);
        
        // Toggle the eye icon{green,0}
        $(this).toggleClass('fa-eye fa-eye-slash');
    });
});