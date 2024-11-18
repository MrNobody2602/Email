$(document).ready(function() {
    // Function to show success toast
    function showSuccessToast(message) {
        $('#validMessage .valid-toast-body').text(message);
        $('#validMessage').toast('show');
    }

    // Function to show error toast
    function showErrorToast(message) {
        $('#invalidMessage .invalid-toast-body').text(message);
        $('#invalidMessage').toast('show');
    }

    // Check for the presence of the showToastMessage variable passed from PHP
    if (typeof showToastMessage !== 'undefined') {
        if (showToastMessage.success) {
            showSuccessToast(showToastMessage.success);
        }
        if (showToastMessage.error) {
            showErrorToast(showToastMessage.error);
        }
    }
});
