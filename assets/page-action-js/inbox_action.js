function changeStatus(emailId, status) {
    const formData = new FormData();
    formData.append('id', emailId);
    formData.append('status', status);

    $('#loadingScreen').removeClass('d-none');

    var minDelay = 1000;
    var startTime = Date.now();

    fetch('../dashboardFunctions/update_status.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {

        var elapsedTime = Date.now() - startTime;

        var remainingTime = minDelay - elapsedTime;
        if (remainingTime > 0) {

            setTimeout(function() {
                $('#loadingScreen').addClass('d-none');
                handleResponse(data);
            }, remainingTime);
        } else {
            
            $('#loadingScreen').addClass('d-none');
            handleResponse(data);
        }
    })
    .catch(error => {
        // Handle the error case
        $('#loadingScreen').addClass('d-none');
        $('#invalidMessage .toast-body').text('Error: Failed to communicate with the server.');
        $('#invalidMessage').toast('show');
    });
}

function handleResponse(data) {
    if (data.status === 'success') {
        $('#validMessage .toast-body').text(data.message);
        $('#validMessage').toast('show');

        setTimeout(function() {
            if (data.new_status === 'trash') {
                window.location.href = '?page=trash';
            } else if (data.new_status === 'archive') {
                window.location.href = '?page=archive';
            }
        }, 3000);
    } else if (data.status === 'error') {
        $('#invalidMessage .toast-body').text(data.message);
        $('#invalidMessage').toast('show');
    }
}

$(document).ready(function() {
    $('.icon-button').on('click', function(event) {
        event.stopImmediatePropagation();
    });
});