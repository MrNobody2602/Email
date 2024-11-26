$(document).ready(function () {
    $('#updateProfileForm').submit(function (e) {
        e.preventDefault(); // Prevent default form submission

        const formData = new FormData(this);

        $.ajax({
            url: '../dashboardFunctions/update_profile.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            timeout: 5000,
            beforeSend: function () {
                $('#loadingScreen').removeClass('d-none');
            },
            success: function (response) {
                $('#loadingScreen').addClass('d-none');

                // Parse the response
                const res = JSON.parse(response);
                if (res.type === 'success') {
                    showToast('validProfileMessage', res.message);

                    // Optional: Reload page or redirect after success
                    setTimeout(function () {
                        location.reload();
                    }, 2000);
                } else {
                    showToast('invalidProfileMessage', res.message);
                }
            },
            error: function (xhr, status, error) {
                $('#loadingScreen').addClass('d-none');
                if (status === "timeout") {
                    showToast('invalidProfileMessage', 'Request timed out. Please try again.');
                } else {
                    showToast('invalidProfileMessage', 'An error occurred: ' + error);
                }
            }
        });
    });
});

// Toast Notification Function
function showToast(toastId, message) {
    const toastElement = $(`#${toastId}`);
    toastElement.find('.toast-body').text(message);
    const bootstrapToast = new bootstrap.Toast(toastElement[0]);
    bootstrapToast.show();
}