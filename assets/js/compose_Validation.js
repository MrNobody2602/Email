$(document).ready(function(){
    $('#composeForm').on('submit', function(e){
        e.preventDefault();

        const sender = $('#sender').val().trim();
        const recipient = $('#recipient').val().trim();
        const subject = $('#subject').val().trim();
        const message = $('#compMessage').val().trim();
        
        $('.toast').toast('dispose');

        if(recipient === ""){
            showToast('invalidMessage', 'There must be a recipient!');
            return;
        } else if (!validateEmail(recipient)) {
            showToast('warningMessage', "The recipient's email is not valid");
            return;
        } else if (recipient == sender){
            showToast('invalidMessage', 'You cannot send a message to yourself');
            return;
        }

        if(subject === ""){
            showToast('invalidMessage', 'Subject is required');
            return;
        }

        // Show loading screen
        $('#loadingScreen').removeClass('d-none');

        // Prepare the form data
        const formData = new FormData($('#composeForm')[0]);
        setTimeout(function() {

            $.ajax({
                url: '../dashboardFunctions/send_email.php',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                timeout: 3000,
                success: function(response) {
                    $('#loadingScreen').addClass('d-none'); 
                    if (response.includes('Email sent successfully!')) {
                        showToast('validMessage', 'Email sent successfully!');
                        
                        setTimeout(function(){
                            window.location.href = '?page=sent'; 
                        }, 2000);
                    } else {
                        showToast('invalidMessage', response);
                    }
                },
                error: function(xhr, status, error) {
                    $('#loadingScreen').addClass('d-none');
                    if (status === "timeout") {
                        showToast('invalidMessage', 'Request timed out. Please try again.');
                    } else {
                        showToast('invalidMessage', 'An error occurred: ' + error);
                    }
                }
            });
        }, 2000);
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
