document.addEventListener("DOMContentLoaded", function () {
    const emailModal = new bootstrap.Modal(document.getElementById("emailModal"), { backdrop: 'static' });

    // Mark email as read
    function markEmailAsRead(emailId, row) {
        fetch('../dashboardFunctions/updateReadStatus.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ email_id: emailId })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log("Email marked as read.");
                // Remove glowing border
                row.classList.remove("glowing-border");
                // Update the read status in the table
                row.querySelector("td:last-child").textContent = 'Read';
            } else {
                console.error("Error updating status:", data.error);
            }
        })
        .catch(error => console.error("Fetch error:", error));
    }

    // Handle row click to show email details in the modal
    function handleRowClick(row) {
        row.addEventListener("click", function () {
            const dataAttribute = row.getAttribute("data-email");
            if (!dataAttribute) {
                console.error("Missing data-email attribute");
                return;
            }

            const emailData = JSON.parse(dataAttribute);

            // Populate the modal with email details
            document.getElementById("modal-sender").textContent = emailData.sender_email || emailData.sender;
            document.getElementById("modal-subject").textContent = emailData.subject;
            document.getElementById("modal-message").textContent = emailData.message;
            document.getElementById("modal-date").textContent = emailData.created_at;

            // Show the modal
            emailModal.show();

            // Remove glowing border and mark email as read immediately (before the fetch request)
            if (this.classList.contains('glowing-border')) {
                row.classList.remove("glowing-border");
                row.querySelector("td:last-child").textContent = 'Read'; 
                markEmailAsRead(emailData.id, this);
            }
        });
    }

    // Attach event listeners to existing rows on page load
    const rows = document.querySelectorAll(".view-emailDetails");
    rows.forEach(handleRowClick);
    
    // WebSocket setup to handle incoming emails
    const socket = new WebSocket('ws://localhost:8081/emailing');

    socket.onopen = function(event) {
        console.log("Connected to WebSocket server.");
    };

    socket.onmessage = function(event) {
        const newEmail = JSON.parse(event.data);
        console.log("New message received:", newEmail);

        const noEmailsRow = document.querySelector("#inbox-table tbody tr td[colspan='6']");
        if (noEmailsRow) {
            noEmailsRow.parentElement.remove();
        }

        const table = document.querySelector("#inbox-table tbody");
        const newRow = document.createElement('tr');
        const emailData = JSON.stringify(newEmail);

        newRow.classList.add('view-emailDetails');
        if (!newEmail.read_status) {
            newRow.classList.add('glowing-border');
        }
        newRow.setAttribute('data-email', emailData);

        // Make sure sender_email is correctly accessed
        newRow.innerHTML = `
            <td></td>
            <td>${newEmail.sender_email || newEmail.sender}</td>
            <td>${newEmail.subject}</td>
            <td class='message-cell'>${newEmail.message}</td>
            <td>${newEmail.created_at}</td>
            <td>${newEmail.read_status ? 'Read' : 'Unread'}</td>
        `;

        table.prepend(newRow);

        // Attach click listener to the new email row
        handleRowClick(newRow);
    };

    socket.onclose = function(event) {
        console.log("Disconnected from WebSocket server.");
    };

    socket.onerror = function(error){
        console.log("Websocket error:", error);
    }
});
