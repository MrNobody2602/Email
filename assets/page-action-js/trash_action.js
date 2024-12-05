function changeStatus(id, status) {
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

function deletePermanently(id) {
    $('#loadingScreen').removeClass('d-none');

    var minDelay = 1000;
    var startTime = Date.now();

    if (confirm('Are you sure you want to delete this email permanently?')) {
        $.ajax({
            url: '../dashboardFunctions/permanent_delete.php',
            type: 'POST',
            data: { id: id },
            dataType: 'json',
            success: function(response) {
                var elapsedTime = Date.now() - startTime;
                var remainingTime = minDelay - elapsedTime;
                if (remainingTime > 0) {
                    setTimeout(function() {
                        $('#loadingScreen').addClass('d-none');
                        handleDeleteResponse(response);
                    }, remainingTime);
                } else {
                    
                    $('#loadingScreen').addClass('d-none');
                    handleDeleteResponse(response);
                }
            },
            error: function() {
                $('#loadingScreen').addClass('d-none');

                $('#invalidMessage .toast-body').text('Error: Failed to delete email permanently.');
                $('#invalidMessage').toast('show');
            }
        });
    } else {
        $('#loadingScreen').addClass('d-none');
    }
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
            } else if (response.new_status === 'archive') {
                window.location.href = '?page=archive';
            }
        }, 2000);
    } else if (response.status === 'error') {
        $('#invalidMessage .toast-body').text(response.message);
        $('#invalidMessage').toast('show');
    }
}

function handleDeleteResponse(response) {
    if (response.status === 'success') {
        $('#invalidMessage .toast-body').text('Email permanently deleted.');
        $('#invalidMessage').toast('show');
        setTimeout(function() {
            window.location.href = '?page=trash';
        }, 2000);
    } else if (response.status === 'error') {
        $('#invalidMessage .toast-body').text(response.message);
        $('#invalidMessage').toast('show');
    }
}
$(document).ready(function() {
    $('.icon-button').on('click', function(event) {
        event.stopImmediatePropagation();
    });
});