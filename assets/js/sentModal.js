// Ensure Bootstrap Modal is shown when clicking on a row
document.querySelectorAll('.view-emailDetails').forEach(row => {
    row.addEventListener('click', function() {
        const emailData = JSON.parse(this.getAttribute('data-email'));

        document.getElementById('modal-recipient').textContent = emailData.recipient_email;
        document.getElementById('modal-subject').textContent = emailData.subject;
        document.getElementById('modal-message').textContent = emailData.message;
        document.getElementById('modal-date').textContent = emailData.created_at;

        var emailModal = new bootstrap.Modal(document.getElementById('emailModal'));
        emailModal.show();
    });
});