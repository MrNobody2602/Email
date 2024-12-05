function changeStatus(id, status) {
    // Show the loading screen immediately
    $('#loadingScreen').removeClass('d-none');

    var minDelay = 1000; 
    var startTime = Date.now();

    $.ajax({
        url: '../dashboardFunctions/update_status.php',
        type: 'POST',
        data: { id: id, status: status },
        dataType: 'json',
        success: function(response) {

            var elapsedTime = Date.now() - startTime;
            var remainingTime = minDelay - elapsedTime;

            if (remainingTime > 0) {
                setTimeout(function() {
                    $('#loadingScreen').addClass('d-none');
                    handleResponse(response);
                }, remainingTime);
            } else {
                
                $('#loadingScreen').addClass('d-none');
                handleResponse(response);
            }
        },
        error: function() {
            $('#loadingScreen').addClass('d-none');

            $('#invalidMessage .toast-body').text('Error: Failed to communicate with the server.');
            $('#invalidMessage').toast('show');
        }
    });
}

function handleResponse(response) {
    if (response.status === 'success') {
        $('#validMessage .toast-body').text(response.message);
        $('#validMessage').toast('show');

        setTimeout(function() {
            if (response.new_status === 'inbox') {
                window.location.href = '?page=inbox'; 
            } else if (response.new_status === 'trash') {
                window.location.href = '?page=trash'; 
            }
        }, 2000);
    } else if (response.status === 'error') {
        // Show the error toast
        $('#invalidMessage .toast-body').text(response.message);
        $('#invalidMessage').toast('show');
    }
}
$(document).ready(function() {
    $('.icon-button').on('click', function(event) {
        event.stopImmediatePropagation();
    });
});