$(document).ready(function() {
    // Function to show toast
    function showToast(toastId, message) {
        $('#' + toastId + ' .toast-body').text(message);
        $('#' + toastId).toast('show'); // Show the specified toast
    }

    // Image Upload Validation
    $('#image-upload').on('change', function() {
        let count = this.files.length;
        if (count > 10) {
            showToast('warningMessage', 'Maximum of 10 images only.');
            this.value = ''; // Reset the input
            $('#image-count').text(0);
        } else {
            $('#image-count').text(count);
        }
    });

    // Video Upload Validation
    $('#video-upload').on('change', function() {
        const file = this.files[0];
        if (file && file.size > 25 * 1024 * 1024) { // 25MB limit
            showToast('warningMessage', 'Video file size should not exceed 25MB.');
            this.value = ''; // Reset the input
            $('#video-count').text(0);
        } else {
            $('#video-count').text(file ? 1 : 0);
        }
    });

    // Document Upload Validation
    $('#document-upload').on('change', function() {
        let count = this.files.length;
        if (count > 10) {
            showToast('warningMessage', 'You can upload a maximum of 10 documents.');
            this.value = ''; // Reset the input
            $('#document-count').text(0);
        } else {
            $('#document-count').text(count);
        }
    });
});

// Initialize toast
$(document).ready(function () {
    $('.toast').toast({
        autohide: true,
        delay: 3000
    });
});